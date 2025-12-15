<?php
/**
 * Template Name: How to Order Page
 * 
 * @package IrimasKitchen
 */

get_header();
?>

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-r from-irimas-blue to-irimas-blue/90">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLTItNC00LTRzLTQgMi00IDQgMiA0IDQgNCA0LTIgNC00em0wLTMwYzAtMi0yLTQtNC00cy00IDItNCA0IDIgNCA0IDQgNC0yIDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-playfair"><?php _e('How to Order', 'irimas-kitchen'); ?></h1>
            <p class="text-xl opacity-90"><?php _e('Simple steps to enjoy our delicious meals', 'irimas-kitchen'); ?></p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-cream-light py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm text-gray-600">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-irimas-red transition"><?php _e('Home', 'irimas-kitchen'); ?></a>
            <span class="mx-2">/</span>
            <span class="text-irimas-blue font-medium"><?php _e('How to Order', 'irimas-kitchen'); ?></span>
        </nav>
    </div>
</div>

<!-- Steps Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Order in 4 Easy Steps', 'irimas-kitchen'); ?></h2>
                <div class="section-divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto"><?php _e('Getting your favorite meals from Irima\'s Kitchen is quick and easy. Follow these simple steps:', 'irimas-kitchen'); ?></p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <!-- Step 1 -->
                <div class="relative bg-cream-light rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-irimas-red text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">1</div>
                    <div class="ml-4">
                        <div class="w-16 h-16 bg-irimas-red/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 font-playfair text-irimas-blue"><?php _e('Browse Our Menu', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><?php _e('Explore our delicious selection of Nigerian dishes, bowls, and catering options. Each item includes detailed descriptions and pricing.', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative bg-cream-light rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-irimas-orange text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">2</div>
                    <div class="ml-4">
                        <div class="w-16 h-16 bg-irimas-orange/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 font-playfair text-irimas-blue"><?php _e('Add to Cart', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><?php _e('Click the "Add to Cart" button for items you want. You can adjust quantities and add special instructions for each item.', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="relative bg-cream-light rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-irimas-green text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">3</div>
                    <div class="ml-4">
                        <div class="w-16 h-16 bg-irimas-green/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 font-playfair text-irimas-blue"><?php _e('Checkout', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><?php _e('Review your order, enter your delivery details, and choose between delivery or pickup. Select your preferred payment method.', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="relative bg-cream-light rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-irimas-blue text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">4</div>
                    <div class="ml-4">
                        <div class="w-16 h-16 bg-irimas-blue/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 font-playfair text-irimas-blue"><?php _e('Enjoy Your Meal', 'irimas-kitchen'); ?></h3>
                        <p class="text-gray-600"><?php _e('Sit back and relax! We\'ll prepare your order fresh and deliver it to your doorstep, or have it ready for pickup.', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Delivery & Pickup Info -->
<section class="py-20 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Delivery -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-irimas-red/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-irimas-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Delivery', 'irimas-kitchen'); ?></h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Available within Lagos metropolis', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Delivery time: 45-60 minutes', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Delivery fee based on location', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Real-time order tracking', 'irimas-kitchen'); ?>
                        </li>
                    </ul>
                </div>
                
                <!-- Pickup -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-irimas-orange/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-irimas-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Pickup', 'irimas-kitchen'); ?></h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Ready in 30-45 minutes', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('No delivery fee', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('SMS notification when ready', 'irimas-kitchen'); ?>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-irimas-green mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <?php _e('Location: Lennox Mall, Lekki', 'irimas-kitchen'); ?>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- Payment Methods -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4 font-playfair text-irimas-blue"><?php _e('Payment Methods', 'irimas-kitchen'); ?></h2>
            <div class="section-divider"></div>
            <p class="text-gray-600 mb-12"><?php _e('We accept multiple payment options for your convenience', 'irimas-kitchen'); ?></p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-cream-light rounded-xl p-6 flex items-center gap-4">
                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center shadow">
                        <svg class="w-8 h-8 text-irimas-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-irimas-blue"><?php _e('Card Payment (Paystack)', 'irimas-kitchen'); ?></h4>
                        <p class="text-sm text-gray-600"><?php _e('Visa, Mastercard, Verve', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
                
                <div class="bg-cream-light rounded-xl p-6 flex items-center gap-4">
                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center shadow">
                        <svg class="w-8 h-8 text-irimas-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-irimas-blue"><?php _e('Bank Transfer', 'irimas-kitchen'); ?></h4>
                        <p class="text-sm text-gray-600"><?php _e('Direct bank transfer', 'irimas-kitchen'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-irimas-blue to-irimas-green text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4 font-playfair"><?php _e('Ready to Order?', 'irimas-kitchen'); ?></h2>
            <p class="text-xl opacity-90 mb-8"><?php _e('Start browsing our menu and place your order today!', 'irimas-kitchen'); ?></p>
            <a href="<?php echo home_url('/order'); ?>" class="btn-primary-white text-lg">
                <?php _e('Order Now', 'irimas-kitchen'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
