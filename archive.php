<?php
/**
 * The template for displaying archive pages
 *
 * @package IrimasKitchen
 */

get_header();
?>

<div class="archive-page py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <header class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue">
                <?php the_archive_title(); ?>
            </h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="text-gray-600 max-w-2xl mx-auto">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="blog-post-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block">
                                <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-64 object-cover')); ?>
                            </a>
                        <?php endif; ?>

                        <div class="p-6">
                            <h2 class="text-2xl font-bold mb-3 font-playfair">
                                <a href="<?php the_permalink(); ?>" class="text-irimas-blue hover:text-irimas-red transition">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <div class="text-sm text-gray-600 mb-4">
                                <?php echo get_the_date(); ?> • <?php _e('By', 'irimas-kitchen'); ?> <?php the_author(); ?>
                            </div>

                            <div class="text-gray-700 mb-4">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="text-irimas-red font-semibold hover:text-irimas-orange transition">
                                <?php _e('Read More →', 'irimas-kitchen'); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600"><?php _e('No posts found.', 'irimas-kitchen'); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="pagination mt-12 flex justify-center items-center space-x-2">
            <?php
            echo paginate_links(array(
                'mid_size'  => 2,
                'prev_text' => '<span class="px-4 py-2 bg-irimas-blue text-white rounded hover:bg-irimas-green transition">← Previous</span>',
                'next_text' => '<span class="px-4 py-2 bg-irimas-blue text-white rounded hover:bg-irimas-green transition">Next →</span>',
                'type'      => 'list',
                'before_page_number' => '<span class="px-4 py-2 bg-gray-200 rounded hover:bg-irimas-red hover:text-white transition">',
                'after_page_number'  => '</span>',
            ));
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
