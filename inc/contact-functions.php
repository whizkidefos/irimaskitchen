<?php
/**
 * Contact Form Functions
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle Contact Form Submission
 */
function irimas_submit_contact_form() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'irimas-kitchen')));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'irimas-kitchen')));
    }
    
    // Create contact submission post
    $submission_id = wp_insert_post(array(
        'post_type' => 'contact_submission',
        'post_title' => sprintf(__('Contact from %s - %s', 'irimas-kitchen'), $name, date('Y-m-d H:i:s')),
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($submission_id)) {
        wp_send_json_error(array('message' => __('Failed to submit form.', 'irimas-kitchen')));
    }
    
    // Save submission meta
    update_post_meta($submission_id, '_contact_name', $name);
    update_post_meta($submission_id, '_contact_email', $email);
    update_post_meta($submission_id, '_contact_phone', $phone);
    update_post_meta($submission_id, '_contact_subject', $subject);
    update_post_meta($submission_id, '_contact_message', $message);
    update_post_meta($submission_id, '_contact_date', current_time('mysql'));
    update_post_meta($submission_id, '_contact_read', '0');
    
    // Send email to admin
    irimas_send_contact_notification_email($submission_id);
    
    // Send confirmation to user
    irimas_send_contact_confirmation_email($email, $name);
    
    wp_send_json_success(array('message' => __('Thank you for contacting us! We will get back to you soon.', 'irimas-kitchen')));
}
add_action('wp_ajax_irimas_submit_contact_form', 'irimas_submit_contact_form');
add_action('wp_ajax_nopriv_irimas_submit_contact_form', 'irimas_submit_contact_form');

/**
 * Send Contact Notification Email to Admin
 */
function irimas_send_contact_notification_email($submission_id) {
    $admin_emails = get_option('irimas_contact_notification_emails', get_option('admin_email'));
    $emails = array_map('trim', explode(',', $admin_emails));
    
    $name = get_post_meta($submission_id, '_contact_name', true);
    $email = get_post_meta($submission_id, '_contact_email', true);
    $phone = get_post_meta($submission_id, '_contact_phone', true);
    $subject_text = get_post_meta($submission_id, '_contact_subject', true);
    $message_text = get_post_meta($submission_id, '_contact_message', true);
    
    $subject = sprintf(__('New Contact Form Submission from %s', 'irimas-kitchen'), $name);
    
    $message = __('You have received a new contact form submission:', 'irimas-kitchen') . "\n\n";
    $message .= sprintf(__('Name: %s', 'irimas-kitchen'), $name) . "\n";
    $message .= sprintf(__('Email: %s', 'irimas-kitchen'), $email) . "\n";
    $message .= sprintf(__('Phone: %s', 'irimas-kitchen'), $phone) . "\n";
    $message .= sprintf(__('Subject: %s', 'irimas-kitchen'), $subject_text) . "\n\n";
    $message .= __('Message:', 'irimas-kitchen') . "\n";
    $message .= $message_text . "\n\n";
    $message .= sprintf(__('View submission: %s', 'irimas-kitchen'), admin_url('post.php?post=' . $submission_id . '&action=edit'));
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    foreach ($emails as $admin_email) {
        if (is_email($admin_email)) {
            wp_mail($admin_email, $subject, $message, $headers);
        }
    }
}

/**
 * Send Contact Confirmation Email to User
 */
function irimas_send_contact_confirmation_email($email, $name) {
    $subject = __('Thank you for contacting Irima\'s Kitchen', 'irimas-kitchen');
    
    $message = sprintf(__('Dear %s,', 'irimas-kitchen'), $name) . "\n\n";
    $message .= __('Thank you for getting in touch with us. We have received your message and will respond to you as soon as possible.', 'irimas-kitchen') . "\n\n";
    $message .= __('Best regards,', 'irimas-kitchen') . "\n";
    $message .= __('Irima\'s Kitchen Team', 'irimas-kitchen');
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

/**
 * Mark Contact Submission as Read
 */
function irimas_mark_contact_read() {
    check_ajax_referer('irimas-nonce', 'nonce');
    
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permission denied.', 'irimas-kitchen')));
    }
    
    $submission_id = intval($_POST['submission_id']);
    update_post_meta($submission_id, '_contact_read', '1');
    
    wp_send_json_success(array('message' => __('Marked as read.', 'irimas-kitchen')));
}
add_action('wp_ajax_irimas_mark_contact_read', 'irimas_mark_contact_read');