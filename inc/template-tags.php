<?php
/**
 * Custom Template Tags
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display navigation menu
 */
function irimas_nav_menu($location = 'primary') {
    if (has_nav_menu($location)) {
        wp_nav_menu(array(
            'theme_location' => $location,
            'container' => false,
            'menu_class' => 'irimas-nav-menu',
            'fallback_cb' => false,
        ));
    }
}

/**
 * Get menu item price
 */
function irimas_get_menu_item_price($post_id) {
    $price = get_post_meta($post_id, '_menu_item_price', true);
    return $price ? '₦' . number_format($price, 2) : '';
}

/**
 * Check if menu item is available
 */
function irimas_is_menu_item_available($post_id) {
    return get_post_meta($post_id, '_menu_item_available', true) === '1';
}

/**
 * Get menu item spicy level
 */
function irimas_get_spicy_level($post_id) {
    $level = get_post_meta($post_id, '_menu_item_spicy_level', true);
    if (!$level) return '';
    
    $icons = array(
        'mild' => '🌶️',
        'medium' => '🌶️🌶️',
        'hot' => '🌶️🌶️🌶️',
    );
    
    return isset($icons[$level]) ? $icons[$level] : '';
}

/**
 * Display breadcrumbs
 */
function irimas_breadcrumbs() {
    if (is_front_page()) return;
    
    echo '<nav class="breadcrumbs py-4 text-sm">';
    echo '<a href="' . home_url('/') . '" class="hover:text-irimas-red transition">' . __('Home', 'irimas-kitchen') . '</a>';
    
    if (is_category() || is_single()) {
        echo ' <span class="mx-2">/</span> ';
        the_category(' <span class="mx-2">/</span> ');
        if (is_single()) {
            echo ' <span class="mx-2">/</span> ';
            the_title();
        }
    } elseif (is_page()) {
        if ($post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo ' <span class="mx-2">/</span> ' . $crumb;
            }
        }
        echo ' <span class="mx-2">/</span> ';
        the_title();
    }
    
    echo '</nav>';
}

/**
 * Calculate reading time for a post
 */
function irimas_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    return max(1, $reading_time); // Minimum 1 minute
}

/**
 * Get cart count
 */
function irimas_get_cart_count() {
    // This will be handled by JavaScript
    return '<span class="cart-count">0</span>';
}

/**
 * Format order status
 */
function irimas_format_order_status($status) {
    $statuses = array(
        'pending' => __('Pending', 'irimas-kitchen'),
        'processing' => __('Processing', 'irimas-kitchen'),
        'completed' => __('Completed', 'irimas-kitchen'),
        'cancelled' => __('Cancelled', 'irimas-kitchen'),
    );
    
    return isset($statuses[$status]) ? $statuses[$status] : ucfirst($status);
}

/**
 * Get featured image URL or placeholder
 */
function irimas_get_post_image($post_id = null, $size = 'full') {
    $post_id = $post_id ?: get_the_ID();
    
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    
    // Return placeholder
    return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&q=80';
}

/**
 * Hide post meta on menu item archives
 */
function irimas_hide_menu_item_meta() {
    if (is_post_type_archive('menu_item') || is_tax('menu_category')) {
        ?>
        <style>
            /* Hide all post meta elements on menu pages */
            .menu-item-card .entry-meta,
            .menu-item-card .posted-on,
            .menu-item-card .byline,
            .menu-item-card .author,
            .menu-item-card .entry-footer,
            .menu-item-card time,
            .menu-item-card .cat-links,
            .menu-item-card .tags-links,
            .menu-item-card .comments-link,
            .menu-item-card .edit-link,
            article.menu-item .entry-meta,
            article.menu-item .posted-on,
            article.menu-item .byline,
            article.menu-item .author,
            article.menu-item .entry-footer,
            article.menu-item time,
            article[class*="menu_item"] .entry-meta,
            article[class*="menu_item"] .posted-on,
            article[class*="menu_item"] .byline,
            article[class*="menu_item"] .author,
            article[class*="menu_item"] .entry-footer,
            article[class*="menu_item"] time {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'irimas_hide_menu_item_meta');