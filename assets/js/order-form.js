/**
 * Order Form JavaScript
 */

(function($) {
    'use strict';

    let cart = JSON.parse(localStorage.getItem('irimas_cart')) || [];

    $(document).ready(function() {
        initializeCart();
        initializeCategoryFilter();
        initializeCheckout();
    });

    function initializeCart() {
        renderCart();

        // Add to cart
        $(document).on('click', '.add-to-cart-btn', function() {
            const btn = $(this);
            const id = btn.data('id');
            const name = btn.data('name');
            const price = parseFloat(btn.data('price'));
            const image = btn.data('image');

            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, image, quantity: 1 });
            }

            saveCart();
            renderCart();
            showNotification('Added to cart!', 'success');
        });

        // Update quantity
        $(document).on('click', '.cart-qty-plus', function() {
            const id = parseInt($(this).data('id'));
            const item = cart.find(i => i.id === id);
            if (item) {
                item.quantity += 1;
                saveCart();
                renderCart();
            }
        });

        $(document).on('click', '.cart-qty-minus', function() {
            const id = parseInt($(this).data('id'));
            const item = cart.find(i => i.id === id);
            if (item && item.quantity > 1) {
                item.quantity -= 1;
                saveCart();
                renderCart();
            }
        });

        // Remove item
        $(document).on('click', '.cart-remove', function() {
            const id = parseInt($(this).data('id'));
            cart = cart.filter(item => item.id !== id);
            saveCart();
            renderCart();
            showNotification('Item removed', 'info');
        });
    }

    function renderCart() {
        const cartItems = $('#cart-items');
        const emptyMsg = $('#empty-cart-message');
        const totalSection = $('#cart-total-section');
        const checkoutBtn = $('#checkout-btn');

        if (cart.length === 0) {
            emptyMsg.show();
            totalSection.hide();
            checkoutBtn.hide();
            $('.cart-count').text('0');
            return;
        }

        emptyMsg.hide();
        totalSection.show();
        checkoutBtn.show();

        let html = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            html += `
                <div class="cart-item mb-4 pb-4 border-b">
                    <div class="flex items-start space-x-3">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold text-sm mb-1">${item.name}</h4>
                            <p class="text-irimas-red font-bold">₦${item.price.toLocaleString()}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <button class="cart-qty-minus w-6 h-6 bg-gray-200 rounded flex items-center justify-center" data-id="${item.id}">-</button>
                                <span class="w-8 text-center">${item.quantity}</span>
                                <button class="cart-qty-plus w-6 h-6 bg-gray-200 rounded flex items-center justify-center" data-id="${item.id}">+</button>
                                <button class="cart-remove text-red-500 ml-auto" data-id="${item.id}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItems.html(html);
        $('#cart-subtotal').text('₦' + total.toLocaleString());
        $('.cart-count').text(cart.reduce((sum, item) => sum + item.quantity, 0));
    }

    function saveCart() {
        localStorage.setItem('irimas_cart', JSON.stringify(cart));
    }

    function initializeCategoryFilter() {
        $('.category-btn').on('click', function() {
            const category = $(this).data('category');
            
            $('.category-btn').removeClass('active bg-irimas-red text-white').addClass('bg-gray-200 text-gray-700');
            $(this).removeClass('bg-gray-200 text-gray-700').addClass('active bg-irimas-red text-white');

            if (category === 'all') {
                $('.menu-item-card').fadeIn();
            } else {
                $('.menu-item-card').hide();
                $(`.menu-item-card[data-category="${category}"]`).fadeIn();
            }
        });
    }

    function initializeCheckout() {
        $('#checkout-btn').on('click', function() {
            renderCheckoutSummary();
            $('#checkout-modal').removeClass('hidden');
        });

        $('#close-checkout-modal').on('click', function() {
            $('#checkout-modal').addClass('hidden');
        });

        $('#checkout-form').on('submit', function(e) {
            e.preventDefault();
            processOrder();
        });
    }

    function renderCheckoutSummary() {
        let html = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            html += `
                <div class="flex justify-between text-sm mb-1">
                    <span>${item.name} x ${item.quantity}</span>
                    <span>₦${itemTotal.toLocaleString()}</span>
                </div>
            `;
        });

        $('#checkout-summary').html(html);
        $('#checkout-total').text('₦' + total.toLocaleString());
    }

    function processOrder() {
        const form = $('#checkout-form');
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.html();

        submitBtn.html('<span class="loading"></span> Processing...').prop('disabled', true);

        $.ajax({
            url: irimasData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'irimas_process_order',
                nonce: irimasData.nonce,
                customer_name: form.find('[name="customer_name"]').val(),
                customer_email: form.find('[name="customer_email"]').val(),
                customer_phone: form.find('[name="customer_phone"]').val(),
                customer_address: form.find('[name="customer_address"]').val(),
                delivery_option: form.find('[name="delivery_option"]').val(),
                payment_method: form.find('[name="payment_method"]').val(),
                special_instructions: form.find('[name="special_instructions"]').val(),
                order_items: JSON.stringify(cart)
            },
            success: function(response) {
                if (response.success) {
                    if (response.data.payment_data && response.data.payment_data.authorization_url) {
                        // Redirect to Paystack
                        window.location.href = response.data.payment_data.authorization_url;
                    } else {
                        // Bank transfer - show success message
                        showNotification('Order placed successfully! Check your email for details.', 'success');
                        cart = [];
                        saveCart();
                        renderCart();
                        $('#checkout-modal').addClass('hidden');
                        form[0].reset();
                    }
                } else {
                    showNotification(response.data.message, 'error');
                    submitBtn.html(originalText).prop('disabled', false);
                }
            },
            error: function() {
                showNotification('An error occurred. Please try again.', 'error');
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    }

    function showNotification(message, type = 'info') {
        const notification = $('<div>')
            .addClass('fixed top-20 right-4 z-50 px-6 py-4 rounded-lg shadow-lg max-w-sm alert alert-' + type)
            .html(message);

        $('body').append(notification);

        setTimeout(function() {
            notification.fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }

})(jQuery);