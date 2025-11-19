<?php
/**
 * Performance Optimization Functions
 */

// Lazy loading for images
function add_lazy_loading() {
    ?>
    <script>
    // Intersection Observer for lazy loading
    document.addEventListener('DOMContentLoaded', function() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const image = entry.target;
                        image.src = image.dataset.src;
                        image.classList.remove('lazy');
                        imageObserver.unobserve(image);
                    }
                });
            });
            
            lazyImages.forEach(function(image) {
                imageObserver.observe(image);
            });
        } else {
            // Fallback for browsers without Intersection Observer
            lazyImages.forEach(function(image) {
                image.src = image.dataset.src;
                image.classList.remove('lazy');
            });
        }
    });
    </script>
    <style>
    img.lazy {
        opacity: 0;
        transition: opacity 0.3s;
    }
    img.lazy.loaded {
        opacity: 1;
    }
    </style>
    <?php
}
add_action('wp_footer', 'add_lazy_loading');

// Optimize CSS delivery
function optimize_css_delivery() {
    // Preload critical CSS
    echo '<link rel="preload" href="' . get_stylesheet_uri() . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link rel="stylesheet" href="' . get_stylesheet_uri() . '"></noscript>' . "\n";
}
add_action('wp_head', 'optimize_css_delivery', 1);

// Add DNS prefetch for external domains
function add_dns_prefetch() {
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.googletagmanager.com">' . "\n";
}
add_action('wp_head', 'add_dns_prefetch', 1);