/**
 * Contact Page JavaScript
 * Handles form submission, FAQ interactions, and other contact page functionality
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Contact Form Handling
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactFormSubmit);
    }
    
    // FAQ Accordion Functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', toggleFAQ);
        }
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', smoothScroll);
    });
    
    // Form validation and enhancement
    enhanceFormInputs();
    
    // Initialize animations
    initializeAnimations();
});

/**
 * Handle contact form submission
 */
function handleContactFormSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitButton = form.querySelector('.contact-submit-button');
    const formData = new FormData(form);
    
    // Validate form
    if (!validateContactForm(form)) {
        return;
    }
    
    // Show loading state
    showLoadingState(submitButton);
    
    // Add action to form data
    formData.append('action', 'contact_form_submit');
    
    // Send AJAX request
    fetch(atlas_theme_ajax.ajax_url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingState(submitButton);
        
        if (data.success) {
            showSuccessMessage(data.data.message);
            form.reset();
        } else {
            showErrorMessage(data.data.message || 'An error occurred. Please try again.');
        }
    })
    .catch(error => {
        hideLoadingState(submitButton);
        showErrorMessage('Network error. Please check your connection and try again.');
        console.error('Contact form error:', error);
    });
}

/**
 * Validate contact form
 */
function validateContactForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            showFieldError(field, 'This field is required');
            isValid = false;
        } else {
            clearFieldError(field);
        }
    });
    
    // Validate email
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            showFieldError(emailField, 'Please enter a valid email address');
            isValid = false;
        }
    }
    
    // Validate phone (optional)
    const phoneField = form.querySelector('input[type="tel"]');
    if (phoneField && phoneField.value) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(phoneField.value)) {
            showFieldError(phoneField, 'Please enter a valid phone number');
            isValid = false;
        }
    }
    
    return isValid;
}

/**
 * Show field error
 */
function showFieldError(field, message) {
    clearFieldError(field);
    
    field.classList.add('error');
    
    const errorElement = document.createElement('div');
    errorElement.className = 'field-error';
    errorElement.textContent = message;
    
    field.parentNode.appendChild(errorElement);
}

/**
 * Clear field error
 */
function clearFieldError(field) {
    field.classList.remove('error');
    
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

/**
 * Show loading state
 */
function showLoadingState(button) {
    button.classList.add('loading');
    button.disabled = true;
}

/**
 * Hide loading state
 */
function hideLoadingState(button) {
    button.classList.remove('loading');
    button.disabled = false;
}

/**
 * Show success message
 */
function showSuccessMessage(customMessage = null) {
    const message = document.createElement('div');
    message.className = 'contact-success-message';
    message.innerHTML = `
        <div class="success-content">
            <i class="fas fa-check-circle"></i>
            <h3>Message Sent Successfully!</h3>
            <p>${customMessage || 'Thank you for your message. I\'ll get back to you within 24 hours.'}</p>
        </div>
    `;
    
    document.body.appendChild(message);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        message.remove();
    }, 5000);
}

/**
 * Show error message
 */
function showErrorMessage(errorMessage) {
    const message = document.createElement('div');
    message.className = 'contact-error-message';
    message.innerHTML = `
        <div class="error-content">
            <i class="fas fa-exclamation-circle"></i>
            <h3>Error</h3>
            <p>${errorMessage}</p>
        </div>
    `;
    
    document.body.appendChild(message);
    
    // Auto remove after 7 seconds
    setTimeout(() => {
        message.remove();
    }, 7000);
}

/**
 * Toggle FAQ item
 */
function toggleFAQ(e) {
    const faqItem = e.currentTarget.parentNode;
    const isActive = faqItem.classList.contains('active');
    
    // Close all FAQ items
    document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Open clicked item if it wasn't active
    if (!isActive) {
        faqItem.classList.add('active');
    }
}

/**
 * Smooth scroll for anchor links
 */
function smoothScroll(e) {
    e.preventDefault();
    
    const targetId = this.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);
    
    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

/**
 * Enhance form inputs with better UX
 */
function enhanceFormInputs() {
    const inputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
    
    inputs.forEach(input => {
        // Add focus/blur effects
        input.addEventListener('focus', function() {
            this.parentNode.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentNode.classList.remove('focused');
            }
        });
        
        // Add floating label effect
        if (input.value) {
            input.parentNode.classList.add('focused');
        }
        
        // Real-time validation
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                clearFieldError(this);
            }
        });
    });
}

/**
 * Initialize scroll animations
 */
function initializeAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.contact-method-card, .contact-info-card, .contact-social-card, .contact-hours-card, .faq-item');
    animateElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * Add CSS for form enhancements
 */
const contactStyles = `
    .form-group.focused .form-label {
        color: #134686;
        transform: translateY(-2px);
    }
    
    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }
    
    .field-error {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    
    .contact-success-message {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
        max-width: 400px;
    }
    
    .success-content {
        padding: 20px;
        text-align: center;
    }
    
    .success-content i {
        font-size: 48px;
        color: #27ae60;
        margin-bottom: 15px;
    }
    
    .success-content h3 {
        color: #134686;
        margin-bottom: 10px;
        font-size: 18px;
    }
    
    .success-content p {
        color: #666;
        font-size: 14px;
        margin: 0;
    }
    
    .contact-method-card,
    .contact-info-card,
    .contact-social-card,
    .contact-hours-card,
    .faq-item {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }
    
    .contact-method-card.animate-in,
    .contact-info-card.animate-in,
    .contact-social-card.animate-in,
    .contact-hours-card.animate-in,
    .faq-item.animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
`;

// Inject styles
const styleSheet = document.createElement('style');
styleSheet.textContent = contactStyles;
document.head.appendChild(styleSheet);
