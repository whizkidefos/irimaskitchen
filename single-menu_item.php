<?php
/**
 * Single Menu Item Template
 * 
 * @package IrimasKitchen
 */

get_header();

while (have_posts()): the_post();
    $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
    $available = get_post_meta(get_the_ID(), '_menu_item_available', true);
    $spicy_level = get_post_meta(get_the_ID(), '_menu_item_spicy_level', true);
    $ingredients = get_post_meta(get_the_ID(), '_menu_item_ingredients', true);
    $item_categories = get_the_terms(get_the_ID(), 'menu_category');
?>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <a href="<?php echo get_post_type_archive_link('menu_item'); ?>" class="hover:text-irimas-red transition"><?php _e('Menu', 'irimas-kitchen'); ?></a>
            <?php if ($item_categories && !is_wp_error($item_categories)): ?>
                <span class="mx-2">/</span>
                <a href="<?php echo get_term_link($item_categories[0]); ?>" class="hover:text-irimas-red transition"><?php echo esc_html($item_categories[0]->name); ?></a>
            <?php endif; ?>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<!-- Menu Item Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    
                    <!-- Image Section -->
                    <div class="relative h-80 lg:h-full min-h-[400px]">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('irimas-featured', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red flex items-center justify-center">
                                <svg class="w-24 h-24 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Badges -->
                        <div class="absolute top-6 left-6 flex flex-col gap-2">
                            <?php if ($available !== '1'): ?>
                                <span class="bg-gray-800 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                    <?php _e('Currently Unavailable', 'irimas-kitchen'); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($spicy_level): ?>
                                <span class="bg-irimas-red text-white px-4 py-2 rounded-full text-sm font-semibold">
                                    <?php 
                                    $spicy_icons = array('mild' => '🌶️ Mild', 'medium' => '🌶️🌶️ Medium', 'hot' => '🌶️🌶️🌶️ Hot');
                                    echo isset($spicy_icons[$spicy_level]) ? $spicy_icons[$spicy_level] : '';
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Category Badge -->
                        <?php if ($item_categories && !is_wp_error($item_categories)): ?>
                            <div class="absolute bottom-6 left-6">
                                <a href="<?php echo get_term_link($item_categories[0]); ?>" class="bg-white/90 backdrop-blur text-irimas-blue px-4 py-2 rounded-full text-sm font-semibold hover:bg-irimas-red hover:text-white transition">
                                    <?php echo esc_html($item_categories[0]->name); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Details Section -->
                    <div class="p-8 lg:p-12 flex flex-col">
                        <div class="flex-1">
                            <h1 class="text-3xl lg:text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                                <?php the_title(); ?>
                            </h1>
                            
                            <?php if ($price): ?>
                                <div class="mb-6">
                                    <span class="text-4xl font-bold text-irimas-green">₦<?php echo number_format($price); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="prose prose-lg max-w-none text-gray-600 mb-8">
                                <?php the_content(); ?>
                            </div>
                            
                            <?php if ($ingredients): ?>
                                <div class="mb-8">
                                    <h3 class="text-lg font-bold mb-3 font-playfair text-irimas-blue"><?php _e('Ingredients', 'irimas-kitchen'); ?></h3>
                                    <div class="flex flex-wrap gap-2">
                                        <?php 
                                        $ingredient_list = explode(',', $ingredients);
                                        foreach ($ingredient_list as $ingredient): 
                                            $ingredient = trim($ingredient);
                                            if ($ingredient):
                                        ?>
                                            <span class="bg-cream-light text-gray-700 px-3 py-1 rounded-full text-sm">
                                                <?php echo esc_html($ingredient); ?>
                                            </span>
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Nutritional Info Placeholder -->
                            <div class="grid grid-cols-3 gap-4 mb-8 p-4 bg-gray-50 rounded-xl">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-irimas-blue">30-45</div>
                                    <div class="text-xs text-gray-500"><?php _e('Prep Time (min)', 'irimas-kitchen'); ?></div>
                                </div>
                                <div class="text-center border-x border-gray-200">
                                    <div class="text-2xl font-bold text-irimas-orange">1-2</div>
                                    <div class="text-xs text-gray-500"><?php _e('Servings', 'irimas-kitchen'); ?></div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-irimas-green">Fresh</div>
                                    <div class="text-xs text-gray-500"><?php _e('Made Daily', 'irimas-kitchen'); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Order Actions -->
                        <div class="border-t border-gray-200 pt-6">
                            <?php if ($available === '1' && $price): ?>
                                <div class="flex items-center gap-4 mb-4">
                                    <label class="text-sm font-medium text-gray-700"><?php _e('Quantity:', 'irimas-kitchen'); ?></label>
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" class="qty-minus px-3 py-2 text-gray-600 hover:text-irimas-red transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" class="qty-input w-16 text-center border-x border-gray-300 py-2 focus:outline-none" value="1" min="1" max="10">
                                        <button type="button" class="qty-plus px-3 py-2 text-gray-600 hover:text-irimas-green transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <button class="add-to-cart-btn w-full bg-irimas-red text-white py-4 rounded-xl font-bold text-lg hover:bg-irimas-blue transition flex items-center justify-center gap-2"
                                        data-id="<?php the_ID(); ?>" 
                                        data-name="<?php echo esc_attr(get_the_title()); ?>" 
                                        data-price="<?php echo esc_attr($price); ?>">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <?php _e('Add to Cart', 'irimas-kitchen'); ?>
                                </button>
                            <?php else: ?>
                                <button class="w-full bg-gray-400 text-white py-4 rounded-xl font-bold text-lg cursor-not-allowed" disabled>
                                    <?php _e('Currently Unavailable', 'irimas-kitchen'); ?>
                                </button>
                            <?php endif; ?>
                            
                            <a href="<?php echo home_url('/order'); ?>" class="block text-center mt-4 text-irimas-blue hover:text-irimas-red transition font-medium">
                                <?php _e('View Full Menu & Order →', 'irimas-kitchen'); ?>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Items -->
<?php
if ($item_categories && !is_wp_error($item_categories)):
    $related_items = get_posts(array(
        'post_type' => 'menu_item',
        'posts_per_page' => 4,
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'menu_category',
                'field' => 'term_id',
                'terms' => $item_categories[0]->term_id,
            ),
        ),
    ));
    
    if ($related_items):
?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold mb-8 font-playfair text-irimas-blue text-center"><?php _e('You May Also Like', 'irimas-kitchen'); ?></h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($related_items as $item): 
                    $item_price = get_post_meta($item->ID, '_menu_item_price', true);
                    $item_available = get_post_meta($item->ID, '_menu_item_available', true);
                ?>
                    <article class="bg-gray-50 rounded-xl overflow-hidden group hover:shadow-lg transition">
                        <div class="relative h-40 overflow-hidden">
                            <?php if (has_post_thumbnail($item)): ?>
                                <?php echo get_the_post_thumbnail($item, 'irimas-thumbnail', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform')); ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red"></div>
                            <?php endif; ?>
                            
                            <?php if ($item_price): ?>
                                <div class="absolute top-2 right-2">
                                    <span class="bg-irimas-green text-white px-2 py-1 rounded-full text-sm font-bold">
                                        ₦<?php echo number_format($item_price); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-irimas-blue mb-2 line-clamp-1">
                                <a href="<?php echo get_permalink($item); ?>" class="hover:text-irimas-red transition">
                                    <?php echo get_the_title($item); ?>
                                </a>
                            </h3>
                            <a href="<?php echo get_permalink($item); ?>" class="text-sm text-irimas-red hover:text-irimas-blue transition">
                                <?php _e('View Details →', 'irimas-kitchen'); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<!-- Quantity Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.querySelector('.qty-input');
    const qtyMinus = document.querySelector('.qty-minus');
    const qtyPlus = document.querySelector('.qty-plus');
    
    if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', function() {
            let val = parseInt(qtyInput.value) || 1;
            if (val > 1) {
                qtyInput.value = val - 1;
            }
        });
        
        qtyPlus.addEventListener('click', function() {
            let val = parseInt(qtyInput.value) || 1;
            if (val < 10) {
                qtyInput.value = val + 1;
            }
        });
    }
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
