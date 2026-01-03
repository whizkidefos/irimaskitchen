<?php
/**
 * Payment Functions - Paystack Integration
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize Paystack Payment
 * 
 * @param int $order_id Order ID
 * @param string $email Customer email
 * @param float $amount Order amount
 * @param string $channel Payment channel: 'card' or 'bank_transfer'
 */
function irimas_initialize_paystack_payment($order_id, $email, $amount, $channel = 'card') {
    $is_test_mode = get_option('irimas_paystack_test_mode', '1');
    $secret_key = $is_test_mode ? 
        get_option('irimas_paystack_test_secret_key') : 
        get_option('irimas_paystack_live_secret_key');
    
    if (empty($secret_key)) {
        return array('error' => __('Paystack not configured', 'irimas-kitchen'));
    }
    
    $order_number = get_post_meta($order_id, '_order_number', true);
    $amount_kobo = $amount * 100; // Convert to kobo
    
    $url = 'https://api.paystack.co/transaction/initialize';
    
    $fields = array(
        'email' => $email,
        'amount' => $amount_kobo,
        'reference' => $order_number,
        'callback_url' => home_url('/order-confirmation/?order_id=' . $order_id),
        'metadata' => array(
            'order_id' => $order_id,
            'order_number' => $order_number,
        ),
    );
    
    // Set payment channels based on method
    if ($channel === 'bank_transfer') {
        $fields['channels'] = array('bank_transfer');
    } elseif ($channel === 'card') {
        $fields['channels'] = array('card');
    }
    // If no channel specified, Paystack will show all available options
    
    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $secret_key,
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode($fields),
        'timeout' => 60,
    );
    
    $response = wp_remote_post($url, $args);
    
    if (is_wp_error($response)) {
        return array('error' => $response->get_error_message());
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    if ($body['status']) {
        update_post_meta($order_id, '_paystack_reference', $order_number);
        update_post_meta($order_id, '_payment_channel', $channel);
        return array(
            'authorization_url' => $body['data']['authorization_url'],
            'access_code' => $body['data']['access_code'],
            'reference' => $body['data']['reference'],
        );
    }
    
    return array('error' => $body['message']);
}

/**
 * Verify Paystack Payment
 */
function irimas_verify_paystack_payment($reference) {
    $is_test_mode = get_option('irimas_paystack_test_mode', '1');
    $secret_key = $is_test_mode ? 
        get_option('irimas_paystack_test_secret_key') : 
        get_option('irimas_paystack_live_secret_key');
    
    $url = 'https://api.paystack.co/transaction/verify/' . $reference;
    
    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $secret_key,
        ),
        'timeout' => 60,
    );
    
    $response = wp_remote_get($url, $args);
    
    if (is_wp_error($response)) {
        return false;
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    if ($body['status'] && $body['data']['status'] === 'success') {
        return $body['data'];
    }
    
    return false;
}

/**
 * Handle Paystack Webhook
 */
function irimas_handle_paystack_webhook() {
    $input = file_get_contents('php://input');
    $event = json_decode($input);
    
    if (!$event) {
        http_response_code(400);
        exit();
    }
    
    // Verify webhook signature
    $is_test_mode = get_option('irimas_paystack_test_mode', '1');
    $secret_key = $is_test_mode ? 
        get_option('irimas_paystack_test_secret_key') : 
        get_option('irimas_paystack_live_secret_key');
    
    $signature = $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] ?? '';
    
    if ($signature !== hash_hmac('sha512', $input, $secret_key)) {
        http_response_code(401);
        exit();
    }
    
    // Handle different event types
    if ($event->event === 'charge.success') {
        $reference = $event->data->reference;
        
        // Find order by reference
        $args = array(
            'post_type' => 'order',
            'meta_key' => '_paystack_reference',
            'meta_value' => $reference,
            'posts_per_page' => 1,
        );
        
        $orders = get_posts($args);
        
        if ($orders) {
            $order_id = $orders[0]->ID;
            update_post_meta($order_id, '_order_status', 'processing');
            update_post_meta($order_id, '_payment_status', 'paid');
            update_post_meta($order_id, '_payment_date', current_time('mysql'));
        }
    }
    
    http_response_code(200);
    exit();
}
add_action('wp_ajax_nopriv_irimas_paystack_webhook', 'irimas_handle_paystack_webhook');
add_action('wp_ajax_irimas_paystack_webhook', 'irimas_handle_paystack_webhook');