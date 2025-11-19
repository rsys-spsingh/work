<?php
/**
 * Open Graph and Social Media Meta Tags
 */

function add_social_meta_tags() {
    global $post;
    
    $site_name = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    $site_url = home_url();
    $default_image = get_template_directory_uri() . '/images/og-default.jpg';
    
    // Open Graph Tags
    echo '<meta property="og:locale" content="en_US">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    
    if (is_front_page()) {
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($site_name . ' - ' . $site_description) . '">' . "\n";
        echo '<meta property="og:description" content="Top admission provider in India with 1 lakh+ successful admissions. Expert guidance for MBA, MCA, BBA, BCA programs.">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($site_url) . '">' . "\n";
    } elseif (is_single()) {
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="article:published_time" content="' . get_the_date('c') . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . get_the_modified_date('c') . '">' . "\n";
    }
    
    // Open Graph Image
    if (is_single() && has_post_thumbnail()) {
        $image_url = get_the_post_thumbnail_url($post->ID, 'large');
    } else {
        $image_url = $default_image;
    }
    
    echo '<meta property="og:image" content="' . esc_url($image_url) . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta property="og:image:type" content="image/jpeg">' . "\n";
    
    // Twitter Card Tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:site" content="@degreedrishti">' . "\n";
    echo '<meta name="twitter:creator" content="@degreedrishti">' . "\n";
    
    if (is_front_page()) {
        echo '<meta name="twitter:title" content="' . esc_attr($site_name . ' - ' . $site_description) . '">' . "\n";
        echo '<meta name="twitter:description" content="Top admission provider in India with 1 lakh+ successful admissions. Expert guidance for MBA, MCA, BBA, BCA programs.">' . "\n";
    } elseif (is_single()) {
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)) . '">' . "\n";
    }
    
    echo '<meta name="twitter:image" content="' . esc_url($image_url) . '">' . "\n";
    
    // Additional social media tags
    echo '<meta property="fb:app_id" content="YOUR_FB_APP_ID">' . "\n"; // Replace with actual FB App ID
    echo '<meta name="pinterest-rich-pin" content="true">' . "\n";
}
add_action('wp_head', 'add_social_meta_tags', 2);