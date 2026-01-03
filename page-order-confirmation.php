<?php
/**
 * Template Name: Order Confirmation
 * 
 * @package IrimasKitchen
 */

get_header();

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if (!$order_id) {
    wp_redirect(home_url('/'));
    exit;
}

// Get order details
$order_number = get_post_meta($order_id, '_order_number', true);
$customer_name = get_post_meta($order_id, '_customer_name', true);
$customer_email = get_post_meta($order_id, '_customer_email', true);
$customer_phone = get_post_meta($order_id, '_customer_phone', true);
$customer_address = get_post_meta($order_id, '_customer_address', true);
$order_items = get_post_meta($order_id, '_order_items', true);
$order_total = get_post_meta($order_id, '_order_total', true);
$payment_method = get_post_meta($order_id, '_payment_method', true);
$delivery_option = get_post_meta($order_id, '_delivery_option', true);
$order_status = get_post_meta($order_id, '_order_status', true);
$order_date = get_post_meta($order_id, '_order_date', true);

// Verify payment if Paystack
$payment_verified = false;
if ($payment_method === 'paystack' && isset($_GET['reference'])) {
    $reference = sanitize_text_field($_GET['reference']);
    $verification = irimas_verify_paystack_payment($reference);
    
    if ($verification) {
        update_post_meta($order_id, '_payment_status', 'paid');
        update_post_meta($order_id, '_order_status', 'processing');
        $payment_verified = true;
        $order_status = 'processing';
    }
}
?>

<div class="order-confirmation-page py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            
            <!-- Success Message -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8 text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                    <?php _e('Order Confirmed!', 'irimas-kitchen'); ?>
                </h1>
                
                <p class="text-gray-600 mb-6">
                    <?php _e('Thank you for your order. We\'ve received it and will start preparing your delicious meal.', 'irimas-kitchen'); ?>
                </p>
                
                <div class="bg-irimas-cream p-4 rounded-lg inline-block">
                    <p class="text-sm text-gray-600 mb-1"><?php _e('Order Number', 'irimas-kitchen'); ?></p>
                    <p class="text-2xl font-bold text-irimas-red"><?php echo esc_html($order_number); ?></p>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                    <?php _e('Order Details', 'irimas-kitchen'); ?>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-semibold text-irimas-blue mb-2"><?php _e('Customer Information', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><strong><?php _e('Name:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_name); ?></p>
                        <p class="text-gray-600"><strong><?php _e('Email:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_email); ?></p>
                        <p class="text-gray-600"><strong><?php _e('Phone:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_phone); ?></p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-irimas-blue mb-2"><?php _e('Delivery Information', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><strong><?php _e('Option:', 'irimas-kitchen'); ?></strong> <?php echo esc_html(ucfirst($delivery_option)); ?></p>
                        <?php if ($delivery_option === 'delivery'): ?>
                            <p class="text-gray-600"><strong><?php _e('Address:', 'irimas-kitchen'); ?></strong><br><?php echo esc_html($customer_address); ?></p>
                        <?php endif; ?>
                        <p class="text-gray-600"><strong><?php _e('Date:', 'irimas-kitchen'); ?></strong> <?php echo date('F j, Y, g:i a', strtotime($order_date)); ?></p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="border-t pt-6">
                    <h3 class="font-semibold text-irimas-blue mb-4"><?php _e('Order Items', 'irimas-kitchen'); ?></h3>
                    
                    <div class="space-y-4">
                        <?php foreach ($order_items as $item): ?>
                            <div class="flex items-center justify-between py-3 border-b">
                                <div class="flex-1">
                                    <p class="font-semibold"><?php echo esc_html($item['name']); ?></p>
                                    <p class="text-sm text-gray-600"><?php _e('Quantity:', 'irimas-kitchen'); ?> <?php echo esc_html($item['quantity']); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-irimas-red">₦<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                                    <p class="text-sm text-gray-600">₦<?php echo number_format($item['price'], 2); ?> each</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <div class="flex justify-between items-center text-xl font-bold">
                            <span class="text-irimas-blue"><?php _e('Total:', 'irimas-kitchen'); ?></span>
                            <span class="text-irimas-red">₦<?php echo number_format($order_total, 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                    <?php _e('Payment Information', 'irimas-kitchen'); ?>
                </h2>
                
                <?php if ($payment_method === 'paystack'): ?>
                    <?php if ($payment_verified): ?>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-green-800"><?php _e('Payment Successful', 'irimas-kitchen'); ?></p>
                                <p class="text-sm text-green-700"><?php _e('Your payment has been confirmed. We will start preparing your order.', 'irimas-kitchen'); ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-start">
                            <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-yellow-800"><?php _e('Payment Pending', 'irimas-kitchen'); ?></p>
                                <p class="text-sm text-yellow-700"><?php _e('Waiting for payment confirmation. This may take a few minutes.', 'irimas-kitchen'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="font-semibold text-blue-800 mb-3"><?php _e('Bank Transfer Details', 'irimas-kitchen'); ?></h3>
                        <div class="text-sm text-blue-700 mb-4 whitespace-pre-line"><?php echo esc_html(get_option('irimas_bank_details', '')); ?></div>
                        <p class="text-sm text-blue-700 font-semibold">
                            <?php _e('Please use your order number as payment reference:', 'irimas-kitchen'); ?> 
                            <span class="text-blue-900"><?php echo esc_html($order_number); ?></span>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Order Status -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                    <?php _e('Order Status', 'irimas-kitchen'); ?>
                </h2>
                
                <div class="flex items-center justify-center">
                    <span class="status-badge status-<?php echo esc_attr($order_status); ?> text-lg px-6 py-3">
                        <?php echo esc_html(irimas_format_order_status($order_status)); ?>
                    </span>
                </div>
                
                <p class="text-center text-gray-600 mt-4">
                    <?php _e('We will notify you via email and SMS when your order status changes.', 'irimas-kitchen'); ?>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo home_url('/'); ?>" class="btn-secondary text-center">
                    <?php _e('Continue Shopping', 'irimas-kitchen'); ?>
                </a>
                
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo home_url('/profile/'); ?>" class="btn-primary text-center">
                        <?php _e('View All Orders', 'irimas-kitchen'); ?>
                    </a>
                <?php endif; ?>
                
                <button onclick="window.print()" class="btn-secondary text-center">
                    <?php _e('Print Receipt', 'irimas-kitchen'); ?>
                </button>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center text-gray-600 text-sm">
                <p><?php _e('A confirmation email has been sent to', 'irimas-kitchen'); ?> <strong><?php echo esc_html($customer_email); ?></strong></p>
                <p class="mt-2">
                    <?php _e('Questions? Contact us at', 'irimas-kitchen'); ?> 
                    <a href="tel:<?php echo esc_attr(get_theme_mod('irimas_phone')); ?>" class="text-irimas-red hover:text-irimas-orange">
                        <?php echo esc_html(get_theme_mod('irimas_phone')); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .site-header,
        .site-footer,
        button,
        .no-print {
            display: none !important;
        }
    }
</style>

<?php get_footer(); ?>