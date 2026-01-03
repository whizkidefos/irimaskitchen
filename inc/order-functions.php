<?php
/**
 * Order Functions
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Process Order Submission
 */
function irimas_process_order() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $customer_name = sanitize_text_field($_POST['customer_name']);
    $customer_email = sanitize_email($_POST['customer_email']);
    $customer_phone = sanitize_text_field($_POST['customer_phone']);
    $customer_address = sanitize_textarea_field($_POST['customer_address']);
    $order_items = json_decode(stripslashes($_POST['order_items']), true);
    $payment_method = sanitize_text_field($_POST['payment_method']);
    $delivery_option = sanitize_text_field($_POST['delivery_option']);
    $special_instructions = sanitize_textarea_field($_POST['special_instructions']);
    $user_id = get_current_user_id();
    
    // Validate required fields
    if (empty($customer_name) || empty($customer_email) || empty($customer_phone) || empty($order_items)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'irimas-kitchen')));
    }
    
    // Calculate total
    $total = 0;
    foreach ($order_items as $item) {
        $total += floatval($item['price']) * intval($item['quantity']);
    }
    
    // Generate order number
    $order_number = 'IK-' . date('Ymd') . '-' . strtoupper(wp_generate_password(6, false));
    
    // Create order post
    $order_id = wp_insert_post(array(
        'post_type' => 'order',
        'post_title' => $order_number,
        'post_status' => 'publish',
        'post_author' => $user_id ? $user_id : 0,
    ));
    
    if (is_wp_error($order_id)) {
        wp_send_json_error(array('message' => __('Failed to create order.', 'irimas-kitchen')));
    }
    
    // Save order meta
    update_post_meta($order_id, '_order_number', $order_number);
    update_post_meta($order_id, '_customer_name', $customer_name);
    update_post_meta($order_id, '_customer_email', $customer_email);
    update_post_meta($order_id, '_customer_phone', $customer_phone);
    update_post_meta($order_id, '_customer_address', $customer_address);
    update_post_meta($order_id, '_order_items', $order_items);
    update_post_meta($order_id, '_order_total', $total);
    update_post_meta($order_id, '_payment_method', $payment_method);
    update_post_meta($order_id, '_delivery_option', $delivery_option);
    update_post_meta($order_id, '_special_instructions', $special_instructions);
    update_post_meta($order_id, '_order_status', 'pending');
    update_post_meta($order_id, '_order_date', current_time('mysql'));
    
    // Send confirmation emails
    irimas_send_order_confirmation_email($order_id);
    irimas_send_admin_order_notification($order_id);
    
    // Return response based on payment method
    if ($payment_method === 'paystack') {
        $paystack_data = irimas_initialize_paystack_payment($order_id, $customer_email, $total);
        wp_send_json_success(array(
            'order_id' => $order_id,
            'order_number' => $order_number,
            'payment_data' => $paystack_data,
        ));
    } else {
        // Bank transfer
        wp_send_json_success(array(
            'order_id' => $order_id,
            'order_number' => $order_number,
            'payment_method' => 'bank_transfer',
        ));
    }
}
add_action('wp_ajax_irimas_process_order', 'irimas_process_order');
add_action('wp_ajax_nopriv_irimas_process_order', 'irimas_process_order');

/**
 * Send Order Confirmation Email to Customer
 */
function irimas_send_order_confirmation_email($order_id) {
    $order_number = get_post_meta($order_id, '_order_number', true);
    $customer_name = get_post_meta($order_id, '_customer_name', true);
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $order_items = get_post_meta($order_id, '_order_items', true);
    $order_total = get_post_meta($order_id, '_order_total', true);
    $payment_method = get_post_meta($order_id, '_payment_method', true);
    
    $subject = sprintf(__('Order Confirmation - %s', 'irimas-kitchen'), $order_number);
    
    $message = sprintf(__('Dear %s,', 'irimas-kitchen'), $customer_name) . "\n\n";
    $message .= __('Thank you for your order at Irima\'s Kitchen!', 'irimas-kitchen') . "\n\n";
    $message .= sprintf(__('Order Number: %s', 'irimas-kitchen'), $order_number) . "\n";
    $message .= sprintf(__('Total Amount: NGN %s', 'irimas-kitchen'), number_format($order_total, 2)) . "\n\n";
    
    $message .= __('Order Items:', 'irimas-kitchen') . "\n";
    foreach ($order_items as $item) {
        $message .= sprintf("- %s x %d - NGN %s\n", 
            $item['name'], 
            $item['quantity'], 
            number_format($item['price'] * $item['quantity'], 2)
        );
    }
    
    $message .= "\n" . sprintf(__('Payment Method: %s', 'irimas-kitchen'), 
        $payment_method === 'paystack' ? 'Paystack' : 'Bank Transfer') . "\n\n";
    
    if ($payment_method === 'bank_transfer') {
        $bank_details = get_option('irimas_bank_details', '');
        if ($bank_details) {
            $message .= __('Bank Transfer Details:', 'irimas-kitchen') . "\n";
            $message .= $bank_details . "\n\n";
        }
    }
    
    $message .= __('We will process your order and contact you shortly.', 'irimas-kitchen') . "\n\n";
    $message .= __('Best regards,', 'irimas-kitchen') . "\n";
    $message .= __('Irima\'s Kitchen Team', 'irimas-kitchen');
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($customer_email, $subject, $message, $headers);
}

/**
 * Send Order Notification to Admin
 */
function irimas_send_admin_order_notification($order_id) {
    $admin_emails = get_option('irimas_order_notification_emails', get_option('admin_email'));
    $emails = array_map('trim', explode(',', $admin_emails));
    
    $order_number = get_post_meta($order_id, '_order_number', true);
    $customer_name = get_post_meta($order_id, '_customer_name', true);
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $customer_phone = get_post_meta($order_id, '_customer_phone', true);
    $order_total = get_post_meta($order_id, '_order_total', true);
    
    $subject = sprintf(__('New Order Received - %s', 'irimas-kitchen'), $order_number);
    
    $message = __('A new order has been placed on Irima\'s Kitchen.', 'irimas-kitchen') . "\n\n";
    $message .= sprintf(__('Order Number: %s', 'irimas-kitchen'), $order_number) . "\n";
    $message .= sprintf(__('Customer: %s', 'irimas-kitchen'), $customer_name) . "\n";
    $message .= sprintf(__('Email: %s', 'irimas-kitchen'), $customer_email) . "\n";
    $message .= sprintf(__('Phone: %s', 'irimas-kitchen'), $customer_phone) . "\n";
    $message .= sprintf(__('Total: NGN %s', 'irimas-kitchen'), number_format($order_total, 2)) . "\n\n";
    $message .= sprintf(__('View order details: %s', 'irimas-kitchen'), admin_url('post.php?post=' . $order_id . '&action=edit'));
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    foreach ($emails as $email) {
        if (is_email($email)) {
            wp_mail($email, $subject, $message, $headers);
        }
    }
}

/**
 * Get User Orders
 */
function irimas_get_user_orders() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => __('You must be logged in.', 'irimas-kitchen')));
    }
    
    $user_id = get_current_user_id();
    
    $args = array(
        'post_type' => 'order',
        'author' => $user_id,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $orders = get_posts($args);
    $order_data = array();
    
    foreach ($orders as $order) {
        $order_data[] = array(
            'id' => $order->ID,
            'order_number' => get_post_meta($order->ID, '_order_number', true),
            'date' => get_the_date('', $order->ID),
            'total' => get_post_meta($order->ID, '_order_total', true),
            'status' => get_post_meta($order->ID, '_order_status', true),
            'items' => get_post_meta($order->ID, '_order_items', true),
        );
    }
    
    wp_send_json_success($order_data);
}
add_action('wp_ajax_irimas_get_user_orders', 'irimas_get_user_orders');

/**
 * Update Order Status
 */
function irimas_update_order_status() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permission denied.', 'irimas-kitchen')));
    }
    
    $order_id = intval($_POST['order_id']);
    $status = sanitize_text_field($_POST['status']);
    
    $allowed_statuses = array('pending', 'processing', 'completed', 'cancelled');
    
    if (!in_array($status, $allowed_statuses)) {
        wp_send_json_error(array('message' => __('Invalid status.', 'irimas-kitchen')));
    }
    
    $old_status = get_post_meta($order_id, '_order_status', true);
    update_post_meta($order_id, '_order_status', $status);
    
    // Send status change notification email
    if ($old_status !== $status) {
        irimas_send_order_status_email($order_id, $status);
    }
    
    wp_send_json_success(array('message' => __('Order status updated.', 'irimas-kitchen')));
}
add_action('wp_ajax_irimas_update_order_status', 'irimas_update_order_status');

/**
 * Send Order Status Change Email to Customer
 */
function irimas_send_order_status_email($order_id, $new_status) {
    $order_number = get_post_meta($order_id, '_order_number', true);
    $customer_name = get_post_meta($order_id, '_customer_name', true);
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $order_total = get_post_meta($order_id, '_order_total', true);
    
    $status_messages = array(
        'pending' => __('Your order has been received and is awaiting confirmation.', 'irimas-kitchen'),
        'processing' => __('Great news! Your order is now being prepared by our chefs.', 'irimas-kitchen'),
        'completed' => __('Your order has been completed and is ready for pickup/delivery!', 'irimas-kitchen'),
        'cancelled' => __('Your order has been cancelled. If you have any questions, please contact us.', 'irimas-kitchen'),
    );
    
    $subject = sprintf(__('Order Status Update - %s', 'irimas-kitchen'), $order_number);
    
    $message = sprintf(__('Dear %s,', 'irimas-kitchen'), $customer_name) . "\n\n";
    $message .= __('Your order status has been updated:', 'irimas-kitchen') . "\n\n";
    $message .= sprintf(__('Order Number: %s', 'irimas-kitchen'), $order_number) . "\n";
    $message .= sprintf(__('New Status: %s', 'irimas-kitchen'), ucfirst($new_status)) . "\n\n";
    $message .= $status_messages[$new_status] . "\n\n";
    
    if ($new_status === 'completed') {
        $delivery_option = get_post_meta($order_id, '_delivery_option', true);
        if ($delivery_option === 'delivery') {
            $message .= __('Your order will be delivered to your address shortly.', 'irimas-kitchen') . "\n";
        } else {
            $message .= __('Your order is ready for pickup at our location:', 'irimas-kitchen') . "\n";
            $message .= get_theme_mod('irimas_address', 'Lennox Mall, Admiralty Way, Lekki Phase One, Lagos') . "\n";
        }
        $message .= "\n";
    }
    
    $message .= sprintf(__('Order Total: NGN %s', 'irimas-kitchen'), number_format($order_total, 2)) . "\n\n";
    $message .= __('If you have any questions, please contact us:', 'irimas-kitchen') . "\n";
    
    if ($phone = get_theme_mod('irimas_phone')) {
        $message .= sprintf(__('Phone: %s', 'irimas-kitchen'), $phone) . "\n";
    }
    if ($email = get_theme_mod('irimas_email')) {
        $message .= sprintf(__('Email: %s', 'irimas-kitchen'), $email) . "\n";
    }
    
    $message .= "\n" . __('Thank you for choosing Irima\'s Kitchen!', 'irimas-kitchen') . "\n\n";
    $message .= __('Best regards,', 'irimas-kitchen') . "\n";
    $message .= __('Irima\'s Kitchen Team', 'irimas-kitchen');
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($customer_email, $subject, $message, $headers);
}