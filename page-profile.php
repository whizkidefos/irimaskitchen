<?php
/**
 * Template Name: Profile Page
 * 
 * @package IrimasKitchen
 */

// Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login/'));
    exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

get_header();
?>

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-r from-irimas-blue to-irimas-blue/90">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-full overflow-hidden ring-4 ring-white shadow-xl">
                <?php echo get_avatar($user_id, 80, '', $current_user->display_name, array('class' => 'w-full h-full object-cover')); ?>
            </div>
            <div class="text-white">
                <h1 class="text-3xl font-bold font-playfair"><?php echo esc_html($current_user->display_name); ?></h1>
                <p class="opacity-90"><?php echo esc_html($current_user->user_email); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Profile Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Sidebar Navigation -->
                <aside class="lg:col-span-1">
                    <nav class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-24">
                        <ul class="divide-y divide-gray-100">
                            <li>
                                <a href="#profile" class="profile-tab-link flex items-center gap-3 px-5 py-4 text-irimas-blue font-medium hover:bg-cream-light transition active" data-tab="profile">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <?php _e('Profile', 'irimas-kitchen'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#orders" class="profile-tab-link flex items-center gap-3 px-5 py-4 text-gray-600 hover:text-irimas-blue hover:bg-cream-light transition" data-tab="orders">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <?php _e('My Orders', 'irimas-kitchen'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#security" class="profile-tab-link flex items-center gap-3 px-5 py-4 text-gray-600 hover:text-irimas-blue hover:bg-cream-light transition" data-tab="security">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <?php _e('Security', 'irimas-kitchen'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo wp_logout_url(home_url('/')); ?>" class="flex items-center gap-3 px-5 py-4 text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <?php _e('Logout', 'irimas-kitchen'); ?>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </aside>
                
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    
                    <!-- Profile Tab -->
                    <div id="profile-tab" class="profile-tab-content">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue"><?php _e('Profile Information', 'irimas-kitchen'); ?></h2>
                            
                            <form id="profile-form" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('First Name', 'irimas-kitchen'); ?></label>
                                        <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition">
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Last Name', 'irimas-kitchen'); ?></label>
                                        <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($current_user->last_name); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Email Address', 'irimas-kitchen'); ?></label>
                                    <input type="email" id="email" value="<?php echo esc_attr($current_user->user_email); ?>" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500" disabled>
                                    <p class="text-xs text-gray-500 mt-1"><?php _e('Email cannot be changed.', 'irimas-kitchen'); ?></p>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Phone Number', 'irimas-kitchen'); ?></label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo esc_attr(get_user_meta($user_id, 'phone', true)); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" placeholder="+234 XXX XXX XXXX">
                                </div>
                                
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Delivery Address', 'irimas-kitchen'); ?></label>
                                    <textarea id="address" name="address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition resize-none" placeholder="<?php _e('Enter your delivery address...', 'irimas-kitchen'); ?>"><?php echo esc_textarea(get_user_meta($user_id, 'address', true)); ?></textarea>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" class="btn-primary">
                                        <?php _e('Save Changes', 'irimas-kitchen'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Orders Tab -->
                    <div id="orders-tab" class="profile-tab-content hidden">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue"><?php _e('My Orders', 'irimas-kitchen'); ?></h2>
                            
                            <?php
                            $orders = get_posts(array(
                                'post_type' => 'order',
                                'author' => $user_id,
                                'posts_per_page' => 10,
                                'orderby' => 'date',
                                'order' => 'DESC',
                            ));
                            
                            if ($orders):
                            ?>
                                <div class="space-y-4">
                                    <?php foreach ($orders as $order): 
                                        $order_status = get_post_meta($order->ID, '_order_status', true);
                                        $order_total = get_post_meta($order->ID, '_order_total', true);
                                        $order_items = get_post_meta($order->ID, '_order_items', true);
                                        
                                        $status_colors = array(
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        );
                                        $status_color = isset($status_colors[$order_status]) ? $status_colors[$order_status] : 'bg-gray-100 text-gray-800';
                                    ?>
                                        <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition">
                                            <div class="flex flex-wrap items-center justify-between gap-4 mb-3">
                                                <div>
                                                    <span class="text-sm text-gray-500"><?php _e('Order', 'irimas-kitchen'); ?></span>
                                                    <span class="font-bold text-irimas-blue">#<?php echo $order->ID; ?></span>
                                                </div>
                                                <span class="<?php echo $status_color; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                                    <?php echo ucfirst($order_status); ?>
                                                </span>
                                            </div>
                                            <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
                                                <div class="text-gray-600">
                                                    <span><?php echo get_the_date('M j, Y', $order); ?></span>
                                                    <?php if ($order_items && is_array($order_items)): ?>
                                                        <span class="mx-2">•</span>
                                                        <span><?php echo count($order_items); ?> <?php _e('items', 'irimas-kitchen'); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="font-bold text-irimas-green">
                                                    ₦<?php echo number_format($order_total); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <h3 class="text-lg font-bold text-gray-600 mb-2"><?php _e('No Orders Yet', 'irimas-kitchen'); ?></h3>
                                    <p class="text-gray-500 mb-6"><?php _e('You haven\'t placed any orders yet.', 'irimas-kitchen'); ?></p>
                                    <a href="<?php echo home_url('/order'); ?>" class="btn-primary">
                                        <?php _e('Start Ordering', 'irimas-kitchen'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Security Tab -->
                    <div id="security-tab" class="profile-tab-content hidden">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold mb-6 font-playfair text-irimas-blue"><?php _e('Change Password', 'irimas-kitchen'); ?></h2>
                            
                            <form id="password-form" class="space-y-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Current Password', 'irimas-kitchen'); ?></label>
                                    <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" required>
                                </div>
                                
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('New Password', 'irimas-kitchen'); ?></label>
                                    <input type="password" id="new_password" name="new_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" required>
                                    <div class="mt-2">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div id="password-strength-bar" class="h-full bg-gray-400 transition-all duration-300" style="width: 0%"></div>
                                        </div>
                                        <p id="password-strength-text" class="text-xs mt-1 text-gray-500"></p>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="confirm_new_password" class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Confirm New Password', 'irimas-kitchen'); ?></label>
                                    <input type="password" id="confirm_new_password" name="confirm_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" required>
                                    <p id="password-match-text" class="text-xs mt-1 hidden"></p>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" class="btn-primary">
                                        <?php _e('Update Password', 'irimas-kitchen'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Account Info -->
                        <div class="bg-white rounded-xl shadow-lg p-8 mt-8">
                            <h3 class="text-lg font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Account Information', 'irimas-kitchen'); ?></h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-500"><?php _e('Username', 'irimas-kitchen'); ?></span>
                                    <span class="font-medium"><?php echo esc_html($current_user->user_login); ?></span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-500"><?php _e('Member Since', 'irimas-kitchen'); ?></span>
                                    <span class="font-medium"><?php echo date_i18n('F j, Y', strtotime($current_user->user_registered)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabLinks = document.querySelectorAll('.profile-tab-link');
    const tabContents = document.querySelectorAll('.profile-tab-content');
    
    tabLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.getAttribute('data-tab');
            
            // Update active states
            tabLinks.forEach(function(l) {
                l.classList.remove('active', 'text-irimas-blue', 'font-medium');
                l.classList.add('text-gray-600');
            });
            this.classList.add('active', 'text-irimas-blue', 'font-medium');
            this.classList.remove('text-gray-600');
            
            // Show/hide content
            tabContents.forEach(function(content) {
                content.classList.add('hidden');
            });
            document.getElementById(tabId + '-tab').classList.remove('hidden');
        });
    });
    
    // Profile form submission
    const profileForm = document.getElementById('profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'irimas_update_profile');
            formData.append('nonce', irimasData.nonce);
            
            fetch(irimasData.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.data.message, 'success');
                } else {
                    showNotification(data.data.message, 'error');
                }
            })
            .catch(() => {
                showNotification('An error occurred. Please try again.', 'error');
            });
        });
    }
    
    // Password form submission
    const passwordForm = document.getElementById('password-form');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'irimas_change_password');
            formData.append('nonce', irimasData.nonce);
            
            fetch(irimasData.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.data.message, 'success');
                    passwordForm.reset();
                } else {
                    showNotification(data.data.message, 'error');
                }
            })
            .catch(() => {
                showNotification('An error occurred. Please try again.', 'error');
            });
        });
        
        // Password strength indicator
        const newPasswordInput = document.getElementById('new_password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let text = '';
            let color = '#ccc';
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/) || password.match(/[^a-zA-Z0-9]/)) strength += 25;
            
            if (strength <= 25) {
                text = 'Weak';
                color = '#D72638';
            } else if (strength <= 50) {
                text = 'Fair';
                color = '#F5A623';
            } else if (strength <= 75) {
                text = 'Good';
                color = '#7ED321';
            } else {
                text = 'Strong';
                color = '#3BB273';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });
        
        // Password match indicator
        const confirmPasswordInput = document.getElementById('confirm_new_password');
        const matchText = document.getElementById('password-match-text');
        
        confirmPasswordInput.addEventListener('input', function() {
            const password = newPasswordInput.value;
            const confirm = this.value;
            
            if (confirm.length > 0) {
                matchText.classList.remove('hidden');
                if (password === confirm) {
                    matchText.textContent = 'Passwords match';
                    matchText.style.color = '#3BB273';
                } else {
                    matchText.textContent = 'Passwords do not match';
                    matchText.style.color = '#D72638';
                }
            } else {
                matchText.classList.add('hidden');
            }
        });
    }
    
    // Notification helper
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 z-50 px-6 py-4 rounded-lg shadow-lg max-w-sm alert alert-' + type;
        notification.innerHTML = message;
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transition = 'all 0.3s ease';
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Remove after 5 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
});
</script>

<?php get_footer(); ?>
