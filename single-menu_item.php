<?php
/**
 * The template for displaying single menu items
 *
 * @package IrimasKitchen
 */

get_header();

while (have_posts()) : the_post();
    $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
    $available = get_post_meta(get_the_ID(), '_menu_item_available', true);
    $ingredients = get_post_meta(get_the_ID(), '_menu_item_ingredients', true);
    $spicy = get_post_meta(get_the_ID(), '_menu_item_spicy_level', true);
    $image_url = irimas_get_post_image(get_the_ID(), 'full');
    $categories = get_the_terms(get_the_ID(), 'menu_category');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-menu-item py-12 bg-gray-50'); ?>>
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm text-gray-600">
            <a href="<?php echo home_url(); ?>" class="hover:text-irimas-red"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <a href="<?php echo get_post_type_archive_link('menu_item'); ?>" class="hover:text-irimas-red"><?php _e('Menu', 'irimas-kitchen'); ?></a>
            <?php if ($categories && !is_wp_error($categories)): ?>
                <span class="mx-2">/</span>
                <a href="<?php echo get_term_link($categories[0]); ?>" class="hover:text-irimas-red">
                    <?php echo esc_html($categories[0]->name); ?>
                </a>
            <?php endif; ?>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue"><?php the_title(); ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Image Section -->
            <div class="relative">
                <img src="<?php echo esc_url($image_url); ?>" 
                     alt="<?php the_title(); ?>" 
                     class="w-full h-full object-cover">
                
                <?php if ($available !== '1'): ?>
                    <div class="absolute top-6 right-6 bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        <?php _e('Currently Unavailable', 'irimas-kitchen'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($spicy): ?>
                    <div class="absolute top-6 left-6 bg-white px-4 py-2 rounded-full text-sm shadow-lg">
                        <?php echo irimas_get_spicy_level(get_the_ID()); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content Section -->
            <div class="p-8 lg:p-12 flex flex-col justify-between">
                <div>
                    <!-- Category Badge -->
                    <?php if ($categories && !is_wp_error($categories)): ?>
                        <div class="mb-4">
                            <a href="<?php echo get_term_link($categories[0]); ?>" 
                               class="inline-block bg-irimas-cream text-irimas-blue px-4 py-2 rounded-full text-sm font-semibold hover:bg-irimas-blue hover:text-white transition">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-irimas-red">
                            ₦<?php echo number_format($price, 2); ?>
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none mb-6 text-gray-700">
                        <?php the_content(); ?>
                    </div>

                    <!-- Ingredients -->
                    <?php if ($ingredients): ?>
                        <div class="mb-6 bg-irimas-cream p-6 rounded-lg">
                            <h3 class="font-bold text-irimas-blue mb-3 text-lg">
                                <?php _e('Ingredients', 'irimas-kitchen'); ?>
                            </h3>
                            <p class="text-gray-700 text-sm leading-relaxed">
                                <?php echo esc_html($ingredients); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Add to Cart Section -->
                <div class="mt-6">
                    <?php if ($available === '1'): ?>
                        <div class="flex items-center gap-4">
                            <div class="quantity-selector flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                                <button type="button" class="quantity-decrease px-4 py-3 bg-gray-100 hover:bg-gray-200 transition" onclick="updateQuantity(-1)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <input type="number" id="item-quantity" value="1" min="1" max="50" 
                                       class="w-16 text-center py-3 border-x-2 border-gray-300 font-semibold" readonly>
                                <button type="button" class="quantity-increase px-4 py-3 bg-gray-100 hover:bg-gray-200 transition" onclick="updateQuantity(1)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>

                            <button class="add-to-cart flex-1 bg-irimas-red text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-irimas-orange transition transform hover:scale-105 shadow-lg" 
                                    data-id="<?php the_ID(); ?>" 
                                    data-name="<?php echo esc_attr(get_the_title()); ?>" 
                                    data-price="<?php echo esc_attr($price); ?>"
                                    data-image="<?php echo esc_url($image_url); ?>">
                                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <?php _e('Add to Cart', 'irimas-kitchen'); ?>
                            </button>
                        </div>

                        <p class="text-sm text-gray-600 mt-4">
                            <svg class="w-4 h-4 inline-block text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Available for delivery and pickup', 'irimas-kitchen'); ?>
                        </p>
                    <?php else: ?>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <p class="text-yellow-800 font-semibold">
                                <?php _e('This item is currently unavailable. Please check back later or contact us for more information.', 'irimas-kitchen'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Related Items -->
        <?php if ($categories && !is_wp_error($categories)): 
            $related = new WP_Query(array(
                'post_type' => 'menu_item',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'menu_category',
                        'field' => 'term_id',
                        'terms' => $categories[0]->term_id,
                    ),
                ),
            ));

            if ($related->have_posts()): ?>
                <div class="mt-32">
                    <h2 class="text-3xl font-bold mb-8 font-playfair text-irimas-blue text-center">
                        <?php _e('You May Also Like', 'irimas-kitchen'); ?>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php while ($related->have_posts()): $related->the_post(); 
                            $rel_price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                            $rel_available = get_post_meta(get_the_ID(), '_menu_item_available', true);
                            $rel_image = irimas_get_post_image(get_the_ID(), 'irimas-menu-item');
                        ?>
                            <article class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="<?php echo esc_url($rel_image); ?>" 
                                             alt="<?php the_title(); ?>" 
                                             class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                                    </div>
                                </a>

                                <div class="p-6">
                                    <h3 class="text-lg font-bold mb-2 font-playfair text-irimas-blue">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-irimas-red transition">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-irimas-red">
                                            ₦<?php echo number_format($rel_price, 2); ?>
                                        </span>
                                        <a href="<?php the_permalink(); ?>" class="text-irimas-blue hover:text-irimas-red text-sm font-semibold transition">
                                            <?php _e('View Details →', 'irimas-kitchen'); ?>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; 
        endif; ?>
    </div>
</article>

<script>
function updateQuantity(change) {
    const input = document.getElementById('item-quantity');
    let value = parseInt(input.value) + change;
    if (value < 1) value = 1;
    if (value > 50) value = 50;
    input.value = value;
}

// Update add to cart to use quantity
document.addEventListener('DOMContentLoaded', function() {
    const addToCartBtn = document.querySelector('.add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const quantity = parseInt(document.getElementById('item-quantity').value);
            
            // Override the click handler to include quantity
            const event = new CustomEvent('add-to-cart', {
                detail: {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    price: parseFloat(this.dataset.price),
                    image: this.dataset.image,
                    quantity: quantity
                }
            });
            
            // Trigger the existing cart functionality
            addToCart(
                this.dataset.id,
                this.dataset.name,
                parseFloat(this.dataset.price),
                this.dataset.image,
                quantity
            );
        });
    }
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>