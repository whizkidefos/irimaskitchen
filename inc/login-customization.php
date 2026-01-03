<?php
/**
 * WordPress Login Screen Customization
 * 
 * @package IrimasKitchen
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customize login page styles
 */
function irimas_login_styles() {
    ?>
    <style type="text/css">
        /* Background */
        body.login {
            background: linear-gradient(135deg, #1F4E79 0%, #3BB273 100%);
            background-size: cover;
            background-attachment: fixed;
        }

        /* Add decorative pattern overlay */
        body.login::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0YzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHptMC0zMGMwLTItMi00LTQtNHMtNCAyLTQgNCAyIDQgNCA0IDQtMiA0LTR6Ii8+PC9nPjwvZz48L3N2Zz4=');
            opacity: 0.3;
            pointer-events: none;
        }

        /* Logo Container */
        #login h1 a {
            background-image: url('<?php echo get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : IRIMAS_THEME_URI . '/assets/images/logo.png'; ?>');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 320px;
            height: 120px;
            padding-bottom: 0;
            margin-bottom: 20px;
        }

        /* Login Form Container */
        #login {
            padding: 5% 0 0;
        }

        #loginform,
        #registerform,
        #lostpasswordform {
            background: rgba(255, 255, 255, 0.98);
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            margin-top: 20px;
        }

        /* Form Labels */
        .login label {
            color: #1F4E79;
            font-size: 14px;
            font-weight: 600;
        }

        /* Input Fields */
        .login input[type="text"],
        .login input[type="password"],
        .login input[type="email"] {
            background: #FDF6EC;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: none;
        }

        .login input[type="text"]:focus,
        .login input[type="password"]:focus,
        .login input[type="email"]:focus {
            background: #ffffff;
            border-color: #D72638;
            box-shadow: 0 0 0 3px rgba(215, 38, 56, 0.1);
            outline: none;
        }

        /* Submit Button */
        .wp-core-ui .button-primary {
            background: #D72638;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(215, 38, 56, 0.3);
            text-shadow: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            height: auto;
            transition: all 0.3s ease;
        }

        .wp-core-ui .button-primary:hover,
        .wp-core-ui .button-primary:focus {
            background: #F49D37;
            box-shadow: 0 6px 16px rgba(244, 157, 55, 0.4);
            transform: translateY(-2px);
        }

        .wp-core-ui .button-primary:active {
            transform: translateY(0);
        }

        /* Remember Me Checkbox */
        .login .forgetmenot label {
            color: #4b5563;
            font-weight: 500;
        }

        input[type="checkbox"]:checked::before {
            color: #D72638;
        }

        /* Links */
        .login #nav a,
        .login #backtoblog a {
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .login #nav a:hover,
        .login #backtoblog a:hover {
            color: #FDF6EC;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        /* Privacy Link */
        .privacy-policy-page-link {
            text-align: center;
            margin-top: 20px;
        }

        .privacy-policy-page-link a {
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Messages */
        .login .message,
        .login .success {
            background: #D1FAE5;
            border-left: 4px solid #3BB273;
            border-radius: 8px;
            color: #065F46;
            padding: 16px;
        }

        .login #login_error {
            background: #FEE2E2;
            border-left: 4px solid #D72638;
            border-radius: 8px;
            color: #991B1B;
            padding: 16px;
        }

        /* Language Switcher */
        .login .language-switcher {
            text-align: center;
            margin-top: 20px;
        }

        .login .language-switcher label {
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .login .language-switcher select {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 8px;
            color: #1F4E79;
        }

        /* Footer Text */
        #login h1 {
            position: relative;
        }

        #login h1::after {
            content: 'Irima\'s Kitchen Admin';
            display: block;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            margin-top: 10px;
            font-family: 'Playfair Display', serif;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            #loginform,
            #registerform,
            #lostpasswordform {
                padding: 24px;
            }

            #login h1 a {
                width: 240px;
                height: 90px;
            }
        }

        /* Loading Animation */
        .login form .button-primary.disabled,
        .login form .button-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Add subtle animation to form */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #loginform,
        #registerform,
        #lostpasswordform {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom Footer */
        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            font-size: 14px;
        }

        .login-footer a {
            color: #FDF6EC;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: #ffffff;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'irimas_login_styles');

/**
 * Change login logo URL
 */
function irimas_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'irimas_login_logo_url');

/**
 * Change login logo title
 */
function irimas_login_logo_title() {
    return get_bloginfo('name') . ' - ' . get_bloginfo('description');
}
add_filter('login_headertext', 'irimas_login_logo_title');

/**
 * Add custom footer to login page
 */
function irimas_login_footer() {
    ?>
    <div class="login-footer">
        <p>
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'irimas-kitchen'); ?>
        </p>
        <p>
            <?php _e('Powered by', 'irimas-kitchen'); ?> 
            <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
        </p>
    </div>
    <?php
}
add_action('login_footer', 'irimas_login_footer');

/**
 * Add Google Fonts to login page
 */
function irimas_login_fonts() {
    wp_enqueue_style('irimas-login-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap');
}
add_action('login_enqueue_scripts', 'irimas_login_fonts');

/**
 * Customize login error messages for security
 */
function irimas_login_errors($error) {
    global $errors;
    $err_codes = $errors->get_error_codes();

    // Change error messages for better security
    if (in_array('invalid_username', $err_codes)) {
        $error = __('Invalid login credentials.', 'irimas-kitchen');
    }

    if (in_array('incorrect_password', $err_codes)) {
        $error = __('Invalid login credentials.', 'irimas-kitchen');
    }

    return $error;
}
add_filter('login_errors', 'irimas_login_errors');
