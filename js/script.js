document.addEventListener('DOMContentLoaded', function() {
    // Partner Slideshow functionality
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slides');
    const dots = document.querySelectorAll('.dot');
    let slideInterval;

    function showSlide(n) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Show current slide
        if (slides.length > 0) {
            slides[n].classList.add('active');
            dots[n].classList.add('active');
        }
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    }

    function currentSlide(n) {
        slideIndex = n - 1;
        showSlide(slideIndex);
        
        // Reset auto-advance timer
        clearInterval(slideInterval);
        startAutoSlide();
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 4000); // Change slide every 4 seconds
    }

    // Make currentSlide function global for onclick handlers
    window.currentSlide = currentSlide;

    // Start auto-slideshow
    if (slides.length > 0) {
        startAutoSlide();
    }

    // Pause slideshow on hover
    const slideshowContainer = document.querySelector('.slideshow-container');
    if (slideshowContainer) {
        slideshowContainer.addEventListener('mouseenter', function() {
            clearInterval(slideInterval);
        });

        slideshowContainer.addEventListener('mouseleave', function() {
            startAutoSlide();
        });
    }

    // Expert Slideshow functionality
    let expertSlideIndex = 0;
    const expertSlides = document.querySelectorAll('.expert-slides');
    const expertDots = document.querySelectorAll('.expert-dot');
    let expertSlideInterval;

    function showExpertSlide(n) {
        // Hide all expert slides
        expertSlides.forEach(slide => slide.classList.remove('active'));
        expertDots.forEach(dot => dot.classList.remove('active'));

        // Show current expert slide
        if (expertSlides.length > 0) {
            expertSlides[n].classList.add('active');
            expertDots[n].classList.add('active');
        }
    }

    function nextExpertSlide() {
        expertSlideIndex = (expertSlideIndex + 1) % expertSlides.length;
        showExpertSlide(expertSlideIndex);
    }

    function currentExpertSlide(n) {
        expertSlideIndex = n - 1;
        showExpertSlide(expertSlideIndex);
        
        // Reset auto-advance timer
        clearInterval(expertSlideInterval);
        startExpertAutoSlide();
    }

    function startExpertAutoSlide() {
        expertSlideInterval = setInterval(nextExpertSlide, 5000); // Change slide every 5 seconds
    }

    // Make currentExpertSlide function global for onclick handlers
    window.currentExpertSlide = currentExpertSlide;

    // Start expert auto-slideshow
    if (expertSlides.length > 0) {
        startExpertAutoSlide();
    }

    // Pause expert slideshow on hover
    const expertSlideshowContainer = document.querySelector('.experts-slideshow-container');
    if (expertSlideshowContainer) {
        expertSlideshowContainer.addEventListener('mouseenter', function() {
            clearInterval(expertSlideInterval);
        });

        expertSlideshowContainer.addEventListener('mouseleave', function() {
            startExpertAutoSlide();
        });
    }

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form validation enhancement
    const form = document.getElementById('contact-form');
    if (form) {
        const inputs = form.querySelectorAll('input[required], select[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearError(this);
            });
            
            input.addEventListener('change', function() {
                clearError(this);
            });
        });
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Clear any existing messages
            clearFormMessages();
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (isValid) {
                // Show loading state
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.innerHTML = 'Submitting Application...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
            } else {
                e.preventDefault();
            }
        });
    }
    
    function validateField(field) {
        const value = field.value.trim();
        
        // Remove existing error
        clearError(field);
        
        if (field.hasAttribute('required') && !value) {
            showError(field, 'This field is required');
            return false;
        }
        
        if (field.type === 'email' && value && !isValidEmail(value)) {
            showError(field, 'Please enter a valid email address');
            return false;
        }
        
        if (field.type === 'tel' && value && !isValidPhone(value)) {
            showError(field, 'Please enter a valid phone number');
            return false;
        }
        
        if (field.id === 'country_code' && value && !isValidCountryCode(value)) {
            showError(field, 'Please select a valid country code');
            return false;
        }
        
        return true;
    }
    
    function showError(field, message) {
        const fieldGroup = field.closest('.form-group');
        field.style.borderColor = '#dc3545';
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        
        fieldGroup.appendChild(errorDiv);
    }
    
    function clearError(field) {
        const fieldGroup = field.closest('.form-group');
        const existingError = fieldGroup.querySelector('.error-message');
        
        if (existingError) {
            existingError.remove();
        }
        
        field.style.borderColor = '#e1e5e9';
    }

    function clearFormMessages() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());
        
        // Reset field border colors
        const fields = document.querySelectorAll('input, select');
        fields.forEach(field => {
            field.style.borderColor = '#e1e5e9';
        });
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidPhone(phone) {
        // Updated regex for phone numbers (without country code)
        const phoneRegex = /^[\d\s\-\(\)]{7,15}$/;
        const cleanPhone = phone.replace(/\s+/g, '').replace(/[-()]/g, '');
        return phoneRegex.test(phone) && cleanPhone.length >= 7;
    }

    function isValidCountryCode(code) {
        const validCodes = ['+91', '+1', '+44', '+61', '+49', '+33', '+81', '+82', '+86', 
                           '+971', '+966', '+65', '+60', '+66', '+62', '+63', '+84', '+880', '+94', '+977'];
        return validCodes.includes(code);
    }

    // Enhanced phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Allow only numbers, spaces, hyphens, and parentheses
            this.value = this.value.replace(/[^+\d\s\-()]/g, '');
        });
    }

    // Auto-select India as default country code
    const countryCodeSelect = document.getElementById('country_code');
    if (countryCodeSelect) {
        countryCodeSelect.value = '+91'; // Default to India
    }

    // Course selection enhancement with visual feedback
    const courseSelect = document.getElementById('course');
    if (courseSelect) {
        courseSelect.addEventListener('change', function() {
            if (this.value) {
                clearError(this);
                this.style.borderColor = '#28a745'; // Green border for valid selection
                setTimeout(() => {
                    this.style.borderColor = '#e1e5e9';
                }, 2000);
            }
        });
    }

    // Add visual feedback for country code selection
    if (countryCodeSelect) {
        countryCodeSelect.addEventListener('change', function() {
            if (this.value) {
                clearError(this);
                this.style.borderColor = '#28a745'; // Green border for valid selection
                setTimeout(() => {
                    this.style.borderColor = '#e1e5e9';
                }, 2000);
            }
        });
    }

    // Add number animation for expert stats
    function animateNumbers() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        statNumbers.forEach(number => {
            const finalNumber = parseInt(number.textContent.replace(/[^\d]/g, ''));
            let current = 0;
            const increment = finalNumber / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalNumber) {
                    number.textContent = number.textContent; // Keep original format
                    clearInterval(timer);
                } else {
                    number.textContent = Math.floor(current) + '+';
                }
            }, 50);
        });
    }

    // Trigger number animation when experts section comes into view
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const expertsSection = document.querySelector('.experts-section');
    if (expertsSection) {
        observer.observe(expertsSection);
    }

    // Floating buttons functionality
    const floatingButtons = document.querySelectorAll('.floating-btn');
    
    floatingButtons.forEach(btn => {
        // Add click analytics (optional)
        btn.addEventListener('click', function(e) {
            const buttonType = this.classList.contains('phone-btn') ? 'phone' : 'whatsapp';
            console.log(`${buttonType} button clicked`);
            
            // You can add analytics tracking here
            // gtag('event', 'click', { event_category: 'floating_button', event_label: buttonType });
        });

        // Enhanced hover effects
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.1)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0px) scale(1)';
        });
    });

    // Hide floating buttons when scrolling to footer to avoid overlap
    const footer = document.querySelector('footer');
    const stickyButtons = document.querySelector('.sticky-buttons');
    
    if (footer && stickyButtons) {
        const checkFooterVisibility = () => {
            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            
            // If footer is visible, add margin to buttons
            if (footerRect.top < windowHeight) {
                const overlap = windowHeight - footerRect.top + 20;
                stickyButtons.style.bottom = `${20 + overlap}px`;
            } else {
                stickyButtons.style.bottom = '20px';
            }
        };

        window.addEventListener('scroll', checkFooterVisibility);
        window.addEventListener('resize', checkFooterVisibility);
        checkFooterVisibility(); // Initial check
    }
});
