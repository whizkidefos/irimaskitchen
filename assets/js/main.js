/**
 * Main JavaScript for Irima's Kitchen Theme
 */

(function($) {
    'use strict';

    // Initialize on document ready
    $(document).ready(function() {
        initializeAnimations();
        initializeHeader();
        initializeMobileMenu();
        initializeBackToTop();
        initializeCart();
        initializeForms();
        initializeRotatingText();
    });

    /**
     * Initialize Anime.js animations
     */
    function initializeAnimations() {
        // Hero animations
        if ($('.hero-section').length) {
            anime.timeline({
                easing: 'easeOutExpo',
                duration: 1000
            })
            .add({
                targets: '.hero-title',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: 300
            })
            .add({
                targets: '.hero-subtitle',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: 200
            }, '-=800')
            .add({
                targets: '.hero-buttons',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: 100
            }, '-=800')
            .add({
                targets: '.scroll-indicator',
                opacity: [0, 1],
                translateY: [20, 0]
            }, '-=600');
        }

        // Section titles animation on scroll
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: entry.target,
                        translateY: [50, 0],
                        opacity: [0, 1],
                        duration: 800,
                        easing: 'easeOutExpo'
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-title, .feature-card, .menu-item-card').forEach(el => {
            observer.observe(el);
        });

        // Stagger feature grid animation
        if ($('.feature-grid').length) {
            const featureObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        anime({
                            targets: '.feature-card',
                            translateY: [80, 0],
                            opacity: [0, 1],
                            delay: anime.stagger(100),
                            duration: 800,
                            easing: 'easeOutExpo'
                        });
                        featureObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.feature-grid').forEach(el => {
                featureObserver.observe(el);
            });
        }

        // Menu grid stagger
        if ($('.menu-grid').length) {
            const menuObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        anime({
                            targets: '.menu-item-card',
                            translateY: [80, 0],
                            opacity: [0, 1],
                            delay: anime.stagger(80),
                            duration: 700,
                            easing: 'easeOutExpo'
                        });
                        menuObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.menu-grid').forEach(el => {
                menuObserver.observe(el);
            });
        }

        // CTA section animation
        if ($('.cta-content').length) {
            const ctaObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        anime({
                            targets: '.cta-content',
                            scale: [0.95, 1],
                            opacity: [0, 1],
                            duration: 1000,
                            easing: 'easeOutExpo'
                        });
                        ctaObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.cta-content').forEach(el => {
                ctaObserver.observe(el);
            });
        }
    }

    /**
     * Initialize rotating text animation
     */
    function initializeRotatingText() {
        const rotatingText = $('.rotating-text');
        if (!rotatingText.length) return;

        const words = rotatingText.data('words');
        if (!words || !words.length) return;

        let currentIndex = 0;

        function rotateWord() {
            anime({
                targets: rotatingText[0],
                opacity: [1, 0],
                translateY: [0, -20],
                duration: 500,
                easing: 'easeInExpo',
                complete: function() {
                    currentIndex = (currentIndex + 1) % words.length;
                    rotatingText.text(words[currentIndex]);
                    anime({
                        targets: rotatingText[0],
                        opacity: [0, 1],
                        translateY: [20, 0],
                        duration: 500,
                        easing: 'easeOutExpo'
                    });
                }
            });
        }

        setInterval(rotateWord, 3000);
    }

    /**
     * Initialize header scroll effects
     */
    function initializeHeader() {
        const header = $('#site-header');
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });
    }

    /**
     * Initialize mobile menu
     */
    function initializeMobileMenu() {
        const toggle = $('#mobile-menu-toggle');
        const mobileNav = $('#mobile-nav');
        const openIcon = $('.menu-icon-open');
        const closeIcon = $('.menu-icon-close');

        toggle.on('click', function() {
            mobileNav.toggleClass('active hidden');
            openIcon.toggleClass('hidden');
            closeIcon.toggleClass('hidden');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length && mobileNav.hasClass('active')) {
                mobileNav.removeClass('active').addClass('hidden');
                openIcon.removeClass('hidden');
                closeIcon.addClass('hidden');
            }
        });
    }

    /**
     * Initialize back to top button
     */
    function initializeBackToTop() {
        const backToTop = $('#back-to-top');

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('visible').removeClass('translate-y-20 opacity-0');
            } else {
                backToTop.removeClass('visible').addClass('translate-y-20 opacity-0');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    /**
     * Initialize cart functionality
     */
    function initializeCart() {
        let cart = JSON.parse(localStorage.getItem('irimas_cart')) || [];
        updateCartCount();

        // Add to cart
        $(document).on('click', '.add-to-cart', function() {
            const button = $(this);
            const itemId = button.data('id');
            const itemName = button.data('name');
            const itemPrice = parseFloat(button.data('price'));

            // Add to cart array
            const existingItem = cart.find(item => item.id === itemId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: itemId,
                    name: itemName,
                    price: itemPrice,
                    quantity: 1
                });
            }

            // Save to localStorage
            localStorage.setItem('irimas_cart', JSON.stringify(cart));
            updateCartCount();

            // Button feedback
            const originalText = button.html();
            button.html('<span class="loading"></span>').prop('disabled', true);

            setTimeout(function() {
                button.html('✓ Added').addClass('bg-green-500');
                
                setTimeout(function() {
                    button.html(originalText).removeClass('bg-green-500').prop('disabled', false);
                }, 1500);
            }, 500);

            // Show notification
            showNotification('Item added to cart!', 'success');
        });

        function updateCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            $('.cart-count').text(totalItems);
        }
    }

    /**
     * Initialize forms
     */
    function initializeForms() {
        // Contact form
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.html('<span class="loading"></span>').prop('disabled', true);

            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_submit_contact_form',
                    nonce: irimasData.nonce,
                    name: form.find('[name="name"]').val(),
                    email: form.find('[name="email"]').val(),
                    phone: form.find('[name="phone"]').val(),
                    subject: form.find('[name="subject"]').val(),
                    message: form.find('[name="message"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data.message, 'success');
                        form[0].reset();
                    } else {
                        showNotification(response.data.message, 'error');
                    }
                },
                error: function() {
                    showNotification('An error occurred. Please try again.', 'error');
                },
                complete: function() {
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
        });

        // Login form
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.html('<span class="loading"></span>').prop('disabled', true);

            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_login_user',
                    nonce: irimasData.nonce,
                    username: form.find('[name="username"]').val(),
                    password: form.find('[name="password"]').val(),
                    remember: form.find('[name="remember"]').is(':checked')
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data.message, 'success');
                        setTimeout(function() {
                            window.location.href = response.data.redirect;
                        }, 1000);
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
        });

        // Register form
        $('#register-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();
            const password = form.find('[name="password"]').val();
            const confirmPassword = form.find('[name="confirm_password"]').val();

            if (password !== confirmPassword) {
                showNotification('Passwords do not match', 'error');
                return;
            }

            submitBtn.html('<span class="loading"></span>').prop('disabled', true);

            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_register_user',
                    nonce: irimasData.nonce,
                    username: form.find('[name="username"]').val(),
                    email: form.find('[name="email"]').val(),
                    password: password,
                    first_name: form.find('[name="first_name"]').val(),
                    last_name: form.find('[name="last_name"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data.message, 'success');
                        setTimeout(function() {
                            window.location.href = response.data.redirect;
                        }, 1000);
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
        });

        // Forgot password form
        $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.html('<span class="loading"></span>').prop('disabled', true);

            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_request_password_reset',
                    nonce: irimasData.nonce,
                    email: form.find('[name="email"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        form.hide();
                        $('#reset-success').removeClass('hidden');
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
        });

        // Resend reset link
        $('#resend-link').on('click', function() {
            $('#reset-success').addClass('hidden');
            $('#forgot-password-form').show();
        });

        // Reset password form
        $('#reset-password-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();
            const password = form.find('[name="password"]').val();
            const confirmPassword = form.find('[name="confirm_password"]').val();

            if (password.length < 8) {
                showNotification('Password must be at least 8 characters long', 'error');
                return;
            }

            if (password !== confirmPassword) {
                showNotification('Passwords do not match', 'error');
                return;
            }

            submitBtn.html('<span class="loading"></span>').prop('disabled', true);

            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_reset_password',
                    nonce: irimasData.nonce,
                    reset_key: form.find('[name="reset_key"]').val(),
                    user_login: form.find('[name="user_login"]').val(),
                    password: password,
                    confirm_password: confirmPassword
                },
                success: function(response) {
                    if (response.success) {
                        form.hide();
                        $('#reset-complete').removeClass('hidden');
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
        });

        // Password visibility toggle
        $('.toggle-password').on('click', function() {
            const btn = $(this);
            const input = btn.siblings('input');
            const eyeOpen = btn.find('.eye-open');
            const eyeClosed = btn.find('.eye-closed');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                eyeOpen.addClass('hidden');
                eyeClosed.removeClass('hidden');
            } else {
                input.attr('type', 'password');
                eyeOpen.removeClass('hidden');
                eyeClosed.addClass('hidden');
            }
        });

        // Password strength indicator
        $('#new-password').on('input', function() {
            const password = $(this).val();
            const strengthBar = $('#password-strength-bar');
            const strengthText = $('#password-strength-text');
            let strength = 0;
            let text = '';
            let color = '';

            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/) || password.match(/[^a-zA-Z0-9]/)) strength += 25;

            if (strength <= 25) {
                text = 'Weak';
                color = '#D72638';
            } else if (strength <= 50) {
                text = 'Fair';
                color = '#F49D37';
            } else if (strength <= 75) {
                text = 'Good';
                color = '#1F4E79';
            } else {
                text = 'Strong';
                color = '#3BB273';
            }

            strengthBar.css({ width: strength + '%', backgroundColor: color });
            strengthText.text(text).css('color', color);
        });

        // Password match indicator
        $('#confirm-password').on('input', function() {
            const password = $('#new-password').val();
            const confirm = $(this).val();
            const matchText = $('#password-match');

            if (confirm.length > 0) {
                matchText.removeClass('hidden');
                if (password === confirm) {
                    matchText.text('Passwords match').css('color', '#3BB273');
                } else {
                    matchText.text('Passwords do not match').css('color', '#D72638');
                }
            } else {
                matchText.addClass('hidden');
            }
        });
    }

    /**
     * Newsletter subscription
     */
    function initNewsletterForm() {
        $(document).on('submit', '.newsletter-form', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const emailInput = form.find('input[type="email"]');
            const submitBtn = form.find('button[type="submit"]');
            const originalBtnText = submitBtn.html();
            
            const email = emailInput.val().trim();
            
            if (!email) {
                showNotification('Please enter your email address.', 'error');
                return;
            }
            
            // Disable button and show loading
            submitBtn.prop('disabled', true).html('<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>');
            
            $.ajax({
                url: irimasData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'irimas_newsletter_subscribe',
                    nonce: irimasData.nonce,
                    email: email
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data.message, 'success');
                        emailInput.val('');
                    } else {
                        showNotification(response.data.message, 'error');
                    }
                },
                error: function() {
                    showNotification('An error occurred. Please try again.', 'error');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
    }
    
    // Initialize newsletter form
    initNewsletterForm();

    /**
     * Show notification
     */
    function showNotification(message, type) {
        type = type || 'info';
        const notification = $('<div>')
            .addClass('fixed top-20 right-4 z-50 px-6 py-4 rounded-lg shadow-lg max-w-sm alert alert-' + type)
            .html(message)
            .css({
                opacity: 0,
                transform: 'translateX(100%)'
            });

        $('body').append(notification);

        anime({
            targets: notification[0],
            translateX: [100, 0],
            opacity: [0, 1],
            duration: 400,
            easing: 'easeOutExpo'
        });

        setTimeout(function() {
            anime({
                targets: notification[0],
                translateX: [0, 100],
                opacity: [1, 0],
                duration: 400,
                easing: 'easeInExpo',
                complete: function() {
                    notification.remove();
                }
            });
        }, 5000);
    }

})(jQuery);
