<?php
/**
 * Template Name: FAQ Page
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
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair"><?php _e('Frequently Asked Questions', 'irimas-kitchen'); ?></h1>
            <p class="text-xl opacity-90"><?php _e('Find answers to common questions about our services', 'irimas-kitchen'); ?></p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php _e('FAQ', 'irimas-kitchen'); ?></span>
        </nav>
    </div>
</div>

<!-- FAQ Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            
            <?php
            // Get FAQ categories
            $faq_categories = get_terms(array(
                'taxonomy' => 'faq_category',
                'hide_empty' => true,
            ));
            
            if (!empty($faq_categories) && !is_wp_error($faq_categories)):
                foreach ($faq_categories as $category):
                    $faqs = get_posts(array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'faq_category',
                                'field' => 'term_id',
                                'terms' => $category->term_id,
                            ),
                        ),
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));
                    
                    if ($faqs):
            ?>
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue flex items-center gap-3">
                        <span class="w-10 h-10 bg-irimas-orange/10 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        <?php echo esc_html($category->name); ?>
                    </h2>
                    
                    <div class="space-y-4">
                        <?php foreach ($faqs as $faq): ?>
                            <div class="faq-item border border-gray-200 rounded-xl overflow-hidden">
                                <button class="faq-toggle w-full flex items-center justify-between p-5 text-left bg-gray-50 hover:bg-gray-100 transition">
                                    <span class="font-semibold text-irimas-blue pr-4"><?php echo get_the_title($faq); ?></span>
                                    <svg class="faq-icon w-5 h-5 text-irimas-orange flex-shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden p-5 bg-white border-t border-gray-200">
                                    <div class="prose prose-sm max-w-none text-gray-600">
                                        <?php echo apply_filters('the_content', $faq->post_content); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php 
                    endif;
                endforeach;
            else:
                // No categories, show all FAQs
                $faqs = get_posts(array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ));
                
                if ($faqs):
            ?>
                <div class="space-y-4">
                    <?php foreach ($faqs as $faq): ?>
                        <div class="faq-item border border-gray-200 rounded-xl overflow-hidden">
                            <button class="faq-toggle w-full flex items-center justify-between p-5 text-left bg-gray-50 hover:bg-gray-100 transition">
                                <span class="font-semibold text-irimas-blue pr-4"><?php echo get_the_title($faq); ?></span>
                                <svg class="faq-icon w-5 h-5 text-irimas-orange flex-shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-content hidden p-5 bg-white border-t border-gray-200">
                                <div class="prose prose-sm max-w-none text-gray-600">
                                    <?php echo apply_filters('the_content', $faq->post_content); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('No FAQs Yet', 'irimas-kitchen'); ?></h2>
                    <p class="text-gray-600"><?php _e('Check back soon for answers to common questions.', 'irimas-kitchen'); ?></p>
                </div>
            <?php 
                endif;
            endif;
            ?>
            
        </div>
    </div>
</section>

<!-- Still Have Questions -->
<section class="py-16 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Still Have Questions?', 'irimas-kitchen'); ?></h2>
            <p class="text-gray-600 mb-8"><?php _e('Can\'t find the answer you\'re looking for? Our team is here to help!', 'irimas-kitchen'); ?></p>
            <a href="<?php echo home_url('/contact'); ?>" class="btn-primary">
                <?php _e('Contact Us', 'irimas-kitchen'); ?>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqToggles = document.querySelectorAll('.faq-toggle');
    
    faqToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.faq-icon');
            
            // Close all other FAQs
            faqToggles.forEach(function(otherToggle) {
                if (otherToggle !== toggle) {
                    otherToggle.nextElementSibling.classList.add('hidden');
                    otherToggle.querySelector('.faq-icon').classList.remove('rotate-180');
                }
            });
            
            // Toggle current FAQ
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });
});
</script>

<?php get_footer(); ?>
