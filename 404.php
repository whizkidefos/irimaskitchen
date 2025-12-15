<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package IrimasKitchen
 */

get_header();
?>

<div class="error-404 py-20 min-h-screen flex items-center bg-gradient-to-br from-cream-light to-white">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-9xl font-bold text-irimas-red mb-4 font-playfair">404</h1>
            <h2 class="text-4xl font-bold mb-6 text-irimas-blue font-playfair">
                <?php _e('Page Not Found', 'irimas-kitchen'); ?>
            </h2>
            <p class="text-xl text-gray-600 mb-8">
                <?php _e('Sorry, the page you are looking for could not be found. It might have been moved or deleted.', 'irimas-kitchen'); ?>
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo home_url('/'); ?>" class="btn-primary text-lg">
                    <?php _e('Go Home', 'irimas-kitchen'); ?>
                </a>
                <a href="<?php echo home_url('/menu'); ?>" class="btn-secondary text-lg">
                    <?php _e('View Menu', 'irimas-kitchen'); ?>
                </a>
                <a href="<?php echo home_url('/contact'); ?>" class="btn-secondary text-lg">
                    <?php _e('Contact Us', 'irimas-kitchen'); ?>
                </a>
            </div>
            
            <div class="mt-12">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80" 
                     alt="Food" 
                     class="mx-auto rounded-lg shadow-xl max-w-md">
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>