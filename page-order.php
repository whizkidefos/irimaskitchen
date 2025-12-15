<?php
/**
 * Template Name: Order Page
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<div class="order-page py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-12 font-playfair text-irimas-blue">
            <?php _e('Place Your Order', 'irimas-kitchen'); ?>
        </h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Menu Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                        <?php _e('Our Menu', 'irimas-kitchen'); ?>
                    </h2>
                    
                    <!-- Category filter -->
                    <div class="flex flex-wrap gap-2 mb-6" id="category-filter">
                        <button class="category-btn active px-4 py-2 rounded-full bg-irimas-red text-white" data-category="all">
                            <?php _e('All', 'irimas-kitchen'); ?>
                        </button>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'menu_category',
                            'hide_empty' => true,
                        ));
                        
                        foreach ($categories as $category):
                        ?>
                            <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-irimas-blue hover:text-white transition" data-category="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Menu items grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="menu-items-grid">
                        <?php
                        $menu_items = get_posts(array(
                            'post_type' => 'menu_item',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));
                        
                        foreach ($menu_items as $item):
                            $price = get_post_meta($item->ID, '_menu_item_price', true);
                            $available = get_post_meta($item->ID, '_menu_item_available', true);
                            $image_url = irimas_get_post_image($item->ID, 'irimas-menu-item');
                            $terms = get_the_terms($item->ID, 'menu_category');
                            $category_slug = $terms ? $terms[0]->slug : '';
                        ?>
                            <div class="menu-item-card bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition" data-category="<?php echo esc_attr($category_slug); ?>">
                                <div class="flex">
                                    <div class="w-32 h-32 flex-shrink-0">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo get_the_title($item); ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4 flex-1 flex flex-col">
                                        <h3 class="font-bold text-irimas-blue mb-1"><?php echo get_the_title($item); ?></h3>
                                        <p class="text-sm text-gray-600 mb-2 flex-1"><?php echo wp_trim_words(get_the_excerpt($item), 10); ?></p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-lg font-bold text-irimas-red">₦<?php echo number_format($price, 2); ?></span>
                                            <?php if ($available === '1'): ?>
                                                <button class="add-to-cart-btn bg-irimas-blue text-white px-3 py-1 rounded text-sm hover:bg-irimas-green transition" 
                                                        data-id="<?php echo $item->ID; ?>" 
                                                        data-name="<?php echo esc_attr(get_the_title($item)); ?>" 
                                                        data-price="<?php echo esc_attr($price); ?>"
                                                        data-image="<?php echo esc_url($image_url); ?>">
                                                    + Add
                                                </button>
                                            <?php else: ?>
                                                <span class="text-sm text-gray-500"><?php _e('Unavailable', 'irimas-kitchen'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Cart Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24" id="cart-sidebar">
                    <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                        <?php _e('Your Order', 'irimas-kitchen'); ?>
                    </h2>
                    
                    <div id="cart-items" class="mb-6 max-h-96 overflow-y-auto">
                        <p class="text-gray-500 text-center py-8" id="empty-cart-message">
                            <?php _e('Your cart is empty', 'irimas-kitchen'); ?>
                        </p>
                    </div>
                    
                    <div class="border-t pt-4 mb-6" id="cart-total-section" style="display: none;">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold"><?php _e('Subtotal:', 'irimas-kitchen'); ?></span>
                            <span class="font-bold text-irimas-red" id="cart-subtotal">₦0.00</span>
                        </div>
                    </div>
                    
                    <button id="checkout-btn" class="w-full btn-primary" style="display: none;">
                        <?php _e('Proceed to Checkout', 'irimas-kitchen'); ?>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Checkout Modal -->
        <div id="checkout-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-3xl font-bold font-playfair text-irimas-blue">
                            <?php _e('Checkout', 'irimas-kitchen'); ?>
                        </h2>
                        <button id="close-checkout-modal" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="checkout-form">
                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="form-label"><?php _e('Full Name *', 'irimas-kitchen'); ?></label>
                                <input type="text" name="customer_name" class="form-input" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label"><?php _e('Email *', 'irimas-kitchen'); ?></label>
                                    <input type="email" name="customer_email" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label"><?php _e('Phone *', 'irimas-kitchen'); ?></label>
                                    <input type="tel" name="customer_phone" class="form-input" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label"><?php _e('Delivery Address *', 'irimas-kitchen'); ?></label>
                                <textarea name="customer_address" class="form-textarea" rows="3" required></textarea>
                            </div>
                            
                            <div>
                                <label class="form-label"><?php _e('Delivery Option *', 'irimas-kitchen'); ?></label>
                                <select name="delivery_option" class="form-select" required>
                                    <option value="delivery"><?php _e('Delivery', 'irimas-kitchen'); ?></option>
                                    <option value="pickup"><?php _e('Pickup', 'irimas-kitchen'); ?></option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label"><?php _e('Payment Method *', 'irimas-kitchen'); ?></label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="paystack"><?php _e('Pay with Paystack (Card)', 'irimas-kitchen'); ?></option>
                                    <option value="bank_transfer"><?php _e('Bank Transfer', 'irimas-kitchen'); ?></option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label"><?php _e('Special Instructions (Optional)', 'irimas-kitchen'); ?></label>
                                <textarea name="special_instructions" class="form-textarea" rows="3" placeholder="<?php _e('Any special requests?', 'irimas-kitchen'); ?>"></textarea>
                            </div>
                        </div>
                        
                        <div class="bg-gray-100 p-4 rounded-lg mb-6">
                            <h3 class="font-bold mb-2"><?php _e('Order Summary', 'irimas-kitchen'); ?></h3>
                            <div id="checkout-summary"></div>
                            <div class="border-t border-gray-300 mt-2 pt-2">
                                <div class="flex justify-between font-bold text-lg">
                                    <span><?php _e('Total:', 'irimas-kitchen'); ?></span>
                                    <span class="text-irimas-red" id="checkout-total">₦0.00</span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full btn-primary text-lg">
                            <?php _e('Place Order', 'irimas-kitchen'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>