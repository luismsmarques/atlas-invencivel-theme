/**
 * Contact Form JavaScript
 * Handles contact form interactions and validation
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        const contactForm = $('.contact-form');
        const submitBtn = contactForm.find('button[type="submit"]');
        const btnText = submitBtn.find('.btn-text');
        const btnLoading = submitBtn.find('.btn-loading');
        
        // Form validation
        function validateForm() {
            let isValid = true;
            
            // Clear previous errors
            contactForm.find('.field-error').text('');
            contactForm.find('.form-group').removeClass('error');
            
            // Validate required fields
            contactForm.find('input[required], textarea[required]').each(function() {
                const field = $(this);
                const value = field.val().trim();
                const fieldId = field.attr('id');
                const errorElement = $('#' + fieldId + '-error');
                
                if (!value) {
                    errorElement.text('This field is required.');
                    field.closest('.form-group').addClass('error');
                    isValid = false;
                }
            });
            
            // Validate email
            const emailField = contactForm.find('input[type="email"]');
            const emailValue = emailField.val().trim();
            const emailError = $('#contact-email-error');
            
            if (emailValue && !isValidEmail(emailValue)) {
                emailError.text('Please enter a valid email address.');
                emailField.closest('.form-group').addClass('error');
                isValid = false;
            }
            
            return isValid;
        }
        
        // Email validation helper
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        // Real-time validation
        contactForm.find('input, textarea').on('blur', function() {
            const field = $(this);
            const value = field.val().trim();
            const fieldId = field.attr('id');
            const errorElement = $('#' + fieldId + '-error');
            
            // Clear previous error
            errorElement.text('');
            field.closest('.form-group').removeClass('error');
            
            // Validate if required
            if (field.prop('required') && !value) {
                errorElement.text('This field is required.');
                field.closest('.form-group').addClass('error');
            }
            
            // Validate email
            if (field.attr('type') === 'email' && value && !isValidEmail(value)) {
                errorElement.text('Please enter a valid email address.');
                field.closest('.form-group').addClass('error');
            }
        });
        
        // Clear errors on input
        contactForm.find('input, textarea').on('input', function() {
            const field = $(this);
            const fieldId = field.attr('id');
            const errorElement = $('#' + fieldId + '-error');
            
            errorElement.text('');
            field.closest('.form-group').removeClass('error');
        });
        
        // Form submission
        contactForm.on('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            btnText.hide();
            btnLoading.show();
            submitBtn.prop('disabled', true);
        });
        
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });
    });
    
})(jQuery);