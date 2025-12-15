<?php
/**
 * Template Name: Forgot Password Page
 * 
 * @package IrimasKitchen
 */

// Redirect logged in users
if (is_user_logged_in()) {
    wp_redirect(home_url('/profile/'));
    exit;
}

get_header();
?>

<div class="forgot-password-page py-20 bg-gradient-to-br from-cream-light to-white min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-irimas-orange/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                    <?php _e('Forgot Password?', 'irimas-kitchen'); ?>
                </h1>
                <p class="text-gray-600">
                    <?php _e('No worries! Enter your email and we\'ll send you reset instructions.', 'irimas-kitchen'); ?>
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <!-- Request Reset Form -->
                <form id="forgot-password-form" class="space-y-6">
                    <div>
                        <label class="form-label flex items-center gap-2">
                            <svg class="w-4 h-4 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <?php _e('Email Address', 'irimas-kitchen'); ?>
                        </label>
                        <input type="email" name="email" class="form-input" placeholder="<?php esc_attr_e('Enter your email address', 'irimas-kitchen'); ?>" required>
                    </div>

                    <button type="submit" class="w-full btn-primary flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php _e('Send Reset Link', 'irimas-kitchen'); ?>
                    </button>
                </form>

                <!-- Success Message (hidden by default) -->
                <div id="reset-success" class="hidden text-center py-8">
                    <div class="w-16 h-16 bg-irimas-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-irimas-blue mb-2"><?php _e('Check Your Email', 'irimas-kitchen'); ?></h3>
                    <p class="text-gray-600 mb-4"><?php _e('We\'ve sent password reset instructions to your email address.', 'irimas-kitchen'); ?></p>
                    <p class="text-sm text-gray-500"><?php _e('Didn\'t receive the email? Check your spam folder or', 'irimas-kitchen'); ?> 
                        <button type="button" id="resend-link" class="text-irimas-red hover:text-irimas-orange font-semibold"><?php _e('try again', 'irimas-kitchen'); ?></button>
                    </p>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600">
                        <?php _e('Remember your password?', 'irimas-kitchen'); ?>
                        <a href="<?php echo home_url('/login'); ?>" class="text-irimas-red font-semibold hover:text-irimas-orange transition">
                            <?php _e('Sign In', 'irimas-kitchen'); ?>
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="<?php echo home_url('/'); ?>" class="inline-flex items-center gap-2 text-gray-500 hover:text-irimas-blue transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <?php _e('Back to Home', 'irimas-kitchen'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
