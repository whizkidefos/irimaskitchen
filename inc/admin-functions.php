<?php
/**
 * Admin Functions and Custom Dashboard
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Custom Admin Dashboard
 */
function irimas_add_admin_dashboard() {
    add_menu_page(
        __('Irima\'s Dashboard', 'irimas-kitchen'),
        __('Irima\'s Dashboard', 'irimas-kitchen'),
        'edit_posts',
        'irimas-dashboard',
        'irimas_render_admin_dashboard',
        'dashicons-admin-home',
        3
    );
    
    add_submenu_page(
        'irimas-dashboard',
        __('Settings', 'irimas-kitchen'),
        __('Settings', 'irimas-kitchen'),
        'manage_options',
        'irimas-settings',
        'irimas_render_settings_page'
    );
}
add_action('admin_menu', 'irimas_add_admin_dashboard');

/**
 * Render Admin Dashboard
 */
function irimas_render_admin_dashboard() {
    // Get statistics
    $total_orders = wp_count_posts('order')->publish;
    $pending_orders = count(get_posts(array(
        'post_type' => 'order',
        'meta_key' => '_order_status',
        'meta_value' => 'pending',
        'posts_per_page' => -1,
    )));
    
    $total_menu_items = wp_count_posts('menu_item')->publish;
    $total_revenue = irimas_calculate_total_revenue();
    $recent_orders = irimas_get_recent_orders(10);
    
    ?>
    <div class="wrap irimas-admin-dashboard">
        <h1><?php _e('Irima\'s Kitchen Dashboard', 'irimas-kitchen'); ?></h1>
        
        <div class="irimas-stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 30px 0;">
            <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px; color: #1F4E79;"><?php _e('Total Orders', 'irimas-kitchen'); ?></h3>
                <p style="font-size: 32px; font-weight: bold; margin: 0; color: #D72638;"><?php echo $total_orders; ?></p>
            </div>
            
            <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px; color: #1F4E79;"><?php _e('Pending Orders', 'irimas-kitchen'); ?></h3>
                <p style="font-size: 32px; font-weight: bold; margin: 0; color: #F49D37;"><?php echo $pending_orders; ?></p>
            </div>
            
            <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px; color: #1F4E79;"><?php _e('Menu Items', 'irimas-kitchen'); ?></h3>
                <p style="font-size: 32px; font-weight: bold; margin: 0; color: #3BB273;"><?php echo $total_menu_items; ?></p>
            </div>
            
            <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px; color: #1F4E79;"><?php _e('Total Revenue', 'irimas-kitchen'); ?></h3>
                <p style="font-size: 32px; font-weight: bold; margin: 0; color: #D72638;">₦<?php echo number_format($total_revenue, 2); ?></p>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-top: 30px;">
            <div class="recent-orders" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2><?php _e('Recent Orders', 'irimas-kitchen'); ?></h2>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th><?php _e('Order #', 'irimas-kitchen'); ?></th>
                            <th><?php _e('Customer', 'irimas-kitchen'); ?></th>
                            <th><?php _e('Total', 'irimas-kitchen'); ?></th>
                            <th><?php _e('Status', 'irimas-kitchen'); ?></th>
                            <th><?php _e('Date', 'irimas-kitchen'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): 
                            $order_number = get_post_meta($order->ID, '_order_number', true);
                            $customer_name = get_post_meta($order->ID, '_customer_name', true);
                            $total = get_post_meta($order->ID, '_order_total', true);
                            $status = get_post_meta($order->ID, '_order_status', true);
                        ?>
                        <tr>
                            <td><a href="<?php echo admin_url('post.php?post=' . $order->ID . '&action=edit'); ?>"><?php echo esc_html($order_number); ?></a></td>
                            <td><?php echo esc_html($customer_name); ?></td>
                            <td>₦<?php echo number_format($total, 2); ?></td>
                            <td><span class="status-badge status-<?php echo esc_attr($status); ?>"><?php echo esc_html(ucfirst($status)); ?></span></td>
                            <td><?php echo get_the_date('', $order); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="quick-stats" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2><?php _e('Quick Stats', 'irimas-kitchen'); ?></h2>
                <canvas id="ordersChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <style>
        .status-badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-processing { background: #DBEAFE; color: #1E40AF; }
        .status-completed { background: #D1FAE5; color: #065F46; }
        .status-cancelled { background: #FEE2E2; color: #991B1B; }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ordersChart');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [
                        <?php echo $pending_orders; ?>,
                        <?php echo irimas_count_orders_by_status('processing'); ?>,
                        <?php echo irimas_count_orders_by_status('completed'); ?>,
                        <?php echo irimas_count_orders_by_status('cancelled'); ?>
                    ],
                    backgroundColor: ['#F49D37', '#1F4E79', '#3BB273', '#D72638']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
    <?php
}

/**
 * Render Settings Page
 */
function irimas_render_settings_page() {
    if (isset($_POST['irimas_save_settings'])) {
        check_admin_referer('irimas_settings_action', 'irimas_settings_nonce');
        
        update_option('irimas_paystack_test_mode', sanitize_text_field($_POST['paystack_test_mode']));
        update_option('irimas_paystack_test_public_key', sanitize_text_field($_POST['paystack_test_public_key']));
        update_option('irimas_paystack_test_secret_key', sanitize_text_field($_POST['paystack_test_secret_key']));
        update_option('irimas_paystack_live_public_key', sanitize_text_field($_POST['paystack_live_public_key']));
        update_option('irimas_paystack_live_secret_key', sanitize_text_field($_POST['paystack_live_secret_key']));
        update_option('irimas_bank_details', sanitize_textarea_field($_POST['bank_details']));
        update_option('irimas_order_notification_emails', sanitize_text_field($_POST['order_notification_emails']));
        update_option('irimas_contact_notification_emails', sanitize_text_field($_POST['contact_notification_emails']));
        
        echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'irimas-kitchen') . '</p></div>';
    }
    
    $test_mode = get_option('irimas_paystack_test_mode', '1');
    $test_public_key = get_option('irimas_paystack_test_public_key', '');
    $test_secret_key = get_option('irimas_paystack_test_secret_key', '');
    $live_public_key = get_option('irimas_paystack_live_public_key', '');
    $live_secret_key = get_option('irimas_paystack_live_secret_key', '');
    $bank_details = get_option('irimas_bank_details', '');
    $order_emails = get_option('irimas_order_notification_emails', get_option('admin_email'));
    $contact_emails = get_option('irimas_contact_notification_emails', get_option('admin_email'));
    ?>
    
    <div class="wrap">
        <h1><?php _e('Irima\'s Kitchen Settings', 'irimas-kitchen'); ?></h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('irimas_settings_action', 'irimas_settings_nonce'); ?>
            
            <h2><?php _e('Paystack Payment Settings', 'irimas-kitchen'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><?php _e('Test Mode', 'irimas-kitchen'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="paystack_test_mode" value="1" <?php checked($test_mode, '1'); ?>>
                            <?php _e('Enable test mode', 'irimas-kitchen'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Test Public Key', 'irimas-kitchen'); ?></th>
                    <td><input type="text" name="paystack_test_public_key" value="<?php echo esc_attr($test_public_key); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><?php _e('Test Secret Key', 'irimas-kitchen'); ?></th>
                    <td><input type="text" name="paystack_test_secret_key" value="<?php echo esc_attr($test_secret_key); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><?php _e('Live Public Key', 'irimas-kitchen'); ?></th>
                    <td><input type="text" name="paystack_live_public_key" value="<?php echo esc_attr($live_public_key); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><?php _e('Live Secret Key', 'irimas-kitchen'); ?></th>
                    <td><input type="text" name="paystack_live_secret_key" value="<?php echo esc_attr($live_secret_key); ?>" class="regular-text"></td>
                </tr>
            </table>
            
            <h2><?php _e('Bank Transfer Details', 'irimas-kitchen'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><?php _e('Bank Details', 'irimas-kitchen'); ?></th>
                    <td>
                        <textarea name="bank_details" rows="5" class="large-text"><?php echo esc_textarea($bank_details); ?></textarea>
                        <p class="description"><?php _e('Enter your bank account details that will be shown to customers who choose bank transfer', 'irimas-kitchen'); ?></p>
                    </td>
                </tr>
            </table>
            
            <h2><?php _e('Notification Settings', 'irimas-kitchen'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><?php _e('Order Notification Emails', 'irimas-kitchen'); ?></th>
                    <td>
                        <input type="text" name="order_notification_emails" value="<?php echo esc_attr($order_emails); ?>" class="regular-text">
                        <p class="description"><?php _e('Comma-separated email addresses to receive order notifications', 'irimas-kitchen'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Contact Form Notification Emails', 'irimas-kitchen'); ?></th>
                    <td>
                        <input type="text" name="contact_notification_emails" value="<?php echo esc_attr($contact_emails); ?>" class="regular-text">
                        <p class="description"><?php _e('Comma-separated email addresses to receive contact form notifications', 'irimas-kitchen'); ?></p>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="irimas_save_settings" class="button button-primary" value="<?php _e('Save Settings', 'irimas-kitchen'); ?>">
            </p>
        </form>
    </div>
    <?php
}

/**
 * Helper Functions
 */
function irimas_calculate_total_revenue() {
    $orders = get_posts(array(
        'post_type' => 'order',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_order_status',
                'value' => array('completed', 'processing'),
                'compare' => 'IN',
            ),
        ),
    ));
    
    $total = 0;
    foreach ($orders as $order) {
        $total += floatval(get_post_meta($order->ID, '_order_total', true));
    }
    
    return $total;
}

function irimas_get_recent_orders($limit = 10) {
    return get_posts(array(
        'post_type' => 'order',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

function irimas_count_orders_by_status($status) {
    return count(get_posts(array(
        'post_type' => 'order',
        'meta_key' => '_order_status',
        'meta_value' => $status,
        'posts_per_page' => -1,
    )));
}

/**
 * Add Order Meta Box
 */
function irimas_add_order_meta_box() {
    add_meta_box(
        'order_details',
        __('Order Details', 'irimas-kitchen'),
        'irimas_order_meta_box_callback',
        'order',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'irimas_add_order_meta_box');

/**
 * Order Meta Box Callback
 */
function irimas_order_meta_box_callback($post) {
    $order_number = get_post_meta($post->ID, '_order_number', true);
    $customer_name = get_post_meta($post->ID, '_customer_name', true);
    $customer_email = get_post_meta($post->ID, '_customer_email', true);
    $customer_phone = get_post_meta($post->ID, '_customer_phone', true);
    $customer_address = get_post_meta($post->ID, '_customer_address', true);
    $order_items = get_post_meta($post->ID, '_order_items', true);
    $order_total = get_post_meta($post->ID, '_order_total', true);
    $payment_method = get_post_meta($post->ID, '_payment_method', true);
    $delivery_option = get_post_meta($post->ID, '_delivery_option', true);
    $order_status = get_post_meta($post->ID, '_order_status', true);
    $special_instructions = get_post_meta($post->ID, '_special_instructions', true);
    ?>
    
    <div class="order-details-meta-box">
        <h3><?php _e('Customer Information', 'irimas-kitchen'); ?></h3>
        <p><strong><?php _e('Name:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_name); ?></p>
        <p><strong><?php _e('Email:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_email); ?></p>
        <p><strong><?php _e('Phone:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_phone); ?></p>
        <p><strong><?php _e('Address:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($customer_address); ?></p>
        
        <h3><?php _e('Order Information', 'irimas-kitchen'); ?></h3>
        <p><strong><?php _e('Order Number:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($order_number); ?></p>
        <p><strong><?php _e('Payment Method:', 'irimas-kitchen'); ?></strong> <?php echo esc_html($payment_method === 'paystack' ? 'Paystack' : 'Bank Transfer'); ?></p>
        <p><strong><?php _e('Delivery Option:', 'irimas-kitchen'); ?></strong> <?php echo esc_html(ucfirst($delivery_option)); ?></p>
        
        <h3><?php _e('Order Items', 'irimas-kitchen'); ?></h3>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('Item', 'irimas-kitchen'); ?></th>
                    <th><?php _e('Price', 'irimas-kitchen'); ?></th>
                    <th><?php _e('Quantity', 'irimas-kitchen'); ?></th>
                    <th><?php _e('Subtotal', 'irimas-kitchen'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo esc_html($item['name']); ?></td>
                    <td>₦<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo esc_html($item['quantity']); ?></td>
                    <td>₦<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right;"><?php _e('Total:', 'irimas-kitchen'); ?></th>
                    <th>₦<?php echo number_format($order_total, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        
        <?php if ($special_instructions): ?>
        <h3><?php _e('Special Instructions', 'irimas-kitchen'); ?></h3>
        <p><?php echo esc_html($special_instructions); ?></p>
        <?php endif; ?>
        
        <h3><?php _e('Order Status', 'irimas-kitchen'); ?></h3>
        <select id="order-status-select" data-order-id="<?php echo $post->ID; ?>">
            <option value="pending" <?php selected($order_status, 'pending'); ?>><?php _e('Pending', 'irimas-kitchen'); ?></option>
            <option value="processing" <?php selected($order_status, 'processing'); ?>><?php _e('Processing', 'irimas-kitchen'); ?></option>
            <option value="completed" <?php selected($order_status, 'completed'); ?>><?php _e('Completed', 'irimas-kitchen'); ?></option>
            <option value="cancelled" <?php selected($order_status, 'cancelled'); ?>><?php _e('Cancelled', 'irimas-kitchen'); ?></option>
        </select>
        <button type="button" id="update-order-status" class="button button-primary"><?php _e('Update Status', 'irimas-kitchen'); ?></button>
        <div id="status-update-message"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#update-order-status').on('click', function() {
            var orderId = $('#order-status-select').data('order-id');
            var status = $('#order-status-select').val();
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'irimas_update_order_status',
                    nonce: '<?php echo wp_create_nonce('irimas-nonce'); ?>',
                    order_id: orderId,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        $('#status-update-message').html('<p style="color: green;">' + response.data.message + '</p>');
                    } else {
                        $('#status-update-message').html('<p style="color: red;">' + response.data.message + '</p>');
                    }
                }
            });
        });
    });
    </script>
    <?php
}