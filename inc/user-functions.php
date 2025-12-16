<?php
/**
 * User Functions - Authentication and Profile
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle User Registration
 */
function irimas_register_user() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    
    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'irimas-kitchen')));
    }
    
    if (username_exists($username)) {
        wp_send_json_error(array('message' => __('Username already exists.', 'irimas-kitchen')));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Invalid email address.', 'irimas-kitchen')));
    }
    
    if (email_exists($email)) {
        wp_send_json_error(array('message' => __('Email already registered.', 'irimas-kitchen')));
    }
    
    // Create user
    $user_id = wp_create_user($username, $password, $email);
    
    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => $user_id->get_error_message()));
    }
    
    // Update user meta
    wp_update_user(array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'display_name' => $first_name . ' ' . $last_name,
    ));
    
    // Auto login
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
    
    wp_send_json_success(array(
        'message' => __('Registration successful!', 'irimas-kitchen'),
        'redirect' => home_url('/profile/'),
    ));
}
add_action('wp_ajax_nopriv_irimas_register_user', 'irimas_register_user');

/**
 * Handle User Login
 */
function irimas_login_user() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $username = sanitize_text_field($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;
    
    if (empty($username) || empty($password)) {
        wp_send_json_error(array('message' => __('Please enter username and password.', 'irimas-kitchen')));
    }
    
    $creds = array(
        'user_login' => $username,
        'user_password' => $password,
        'remember' => $remember,
    );
    
    $user = wp_signon($creds, false);
    
    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => __('Invalid username or password.', 'irimas-kitchen')));
    }
    
    wp_send_json_success(array(
        'message' => __('Login successful!', 'irimas-kitchen'),
        'redirect' => home_url('/profile/'),
    ));
}
add_action('wp_ajax_nopriv_irimas_login_user', 'irimas_login_user');

/**
 * Handle User Logout
 */
function irimas_logout_user() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    wp_logout();
    
    wp_send_json_success(array(
        'message' => __('Logged out successfully.', 'irimas-kitchen'),
        'redirect' => home_url('/'),
    ));
}
add_action('wp_ajax_irimas_logout_user', 'irimas_logout_user');

/**
 * Update User Profile
 */
function irimas_update_profile() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => __('You must be logged in.', 'irimas-kitchen')));
    }
    
    $user_id = get_current_user_id();
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $phone = sanitize_text_field($_POST['phone']);
    $address = sanitize_textarea_field($_POST['address']);
    
    // Update user
    wp_update_user(array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'display_name' => $first_name . ' ' . $last_name,
    ));
    
    // Update meta
    update_user_meta($user_id, 'phone', $phone);
    update_user_meta($user_id, 'address', $address);
    
    wp_send_json_success(array('message' => __('Profile updated successfully!', 'irimas-kitchen')));
}
add_action('wp_ajax_irimas_update_profile', 'irimas_update_profile');

/**
 * Change Password
 */
function irimas_change_password() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => __('You must be logged in.', 'irimas-kitchen')));
    }
    
    $user_id = get_current_user_id();
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verify current password
    $user = get_userdata($user_id);
    if (!wp_check_password($current_password, $user->user_pass, $user_id)) {
        wp_send_json_error(array('message' => __('Current password is incorrect.', 'irimas-kitchen')));
    }
    
    // Verify new passwords match
    if ($new_password !== $confirm_password) {
        wp_send_json_error(array('message' => __('New passwords do not match.', 'irimas-kitchen')));
    }
    
    // Update password
    wp_set_password($new_password, $user_id);
    
    wp_send_json_success(array('message' => __('Password changed successfully!', 'irimas-kitchen')));
}
add_action('wp_ajax_irimas_change_password', 'irimas_change_password');

/**
 * Redirect logged-in users from login/register pages
 */
function irimas_redirect_logged_in_users() {
    if (is_user_logged_in() && (is_page('login') || is_page('register'))) {
        wp_redirect(home_url('/profile/'));
        exit;
    }
}
add_action('template_redirect', 'irimas_redirect_logged_in_users');

/**
 * Handle Password Reset Request
 */
function irimas_request_password_reset() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'irimas-kitchen')));
    }
    
    $user = get_user_by('email', $email);
    
    if (!$user) {
        // Don't reveal if email exists or not for security
        wp_send_json_success(array('message' => __('If an account exists with this email, you will receive reset instructions.', 'irimas-kitchen')));
    }
    
    // Generate reset key
    $reset_key = get_password_reset_key($user);
    
    if (is_wp_error($reset_key)) {
        wp_send_json_error(array('message' => __('Unable to generate reset link. Please try again.', 'irimas-kitchen')));
    }
    
    // Build reset URL
    $reset_url = add_query_arg(array(
        'key' => $reset_key,
        'login' => rawurlencode($user->user_login),
    ), home_url('/reset-password/'));
    
    // Send email
    $to = $email;
    $subject = sprintf(__('[%s] Password Reset Request', 'irimas-kitchen'), get_bloginfo('name'));
    $message = sprintf(
        __('Hello %s,\n\nYou recently requested to reset your password for your account at %s.\n\nClick the link below to reset your password:\n%s\n\nThis link will expire in 24 hours.\n\nIf you did not request a password reset, please ignore this email.\n\nBest regards,\nThe %s Team', 'irimas-kitchen'),
        $user->display_name,
        get_bloginfo('name'),
        $reset_url,
        get_bloginfo('name')
    );
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    wp_mail($to, $subject, $message, $headers);
    
    wp_send_json_success(array('message' => __('Password reset instructions have been sent to your email.', 'irimas-kitchen')));
}
add_action('wp_ajax_nopriv_irimas_request_password_reset', 'irimas_request_password_reset');

/**
 * Handle Password Reset
 */
function irimas_reset_password() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $reset_key = sanitize_text_field($_POST['reset_key']);
    $user_login = sanitize_text_field($_POST['user_login']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($reset_key) || empty($user_login)) {
        wp_send_json_error(array('message' => __('Invalid reset link.', 'irimas-kitchen')));
    }
    
    if (empty($password) || strlen($password) < 8) {
        wp_send_json_error(array('message' => __('Password must be at least 8 characters long.', 'irimas-kitchen')));
    }
    
    if ($password !== $confirm_password) {
        wp_send_json_error(array('message' => __('Passwords do not match.', 'irimas-kitchen')));
    }
    
    // Verify reset key
    $user = check_password_reset_key($reset_key, $user_login);
    
    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => __('This reset link is invalid or has expired. Please request a new one.', 'irimas-kitchen')));
    }
    
    // Reset password
    reset_password($user, $password);
    
    wp_send_json_success(array(
        'message' => __('Your password has been reset successfully!', 'irimas-kitchen'),
        'redirect' => home_url('/login/'),
    ));
}
add_action('wp_ajax_nopriv_irimas_reset_password', 'irimas_reset_password');

/**
 * Handle Newsletter Subscription
 */
function irimas_newsletter_subscribe() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'irimas-kitchen')));
    }
    
    // Check if already subscribed
    $subscribers = get_option('irimas_newsletter_subscribers', array());
    
    if (in_array($email, array_column($subscribers, 'email'))) {
        wp_send_json_error(array('message' => __('This email is already subscribed to our newsletter.', 'irimas-kitchen')));
    }
    
    // Add subscriber
    $subscribers[] = array(
        'email' => $email,
        'date' => current_time('mysql'),
        'status' => 'active',
    );
    
    update_option('irimas_newsletter_subscribers', $subscribers);
    
    // Send welcome email
    $subject = sprintf(__('Welcome to %s Newsletter!', 'irimas-kitchen'), get_bloginfo('name'));
    $message = sprintf(
        __("Hello!\n\nThank you for subscribing to the %s newsletter.\n\nYou'll receive updates about our latest recipes, special offers, and delicious news from our kitchen.\n\nBest regards,\nThe %s Team", 'irimas-kitchen'),
        get_bloginfo('name'),
        get_bloginfo('name')
    );
    
    wp_mail($email, $subject, $message);
    
    wp_send_json_success(array(
        'message' => __('Thank you for subscribing! Check your email for a welcome message.', 'irimas-kitchen'),
    ));
}
add_action('wp_ajax_irimas_newsletter_subscribe', 'irimas_newsletter_subscribe');
add_action('wp_ajax_nopriv_irimas_newsletter_subscribe', 'irimas_newsletter_subscribe');