<?php
/**
 * Contact Form Handler for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle contact form submission via AJAX
 */
function atlas_theme_handle_contact_form() {
    // Verify nonce
    if ( ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form_nonce' ) ) {
        wp_die( 'Security check failed' );
    }
    
    // Sanitize form data
    $name = sanitize_text_field( $_POST['contact_name'] );
    $email = sanitize_email( $_POST['contact_email'] );
    $phone = sanitize_text_field( $_POST['contact_phone'] );
    $subject = sanitize_text_field( $_POST['contact_subject'] );
    $message = sanitize_textarea_field( $_POST['contact_message'] );
    $privacy = isset( $_POST['contact_privacy'] ) ? true : false;
    
    // Validate required fields
    $errors = array();
    
    if ( empty( $name ) ) {
        $errors[] = 'Name is required';
    }
    
    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors[] = 'Valid email is required';
    }
    
    if ( empty( $subject ) ) {
        $errors[] = 'Subject is required';
    }
    
    if ( empty( $message ) ) {
        $errors[] = 'Message is required';
    }
    
    if ( ! $privacy ) {
        $errors[] = 'Privacy policy agreement is required';
    }
    
    // If there are errors, return them
    if ( ! empty( $errors ) ) {
        wp_send_json_error( array(
            'message' => 'Please fix the following errors:',
            'errors' => $errors
        ) );
    }
    
    // Prepare email content
    $to = get_option( 'atlas_contact_email', get_option( 'admin_email' ) );
    $email_subject = 'New Contact Form Submission: ' . $subject;
    
    $email_message = "New contact form submission from " . get_bloginfo( 'name' ) . "\n\n";
    $email_message .= "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n";
    $email_message .= "Phone: " . $phone . "\n";
    $email_message .= "Subject: " . $subject . "\n\n";
    $email_message .= "Message:\n" . $message . "\n\n";
    $email_message .= "Submitted on: " . current_time( 'mysql' ) . "\n";
    $email_message .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    // Send email
    $mail_sent = wp_mail( $to, $email_subject, $email_message, $headers );
    
    if ( $mail_sent ) {
        // Save to database (optional)
        atlas_theme_save_contact_submission( $name, $email, $phone, $subject, $message );
        
        // Send auto-reply to user
        atlas_theme_send_auto_reply( $name, $email );
        
        wp_send_json_success( array(
            'message' => 'Thank you for your message! I\'ll get back to you within 24 hours.'
        ) );
    } else {
        wp_send_json_error( array(
            'message' => 'Sorry, there was an error sending your message. Please try again or contact me directly.'
        ) );
    }
}
add_action( 'wp_ajax_contact_form_submit', 'atlas_theme_handle_contact_form' );
add_action( 'wp_ajax_nopriv_contact_form_submit', 'atlas_theme_handle_contact_form' );

/**
 * Save contact submission to database
 */
function atlas_theme_save_contact_submission( $name, $email, $phone, $subject, $message ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'atlas_contact_submissions';
    
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'submitted_at' => current_time( 'mysql' ),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ),
        array(
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
        )
    );
}

/**
 * Send auto-reply to user
 */
function atlas_theme_send_auto_reply( $name, $email ) {
    $subject = 'Thank you for contacting ' . get_bloginfo( 'name' );
    
    $message = "Hello " . $name . ",\n\n";
    $message .= "Thank you for reaching out! I've received your message and will get back to you within 24 hours.\n\n";
    $message .= "In the meantime, feel free to:\n";
    $message .= "- Check out my latest projects on my website\n";
    $message .= "- Follow me on social media for updates\n";
    $message .= "- Browse my services if you haven't already\n\n";
    $message .= "Best regards,\n";
    $message .= get_option( 'atlas_hero_name', 'Luis Marques' ) . "\n";
    $message .= get_bloginfo( 'name' );
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>'
    );
    
    wp_mail( $email, $subject, $message, $headers );
}

/**
 * Create contact submissions table
 */
function atlas_theme_create_contact_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'atlas_contact_submissions';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20) DEFAULT '',
        subject varchar(200) NOT NULL,
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP,
        ip_address varchar(45) DEFAULT '',
        user_agent text DEFAULT '',
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
add_action( 'after_switch_theme', 'atlas_theme_create_contact_table' );

/**
 * Add contact form options to theme customizer
 */
function atlas_theme_contact_customizer( $wp_customize ) {
    // Contact Section
    $wp_customize->add_section( 'atlas_contact', array(
        'title'    => __( 'Contact Information', 'atlas-theme' ),
        'priority' => 160,
    ) );
    
    // Contact Email
    $wp_customize->add_setting( 'atlas_contact_email', array(
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_email', array(
        'label'   => __( 'Contact Email', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'email',
    ) );
    
    // Contact Phone
    $wp_customize->add_setting( 'atlas_contact_phone', array(
        'default'           => '+351 123 456 789',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_phone', array(
        'label'   => __( 'Contact Phone', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
    
    // Contact Location
    $wp_customize->add_setting( 'atlas_contact_location', array(
        'default'           => 'Porto, Portugal',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_location', array(
        'label'   => __( 'Contact Location', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'atlas_theme_contact_customizer' );

/**
 * Add contact form shortcode
 */
function atlas_theme_contact_form_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'show_title' => 'true',
        'title' => 'Get In Touch',
    ), $atts );
    
    ob_start();
    ?>
    <div class="contact-form-shortcode">
        <?php if ( $atts['show_title'] === 'true' ) : ?>
            <h3><?php echo esc_html( $atts['title'] ); ?></h3>
        <?php endif; ?>
        
        <form class="contact-form" id="contact-form-shortcode" method="post" action="">
            <?php wp_nonce_field( 'contact_form_nonce', 'contact_nonce' ); ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="contact-name-shortcode" class="form-label"><?php esc_html_e( 'Full Name', 'atlas-theme' ); ?> <span class="required">*</span></label>
                    <input type="text" id="contact-name-shortcode" name="contact_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="contact-email-shortcode" class="form-label"><?php esc_html_e( 'Email Address', 'atlas-theme' ); ?> <span class="required">*</span></label>
                    <input type="email" id="contact-email-shortcode" name="contact_email" class="form-input" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="contact-subject-shortcode" class="form-label"><?php esc_html_e( 'Subject', 'atlas-theme' ); ?> <span class="required">*</span></label>
                <select id="contact-subject-shortcode" name="contact_subject" class="form-select" required>
                    <option value=""><?php esc_html_e( 'Select a subject', 'atlas-theme' ); ?></option>
                    <option value="web-development"><?php esc_html_e( 'Web Development', 'atlas-theme' ); ?></option>
                    <option value="wordpress"><?php esc_html_e( 'WordPress Development', 'atlas-theme' ); ?></option>
                    <option value="digital-marketing"><?php esc_html_e( 'Digital Marketing', 'atlas-theme' ); ?></option>
                    <option value="consulting"><?php esc_html_e( 'Business Consulting', 'atlas-theme' ); ?></option>
                    <option value="other"><?php esc_html_e( 'Other', 'atlas-theme' ); ?></option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="contact-message-shortcode" class="form-label"><?php esc_html_e( 'Message', 'atlas-theme' ); ?> <span class="required">*</span></label>
                <textarea id="contact-message-shortcode" name="contact_message" class="form-textarea" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-checkbox">
                    <input type="checkbox" name="contact_privacy" required>
                    <span class="checkmark"></span>
                    <span class="checkbox-text">
                        <?php esc_html_e( 'I agree to the', 'atlas-theme' ); ?>
                        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" target="_blank"><?php esc_html_e( 'Privacy Policy', 'atlas-theme' ); ?></a>
                    </span>
                </label>
            </div>
            
            <div class="form-submit">
                <button type="submit" class="contact-submit-button">
                    <i class="fas fa-paper-plane"></i>
                    <span><?php esc_html_e( 'Send Message', 'atlas-theme' ); ?></span>
                </button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'contact_form', 'atlas_theme_contact_form_shortcode' );
