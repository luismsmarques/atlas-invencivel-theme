<?php
/**
 * The template for displaying the Contact page
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="contact-hero-bg">
        <div class="wave-lines"></div>
    </div>
    <div class="container">
        <div class="contact-hero-content">
            <!-- Breadcrumbs -->
            <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'atlas-theme' ); ?>">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-link">
                            <i class="fas fa-home"></i>
                            <span><?php esc_html_e( 'Home', 'atlas-theme' ); ?></span>
                        </a>
                    </li>
                    <li class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li class="breadcrumb-item current" aria-current="page">
                        <span><?php esc_html_e( 'Contact', 'atlas-theme' ); ?></span>
                    </li>
                </ol>
            </nav>
            
            <!-- Contact Title -->
            <div class="contact-hero-text">
                <h1 class="contact-title"><?php esc_html_e( 'GET IN TOUCH', 'atlas-theme' ); ?></h1>
                <p class="contact-subtitle"><?php esc_html_e( 'Ready to collaborate? Let\'s discuss your next project and bring your ideas to life.', 'atlas-theme' ); ?></p>
            </div>
            
            <!-- Contact Meta -->
            <div class="contact-meta">
                <div class="contact-meta-item">
                    <i class="fas fa-clock"></i>
                    <span><?php esc_html_e( 'Response within 24h', 'atlas-theme' ); ?></span>
                </div>
                <div class="contact-meta-item">
                    <i class="fas fa-globe"></i>
                    <span><?php esc_html_e( 'Available worldwide', 'atlas-theme' ); ?></span>
                </div>
                <div class="contact-meta-item">
                    <i class="fas fa-handshake"></i>
                    <span><?php esc_html_e( 'Free consultation', 'atlas-theme' ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Methods Section -->
<section class="contact-methods">
    <div class="container">
        <div class="contact-methods-grid">
            <!-- Email Contact -->
            <div class="contact-method-card">
                <div class="contact-method-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="contact-method-title"><?php esc_html_e( 'Email Me', 'atlas-theme' ); ?></h3>
                <p class="contact-method-description"><?php esc_html_e( 'Send me a detailed message about your project and I\'ll get back to you within 24 hours.', 'atlas-theme' ); ?></p>
                <a href="mailto:<?php echo esc_attr( get_option( 'atlas_contact_email', 'hello@atlasinvencivel.com' ) ); ?>" class="contact-method-button">
                    <i class="fas fa-paper-plane"></i>
                    <?php esc_html_e( 'Send Email', 'atlas-theme' ); ?>
                </a>
                <div class="contact-method-info">
                    <span class="contact-method-label"><?php esc_html_e( 'Email:', 'atlas-theme' ); ?></span>
                    <span class="contact-method-value"><?php echo esc_html( get_option( 'atlas_contact_email', 'hello@atlasinvencivel.com' ) ); ?></span>
                </div>
            </div>
            
            <!-- Phone Contact -->
            <div class="contact-method-card">
                <div class="contact-method-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3 class="contact-method-title"><?php esc_html_e( 'Call Me', 'atlas-theme' ); ?></h3>
                <p class="contact-method-description"><?php esc_html_e( 'Prefer to talk directly? Give me a call for immediate assistance and project discussion.', 'atlas-theme' ); ?></p>
                <a href="tel:<?php echo esc_attr( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?>" class="contact-method-button">
                    <i class="fas fa-phone-alt"></i>
                    <?php esc_html_e( 'Call Now', 'atlas-theme' ); ?>
                </a>
                <div class="contact-method-info">
                    <span class="contact-method-label"><?php esc_html_e( 'Phone:', 'atlas-theme' ); ?></span>
                    <span class="contact-method-value"><?php echo esc_html( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?></span>
                </div>
            </div>
            
            <!-- WhatsApp Contact -->
            <div class="contact-method-card">
                <div class="contact-method-icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="contact-method-title"><?php esc_html_e( 'WhatsApp', 'atlas-theme' ); ?></h3>
                <p class="contact-method-description"><?php esc_html_e( 'Quick questions or urgent matters? Message me on WhatsApp for instant communication.', 'atlas-theme' ); ?></p>
                <a href="https://wa.me/<?php echo esc_attr( str_replace( array( '+', ' ', '-', '(', ')' ), '', get_option( 'atlas_contact_phone', '+351123456789' ) ) ); ?>" target="_blank" rel="noopener" class="contact-method-button">
                    <i class="fab fa-whatsapp"></i>
                    <?php esc_html_e( 'Message Me', 'atlas-theme' ); ?>
                </a>
                <div class="contact-method-info">
                    <span class="contact-method-label"><?php esc_html_e( 'WhatsApp:', 'atlas-theme' ); ?></span>
                    <span class="contact-method-value"><?php echo esc_html( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="contact-form-wrapper">
            <div class="contact-form-content">
                <div class="section-header">
                    <h2 class="section-title"><?php esc_html_e( 'SEND ME A MESSAGE', 'atlas-theme' ); ?></h2>
                    <p class="section-description">
                        <?php esc_html_e( 'Have a project in mind? Fill out the form below and I\'ll get back to you as soon as possible with a detailed proposal.', 'atlas-theme' ); ?>
                    </p>
                </div>
                
                <form class="contact-form" id="contact-form" method="post" action="">
                    <?php wp_nonce_field( 'contact_form_nonce', 'contact_nonce' ); ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name" class="form-label"><?php esc_html_e( 'Full Name', 'atlas-theme' ); ?> <span class="required">*</span></label>
                            <input type="text" id="contact-name" name="contact_name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="form-label"><?php esc_html_e( 'Email Address', 'atlas-theme' ); ?> <span class="required">*</span></label>
                            <input type="email" id="contact-email" name="contact_email" class="form-input" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-phone" class="form-label"><?php esc_html_e( 'Phone Number', 'atlas-theme' ); ?></label>
                            <input type="tel" id="contact-phone" name="contact_phone" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="contact-subject" class="form-label"><?php esc_html_e( 'Subject', 'atlas-theme' ); ?> <span class="required">*</span></label>
                            <select id="contact-subject" name="contact_subject" class="form-select" required>
                                <option value=""><?php esc_html_e( 'Select a subject', 'atlas-theme' ); ?></option>
                                <option value="web-development"><?php esc_html_e( 'Web Development', 'atlas-theme' ); ?></option>
                                <option value="wordpress"><?php esc_html_e( 'WordPress Development', 'atlas-theme' ); ?></option>
                                <option value="digital-marketing"><?php esc_html_e( 'Digital Marketing', 'atlas-theme' ); ?></option>
                                <option value="consulting"><?php esc_html_e( 'Business Consulting', 'atlas-theme' ); ?></option>
                                <option value="other"><?php esc_html_e( 'Other', 'atlas-theme' ); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message" class="form-label"><?php esc_html_e( 'Project Details', 'atlas-theme' ); ?> <span class="required">*</span></label>
                        <textarea id="contact-message" name="contact_message" class="form-textarea" rows="6" placeholder="<?php esc_attr_e( 'Tell me about your project, goals, timeline, and any specific requirements...', 'atlas-theme' ); ?>" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-checkbox">
                            <input type="checkbox" name="contact_privacy" required>
                            <span class="checkmark"></span>
                            <span class="checkbox-text">
                                <?php esc_html_e( 'I agree to the', 'atlas-theme' ); ?>
                                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" target="_blank"><?php esc_html_e( 'Privacy Policy', 'atlas-theme' ); ?></a>
                                <?php esc_html_e( 'and consent to the processing of my personal data.', 'atlas-theme' ); ?>
                            </span>
                        </label>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="contact-submit-button">
                            <i class="fas fa-paper-plane"></i>
                            <span><?php esc_html_e( 'Send Message', 'atlas-theme' ); ?></span>
                            <div class="button-loading">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Contact Info Sidebar -->
            <aside class="contact-info-sidebar">
                <!-- Quick Contact Info -->
                <div class="contact-info-card">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Quick Contact', 'atlas-theme' ); ?></h3>
                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info-content">
                                <span class="contact-info-label"><?php esc_html_e( 'Email', 'atlas-theme' ); ?></span>
                                <a href="mailto:<?php echo esc_attr( get_option( 'atlas_contact_email', 'hello@atlasinvencivel.com' ) ); ?>" class="contact-info-value">
                                    <?php echo esc_html( get_option( 'atlas_contact_email', 'hello@atlasinvencivel.com' ) ); ?>
                                </a>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-info-content">
                                <span class="contact-info-label"><?php esc_html_e( 'Phone', 'atlas-theme' ); ?></span>
                                <a href="tel:<?php echo esc_attr( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?>" class="contact-info-value">
                                    <?php echo esc_html( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?>
                                </a>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-info-content">
                                <span class="contact-info-label"><?php esc_html_e( 'Location', 'atlas-theme' ); ?></span>
                                <span class="contact-info-value"><?php echo esc_html( get_option( 'atlas_contact_location', 'Porto, Portugal' ) ); ?></span>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-info-content">
                                <span class="contact-info-label"><?php esc_html_e( 'Response Time', 'atlas-theme' ); ?></span>
                                <span class="contact-info-value"><?php esc_html_e( 'Within 24 hours', 'atlas-theme' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="contact-social-card">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Follow Me', 'atlas-theme' ); ?></h3>
                    <p class="contact-social-description"><?php esc_html_e( 'Stay updated with my latest projects and insights.', 'atlas-theme' ); ?></p>
                    <div class="contact-social-links">
                        <?php
                        $social_links = array(
                            'linkedin' => array(
                                'url' => get_option( 'atlas_social_linkedin', 'https://linkedin.com/in/luismsmarques' ),
                                'icon' => 'fab fa-linkedin-in',
                                'label' => 'LinkedIn'
                            ),
                            'twitter' => array(
                                'url' => get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques' ),
                                'icon' => 'fab fa-x-twitter',
                                'label' => 'X (Twitter)'
                            ),
                            'github' => array(
                                'url' => get_option( 'atlas_social_github', 'https://github.com/luismsmarques' ),
                                'icon' => 'fab fa-github',
                                'label' => 'GitHub'
                            ),
                            'instagram' => array(
                                'url' => get_option( 'atlas_social_instagram', '' ),
                                'icon' => 'fab fa-instagram',
                                'label' => 'Instagram'
                            ),
                        );
                        
                        foreach ( $social_links as $platform => $data ) {
                            if ( ! empty( $data['url'] ) ) {
                                echo '<a href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener" class="contact-social-link" aria-label="' . esc_attr( $data['label'] ) . '">';
                                echo '<i class="' . esc_attr( $data['icon'] ) . '"></i>';
                                echo '<span>' . esc_html( $data['label'] ) . '</span>';
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Business Hours -->
                <div class="contact-hours-card">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Business Hours', 'atlas-theme' ); ?></h3>
                    <div class="contact-hours-list">
                        <div class="contact-hours-item">
                            <span class="contact-hours-day"><?php esc_html_e( 'Monday - Friday', 'atlas-theme' ); ?></span>
                            <span class="contact-hours-time"><?php esc_html_e( '9:00 AM - 6:00 PM', 'atlas-theme' ); ?></span>
                        </div>
                        <div class="contact-hours-item">
                            <span class="contact-hours-day"><?php esc_html_e( 'Saturday', 'atlas-theme' ); ?></span>
                            <span class="contact-hours-time"><?php esc_html_e( '10:00 AM - 2:00 PM', 'atlas-theme' ); ?></span>
                        </div>
                        <div class="contact-hours-item">
                            <span class="contact-hours-day"><?php esc_html_e( 'Sunday', 'atlas-theme' ); ?></span>
                            <span class="contact-hours-time"><?php esc_html_e( 'Closed', 'atlas-theme' ); ?></span>
                        </div>
                    </div>
                    <div class="contact-hours-note">
                        <i class="fas fa-info-circle"></i>
                        <span><?php esc_html_e( 'Emergency projects available 24/7', 'atlas-theme' ); ?></span>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="contact-faq">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'FREQUENTLY ASKED QUESTIONS', 'atlas-theme' ); ?></h2>
            <p class="section-description">
                <?php esc_html_e( 'Quick answers to common questions about my services and process.', 'atlas-theme' ); ?>
            </p>
        </div>
        
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question">
                    <h3><?php esc_html_e( 'How long does a typical project take?', 'atlas-theme' ); ?></h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'Project timelines vary depending on complexity. Simple websites take 1-2 weeks, while complex applications can take 2-3 months. I always provide detailed timelines during our initial consultation.', 'atlas-theme' ); ?></p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3><?php esc_html_e( 'What technologies do you work with?', 'atlas-theme' ); ?></h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'I specialize in WordPress development, PHP, JavaScript, React, and modern web technologies. I also have experience with digital marketing, AI integration, and business strategy.', 'atlas-theme' ); ?></p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3><?php esc_html_e( 'Do you provide ongoing support?', 'atlas-theme' ); ?></h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'Yes! I offer comprehensive maintenance packages including updates, security monitoring, performance optimization, and content management support.', 'atlas-theme' ); ?></p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3><?php esc_html_e( 'What is your pricing structure?', 'atlas-theme' ); ?></h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'I offer flexible pricing based on project scope and requirements. Contact me for a free consultation and detailed quote tailored to your specific needs.', 'atlas-theme' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
