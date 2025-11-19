<?php
/**
 * Security Enhancement Functions
 */

// Rate limiting for form submissions
function check_form_rate_limit() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $limit_key = 'form_submission_' . md5($ip);
    $current_time = time();
    $window = 300; // 5 minutes
    $max_attempts = 3;
    
    $attempts = get_transient($limit_key);
    if (!$attempts) {
        $attempts = array();
    }
    
    // Clean old attempts
    $attempts = array_filter($attempts, function($time) use ($current_time, $window) {
        return ($current_time - $time) < $window;
    });
    
    if (count($attempts) >= $max_attempts) {
        wp_die('Too many form submissions. Please wait 5 minutes before trying again.', 'Rate Limit Exceeded', array('response' => 429));
    }
    
    // Record this attempt
    $attempts[] = $current_time;
    set_transient($limit_key, $attempts, $window);
}

// Enhanced input sanitization
function enhanced_sanitize_input($input, $type = 'text') {
    switch ($type) {
        case 'email':
            return sanitize_email($input);
        case 'phone':
            return preg_replace('/[^0-9+\-\s\(\)]/', '', $input);
        case 'name':
            return sanitize_text_field(preg_replace('/[^a-zA-Z\s]/', '', $input));
        default:
            return sanitize_text_field($input);
    }
}

// Add security headers
function add_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', 'add_security_headers');