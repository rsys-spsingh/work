document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-page-form');
    
    if (contactForm) {
        // Form validation and submission
        contactForm.addEventListener('submit', function(e) {
            if (!validateContactForm()) {
                e.preventDefault();
            } else {
                // Show loading state
                const submitBtn = contactForm.querySelector('.submit-btn');
                submitBtn.innerHTML = '<span class="btn-text">Sending...</span>';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                
                // Track form submission
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'contact_form_submit', {
                        'event_category': 'engagement',
                        'event_label': 'contact_page'
                    });
                }
            }
        });
        
        // Real-time validation
        const inputs = contactForm.querySelectorAll('input[required], select[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
        
        // Auto-select India as default
        const countrySelect = document.getElementById('contact_country_code');
        if (countrySelect && !countrySelect.value) {
            countrySelect.value = '+91';
        }
        
        // Phone number formatting
        const phoneInput = document.getElementById('contact_phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^+\d\s\-()]/g, '');
            });
        }
    }
    
    // Form validation functions
    function validateContactForm() {
        let isValid = true;
        const requiredFields = contactForm.querySelectorAll('input[required], select[required], textarea[required]');
        
        requiredFields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    function validateField(field) {
        const value = field.value.trim();
        clearFieldError(field);
        
        if (field.hasAttribute('required') && !value) {
            showFieldError(field, 'This field is required');
            return false;
        }
        
        if (field.type === 'email' && value && !isValidEmail(value)) {
            showFieldError(field, 'Please enter a valid email address');
            return false;
        }
        
        if (field.id === 'contact_phone' && value && !isValidPhone(value)) {
            showFieldError(field, 'Please enter a valid phone number');
            return false;
        }
        
        if (field.id === 'contact_message' && value && value.length < 10) {
            showFieldError(field, 'Message must be at least 10 characters long');
            return false;
        }
        
        return true;
    }
    
    function showFieldError(field, message) {
        const formGroup = field.closest('.form-group');
        field.style.borderColor = '#dc3545';
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        errorDiv.style.color = '#dc3545';
        errorDiv.style.fontSize = '14px';
        errorDiv.style.marginTop = '5px';
        
        formGroup.appendChild(errorDiv);
    }
    
    function clearFieldError(field) {
        const formGroup = field.closest('.form-group');
        const existingError = formGroup.querySelector('.field-error');
        
        if (existingError) {
            existingError.remove();
        }
        
        field.style.borderColor = '#e1e5e9';
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidPhone(phone) {
        const phoneRegex = /^[\d\s\-\(\)]{7,15}$/;
        const cleanPhone = phone.replace(/\s+/g, '').replace(/[-()]/g, '');
        return phoneRegex.test(phone) && cleanPhone.length >= 7;
    }
    
    // Display success/error messages
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'message_sent') {
        const name = urlParams.get('name') || 'there';
        const course = urlParams.get('course') || 'your selected course';
        
        showMessage(`Thank you, ${name}! Your message has been sent successfully. Our team will contact you soon regarding ${course}.`, 'success');
        
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    
    if (urlParams.get('error')) {
        const errorCode = urlParams.get('error');
        let errorMessage = 'An error occurred. Please try again.';
        
        switch (errorCode) {
            case 'missing_fields':
                errorMessage = 'Please fill in all required fields.';
                break;
            case 'invalid_email':
                errorMessage = 'Please enter a valid email address.';
                break;
            case 'database_error':
                errorMessage = 'There was an error saving your message. Please try again.';
                break;
        }
        
        showMessage(errorMessage, 'error');
        
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    
    function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = type === 'success' ? 'success-message' : 'error-alert';
        messageDiv.textContent = message;
        
        const form = document.querySelector('.contact-form');
        form.parentNode.insertBefore(messageDiv, form);
        
        // Scroll to message
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Remove after 10 seconds
        setTimeout(() => {
            messageDiv.remove();
        }, 10000);
    }
    
    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});