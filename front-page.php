<?php
/**
 * Front Page Template
 * 
 * This template is used when a static page is set as the front page.
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section relative h-screen flex items-center justify-center overflow-hidden">
    <div class="hero-bg absolute inset-0 z-0">
        <?php 
        $hero_image = get_theme_mod('irimas_hero_image');
        if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image); ?>" alt="Hero" class="w-full h-full object-cover">
        <?php else: ?>
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&q=80" alt="Hero" class="w-full h-full object-cover">
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-r from-irimas-blue/80 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-white">
        <div class="max-w-2xl hero-content">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 font-playfair hero-title">
                <?php echo get_theme_mod('irimas_hero_title', __('Welcome to Irima\'s Kitchen', 'irimas-kitchen')); ?>
            </h1>
            <p class="text-xl md:text-2xl mb-4 hero-subtitle">
                <?php _e('We specialize in', 'irimas-kitchen'); ?>
                <span class="rotating-text inline-block text-irimas-orange font-bold" data-words='["Delicious Meals", "Event Catering", "Private Chef Services", "Meals in Bowls", "Authentic Cuisine"]'>
                    <?php _e('Delicious Meals', 'irimas-kitchen'); ?>
                </span>
            </p>
            <p class="text-lg md:text-xl mb-8 opacity-90 hero-tagline">
                <?php echo get_theme_mod('irimas_hero_subtitle', __('Boutique Restaurant and Catering Services', 'irimas-kitchen')); ?>
            </p>
            <div class="flex flex-wrap gap-4 hero-buttons">
                <a href="<?php echo home_url('/menu'); ?>" class="btn-primary text-lg">
                    <?php _e('View Menu', 'irimas-kitchen'); ?>
                </a>
                <a href="<?php echo home_url('/order'); ?>" class="btn-secondary-white text-lg">
                    <?php _e('Order Now', 'irimas-kitchen'); ?>
                </a>
            </div>
        </div>
    </div>
    
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 scroll-indicator">
        <svg class="w-8 h-8 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue section-title">
                <?php _e('Our Services', 'irimas-kitchen'); ?>
            </h2>
            <div class="section-divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                <?php _e('Discover our range of boutique dining and catering services', 'irimas-kitchen'); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 feature-grid">
            <div class="feature-card bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="feature-icon w-16 h-16 bg-irimas-red/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-irimas-blue font-playfair text-center">
                    <?php _e('Meals in Bowls', 'irimas-kitchen'); ?>
                </h3>
                <p class="text-gray-600 text-center">
                    <?php _e('Delicious, nutritious meals served fresh in convenient bowls', 'irimas-kitchen'); ?>
                </p>
            </div>
            
            <div class="feature-card bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="feature-icon w-16 h-16 bg-irimas-orange/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-irimas-blue font-playfair text-center">
                    <?php _e('Event Catering', 'irimas-kitchen'); ?>
                </h3>
                <p class="text-gray-600 text-center">
                    <?php _e('Professional catering for all your special events and occasions', 'irimas-kitchen'); ?>
                </p>
            </div>
            
            <div class="feature-card bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="feature-icon w-16 h-16 bg-irimas-green/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-irimas-blue font-playfair text-center">
                    <?php _e('Delivery & Pickup', 'irimas-kitchen'); ?>
                </h3>
                <p class="text-gray-600 text-center">
                    <?php _e('Convenient delivery and pickup options for your orders', 'irimas-kitchen'); ?>
                </p>
            </div>
            
            <div class="feature-card bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="feature-icon w-16 h-16 bg-irimas-blue/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-irimas-blue font-playfair text-center">
                    <?php _e('Private Chef', 'irimas-kitchen'); ?>
                </h3>
                <p class="text-gray-600 text-center">
                    <?php _e('Personalized chef services for intimate dining experiences', 'irimas-kitchen'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Menu Items -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue">
                <?php _e('Featured Dishes', 'irimas-kitchen'); ?>
            </h2>
            <div class="section-divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                <?php _e('Taste our chef\'s special selections', 'irimas-kitchen'); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 menu-grid">
            <?php
            $featured_items = get_posts(array(
                'post_type' => 'menu_item',
                'posts_per_page' => 6,
                'orderby' => 'rand',
            ));
            
            foreach ($featured_items as $item):
                setup_postdata($item);
                $price = get_post_meta($item->ID, '_menu_item_price', true);
                $available = get_post_meta($item->ID, '_menu_item_available', true);
                $image_url = irimas_get_post_image($item->ID, 'irimas-menu-item');
            ?>
                <div class="menu-item-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all">
                    <div class="relative h-64 overflow-hidden">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo get_the_title($item); ?>" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                        <?php if ($available !== '1'): ?>
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <?php _e('Sold Out', 'irimas-kitchen'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-irimas-blue font-playfair">
                            <?php echo get_the_title($item); ?>
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            <?php echo wp_trim_words(get_the_excerpt($item), 15); ?>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-irimas-red">₦<?php echo number_format($price, 2); ?></span>
                            <?php if ($available === '1'): ?>
                                <button class="add-to-cart btn-primary" data-id="<?php echo $item->ID; ?>" data-name="<?php echo esc_attr(get_the_title($item)); ?>" data-price="<?php echo esc_attr($price); ?>">
                                    <?php _e('Add to Cart', 'irimas-kitchen'); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo home_url('/menu'); ?>" class="btn-secondary text-lg">
                <?php _e('View Full Menu', 'irimas-kitchen'); ?>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-irimas-blue to-irimas-green text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center cta-content">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 font-playfair">
                <?php _e('Ready to Experience Exceptional Cuisine?', 'irimas-kitchen'); ?>
            </h2>
            <p class="text-xl mb-8 opacity-90">
                <?php _e('Order now and enjoy our delicious meals delivered to your doorstep', 'irimas-kitchen'); ?>
            </p>
            <a href="<?php echo home_url('/order'); ?>" class="btn-primary-white text-lg">
                <?php _e('Place Your Order', 'irimas-kitchen'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>