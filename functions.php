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

// Enqueue styles and scripts
function edupro_scripts() {
    wp_enqueue_style('edupro-style', get_stylesheet_uri(), array(), '1.2.0');
    wp_enqueue_script('edupro-script', get_template_directory_uri() . '/js/script.js', array(), '1.2.0', true);
}
add_action('wp_enqueue_scripts', 'edupro_scripts');

// Handle contact form submission
function handle_contact_form_submission() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize form data
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $phone = sanitize_text_field($_POST['phone']);
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
    
    // Send notification email (optional)
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
    wp_redirect(home_url('/?success=form_submitted'));
    exit;
}
add_action('admin_post_contact_form_submission', 'handle_contact_form_submission');
add_action('admin_post_nopriv_contact_form_submission', 'handle_contact_form_submission');

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

// Display form messages
function display_form_messages() {
    if (isset($_GET['success']) && $_GET['success'] == 'form_submitted') {
        echo '<div class="success-message">Thank you! Your application has been submitted successfully. We will contact you soon at the provided email and phone number.</div>';
    }
    
    if (isset($_GET['error'])) {
        $error_message = '';
        switch ($_GET['error']) {
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
?>