<?php
/**
 * Custom Post Types
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Menu Items Post Type
 */
function irimas_register_menu_items() {
    $labels = array(
        'name'                  => _x('Menu Items', 'Post Type General Name', 'irimas-kitchen'),
        'singular_name'         => _x('Menu Item', 'Post Type Singular Name', 'irimas-kitchen'),
        'menu_name'             => __('Menu Items', 'irimas-kitchen'),
        'add_new_item'          => __('Add New Menu Item', 'irimas-kitchen'),
        'edit_item'             => __('Edit Menu Item', 'irimas-kitchen'),
        'view_item'             => __('View Menu Item', 'irimas-kitchen'),
        'all_items'             => __('All Menu Items', 'irimas-kitchen'),
        'search_items'          => __('Search Menu Items', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'show_in_rest'          => true,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'             => 'dashicons-food',
        'rewrite'               => array('slug' => 'menu'),
    );
    
    register_post_type('menu_item', $args);
}
add_action('init', 'irimas_register_menu_items');

/**
 * Register Menu Categories Taxonomy
 */
function irimas_register_menu_categories() {
    $labels = array(
        'name'              => _x('Menu Categories', 'taxonomy general name', 'irimas-kitchen'),
        'singular_name'     => _x('Menu Category', 'taxonomy singular name', 'irimas-kitchen'),
        'search_items'      => __('Search Categories', 'irimas-kitchen'),
        'all_items'         => __('All Categories', 'irimas-kitchen'),
        'edit_item'         => __('Edit Category', 'irimas-kitchen'),
        'add_new_item'      => __('Add New Category', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'menu-category'),
    );
    
    register_taxonomy('menu_category', array('menu_item'), $args);
}
add_action('init', 'irimas_register_menu_categories');

/**
 * Register Orders Post Type
 */
function irimas_register_orders() {
    $labels = array(
        'name'                  => _x('Orders', 'Post Type General Name', 'irimas-kitchen'),
        'singular_name'         => _x('Order', 'Post Type Singular Name', 'irimas-kitchen'),
        'menu_name'             => __('Orders', 'irimas-kitchen'),
        'edit_item'             => __('Edit Order', 'irimas-kitchen'),
        'view_item'             => __('View Order', 'irimas-kitchen'),
        'all_items'             => __('All Orders', 'irimas-kitchen'),
        'search_items'          => __('Search Orders', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap'          => true,
        'supports'              => array('title'),
        'menu_icon'             => 'dashicons-cart',
    );
    
    register_post_type('order', $args);
}
add_action('init', 'irimas_register_orders');

/**
 * Register Contact Submissions Post Type
 */
function irimas_register_contact_submissions() {
    $labels = array(
        'name'                  => _x('Contact Submissions', 'Post Type General Name', 'irimas-kitchen'),
        'singular_name'         => _x('Contact Submission', 'Post Type Singular Name', 'irimas-kitchen'),
        'menu_name'             => __('Contact Forms', 'irimas-kitchen'),
        'all_items'             => __('All Submissions', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap'          => true,
        'supports'              => array('title'),
        'menu_icon'             => 'dashicons-email',
    );
    
    register_post_type('contact_submission', $args);
}
add_action('init', 'irimas_register_contact_submissions');

/**
 * Add Meta Boxes for Menu Items
 */
function irimas_add_menu_item_meta_boxes() {
    add_meta_box(
        'menu_item_details',
        __('Menu Item Details', 'irimas-kitchen'),
        'irimas_menu_item_meta_box_callback',
        'menu_item',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'irimas_add_menu_item_meta_boxes');

/**
 * Menu Item Meta Box Callback
 */
function irimas_menu_item_meta_box_callback($post) {
    wp_nonce_field('irimas_save_menu_item_meta', 'irimas_menu_item_nonce');
    
    $price = get_post_meta($post->ID, '_menu_item_price', true);
    $available = get_post_meta($post->ID, '_menu_item_available', true);
    $ingredients = get_post_meta($post->ID, '_menu_item_ingredients', true);
    $spicy_level = get_post_meta($post->ID, '_menu_item_spicy_level', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="menu_item_price"><?php _e('Price (NGN)', 'irimas-kitchen'); ?></label></th>
            <td>
                <input type="number" id="menu_item_price" name="menu_item_price" 
                       value="<?php echo esc_attr($price); ?>" step="0.01" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="menu_item_available"><?php _e('Available', 'irimas-kitchen'); ?></label></th>
            <td>
                <input type="checkbox" id="menu_item_available" name="menu_item_available" 
                       value="1" <?php checked($available, '1'); ?>>
                <span class="description"><?php _e('Check if this item is currently available for order', 'irimas-kitchen'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="menu_item_ingredients"><?php _e('Ingredients', 'irimas-kitchen'); ?></label></th>
            <td>
                <textarea id="menu_item_ingredients" name="menu_item_ingredients" 
                          rows="3" class="large-text"><?php echo esc_textarea($ingredients); ?></textarea>
                <p class="description"><?php _e('Comma-separated list of ingredients', 'irimas-kitchen'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="menu_item_spicy_level"><?php _e('Spicy Level', 'irimas-kitchen'); ?></label></th>
            <td>
                <select id="menu_item_spicy_level" name="menu_item_spicy_level">
                    <option value=""><?php _e('Not Spicy', 'irimas-kitchen'); ?></option>
                    <option value="mild" <?php selected($spicy_level, 'mild'); ?>><?php _e('Mild', 'irimas-kitchen'); ?></option>
                    <option value="medium" <?php selected($spicy_level, 'medium'); ?>><?php _e('Medium', 'irimas-kitchen'); ?></option>
                    <option value="hot" <?php selected($spicy_level, 'hot'); ?>><?php _e('Hot', 'irimas-kitchen'); ?></option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Menu Item Meta
 */
function irimas_save_menu_item_meta($post_id) {
    if (!isset($_POST['irimas_menu_item_nonce']) || 
        !wp_verify_nonce($_POST['irimas_menu_item_nonce'], 'irimas_save_menu_item_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['menu_item_price'])) {
        update_post_meta($post_id, '_menu_item_price', sanitize_text_field($_POST['menu_item_price']));
    }
    
    $available = isset($_POST['menu_item_available']) ? '1' : '0';
    update_post_meta($post_id, '_menu_item_available', $available);
    
    if (isset($_POST['menu_item_ingredients'])) {
        update_post_meta($post_id, '_menu_item_ingredients', sanitize_textarea_field($_POST['menu_item_ingredients']));
    }
    
    if (isset($_POST['menu_item_spicy_level'])) {
        update_post_meta($post_id, '_menu_item_spicy_level', sanitize_text_field($_POST['menu_item_spicy_level']));
    }
}
add_action('save_post_menu_item', 'irimas_save_menu_item_meta');

/**
 * Register FAQ Post Type
 */
function irimas_register_faqs() {
    $labels = array(
        'name'                  => _x('FAQs', 'Post Type General Name', 'irimas-kitchen'),
        'singular_name'         => _x('FAQ', 'Post Type Singular Name', 'irimas-kitchen'),
        'menu_name'             => __('FAQs', 'irimas-kitchen'),
        'add_new_item'          => __('Add New FAQ', 'irimas-kitchen'),
        'edit_item'             => __('Edit FAQ', 'irimas-kitchen'),
        'view_item'             => __('View FAQ', 'irimas-kitchen'),
        'all_items'             => __('All FAQs', 'irimas-kitchen'),
        'search_items'          => __('Search FAQs', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => false,
        'show_in_rest'          => true,
        'supports'              => array('title', 'editor'),
        'menu_icon'             => 'dashicons-editor-help',
        'rewrite'               => array('slug' => 'faq'),
    );
    
    register_post_type('faq', $args);
}
add_action('init', 'irimas_register_faqs');

/**
 * Register FAQ Categories Taxonomy
 */
function irimas_register_faq_categories() {
    $labels = array(
        'name'              => _x('FAQ Categories', 'taxonomy general name', 'irimas-kitchen'),
        'singular_name'     => _x('FAQ Category', 'taxonomy singular name', 'irimas-kitchen'),
        'search_items'      => __('Search Categories', 'irimas-kitchen'),
        'all_items'         => __('All Categories', 'irimas-kitchen'),
        'edit_item'         => __('Edit Category', 'irimas-kitchen'),
        'add_new_item'      => __('Add New Category', 'irimas-kitchen'),
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'faq-category'),
    );
    
    register_taxonomy('faq_category', array('faq'), $args);
}
add_action('init', 'irimas_register_faq_categories');