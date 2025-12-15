<?php
/**
 * Default Page Template
 * 
 * Used for generic pages like Privacy Policy, Terms of Service, etc.
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
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair"><?php the_title(); ?></h1>
            <?php if (has_excerpt()): ?>
                <p class="text-xl opacity-90"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<!-- Page Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                
                <?php if (has_post_thumbnail()): ?>
                    <div class="mb-10 rounded-xl overflow-hidden shadow-lg">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
                    </div>
                <?php endif; ?>
                
                <article class="prose prose-lg max-w-none prose-headings:font-playfair prose-headings:text-irimas-blue prose-a:text-irimas-red prose-a:no-underline hover:prose-a:underline">
                    <?php the_content(); ?>
                </article>
                
                <?php 
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()):
                    comments_template();
                endif;
                ?>
                
            <?php endwhile; endif; ?>
        </div>
    </div>
</section>

<!-- Last Updated -->
<div class="bg-cream-light py-8 border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center text-gray-500 text-sm">
            <?php _e('Last updated:', 'irimas-kitchen'); ?> 
            <time datetime="<?php echo get_the_modified_date('c'); ?>">
                <?php echo get_the_modified_date(); ?>
            </time>
        </div>
    </div>
</div>

<!-- Related Links (Optional) -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="border-t border-gray-200 pt-10">
                <h3 class="text-xl font-bold mb-6 font-playfair text-irimas-blue"><?php _e('Quick Links', 'irimas-kitchen'); ?></h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-3 p-4 rounded-lg bg-cream-light hover:bg-irimas-orange/10 transition group">
                        <svg class="w-5 h-5 text-irimas-blue group-hover:text-irimas-orange transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium text-gray-700"><?php _e('Home', 'irimas-kitchen'); ?></span>
                    </a>
                    <a href="<?php echo home_url('/menu'); ?>" class="flex items-center gap-3 p-4 rounded-lg bg-cream-light hover:bg-irimas-orange/10 transition group">
                        <svg class="w-5 h-5 text-irimas-red group-hover:text-irimas-orange transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="font-medium text-gray-700"><?php _e('Menu', 'irimas-kitchen'); ?></span>
                    </a>
                    <a href="<?php echo home_url('/contact'); ?>" class="flex items-center gap-3 p-4 rounded-lg bg-cream-light hover:bg-irimas-orange/10 transition group">
                        <svg class="w-5 h-5 text-irimas-green group-hover:text-irimas-orange transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium text-gray-700"><?php _e('Contact', 'irimas-kitchen'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
