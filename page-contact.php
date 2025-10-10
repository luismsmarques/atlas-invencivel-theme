<?php
/**
 * Template Name: Contact Page
 * The template for displaying the contact page
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<style>
/* Temporary inline CSS to ensure contact page styling */
.contact-hero {
    background: linear-gradient(135deg, #134686 0%, #1e5ba8 100%);
    color: white;
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}

.contact-hero-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.contact-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.2;
    color: white;
}

.contact-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    color: white;
}

.contact-section {
    padding: 100px 0;
    background: #f8f9fa;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}

.contact-form-wrapper,
.contact-info-wrapper {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.contact-form-header h2,
.contact-info-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #134686;
    margin-bottom: 10px;
}

.contact-form-header p,
.contact-info-header p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.required {
    color: #e74c3c;
}

.form-group input,
.form-group textarea {
    padding: 15px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    font-family: inherit;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #134686;
    background: white;
    box-shadow: 0 0 0 3px rgba(19, 70, 134, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
}

.btn-primary {
    background: linear-gradient(135deg, #134686 0%, #1e5ba8 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(19, 70, 134, 0.3);
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e1e5e9;
}

.contact-info-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #134686 0%, #1e5ba8 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
}

.contact-info-icon i {
    color: white;
    font-size: 1.2rem;
}

.contact-info-content h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.contact-info-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.contact-info-content a {
    color: #134686;
    text-decoration: none;
    font-weight: 500;
}

.contact-info-content a:hover {
    text-decoration: underline;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    width: 45px;
    height: 45px;
    background: #f8f9fa;
    border: 2px solid #e1e5e9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #134686;
    border-color: #134686;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .contact-form-wrapper,
    .contact-info-wrapper {
        padding: 30px 20px;
    }
    
    .contact-title {
        font-size: 2.5rem;
    }
}
</style>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1 class="contact-title"><?php esc_html_e( 'Get In Touch', 'atlas-theme' ); ?></h1>
            <p class="contact-subtitle">
                <?php esc_html_e( 'Ready to work together? Let\'s discuss your project and bring your ideas to life.', 'atlas-theme' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <div class="contact-form-header">
                    <h2><?php esc_html_e( 'Send me a message', 'atlas-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Fill out the form below and I\'ll get back to you as soon as possible.', 'atlas-theme' ); ?></p>
                </div>
                
                <?php
                // Check if Contact Form 7 is active
                if ( function_exists( 'wpcf7_contact_form' ) ) {
                    // Use Contact Form 7 shortcode
                    echo do_shortcode( '[contact-form-7 id="5d3b3ca" title="Contact 1.0"]' );
                } else {
                    // Fallback to custom form if Contact Form 7 is not available
                    ?>
                    <div class="cf7-fallback-notice">
                        <p><?php esc_html_e( 'Contact Form 7 plugin is required for this form to work properly. Please install and activate Contact Form 7.', 'atlas-theme' ); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info-wrapper">
                <div class="contact-info-header">
                    <h2><?php esc_html_e( 'Contact Information', 'atlas-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Prefer to reach out directly? Here are my contact details.', 'atlas-theme' ); ?></p>
                </div>
                
                <div class="contact-info-items">
                    <!-- Email -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3><?php esc_html_e( 'Email', 'atlas-theme' ); ?></h3>
                            <p>
                                <a href="mailto:lm@atlasinvencivel.pt">
                                    lm@atlasinvencivel.pt
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <!-- <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3><?php esc_html_e( 'Phone', 'atlas-theme' ); ?></h3>
                            <p>
                                <a href="tel:+351123456789">
                                    <?php esc_html_e( '+351 123 456 789', 'atlas-theme' ); ?>
                                </a>
                            </p>
                        </div>
                    </div> -->
                    
                    <!-- Location -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3><?php esc_html_e( 'Location', 'atlas-theme' ); ?></h3>
                            <p><?php esc_html_e( 'Porto, Portugal', 'atlas-theme' ); ?></p>
                        </div>
                    </div>
                    
                    <!-- Availability -->
                    <!-- <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-clock" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3><?php esc_html_e( 'Availability', 'atlas-theme' ); ?></h3>
                            <p><?php esc_html_e( 'Monday - Friday: 9:00 AM - 6:00 PM', 'atlas-theme' ); ?></p>
                            <p><?php esc_html_e( 'Response time: Within 24 hours', 'atlas-theme' ); ?></p>
                        </div>
                    </div> -->
                </div>
                
                <!-- Social Media -->
                <div class="contact-social">
                    <h3><?php esc_html_e( 'Follow me', 'atlas-theme' ); ?></h3>
                    <div class="social-links" role="list">
                        <?php
                        $social_links = array(
                            'linkedin' => array(
                                'url' => 'https://linkedin.com/in/luismsmarques',
                                'icon' => 'fab fa-linkedin-in',
                                'label' => 'LinkedIn'
                            ),
                            'twitter' => array(
                                'url' => 'https://x.com/luismsmarques',
                                'icon' => 'fab fa-x-twitter',
                                'label' => 'X (Twitter)'
                            ),
                            'github' => array(
                                'url' => 'https://github.com/luismsmarques',
                                'icon' => 'fab fa-github',
                                'label' => 'GitHub'
                            ),
                        );
                        
                        foreach ( $social_links as $platform => $data ) {
                            echo '<a href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener" class="social-link" aria-label="' . esc_attr( $data['label'] ) . '" role="listitem">';
                            echo '<i class="' . esc_attr( $data['icon'] ) . '" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>