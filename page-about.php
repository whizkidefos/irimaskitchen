<?php
/**
 * Template Name: About Page
 * 
 * @package IrimasKitchen
 */

get_header();

// Get customizer values
$hero_title = get_theme_mod('irimas_about_hero_title', 'Our Story');
$hero_subtitle = get_theme_mod('irimas_about_hero_subtitle', 'Discover the passion behind every dish we create');
$hero_image = get_theme_mod('irimas_about_hero_image');
$story_title = get_theme_mod('irimas_about_story_title', 'Who We Are');
$story_content = get_theme_mod('irimas_about_story_content', 'Irima\'s Kitchen was born from a deep love for authentic Nigerian cuisine and a desire to share the rich flavors of our heritage with the world. What started as a small family kitchen has grown into a beloved culinary destination, where every dish tells a story of tradition, passion, and innovation.');
$story_image = get_theme_mod('irimas_about_story_image');
$mission = get_theme_mod('irimas_about_mission', 'To deliver exceptional culinary experiences that celebrate the richness of Nigerian cuisine while embracing innovation and quality in every dish we serve.');
$vision = get_theme_mod('irimas_about_vision', 'To become the leading destination for authentic Nigerian cuisine, inspiring food lovers worldwide and setting the standard for excellence in African culinary arts.');
$team_title = get_theme_mod('irimas_about_team_title', 'Meet Our Team');
?>

<!-- Hero Section -->
<section class="relative h-[60vh] min-h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image); ?>" alt="About Us" class="w-full h-full object-cover">
        <?php else: ?>
            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1920&q=80" alt="About Us" class="w-full h-full object-cover">
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-r from-irimas-blue/90 to-irimas-blue/70"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-4 font-playfair"><?php echo esc_html($hero_title); ?></h1>
        <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto"><?php echo esc_html($hero_subtitle); ?></p>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue"><?php echo esc_html($story_title); ?></h2>
                <div class="section-divider !mx-0 !mb-6"></div>
                <div class="prose prose-lg text-gray-600 space-y-4">
                    <?php echo wpautop(wp_kses_post($story_content)); ?>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="relative">
                    <?php if ($story_image): ?>
                        <img src="<?php echo esc_url($story_image); ?>" alt="Our Story" class="rounded-lg shadow-2xl w-full">
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=800&q=80" alt="Our Story" class="rounded-lg shadow-2xl w-full">
                    <?php endif; ?>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-irimas-orange/20 rounded-lg -z-10"></div>
                    <div class="absolute -top-6 -right-6 w-32 h-32 bg-irimas-red/20 rounded-lg -z-10"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-20 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Mission -->
            <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-irimas-red/10 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Our Mission', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600 leading-relaxed"><?php echo wp_kses_post($mission); ?></p>
            </div>
            
            <!-- Vision -->
            <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-irimas-orange/10 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Our Vision', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600 leading-relaxed"><?php echo wp_kses_post($vision); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Our Values', 'irimas-kitchen'); ?></h2>
            <div class="section-divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto"><?php _e('The principles that guide everything we do', 'irimas-kitchen'); ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Quality -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-irimas-red/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-irimas-red/20 transition-colors">
                    <svg class="w-10 h-10 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 font-playfair text-irimas-blue"><?php _e('Quality', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600"><?php _e('We use only the finest, freshest ingredients in every dish', 'irimas-kitchen'); ?></p>
            </div>
            
            <!-- Authenticity -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-irimas-orange/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-irimas-orange/20 transition-colors">
                    <svg class="w-10 h-10 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 font-playfair text-irimas-blue"><?php _e('Authenticity', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600"><?php _e('True to our Nigerian culinary heritage and traditions', 'irimas-kitchen'); ?></p>
            </div>
            
            <!-- Innovation -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-irimas-green/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-irimas-green/20 transition-colors">
                    <svg class="w-10 h-10 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 font-playfair text-irimas-blue"><?php _e('Innovation', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600"><?php _e('Constantly evolving while respecting our roots', 'irimas-kitchen'); ?></p>
            </div>
            
            <!-- Service -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-irimas-blue/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-irimas-blue/20 transition-colors">
                    <svg class="w-10 h-10 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 font-playfair text-irimas-blue"><?php _e('Service', 'irimas-kitchen'); ?></h3>
                <p class="text-gray-600"><?php _e('Exceptional hospitality in every interaction', 'irimas-kitchen'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section (Optional - shows if there's page content) -->
<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <?php if (get_the_content()): ?>
    <section class="py-20 bg-cream-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue"><?php echo esc_html($team_title); ?></h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="prose prose-lg max-w-none">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php endwhile; endif; ?>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-irimas-blue to-irimas-green text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 font-playfair"><?php _e('Ready to Taste the Difference?', 'irimas-kitchen'); ?></h2>
            <p class="text-xl mb-8 opacity-90"><?php _e('Experience the authentic flavors of Nigerian cuisine today', 'irimas-kitchen'); ?></p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo home_url('/menu'); ?>" class="btn-primary-white">
                    <?php _e('View Our Menu', 'irimas-kitchen'); ?>
                </a>
                <a href="<?php echo home_url('/contact'); ?>" class="btn-secondary-white">
                    <?php _e('Contact Us', 'irimas-kitchen'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
