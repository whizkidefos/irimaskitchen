<?php
/**
 * Template Name: Reset Password Page
 * 
 * @package IrimasKitchen
 */

// Redirect logged in users
if (is_user_logged_in()) {
    wp_redirect(home_url('/profile/'));
    exit;
}

// Get reset key and login from URL
$reset_key = isset($_GET['key']) ? sanitize_text_field($_GET['key']) : '';
$user_login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';

get_header();
?>

<div class="reset-password-page py-20 bg-gradient-to-br from-cream-light to-white min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <?php if (empty($reset_key) || empty($user_login)): ?>
                <!-- Invalid/Missing Reset Link -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-irimas-red/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold mb-4 font-playfair text-irimas-blue">
                        <?php _e('Invalid Reset Link', 'irimas-kitchen'); ?>
                    </h1>
                    <p class="text-gray-600 mb-6">
                        <?php _e('This password reset link is invalid or has expired. Please request a new one.', 'irimas-kitchen'); ?>
                    </p>
                    <a href="<?php echo home_url('/forgot-password'); ?>" class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <?php _e('Request New Link', 'irimas-kitchen'); ?>
                    </a>
                </div>
            <?php else: ?>
                <!-- Reset Password Form -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-irimas-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                        <?php _e('Create New Password', 'irimas-kitchen'); ?>
                    </h1>
                    <p class="text-gray-600">
                        <?php _e('Your new password must be at least 8 characters long.', 'irimas-kitchen'); ?>
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <form id="reset-password-form" class="space-y-6">
                        <input type="hidden" name="reset_key" value="<?php echo esc_attr($reset_key); ?>">
                        <input type="hidden" name="user_login" value="<?php echo esc_attr($user_login); ?>">
                        
                        <div>
                            <label class="form-label flex items-center gap-2">
                                <svg class="w-4 h-4 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <?php _e('New Password', 'irimas-kitchen'); ?>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="new-password" class="form-input pr-12" placeholder="<?php esc_attr_e('Enter new password', 'irimas-kitchen'); ?>" required minlength="8">
                                <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-irimas-blue transition">
                                    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Password strength indicator -->
                            <div class="mt-2">
                                <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                                    <div id="password-strength-bar" class="h-full w-0 transition-all duration-300"></div>
                                </div>
                                <p id="password-strength-text" class="text-xs mt-1 text-gray-500"></p>
                            </div>
                        </div>

                        <div>
                            <label class="form-label flex items-center gap-2">
                                <svg class="w-4 h-4 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <?php _e('Confirm New Password', 'irimas-kitchen'); ?>
                            </label>
                            <div class="relative">
                                <input type="password" name="confirm_password" id="confirm-password" class="form-input pr-12" placeholder="<?php esc_attr_e('Confirm new password', 'irimas-kitchen'); ?>" required>
                                <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-irimas-blue transition">
                                    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            <p id="password-match" class="text-xs mt-1 hidden"></p>
                        </div>

                        <button type="submit" class="w-full btn-primary flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <?php _e('Reset Password', 'irimas-kitchen'); ?>
                        </button>
                    </form>

                    <!-- Success Message (hidden by default) -->
                    <div id="reset-complete" class="hidden text-center py-8">
                        <div class="w-16 h-16 bg-irimas-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-irimas-blue mb-2"><?php _e('Password Reset Complete!', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600 mb-6"><?php _e('Your password has been successfully reset.', 'irimas-kitchen'); ?></p>
                        <a href="<?php echo home_url('/login'); ?>" class="btn-primary inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <?php _e('Sign In Now', 'irimas-kitchen'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
