<?php
/**
 * Theme Customizer
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add customizer settings
 */
function irimas_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('irimas_hero', array(
        'title' => __('Hero Section', 'irimas-kitchen'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('irimas_hero_title', array(
        'default' => __('Welcome to Irima\'s Kitchen', 'irimas-kitchen'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_hero_title', array(
        'label' => __('Hero Title', 'irimas-kitchen'),
        'section' => 'irimas_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_hero_subtitle', array(
        'default' => __('Boutique Restaurant and Catering Services', 'irimas-kitchen'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_hero_subtitle', array(
        'label' => __('Hero Subtitle', 'irimas-kitchen'),
        'section' => 'irimas_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_hero_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'irimas_hero_image', array(
        'label' => __('Hero Background Image', 'irimas-kitchen'),
        'section' => 'irimas_hero',
    )));
    
    // About Page Section
    $wp_customize->add_section('irimas_about', array(
        'title' => __('About Page', 'irimas-kitchen'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('irimas_about_hero_title', array(
        'default' => 'Our Story',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_about_hero_title', array(
        'label' => __('Hero Title', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_about_hero_subtitle', array(
        'default' => 'Discover the passion behind every dish we create',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_about_hero_subtitle', array(
        'label' => __('Hero Subtitle', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_about_hero_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'irimas_about_hero_image', array(
        'label' => __('Hero Background Image', 'irimas-kitchen'),
        'section' => 'irimas_about',
    )));
    
    $wp_customize->add_setting('irimas_about_story_title', array(
        'default' => 'Who We Are',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_about_story_title', array(
        'label' => __('Story Section Title', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_about_story_content', array(
        'default' => 'Irima\'s Kitchen was born from a deep love for authentic Nigerian cuisine and a desire to share the rich flavors of our heritage with the world. What started as a small family kitchen has grown into a beloved culinary destination, where every dish tells a story of tradition, passion, and innovation.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('irimas_about_story_content', array(
        'label' => __('Story Content', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('irimas_about_story_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'irimas_about_story_image', array(
        'label' => __('Story Section Image', 'irimas-kitchen'),
        'section' => 'irimas_about',
    )));
    
    $wp_customize->add_setting('irimas_about_mission', array(
        'default' => 'To deliver exceptional culinary experiences that celebrate the richness of Nigerian cuisine while embracing innovation and quality in every dish we serve.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('irimas_about_mission', array(
        'label' => __('Mission Statement', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('irimas_about_vision', array(
        'default' => 'To become the leading destination for authentic Nigerian cuisine, inspiring food lovers worldwide and setting the standard for excellence in African culinary arts.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('irimas_about_vision', array(
        'label' => __('Vision Statement', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('irimas_about_team_title', array(
        'default' => 'Meet Our Team',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_about_team_title', array(
        'label' => __('Team Section Title', 'irimas-kitchen'),
        'section' => 'irimas_about',
        'type' => 'text',
    ));
    
    // Contact Information
    $wp_customize->add_section('irimas_contact', array(
        'title' => __('Contact Information', 'irimas-kitchen'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('irimas_phone', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('irimas_phone', array(
        'label' => __('Phone Number', 'irimas-kitchen'),
        'section' => 'irimas_contact',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('irimas_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('irimas_email', array(
        'label' => __('Email Address', 'irimas-kitchen'),
        'section' => 'irimas_contact',
        'type' => 'email',
    ));
    
    $wp_customize->add_setting('irimas_address', array(
        'default' => 'Lennox Mall, Admiralty Way, Lekki Phase One, Lagos, Nigeria',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('irimas_address', array(
        'label' => __('Physical Address', 'irimas-kitchen'),
        'section' => 'irimas_contact',
        'type' => 'textarea',
    ));
    
    // Social Media
    $wp_customize->add_section('irimas_social', array(
        'title' => __('Social Media', 'irimas-kitchen'),
        'priority' => 50,
    ));
    
    $social_links = array('facebook', 'instagram', 'twitter', 'youtube');
    
    foreach ($social_links as $social) {
        $wp_customize->add_setting('irimas_' . $social, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('irimas_' . $social, array(
            'label' => sprintf(__('%s URL', 'irimas-kitchen'), ucfirst($social)),
            'section' => 'irimas_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'irimas_customize_register');
