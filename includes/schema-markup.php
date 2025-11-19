<?php
/**
 * Schema Markup Functions for SEO
 */

// Add JSON-LD Schema Markup to head
function add_schema_markup() {
    if (is_front_page()) {
        // Organization Schema
        $organization_schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url' => home_url(),
            'logo' => get_template_directory_uri() . '/images/logo.png',
            'address' => array(
                '@type' => 'PostalAddress',
                'streetAddress' => 'C Block, Sector 2',
                'addressLocality' => 'Noida',
                'addressCountry' => 'IN'
            ),
            'contactPoint' => array(
                '@type' => 'ContactPoint',
                'telephone' => '+91-98765-43210',
                'contactType' => 'Admissions',
                'email' => 'info@degreedrishti.com'
            ),
            'sameAs' => array(
                'https://facebook.com/degreedrishti',
                'https://twitter.com/degreedrishti',
                'https://linkedin.com/company/degreedrishti'
            )
        );
        
        // Courses Schema
        $courses_schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'Educational Courses',
            'itemListElement' => array()
        );
        
        $courses = array(
            'MBA' => 'Master of Business Administration',
            'MCA' => 'Master of Computer Applications',
            'BBA' => 'Bachelor of Business Administration',
            'BCA' => 'Bachelor of Computer Applications'
        );
        
        $position = 1;
        foreach ($courses as $course_code => $course_name) {
            $courses_schema['itemListElement'][] = array(
                '@type' => 'Course',
                'name' => $course_name,
                'description' => 'Professional ' . $course_name . ' program',
                'provider' => array(
                    '@type' => 'EducationalOrganization',
                    'name' => get_bloginfo('name')
                ),
                'position' => $position++
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($organization_schema) . '</script>';
        echo '<script type="application/ld+json">' . json_encode($courses_schema) . '</script>';
    }
}
add_action('wp_head', 'add_schema_markup');

// Breadcrumb Schema
function add_breadcrumb_schema() {
    if (!is_front_page()) {
        $breadcrumb_schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => home_url()
                )
            )
        );
        
        if (is_single()) {
            $breadcrumb_schema['itemListElement'][] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => get_the_title(),
                'item' => get_permalink()
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($breadcrumb_schema) . '</script>';
    }
}
add_action('wp_head', 'add_breadcrumb_schema');