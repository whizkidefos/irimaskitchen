<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header fixed w-full top-0 z-50 bg-white/95 backdrop-blur-sm shadow-md transition-all duration-300" id="site-header">
    <div class="container mx-auto px-2 sm:px-4 lg:px-6 max-w-full xl:max-w-[1400px]">
        <div class="flex items-center justify-between py-3 lg:py-4">
            <!-- Logo -->
            <div class="logo-wrapper">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <a href="<?php echo home_url('/'); ?>" class="flex items-center space-x-2">
                        <img src="<?php echo IRIMAS_THEME_URI; ?>/assets/images/irimas-kitchen-badge-logo.png" alt="<?php bloginfo('name'); ?>" class="h-10 w-auto">
                        <span class="text-xl lg:text-2xl font-bold text-irimas-blue font-playfair"><?php bloginfo('name'); ?></span>
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex items-center space-x-6 text-base font-medium',
                    'fallback_cb' => 'irimas_default_menu',
                    'walker' => new Irimas_Nav_Walker(),
                ));
                ?>
                
                <!-- Cart Icon -->
                <a href="<?php echo home_url('/order'); ?>" class="relative cart-icon group">
                    <svg class="w-6 h-6 text-irimas-blue group-hover:text-irimas-red transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="cart-count absolute -top-2 -right-2 bg-irimas-red text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                </a>
                
                <!-- User Account -->
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo home_url('/profile'); ?>" class="flex items-center space-x-2 text-irimas-blue hover:text-irimas-red transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span><?php echo wp_get_current_user()->display_name; ?></span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo home_url('/login'); ?>" class="btn-secondary">
                        <?php _e('Login', 'irimas-kitchen'); ?>
                    </a>
                <?php endif; ?>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle Menu">
                <svg class="w-6 h-6 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path class="menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path class="menu-icon-close hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <nav class="mobile-nav lg:hidden hidden py-4 border-t border-gray-200" id="mobile-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-2',
                'fallback_cb' => 'irimas_default_menu',
                'walker' => new Irimas_Mobile_Nav_Walker(),
            ));
            ?>
            
            <div class="pt-4 border-t border-gray-200 flex flex-col space-y-4">
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo home_url('/profile'); ?>" class="flex items-center space-x-2 text-irimas-blue">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span><?php _e('My Profile', 'irimas-kitchen'); ?></span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo home_url('/login'); ?>" class="btn-secondary inline-block text-center">
                        <?php _e('Login', 'irimas-kitchen'); ?>
                    </a>
                    <a href="<?php echo home_url('/register'); ?>" class="btn-primary inline-block text-center">
                        <?php _e('Register', 'irimas-kitchen'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<div class="site-content pt-20">
<?php

/**
 * Default menu fallback
 */
function irimas_default_menu() {
    echo '<ul class="flex items-center space-x-6">';
    echo '<li><a href="' . home_url('/') . '" class="nav-link">' . __('Home', 'irimas-kitchen') . '</a></li>';
    echo '<li><a href="' . home_url('/menu') . '" class="nav-link">' . __('Menu', 'irimas-kitchen') . '</a></li>';
    echo '<li><a href="' . home_url('/order') . '" class="nav-link">' . __('Order Now', 'irimas-kitchen') . '</a></li>';
    echo '<li><a href="' . home_url('/about') . '" class="nav-link">' . __('About', 'irimas-kitchen') . '</a></li>';
    echo '<li><a href="' . home_url('/contact') . '" class="nav-link">' . __('Contact', 'irimas-kitchen') . '</a></li>';
    echo '</ul>';
}