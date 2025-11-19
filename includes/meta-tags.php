<?php
/**
 * Dynamic Meta Tags for SEO
 */

// Enhanced meta tags
function add_custom_meta_tags() {
    global $post;
    
    // Default meta description
    $meta_description = 'Leading education provider in India with 100,000+ successful admissions. Explore MBA, MCA, BBA, BCA programs and more.';
    $meta_keywords = 'MBA, MCA, BBA, BCA, education, admission, degree, online courses, India';
    $page_title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
    
    if (is_front_page()) {
        $meta_description = 'Top admission provider in India with 1 lakh+ successful admissions. Choose from MBA, MCA, BBA, BCA, and integrated programs. Expert guidance since 2023.';
        $meta_keywords = 'MBA admission, MCA course, BBA degree, BCA program, online education, distance learning, India';
    } elseif (is_single()) {
        $meta_description = wp_trim_words(get_the_excerpt() ?: get_the_content(), 25, '...');
        $page_title = get_the_title() . ' - ' . get_bloginfo('name');
    }
    
    // Output meta tags
    echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
    echo '<meta name="keywords" content="' . esc_attr($meta_keywords) . '">' . "\n";
    echo '<meta name="author" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    
    // Canonical URL
    echo '<link rel="canonical" href="' . esc_url(get_canonical_url()) . '">' . "\n";
    
    // Mobile optimization
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "\n";
    echo '<meta name="format-detection" content="telephone=no">' . "\n";
    
    // Theme color for mobile browsers
    echo '<meta name="theme-color" content="#1e3c72">' . "\n";
    echo '<meta name="msapplication-TileColor" content="#1e3c72">' . "\n";
}
add_action('wp_head', 'add_custom_meta_tags', 1);

// Get canonical URL
function get_canonical_url() {
    if (is_front_page()) {
        return home_url();
    } elseif (is_single()) {
        return get_permalink();
    }
    return home_url($_SERVER['REQUEST_URI']);
}