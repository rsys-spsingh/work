<footer style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 40px 0; margin-top: 60px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 30px;">
            <div>
                <h3 style="margin-bottom: 15px; color: white;">Contact Info</h3>
                <p>Email: info@degreedrishti.com</p>
                <p>Phone: +91 98765 43210</p>
                <p>Address: C Block, Sector 2, Noida</p>
            </div>
            <div>
                <h3 style="margin-bottom: 15px; color: white;">Quick Links</h3>
                <p><a href="#about" style="color: white; text-decoration: none;">About Us</a></p>
                <p><a href="#programs" style="color: white; text-decoration: none;">Programs</a></p>
                <p><a href="#contact" style="color: white; text-decoration: none;">Contact</a></p>
            </div>
            <div>
                <h3 style="margin-bottom: 15px; color: white;">Follow Us</h3>
                <p>Facebook | Twitter | LinkedIn | Instagram</p>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px;">
            <p>&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name') ? get_bloginfo('name') : 'Degree Drishti'; ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Sticky Floating Action Buttons -->
<div class="sticky-buttons">
    <a href="tel:+919876543210" class="floating-btn phone-btn" title="Call Us">
        <i>📞</i>
        <span class="tooltip">Call Us Now</span>
    </a>
    <a href="https://wa.me/919876543210?text=Hello%2C%20I%20want%20to%20know%20about%20admission%20process" class="floating-btn whatsapp-btn" title="WhatsApp">
        <i>💬</i>
        <span class="tooltip">Chat on WhatsApp</span>
    </a>
</div>

<!-- Font Awesome Icons (if you want to use icon fonts instead of emojis) -->
<script>
// Alternative with Font Awesome icons - uncomment this section and comment emojis above if you prefer
/*
document.addEventListener('DOMContentLoaded', function() {
    // Load Font Awesome if not already loaded
    if (!document.querySelector('link[href*="font-awesome"]')) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
        document.head.appendChild(link);
        
        // Update button icons after Font Awesome loads
        setTimeout(() => {
            const phoneBtn = document.querySelector('.phone-btn i');
            const whatsappBtn = document.querySelector('.whatsapp-btn i');
            
            if (phoneBtn) phoneBtn.innerHTML = '<i class="fas fa-phone"></i>';
            if (whatsappBtn) whatsappBtn.innerHTML = '<i class="fab fa-whatsapp"></i>';
        }, 500);
    }
});
*/
</script>

<?php wp_footer(); ?>
</body>
</html>