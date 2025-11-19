<?php
// Theme setup
function edupro_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'edupro_theme_setup');

// Include enhancement files
require_once get_template_directory() . '/includes/schema-markup.php';
require_once get_template_directory() . '/includes/meta-tags.php';
require_once get_template_directory() . '/includes/social-meta.php';
require_once get_template_directory() . '/includes/sitemap.php';
require_once get_template_directory() . '/includes/performance.php';
require_once get_template_directory() . '/includes/security.php';

// Enqueue styles and scripts with versioning
function edupro_scripts() {
    $theme_version = wp_get_theme()->get('Version') ?: '1.5.0';
    
    wp_enqueue_style('edupro-style', get_stylesheet_uri(), array(), $theme_version);
    wp_enqueue_script('edupro-script', get_template_directory_uri() . '/js/script.js', array(), $theme_version, true);
    
    // Add async/defer to scripts
    add_filter('script_loader_tag', 'add_async_defer_attributes', 10, 2);
}
add_action('wp_enqueue_scripts', 'edupro_scripts');

// Add async/defer attributes to scripts
function add_async_defer_attributes($tag, $handle) {
    $async_scripts = array('edupro-script');
    $defer_scripts = array();
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}

// Enhanced contact form submission handler
function handle_contact_form_submission() {
    // Check rate limit
    check_form_rate_limit();
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Enhanced input sanitization
    $first_name = enhanced_sanitize_input($_POST['first_name'], 'name');
    $last_name = enhanced_sanitize_input($_POST['last_name'], 'name');
    $email = enhanced_sanitize_input($_POST['email'], 'email');
    $country_code = sanitize_text_field($_POST['country_code']);
    $phone = enhanced_sanitize_input($_POST['phone'], 'phone');
    $course = sanitize_text_field($_POST['course']);
    
    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($country_code) || empty($phone) || empty($course)) {
        wp_redirect(home_url('/?error=missing_fields'));
        exit;
    }
    
    // Validate email
    if (!is_email($email)) {
        wp_redirect(home_url('/?error=invalid_email'));
        exit;
    }
    
    // Validate course selection
    $valid_courses = array(
        'MBA', 'MBA-Dual', 'MBA-WX', 'Executive-MBA', 'MCA', 'MCom', 'MSc-Data-Science', 
        'MA-Journalism', 'MA-Public-Policy', 'BBA', 'BCA', 'BCom', 'BA',
        'BCA-MCA', 'BBA-MBA', 'BCom-MBA', 'BCom-ACCA', 
        'Cert-3Months', 'Cert-6Months', 'Diploma-1Year'
    );
    
    if (!in_array($course, $valid_courses)) {
        wp_redirect(home_url('/?error=invalid_course'));
        exit;
    }
    
    // Validate country code
    $valid_country_codes = array(
        '+91', '+1', '+44', '+61', '+49', '+33', '+81', '+82', '+86', 
        '+971', '+966', '+65', '+60', '+66', '+62', '+63', '+84', '+880', '+94', '+977'
    );
    
    if (!in_array($country_code, $valid_country_codes)) {
        wp_redirect(home_url('/?error=invalid_country_code'));
        exit;
    }
    
    // Store form submission in database
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'contact_submissions';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'country_code' => $country_code,
            'phone' => $phone,
            'course' => $course,
            'submission_date' => current_time('mysql')
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($result === false) {
        wp_redirect(home_url('/?error=database_error'));
        exit;
    }
    
    // Send notification email
    $admin_email = get_option('admin_email');
    $subject = 'New Course Application - ' . get_bloginfo('name');
    $message = "New application received:\n\n";
    $message .= "Name: {$first_name} {$last_name}\n";
    $message .= "Email: {$email}\n";
    $message .= "Phone: {$country_code} {$phone}\n";
    $message .= "Course: {$course}\n";
    $message .= "Date: " . current_time('F j, Y g:i a') . "\n";
    
    wp_mail($admin_email, $subject, $message);
    
    // Redirect with success message
    wp_redirect(home_url('/?success=form_submitted&course=' . urlencode($course) . '&conversion=1&fname=' . urlencode($first_name) . '&lname=' . urlencode($last_name) . '&email=' . urlencode($email) . '&country=' . urlencode($country_code)));
    exit;
}
add_action('admin_post_contact_form_submission', 'handle_contact_form_submission');
add_action('admin_post_nopriv_contact_form_submission', 'handle_contact_form_submission');

// Rest of the original functions.php code...
// (Keep all the existing functions like create_contact_submissions_table, display_form_messages, etc.)

// Create database table for form submissions
function create_contact_submissions_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'contact_submissions';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        country_code varchar(10) NOT NULL,
        phone varchar(20) NOT NULL,
        course varchar(50) NOT NULL,
        submission_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_contact_submissions_table');

// Display form messages with Google Tag Manager conversion tracking
function display_form_messages() {
    if (isset($_GET['success']) && $_GET['success'] == 'form_submitted') {
        $course = isset($_GET['course']) ? esc_html($_GET['course']) : 'Unknown';
        $conversion = isset($_GET['conversion']) ? $_GET['conversion'] : '';
        $fname = isset($_GET['fname']) ? esc_html($_GET['fname']) : '';
        $lname = isset($_GET['lname']) ? esc_html($_GET['lname']) : '';
        $email = isset($_GET['email']) ? esc_html($_GET['email']) : '';
        $country = isset($_GET['country']) ? esc_html($_GET['country']) : '';
        
        echo '<div class="success-message">Thank you! Your application has been submitted successfully. We will contact you soon at the provided email and phone number.</div>';
        
        // Add Google Tag Manager conversion tracking
        if ($conversion == '1') {
            ?>
            <script>
                // Track successful form submission as conversion using GTM dataLayer
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    'event': 'form_submission_success',
                    'event_category': 'conversion',
                    'event_action': 'submit_contact_form',
                    'event_label': '<?php echo $course; ?>',
                    'course_name': '<?php echo $course; ?>',
                    'user_first_name': '<?php echo $fname; ?>',
                    'user_last_name': '<?php echo $lname; ?>',
                    'user_email': '<?php echo $email; ?>',
                    'country_code': '<?php echo $country; ?>',
                    'conversion_value': 1,
                    'currency': 'INR',
                    'timestamp': new Date().toISOString()
                });

                // Also push conversion event for Google Ads
                window.dataLayer.push({
                    'event': 'conversion',
                    'google_conversion_id': 'AW-17740599737',
                    'google_conversion_label': 'conversion_label_here',
                    'google_conversion_value': 1,
                    'google_conversion_currency': 'INR'
                });

                // Track as gtag conversion as well (fallback)
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'conversion', {
                        'send_to': 'AW-17740599737/conversion_label_here',
                        'event_category': 'conversion',
                        'event_label': '<?php echo $course; ?>',
                        'value': 1.0,
                        'currency': 'INR'
                    });
                    
                    gtag('event', 'generate_lead', {
                        'event_category': 'conversion',
                        'event_label': '<?php echo $course; ?>',
                        'value': 1,
                        'currency': 'INR'
                    });
                }
            </script>
            <?php
        }
    }
    
    if (isset($_GET['error'])) {
        $error_message = '';
        $error_code = $_GET['error'];
        
        switch ($error_code) {
            case 'missing_fields':
                $error_message = 'Please fill in all required fields including country code.';
                break;
            case 'invalid_email':
                $error_message = 'Please enter a valid email address.';
                break;
            case 'invalid_course':
                $error_message = 'Please select a valid course from the dropdown.';
                break;
            case 'invalid_country_code':
                $error_message = 'Please select a valid country code.';
                break;
            case 'database_error':
                $error_message = 'There was an error saving your submission. Please try again.';
                break;
            default:
                $error_message = 'An error occurred. Please try again.';
        }
        echo '<div class="error-alert">' . $error_message . '</div>';
        
        // Track form submission errors with GTM
        ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'form_submission_error',
                'event_category': 'form',
                'event_action': 'submission_error',
                'event_label': '<?php echo $error_code; ?>',
                'error_type': '<?php echo $error_code; ?>',
                'error_message': '<?php echo esc_js($error_message); ?>'
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'display_form_messages');

// Add admin menu for viewing submissions
function add_submissions_admin_menu() {
    add_menu_page(
        'Contact Submissions',
        'Submissions',
        'manage_options',
        'contact-submissions',
        'display_submissions_page',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'add_submissions_admin_menu');

// Display submissions in admin
function display_submissions_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_submissions';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submission_date DESC");
    
    echo '<div class="wrap">';
    echo '<h1>Contact Submissions</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th></tr></thead>';
    echo '<tbody>';
    
    foreach ($submissions as $submission) {
        echo '<tr>';
        echo '<td>' . date('M j, Y g:i a', strtotime($submission->submission_date)) . '</td>';
        echo '<td>' . esc_html($submission->first_name . ' ' . $submission->last_name) . '</td>';
        echo '<td><a href="mailto:' . esc_attr($submission->email) . '">' . esc_html($submission->email) . '</a></td>';
        echo '<td>' . esc_html($submission->country_code . ' ' . $submission->phone) . '</td>';
        echo '<td>' . esc_html($submission->course) . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

// Remove admin bar for non-admin users
if (!current_user_can('administrator')) {
    show_admin_bar(false);
}
// Enhanced contact form submission handler for contact page
function handle_contact_page_form_submission() {
    // Check rate limit (if function exists)
    if (function_exists('check_form_rate_limit')) {
        check_form_rate_limit();
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['contact_page_form_nonce'], 'contact_page_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize form data
    $first_name = sanitize_text_field($_POST['contact_first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['contact_last_name'] ?? '');
    $email = sanitize_email($_POST['contact_email'] ?? '');
    $country_code = sanitize_text_field($_POST['contact_country_code'] ?? '');
    $phone = sanitize_text_field($_POST['contact_phone'] ?? '');
    $city = sanitize_text_field($_POST['contact_city'] ?? '');
    $course = sanitize_text_field($_POST['contact_course'] ?? '');
    $education = sanitize_text_field($_POST['contact_education'] ?? '');
    $preferred_mode = sanitize_text_field($_POST['contact_preferred_mode'] ?? '');
    $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');
    $updates = sanitize_text_field($_POST['contact_updates'] ?? '');
    $whatsapp = sanitize_text_field($_POST['contact_whatsapp'] ?? '');
    
    // Validate required fields
    $required_fields = [$first_name, $last_name, $email, $country_code, $phone, $course, $subject, $message];
    foreach ($required_fields as $field) {
        if (empty($field)) {
            wp_redirect(get_permalink(get_page_by_path('contact')) . '?error=missing_fields');
            exit;
        }
    }
    
    // Validate email
    if (!is_email($email)) {
        wp_redirect(get_permalink(get_page_by_path('contact')) . '?error=invalid_email');
        exit;
    }
    
    // Store in database
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_page_submissions';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'country_code' => $country_code,
            'phone' => $phone,
            'city' => $city,
            'course' => $course,
            'education' => $education,
            'preferred_mode' => $preferred_mode,
            'subject' => $subject,
            'message' => $message,
            'updates_consent' => $updates,
            'whatsapp_consent' => $whatsapp,
            'submission_date' => current_time('mysql'),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($result === false) {
        wp_redirect(get_permalink(get_page_by_path('contact')) . '?error=database_error');
        exit;
    }
    
    // Send notification email
    $admin_email = get_option('admin_email');
    $subject_line = 'New Contact Form Submission - ' . $subject;
    $email_message = "New contact form submission:\n\n";
    $email_message .= "Name: {$first_name} {$last_name}\n";
    $email_message .= "Email: {$email}\n";
    $email_message .= "Phone: {$country_code} {$phone}\n";
    $email_message .= "City: {$city}\n";
    $email_message .= "Course: {$course}\n";
    $email_message .= "Education: {$education}\n";
    $email_message .= "Preferred Mode: {$preferred_mode}\n";
    $email_message .= "Subject: {$subject}\n";
    $email_message .= "Message: {$message}\n";
    $email_message .= "Updates Consent: " . ($updates ? 'Yes' : 'No') . "\n";
    $email_message .= "WhatsApp Consent: " . ($whatsapp ? 'Yes' : 'No') . "\n";
    $email_message .= "Date: " . current_time('F j, Y g:i a') . "\n";
    
    wp_mail($admin_email, $subject_line, $email_message);
    
    // Redirect with success message
    wp_redirect(get_permalink(get_page_by_path('contact')) . '?success=message_sent&name=' . urlencode($first_name) . '&course=' . urlencode($course));
    exit;
}
add_action('admin_post_contact_page_form_submission', 'handle_contact_page_form_submission');
add_action('admin_post_nopriv_contact_page_form_submission', 'handle_contact_page_form_submission');

// Create contact page submissions table
function create_contact_page_submissions_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'contact_page_submissions';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        country_code varchar(10) NOT NULL,
        phone varchar(20) NOT NULL,
        city varchar(100),
        course varchar(50) NOT NULL,
        education varchar(50),
        preferred_mode varchar(50),
        subject varchar(100) NOT NULL,
        message text NOT NULL,
        updates_consent varchar(5),
        whatsapp_consent varchar(5),
        submission_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45),
        user_agent text,
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY (id),
        INDEX email_idx (email),
        INDEX date_idx (submission_date),
        INDEX status_idx (status)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_contact_page_submissions_table');

// Enqueue contact page styles and scripts
function contact_page_scripts() {
    if (is_page('contact')) {
        wp_enqueue_style('contact-page-styles', get_template_directory_uri() . '/css/contact-page-styles.css', array(), '1.0.0');
        wp_enqueue_script('contact-page-js', get_template_directory_uri() . '/js/contact-page.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'contact_page_scripts');

// Add admin menu for contact page submissions
function add_contact_submissions_admin_menu() {
    add_menu_page(
        'Contact Page Submissions',
        'Contact Messages',
        'manage_options',
        'contact-page-submissions',
        'display_contact_submissions_page',
        'dashicons-email-alt2',
        31
    );
}
add_action('admin_menu', 'add_contact_submissions_admin_menu');

// Display contact submissions in admin
function display_contact_submissions_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_page_submissions';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submission_date DESC");
    
    echo '<div class="wrap">';
    echo '<h1>Contact Page Submissions</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Subject</th><th>Status</th></tr></thead>';
    echo '<tbody>';
    
    foreach ($submissions as $submission) {
        echo '<tr>';
        echo '<td>' . date('M j, Y g:i a', strtotime($submission->submission_date)) . '</td>';
        echo '<td>' . esc_html($submission->first_name . ' ' . $submission->last_name) . '</td>';
        echo '<td><a href="mailto:' . esc_attr($submission->email) . '">' . esc_html($submission->email) . '</a></td>';
        echo '<td><a href="tel:' . esc_attr($submission->country_code . $submission->phone) . '">' . esc_html($submission->country_code . ' ' . $submission->phone) . '</a></td>';
        echo '<td>' . esc_html($submission->course) . '</td>';
        echo '<td>' . esc_html($submission->subject) . '</td>';
        echo '<td>' . esc_html($submission->status) . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>