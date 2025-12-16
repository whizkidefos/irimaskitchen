<?php
/**
 * Single Post Template
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<!-- Article Header with Featured Image -->
<?php while (have_posts()) : the_post(); ?>

<?php if (has_post_thumbnail()) : ?>
<section class="relative h-[50vh] min-h-[400px] max-h-[600px] overflow-hidden">
    <div class="absolute inset-0">
        <?php the_post_thumbnail('irimas-featured', array('class' => 'w-full h-full object-cover')); ?>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 p-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl">
                <?php if (has_category()): ?>
                    <div class="mb-4">
                        <?php 
                        $categories = get_the_category();
                        if ($categories): ?>
                            <a href="<?php echo get_category_link($categories[0]->term_id); ?>" class="inline-block bg-irimas-red text-white px-4 py-1 rounded-full text-sm font-semibold hover:bg-irimas-orange transition">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white font-playfair leading-tight mb-4">
                    <?php the_title(); ?>
                </h1>
                <div class="flex items-center text-white/90">
                    <span class="font-medium"><?php _e('By', 'irimas-kitchen'); ?> <?php the_author(); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="relative py-20 bg-gradient-to-r from-irimas-blue to-irimas-blue/90">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl">
            <?php if (has_category()): ?>
                <div class="mb-4">
                    <?php 
                    $categories = get_the_category();
                    if ($categories): ?>
                        <a href="<?php echo get_category_link($categories[0]->term_id); ?>" class="inline-block bg-irimas-red text-white px-4 py-1 rounded-full text-sm font-semibold hover:bg-irimas-orange transition">
                            <?php echo esc_html($categories[0]->name); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white font-playfair leading-tight mb-4">
                <?php the_title(); ?>
            </h1>
            <div class="flex items-center text-white/90">
                <span class="font-medium"><?php _e('By', 'irimas-kitchen'); ?> <?php the_author(); ?></span>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-irimas-red transition"><?php _e('Blog', 'irimas-kitchen'); ?></a>
            <?php if (has_category()): ?>
                <span class="mx-2">/</span>
                <?php 
                $categories = get_the_category();
                if ($categories): ?>
                    <a href="<?php echo get_category_link($categories[0]->term_id); ?>" class="hover:text-irimas-red transition"><?php echo esc_html($categories[0]->name); ?></a>
                <?php endif; ?>
            <?php endif; ?>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<!-- Article Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Main Content -->
            <article class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    
                    <!-- Article Body -->
                    <div class="p-8 md:p-12">
                        <div class="prose prose-lg max-w-none prose-headings:font-playfair prose-headings:text-irimas-blue prose-a:text-irimas-red prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-blockquote:border-irimas-red prose-blockquote:bg-cream-light prose-blockquote:py-1 prose-blockquote:px-4 prose-blockquote:rounded-r-lg">
                            <?php the_content(); ?>
                        </div>
                        
                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links mt-8 pt-6 border-t border-gray-200"><span class="font-semibold mr-2">' . __('Pages:', 'irimas-kitchen') . '</span>',
                            'after'  => '</div>',
                            'link_before' => '<span class="inline-block px-3 py-1 bg-irimas-red text-white rounded mx-1">',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>
                    
                    <!-- Tags -->
                    <?php if (has_tag()): ?>
                    <div class="px-8 md:px-12 pb-8">
                        <div class="flex flex-wrap items-center gap-2 pt-6 border-t border-gray-200">
                            <span class="text-gray-500 font-medium"><?php _e('Tags:', 'irimas-kitchen'); ?></span>
                            <?php
                            $tags = get_the_tags();
                            foreach ($tags as $tag): ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-irimas-red hover:text-white transition">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Author Box -->
                    <div class="px-8 md:px-12 pb-8">
                        <div class="bg-cream-light rounded-xl p-6 flex flex-col sm:flex-row gap-4 items-center sm:items-start">
                            <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 ring-4 ring-white shadow-lg">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80, '', get_the_author(), array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-sm text-gray-500 mb-1"><?php _e('Written by', 'irimas-kitchen'); ?></p>
                                <h4 class="text-xl font-bold font-playfair text-irimas-blue mb-2"><?php the_author(); ?></h4>
                                <?php if (get_the_author_meta('description')): ?>
                                    <p class="text-gray-600 text-sm"><?php echo get_the_author_meta('description'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Post Navigation -->
                    <div class="px-8 md:px-12 pb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>
                            
                            <?php if ($prev_post): ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="group flex items-center gap-3 p-4 bg-gray-50 rounded-xl hover:bg-irimas-blue transition">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <div>
                                    <span class="text-xs text-gray-500 group-hover:text-white/70 transition"><?php _e('Previous', 'irimas-kitchen'); ?></span>
                                    <p class="font-semibold text-gray-800 group-hover:text-white transition line-clamp-1"><?php echo get_the_title($prev_post); ?></p>
                                </div>
                            </a>
                            <?php else: ?>
                            <div></div>
                            <?php endif; ?>
                            
                            <?php if ($next_post): ?>
                            <a href="<?php echo get_permalink($next_post); ?>" class="group flex items-center justify-end gap-3 p-4 bg-gray-50 rounded-xl hover:bg-irimas-blue transition text-right">
                                <div>
                                    <span class="text-xs text-gray-500 group-hover:text-white/70 transition"><?php _e('Next', 'irimas-kitchen'); ?></span>
                                    <p class="font-semibold text-gray-800 group-hover:text-white transition line-clamp-1"><?php echo get_the_title($next_post); ?></p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Comments Section -->
                <?php if (comments_open() || get_comments_number()): ?>
                <div class="mt-10">
                    <?php comments_template(); ?>
                </div>
                <?php endif; ?>
                
            </article>
            
            <!-- Sidebar -->
            <aside class="lg:w-1/3">
                <div class="sticky top-24 space-y-8">
                    
                    <!-- Related Posts -->
                    <?php
                    $categories = get_the_category();
                    if ($categories):
                        $related_posts = get_posts(array(
                            'category__in' => array($categories[0]->term_id),
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                        ));
                        
                        if ($related_posts):
                    ?>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue border-b border-gray-200 pb-2"><?php _e('Related Articles', 'irimas-kitchen'); ?></h3>
                        <ul class="space-y-4">
                            <?php foreach ($related_posts as $post): setup_postdata($post); ?>
                                <li class="flex gap-3 group">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                                        <?php if (has_post_thumbnail($post)): ?>
                                            <?php echo get_the_post_thumbnail($post, 'thumbnail', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform')); ?>
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <a href="<?php the_permalink(); ?>" class="text-sm font-semibold text-gray-800 hover:text-irimas-red transition line-clamp-2">
                                            <?php the_title(); ?>
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1"><?php _e('By', 'irimas-kitchen'); ?> <?php the_author(); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endif; endif; ?>
                    
                    <!-- Categories Widget -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue border-b border-gray-200 pb-2"><?php _e('Categories', 'irimas-kitchen'); ?></h3>
                        <ul class="space-y-3">
                            <?php
                            $all_categories = get_categories(array('hide_empty' => true));
                            foreach ($all_categories as $category):
                            ?>
                                <li>
                                    <a href="<?php echo get_category_link($category->term_id); ?>" class="flex items-center justify-between text-gray-600 hover:text-irimas-red transition group">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full group-hover:bg-irimas-red group-hover:text-white transition">
                                            <?php echo $category->count; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Newsletter Widget -->
                    <div class="bg-gradient-to-br from-irimas-blue to-irimas-green rounded-xl shadow-lg p-6 text-white">
                        <h3 class="text-lg font-bold mb-2 font-playfair"><?php _e('Newsletter', 'irimas-kitchen'); ?></h3>
                        <p class="text-sm opacity-90 mb-4"><?php _e('Subscribe for recipes, tips, and exclusive offers!', 'irimas-kitchen'); ?></p>
                        <form class="space-y-3">
                            <input type="email" placeholder="<?php _e('Your email address', 'irimas-kitchen'); ?>" class="w-full px-4 py-3 rounded-lg text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-white/50 outline-none">
                            <button type="submit" class="w-full bg-white text-irimas-blue font-semibold py-3 rounded-lg hover:bg-irimas-orange hover:text-white transition">
                                <?php _e('Subscribe', 'irimas-kitchen'); ?>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Dynamic Sidebar Widgets -->
                    <?php if (is_active_sidebar('blog-sidebar')): ?>
                        <?php dynamic_sidebar('blog-sidebar'); ?>
                    <?php endif; ?>
                    
                </div>
            </aside>
            
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
