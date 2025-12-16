<?php
/**
 * Blog Index Template
 * 
 * Displays the blog posts listing with sidebar
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<!-- Blog Header -->
<section class="relative py-20 bg-gradient-to-r from-irimas-blue to-irimas-blue/90">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair"><?php _e('Our Blog', 'irimas-kitchen'); ?></h1>
            <p class="text-xl opacity-90"><?php _e('Recipes, tips, and stories from our kitchen to yours', 'irimas-kitchen'); ?></p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php _e('Blog', 'irimas-kitchen'); ?></span>
        </nav>
    </div>
</div>

<!-- Blog Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Main Content -->
            <main class="lg:w-2/3">
                <?php if (have_posts()): ?>
                    
                    <!-- Featured Post (First Post) -->
                    <?php if (!is_paged()): ?>
                        <?php rewind_posts(); ?>
                        <?php if (have_posts()): the_post(); ?>
                            <article class="featured-post bg-white rounded-2xl shadow-xl overflow-hidden mb-10 group">
                                <div class="relative h-80 overflow-hidden">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('irimas-featured', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-irimas-blue to-irimas-green flex items-center justify-center">
                                            <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-irimas-red text-white px-4 py-1 rounded-full text-sm font-semibold">
                                            <?php _e('Featured', 'irimas-kitchen'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8">
                                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <?php the_author(); ?>
                                        </span>
                                        <?php if (has_category()): ?>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="text-2xl md:text-3xl font-bold mb-4 font-playfair text-irimas-blue">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-irimas-red transition"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="text-gray-600 mb-6 leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-irimas-red font-semibold hover:gap-3 transition-all">
                                        <?php _e('Read More', 'irimas-kitchen'); ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <!-- Blog Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <?php 
                        $post_count = 0;
                        while (have_posts()): the_post(); 
                            // Skip first post on first page (already shown as featured)
                            if (!is_paged() && $post_count === 0) {
                                $post_count++;
                                continue;
                            }
                            $post_count++;
                        ?>
                            <article class="blog-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
                                <div class="relative h-48 overflow-hidden">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('irimas-menu-item', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (has_category()): ?>
                                        <div class="absolute top-3 left-3">
                                            <?php 
                                            $categories = get_the_category();
                                            if ($categories): ?>
                                                <span class="bg-irimas-blue text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                        <span><?php echo get_the_date(); ?></span>
                                        <span>•</span>
                                        <span><?php echo irimas_reading_time(); ?> <?php _e('min read', 'irimas-kitchen'); ?></span>
                                    </div>
                                    <h3 class="text-lg font-bold mb-3 font-playfair text-irimas-blue line-clamp-2">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-irimas-red transition"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="text-irimas-red text-sm font-semibold hover:underline">
                                        <?php _e('Read More →', 'irimas-kitchen'); ?>
                                    </a>
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
                            'class' => 'irimas-pagination',
                        ));
                        ?>
                    </div>
                    
                <?php else: ?>
                    
                    <!-- No Posts Found -->
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('No Posts Yet', 'irimas-kitchen'); ?></h2>
                        <p class="text-gray-600 mb-6"><?php _e('We\'re working on some delicious content. Check back soon!', 'irimas-kitchen'); ?></p>
                        <a href="<?php echo home_url('/'); ?>" class="btn-primary">
                            <?php _e('Back to Home', 'irimas-kitchen'); ?>
                        </a>
                    </div>
                    
                <?php endif; ?>
            </main>
            
            <!-- Sidebar -->
            <aside class="lg:w-1/3">
                <div class="sticky top-24 space-y-8">
                    
                    <!-- Search Widget -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue border-b border-gray-200 pb-2"><?php _e('Search', 'irimas-kitchen'); ?></h3>
                        <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                            <div class="relative">
                                <input type="search" name="s" placeholder="<?php _e('Search articles...', 'irimas-kitchen'); ?>" class="w-full pl-4 pr-12 py-3 border border-gray-200 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition">
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-irimas-red transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue border-b border-gray-200 pb-2"><?php _e('Categories', 'irimas-kitchen'); ?></h3>
                        <ul class="space-y-3">
                            <?php
                            $categories = get_categories(array('hide_empty' => true));
                            foreach ($categories as $category):
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
                    
                    <!-- Recent Posts Widget -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue border-b border-gray-200 pb-2"><?php _e('Recent Posts', 'irimas-kitchen'); ?></h3>
                        <ul class="space-y-4">
                            <?php
                            $recent_posts = get_posts(array('numberposts' => 5));
                            foreach ($recent_posts as $post):
                                setup_postdata($post);
                            ?>
                                <li class="flex gap-3 group">
                                    <div class="w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden">
                                        <?php if (has_post_thumbnail($post)): ?>
                                            <?php echo get_the_post_thumbnail($post, 'thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-irimas-orange to-irimas-red"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <a href="<?php the_permalink(); ?>" class="text-sm font-semibold text-gray-800 hover:text-irimas-red transition line-clamp-2">
                                            <?php the_title(); ?>
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo get_the_date(); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    
                    <!-- Newsletter Widget -->
                    <div class="bg-gradient-to-br from-irimas-blue to-irimas-green rounded-xl shadow-lg p-6 text-white">
                        <h3 class="text-lg font-bold mb-2 font-playfair"><?php _e('Newsletter', 'irimas-kitchen'); ?></h3>
                        <p class="text-sm opacity-90 mb-4"><?php _e('Subscribe for recipes, tips, and exclusive offers!', 'irimas-kitchen'); ?></p>
                        <form class="newsletter-form space-y-3">
                            <input type="email" name="email" placeholder="<?php _e('Your email address', 'irimas-kitchen'); ?>" class="w-full px-4 py-3 rounded-lg text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-white/50 outline-none" required>
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

<?php get_footer(); ?>
