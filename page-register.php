<?php
/**
 * Template Name: Register Page
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<div class="register-page py-20 bg-gradient-to-br from-cream-light to-white min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4 font-playfair text-irimas-blue">
                    <?php _e('Create Account', 'irimas-kitchen'); ?>
                </h1>
                <p class="text-gray-600">
                    <?php _e('Join Irima\'s Kitchen today', 'irimas-kitchen'); ?>
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form id="register-form" class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label"><?php _e('First Name', 'irimas-kitchen'); ?></label>
                            <input type="text" name="first_name" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label"><?php _e('Last Name', 'irimas-kitchen'); ?></label>
                            <input type="text" name="last_name" class="form-input" required>
                        </div>
                    </div>

                    <div>
                        <label class="form-label"><?php _e('Username', 'irimas-kitchen'); ?></label>
                        <input type="text" name="username" class="form-input" required>
                    </div>

                    <div>
                        <label class="form-label"><?php _e('Email', 'irimas-kitchen'); ?></label>
                        <input type="email" name="email" class="form-input" required>
                    </div>

                    <div>
                        <label class="form-label"><?php _e('Password', 'irimas-kitchen'); ?></label>
                        <input type="password" name="password" class="form-input" required>
                    </div>

                    <div>
                        <label class="form-label"><?php _e('Confirm Password', 'irimas-kitchen'); ?></label>
                        <input type="password" name="confirm_password" class="form-input" required>
                    </div>

                    <button type="submit" class="w-full btn-primary">
                        <?php _e('Create Account', 'irimas-kitchen'); ?>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        <?php _e('Already have an account?', 'irimas-kitchen'); ?>
                        <a href="<?php echo home_url('/login'); ?>" class="text-irimas-red font-semibold hover:text-irimas-orange">
                            <?php _e('Sign In', 'irimas-kitchen'); ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>