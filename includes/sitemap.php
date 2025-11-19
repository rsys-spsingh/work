<?php
/**
 * XML Sitemap Generation
 */

// Generate XML Sitemap
function generate_xml_sitemap() {
    if (isset($_GET['sitemap']) && $_GET['sitemap'] === 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
        
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Homepage
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url()) . '</loc>' . "\n";
        echo '<changefreq>weekly</changefreq>' . "\n";
        echo '<priority>1.0</priority>' . "\n";
        echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '</url>' . "\n";
        
        // Course pages (if they exist as posts/pages)
        $courses = array(
            'mba' => 'MBA Program',
            'mca' => 'MCA Program', 
            'bba' => 'BBA Program',
            'bca' => 'BCA Program'
        );
        
        foreach ($courses as $slug => $title) {
            echo '<url>' . "\n";
            echo '<loc>' . esc_url(home_url() . '/#' . $slug) . '</loc>' . "\n";
            echo '<changefreq>monthly</changefreq>' . "\n";
            echo '<priority>0.8</priority>' . "\n";
            echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
            echo '</url>' . "\n";
        }
        
        // Posts
        $posts = get_posts(array('numberposts' => -1, 'post_status' => 'publish'));
        foreach ($posts as $post) {
            echo '<url>' . "\n";
            echo '<loc>' . esc_url(get_permalink($post->ID)) . '</loc>' . "\n";
            echo '<changefreq>monthly</changefreq>' . "\n";
            echo '<priority>0.6</priority>' . "\n";
            echo '<lastmod>' . date('c', strtotime($post->post_modified)) . '</lastmod>' . "\n";
            echo '</url>' . "\n";
        }
        
        echo '</urlset>';
        exit;
    }
}
add_action('init', 'generate_xml_sitemap');

// Add sitemap to robots.txt
function add_sitemap_to_robots() {
    return "Sitemap: " . home_url() . "/?sitemap=xml\n";
}
add_filter('robots_txt', 'add_sitemap_to_robots');