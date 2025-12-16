<?php
/**
 * Menu Items Archive Template
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-r from-irimas-blue to-irimas-blue/90">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair"><?php _e('Our Menu', 'irimas-kitchen'); ?></h1>
            <p class="text-xl opacity-90"><?php _e('Discover our delicious selection of authentic Nigerian dishes', 'irimas-kitchen'); ?></p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php _e('Menu', 'irimas-kitchen'); ?></span>
        </nav>
    </div>
</div>

<!-- Menu Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <!-- Category Filter -->
        <?php
        $menu_categories = get_terms(array(
            'taxonomy' => 'menu_category',
            'hide_empty' => true,
        ));
        
        if (!empty($menu_categories) && !is_wp_error($menu_categories)):
        ?>
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <a href="<?php echo get_post_type_archive_link('menu_item'); ?>" class="px-6 py-2 rounded-full font-semibold transition <?php echo !is_tax('menu_category') ? 'bg-irimas-red text-white' : 'bg-white text-gray-700 hover:bg-irimas-red hover:text-white shadow'; ?>">
                <?php _e('All', 'irimas-kitchen'); ?>
            </a>
            <?php foreach ($menu_categories as $category): ?>
                <a href="<?php echo get_term_link($category); ?>" class="px-6 py-2 rounded-full font-semibold transition <?php echo (is_tax('menu_category', $category->term_id)) ? 'bg-irimas-red text-white' : 'bg-white text-gray-700 hover:bg-irimas-red hover:text-white shadow'; ?>">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <?php if (have_posts()): ?>
            
            <!-- Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while (have_posts()): the_post(); 
                    $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                    $available = get_post_meta(get_the_ID(), '_menu_item_available', true);
                    $spicy_level = get_post_meta(get_the_ID(), '_menu_item_spicy_level', true);
                    $ingredients = get_post_meta(get_the_ID(), '_menu_item_ingredients', true);
                ?>
                    <article class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 <?php echo ($available !== '1') ? 'opacity-75' : ''; ?>">
                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('irimas-menu-item', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500')); ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <?php if ($available !== '1'): ?>
                                    <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <?php _e('Unavailable', 'irimas-kitchen'); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if ($spicy_level): ?>
                                    <span class="bg-irimas-red text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <?php 
                                        $spicy_icons = array('mild' => '🌶️', 'medium' => '🌶️🌶️', 'hot' => '🌶️🌶️🌶️');
                                        echo isset($spicy_icons[$spicy_level]) ? $spicy_icons[$spicy_level] . ' ' . ucfirst($spicy_level) : '';
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Price Badge -->
                            <?php if ($price): ?>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-irimas-green text-white px-4 py-2 rounded-full font-bold text-lg shadow-lg">
                                        ₦<?php echo number_format($price); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Category -->
                            <?php 
                            $item_categories = get_the_terms(get_the_ID(), 'menu_category');
                            if ($item_categories && !is_wp_error($item_categories)):
                            ?>
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-white/90 backdrop-blur text-irimas-blue px-3 py-1 rounded-full text-xs font-semibold">
                                        <?php echo esc_html($item_categories[0]->name); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 font-playfair text-irimas-blue">
                                <a href="<?php the_permalink(); ?>" class="hover:text-irimas-red transition">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php if (has_excerpt()): ?>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo get_the_excerpt(); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($ingredients): ?>
                                <p class="text-xs text-gray-500 mb-4">
                                    <span class="font-semibold"><?php _e('Ingredients:', 'irimas-kitchen'); ?></span> 
                                    <?php echo esc_html(wp_trim_words($ingredients, 10)); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <a href="<?php the_permalink(); ?>" class="text-irimas-red font-semibold text-sm hover:text-irimas-blue transition">
                                    <?php _e('View Details →', 'irimas-kitchen'); ?>
                                </a>
                                
                                <?php if ($available === '1' && $price): ?>
                                    <button class="add-to-cart-btn bg-irimas-red text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-irimas-blue transition" 
                                            data-id="<?php the_ID(); ?>" 
                                            data-name="<?php echo esc_attr(get_the_title()); ?>" 
                                            data-price="<?php echo esc_attr($price); ?>">
                                        <?php _e('Add to Cart', 'irimas-kitchen'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
                    'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                ));
                ?>
            </div>
            
        <?php else: ?>
            
            <!-- No Items -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <h2 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('No Menu Items Yet', 'irimas-kitchen'); ?></h2>
                <p class="text-gray-600 mb-8"><?php _e('We\'re preparing our menu. Check back soon!', 'irimas-kitchen'); ?></p>
                <a href="<?php echo home_url('/'); ?>" class="btn-primary">
                    <?php _e('Back to Home', 'irimas-kitchen'); ?>
                </a>
            </div>
            
        <?php endif; ?>
        
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-irimas-blue to-irimas-green text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4 font-playfair"><?php _e('Ready to Order?', 'irimas-kitchen'); ?></h2>
            <p class="text-xl opacity-90 mb-8"><?php _e('Place your order now and enjoy authentic Nigerian cuisine!', 'irimas-kitchen'); ?></p>
            <a href="<?php echo home_url('/order'); ?>" class="btn-primary-white text-lg">
                <?php _e('Order Now', 'irimas-kitchen'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
