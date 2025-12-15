</div><!-- .site-content -->

<footer class="site-footer bg-gradient-to-br from-irimas-blue via-irimas-blue to-slate-900 text-white py-16 mt-20 relative overflow-hidden">
    <!-- Decorative Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- About Column -->
            <div class="footer-column">
                <h3 class="text-xl font-bold mb-4 font-playfair"><?php bloginfo('name'); ?></h3>
                <p class="text-cream-light mb-4">
                    <?php echo get_bloginfo('description'); ?>
                </p>
                <div class="flex space-x-4">
                    <?php if ($facebook = get_theme_mod('irimas_facebook')): ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-irimas-orange transition" aria-label="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($instagram = get_theme_mod('irimas_instagram')): ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-irimas-orange transition" aria-label="Instagram">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"></rect>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2"></line>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($tiktok = get_theme_mod('irimas_tiktok')): ?>
                        <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-irimas-orange transition" aria-label="TikTok">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-column">
                <h3 class="text-xl font-semibold mb-4 font-playfair"><?php _e('Quick Links', 'irimas-kitchen'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'space-y-2',
                    'fallback_cb' => false,
                ));
                ?>
            </div>
            
            <!-- Contact Info -->
            <div class="footer-column">
                <h3 class="text-xl font-semibold mb-4 font-playfair"><?php _e('Contact Us', 'irimas-kitchen'); ?></h3>
                <ul class="space-y-3 text-cream-light">
                    <?php if ($phone = get_theme_mod('irimas_phone')): ?>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <a href="tel:<?php echo esc_attr($phone); ?>" class="hover:text-white transition"><?php echo esc_html($phone); ?></a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if ($email = get_theme_mod('irimas_email')): ?>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-white transition"><?php echo esc_html($email); ?></a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if ($address = get_theme_mod('irimas_address')): ?>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><?php echo esc_html($address); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <!-- Opening Hours -->
            <div class="footer-column">
                <h3 class="text-xl font-semibold mb-4 font-playfair"><?php _e('Opening Hours', 'irimas-kitchen'); ?></h3>
                <ul class="space-y-2 text-cream-light">
                    <li class="flex justify-between">
                        <span><?php _e('Monday - Friday', 'irimas-kitchen'); ?></span>
                        <span class="font-medium text-white">9:00 - 22:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span><?php _e('Saturday', 'irimas-kitchen'); ?></span>
                        <span class="font-medium text-white">10:00 - 23:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span><?php _e('Sunday', 'irimas-kitchen'); ?></span>
                        <span class="font-medium text-white">10:00 - 21:00</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-cream-light text-sm mb-4 md:mb-0">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'irimas-kitchen'); ?>
            </p>
            <p class="text-cream-light text-sm">
                <?php _e('Designed with', 'irimas-kitchen'); ?> <span class="text-irimas-red">❤</span> <?php _e('by Irima\'s Kitchen', 'irimas-kitchen'); ?>
            </p>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-irimas-red text-white p-3 rounded-full shadow-lg hover:bg-irimas-orange transition-all transform translate-y-20 opacity-0" aria-label="Back to top">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>