<?php
/**
 * Irima's Kitchen Theme Functions
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define theme constants
define('IRIMAS_VERSION', '1.0.0');
define('IRIMAS_THEME_DIR', get_template_directory());
define('IRIMAS_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function irimas_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'irimas-kitchen'),
        'footer' => __('Footer Menu', 'irimas-kitchen'),
    ));
    
    // Add image sizes
    add_image_size('irimas-featured', 1200, 675, true);
    add_image_size('irimas-menu-item', 600, 600, true);
    add_image_size('irimas-thumbnail', 400, 400, true);
}
add_action('after_setup_theme', 'irimas_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function irimas_enqueue_scripts() {
    // Main stylesheet (required for WordPress)
    wp_enqueue_style('irimas-style', get_stylesheet_uri(), array(), IRIMAS_VERSION);
    
    // Tailwind CSS (compiled output)
    wp_enqueue_style('irimas-tailwind', IRIMAS_THEME_URI . '/assets/css/irimas-kitchen.css', array(), IRIMAS_VERSION);
    
    // Custom styles
    wp_enqueue_style('irimas-custom', IRIMAS_THEME_URI . '/assets/css/custom.css', array('irimas-tailwind'), IRIMAS_VERSION);
    
    // Google Fonts - Using Playfair Display for headings and Poppins for body
    wp_enqueue_style('irimas-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Anime.js for animations
    wp_enqueue_script('animejs', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array(), '3.2.1', true);
    
    // Main JavaScript
    wp_enqueue_script('irimas-main', IRIMAS_THEME_URI . '/assets/js/main.js', array('jquery', 'animejs'), IRIMAS_VERSION, true);
    
    // Localize script with WordPress data
    wp_localize_script('irimas-main', 'irimasData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('irimas-nonce'),
        'themeUrl' => IRIMAS_THEME_URI,
    ));
    
    // Enqueue specific scripts based on page
    if (is_page_template('page-order.php')) {
        wp_enqueue_script('irimas-order', IRIMAS_THEME_URI . '/assets/js/order-form.js', array('animejs'), IRIMAS_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'irimas_enqueue_scripts');

/**
 * Register Widget Areas
 */
function irimas_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'irimas-kitchen'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer column 1.', 'irimas-kitchen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-semibold mb-4 text-white">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 2', 'irimas-kitchen'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in footer column 2.', 'irimas-kitchen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-semibold mb-4 text-white">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 3', 'irimas-kitchen'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in footer column 3.', 'irimas-kitchen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-semibold mb-4 text-white">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'irimas_widgets_init');

/**
 * Include theme files
 */
require_once IRIMAS_THEME_DIR . '/inc/menu-walker.php';
require_once IRIMAS_THEME_DIR . '/inc/custom-post-types.php';
require_once IRIMAS_THEME_DIR . '/inc/admin-functions.php';
require_once IRIMAS_THEME_DIR . '/inc/order-functions.php';
require_once IRIMAS_THEME_DIR . '/inc/payment-functions.php';
require_once IRIMAS_THEME_DIR . '/inc/user-functions.php';
require_once IRIMAS_THEME_DIR . '/inc/contact-functions.php';
require_once IRIMAS_THEME_DIR . '/inc/customizer.php';

/**
 * Custom template tags
 */
require_once IRIMAS_THEME_DIR . '/inc/template-tags.php';