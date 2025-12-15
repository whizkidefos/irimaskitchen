<?php
/**
 * Template Name: Login Page
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<div class="login-page py-20 bg-gradient-to-br from-cream-light to-white min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                    <?php _e('Welcome Back', 'irimas-kitchen'); ?>
                </h1>
                <p class="text-gray-600">
                    <?php _e('Sign in to your account', 'irimas-kitchen'); ?>
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form id="login-form" class="space-y-6">
                    <div>
                        <label class="form-label"><?php _e('Username or Email', 'irimas-kitchen'); ?></label>
                        <input type="text" name="username" class="form-input" required>
                    </div>

                    <div>
                        <label class="form-label"><?php _e('Password', 'irimas-kitchen'); ?></label>
                        <input type="password" name="password" class="form-input" required>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-600"><?php _e('Remember me', 'irimas-kitchen'); ?></label>
                    </div>

                    <button type="submit" class="w-full btn-primary">
                        <?php _e('Sign In', 'irimas-kitchen'); ?>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 mb-4">
                        <?php _e('Don\'t have an account?', 'irimas-kitchen'); ?>
                        <a href="<?php echo home_url('/register'); ?>" class="text-irimas-red font-semibold hover:text-irimas-orange">
                            <?php _e('Register', 'irimas-kitchen'); ?>
                        </a>
                    </p>
                    <a href="<?php echo home_url('/forgot-password'); ?>" class="text-sm text-gray-500 hover:text-irimas-blue transition">
                        <?php _e('Forgot your password?', 'irimas-kitchen'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>