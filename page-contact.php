<?php
/**
 * Template Name: Contact Page
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<div class="contact-page py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair text-irimas-blue">
                <?php _e('Get in Touch', 'irimas-kitchen'); ?>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                <?php _e('Have a question or want to book our catering service? We\'d love to hear from you.', 'irimas-kitchen'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue">
                        <?php _e('Send us a Message', 'irimas-kitchen'); ?>
                    </h2>

                    <form id="contact-form" class="space-y-6">
                        <div>
                            <label class="form-label"><?php _e('Your Name *', 'irimas-kitchen'); ?></label>
                            <input type="text" name="name" class="form-input" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label"><?php _e('Email *', 'irimas-kitchen'); ?></label>
                                <input type="email" name="email" class="form-input" required>
                            </div>
                            <div>
                                <label class="form-label"><?php _e('Phone', 'irimas-kitchen'); ?></label>
                                <input type="tel" name="phone" class="form-input">
                            </div>
                        </div>

                        <div>
                            <label class="form-label"><?php _e('Subject', 'irimas-kitchen'); ?></label>
                            <input type="text" name="subject" class="form-input">
                        </div>

                        <div>
                            <label class="form-label"><?php _e('Message *', 'irimas-kitchen'); ?></label>
                            <textarea name="message" class="form-textarea" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="w-full btn-primary">
                            <?php _e('Send Message', 'irimas-kitchen'); ?>
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-xl font-bold mb-4 font-playfair text-irimas-blue">
                        <?php _e('Contact Information', 'irimas-kitchen'); ?>
                    </h3>

                    <div class="space-y-4">
                        <?php if ($phone = get_theme_mod('irimas_phone')): ?>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-irimas-red/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-irimas-blue"><?php _e('Phone', 'irimas-kitchen'); ?></p>
                                <a href="tel:<?php echo esc_attr($phone); ?>" class="text-gray-600 hover:text-irimas-red">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($email = get_theme_mod('irimas_email')): ?>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-irimas-orange/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-irimas-blue"><?php _e('Email', 'irimas-kitchen'); ?></p>
                                <a href="mailto:<?php echo esc_attr($email); ?>" class="text-gray-600 hover:text-irimas-red">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($address = get_theme_mod('irimas_address')): ?>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-irimas-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-irimas-blue"><?php _e('Address', 'irimas-kitchen'); ?></p>
                                <p class="text-gray-600"><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-irimas-blue to-irimas-green text-white rounded-lg shadow-lg p-8">
                    <h3 class="text-xl font-bold mb-4 font-playfair">
                        <?php _e('Opening Hours', 'irimas-kitchen'); ?>
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span><?php _e('Monday - Friday', 'irimas-kitchen'); ?></span>
                            <span class="font-semibold">9:00 - 22:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span><?php _e('Saturday', 'irimas-kitchen'); ?></span>
                            <span class="font-semibold">10:00 - 23:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span><?php _e('Sunday', 'irimas-kitchen'); ?></span>
                            <span class="font-semibold">10:00 - 21:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>