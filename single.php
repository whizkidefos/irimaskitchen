<?php
/**
 * The template for displaying single blog posts
 *
 * @package IrimasKitchen
 */

get_header();
?>

<div class="single-post py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
                <header class="mb-8">
                    <?php irimas_breadcrumbs(); ?>
                    
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue mt-4">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="flex items-center text-gray-600 text-sm space-x-4">
                        <span><?php echo get_the_date(); ?></span>
                        <span>•</span>
                        <span><?php _e('By', 'irimas-kitchen'); ?> <?php the_author(); ?></span>
                        <span>•</span>
                        <span><?php comments_number(); ?></span>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-8 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('full', array('class' => 'w-full h-auto')); ?>
                    </div>
                <?php endif; ?>

                <div class="prose max-w-none bg-white p-8 rounded-lg shadow-lg">
                    <?php the_content(); ?>
                </div>

                <footer class="mt-8">
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'irimas-kitchen'),
                        'after'  => '</div>',
                    ));
                    ?>
                    
                    <?php if (get_the_tags()) : ?>
                        <div class="mt-6">
                            <?php the_tags('<div class="flex flex-wrap gap-2"><span class="font-semibold mr-2">Tags:</span>', '', '</div>'); ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>