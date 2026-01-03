<?php
/**
 * The template for displaying menu category archives
 *
 * @package IrimasKitchen
 */

get_header();

$term = get_queried_object();
?>

<div class="menu-category-page py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <header class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue">
                <?php echo esc_html($term->name); ?>
            </h1>
            <?php if ($term->description): ?>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    <?php echo esc_html($term->description); ?>
                </p>
            <?php endif; ?>
        </header>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <a href="<?php echo get_post_type_archive_link('menu_item'); ?>" 
               class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-irimas-blue hover:text-white transition">
                <?php _e('All', 'irimas-kitchen'); ?>
            </a>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'menu_category',
                'hide_empty' => true,
            ));
            
            foreach ($categories as $category):
                $is_current = ($category->term_id === $term->term_id);
            ?>
                <a href="<?php echo get_term_link($category); ?>" 
                   class="px-4 py-2 rounded-full <?php echo $is_current ? 'bg-irimas-red text-white' : 'bg-gray-200 text-gray-700 hover:bg-irimas-blue hover:text-white'; ?> transition">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); 
                    $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                    $available = get_post_meta(get_the_ID(), '_menu_item_available', true);
                    $spicy = get_post_meta(get_the_ID(), '_menu_item_spicy_level', true);
                    $image_url = irimas_get_post_image(get_the_ID(), 'irimas-menu-item');
                ?>
                    <article class="menu-item-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all">
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="relative h-64 overflow-hidden">
                                <img src="<?php echo esc_url($image_url); ?>" 
                                     alt="<?php the_title(); ?>" 
                                     class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                                
                                <?php if ($available !== '1'): ?>
                                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        <?php _e('Unavailable', 'irimas-kitchen'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($spicy): ?>
                                    <div class="absolute top-4 left-4 bg-white/90 px-3 py-1 rounded-full text-sm">
                                        <?php echo irimas_get_spicy_level(get_the_ID()); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>

                        <div class="p-6">
                            <a href="<?php the_permalink(); ?>" class="block mb-4">
                                <h2 class="text-xl font-bold mb-2 font-playfair text-irimas-blue hover:text-irimas-red transition">
                                    <?php the_title(); ?>
                                </h2>

                                <p class="text-gray-600 text-sm line-clamp-2">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </p>
                            </a>

                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-irimas-red">
                                    ₦<?php echo number_format($price, 2); ?>
                                </span>
                                
                                <?php if ($available === '1'): ?>
                                    <button class="add-to-cart bg-irimas-blue text-white px-4 py-2 rounded hover:bg-irimas-green transition" 
                                            data-id="<?php the_ID(); ?>" 
                                            data-name="<?php echo esc_attr(get_the_title()); ?>" 
                                            data-price="<?php echo esc_attr($price); ?>"
                                            data-image="<?php echo esc_url($image_url); ?>">
                                        <?php _e('Add to Cart', 'irimas-kitchen'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg"><?php _e('No items in this category yet.', 'irimas-kitchen'); ?></p>
                    <a href="<?php echo get_post_type_archive_link('menu_item'); ?>" class="btn-primary mt-4 inline-block">
                        <?php _e('View All Menu Items', 'irimas-kitchen'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($wp_query->max_num_pages > 1): ?>
            <nav class="pagination mt-12" aria-label="Menu items pagination">
                <?php
                echo paginate_links(array(
                    'mid_size'  => 2,
                    'prev_text' => '← ' . __('Previous', 'irimas-kitchen'),
                    'next_text' => __('Next', 'irimas-kitchen') . ' →',
                    'type'      => 'list',
                    'current'   => max(1, get_query_var('paged')),
                    'total'     => $wp_query->max_num_pages,
                ));
                ?>
            </nav>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>