<?php
/**
 * Custom Widgets for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Company Info Widget
 */
class Atlas_Company_Info_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'atlas_company_info',
            esc_html__( 'Atlas - Company Info', 'atlas-theme' ),
            array(
                'description' => esc_html__( 'Display company information with logo and social links.', 'atlas-theme' ),
            )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $logo_icon = ! empty( $instance['logo_icon'] ) ? $instance['logo_icon'] : 'A';
        $logo_text = ! empty( $instance['logo_text'] ) ? $instance['logo_text'] : 'Atlas Invencível';
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }
        
        echo '<div class="footer-logo">';
        echo '<div class="footer-logo-icon">' . esc_html( $logo_icon ) . '</div>';
        echo '<span class="footer-logo-text">' . esc_html( $logo_text ) . '</span>';
        echo '</div>';
        
        if ( ! empty( $description ) ) {
            echo '<p class="footer-description">' . esc_html( $description ) . '</p>';
        }
        
        // Social Links
        echo '<div class="footer-social">';
        $social_links = array(
            'linkedin' => get_option( 'atlas_social_linkedin', '' ),
            'twitter' => get_option( 'atlas_social_twitter', '' ),
            'github' => get_option( 'atlas_social_github', '' ),
            'instagram' => get_option( 'atlas_social_instagram', '' ),
        );
        
        foreach ( $social_links as $platform => $url ) {
            if ( ! empty( $url ) ) {
                $icon_class = 'fab fa-' . $platform;
                if ( $platform === 'twitter' ) {
                    $icon_class = 'fab fa-x-twitter';
                } elseif ( $platform === 'linkedin' ) {
                    $icon_class = 'fab fa-linkedin-in';
                }
                
                echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener" class="social-link" aria-label="' . ucfirst( $platform ) . '">';
                echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
                echo '</a>';
            }
        }
        echo '</div>';
        
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $logo_icon = ! empty( $instance['logo_icon'] ) ? $instance['logo_icon'] : 'A';
        $logo_text = ! empty( $instance['logo_text'] ) ? $instance['logo_text'] : 'Atlas Invencível';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'atlas-theme' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="3"><?php echo esc_textarea( $description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'logo_icon' ) ); ?>"><?php esc_html_e( 'Logo Icon:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_icon' ) ); ?>" type="text" value="<?php echo esc_attr( $logo_icon ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'logo_text' ) ); ?>"><?php esc_html_e( 'Logo Text:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_text' ) ); ?>" type="text" value="<?php echo esc_attr( $logo_text ); ?>">
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? sanitize_textarea_field( $new_instance['description'] ) : '';
        $instance['logo_icon'] = ( ! empty( $new_instance['logo_icon'] ) ) ? sanitize_text_field( $new_instance['logo_icon'] ) : '';
        $instance['logo_text'] = ( ! empty( $new_instance['logo_text'] ) ) ? sanitize_text_field( $new_instance['logo_text'] ) : '';
        
        return $instance;
    }
}

/**
 * Services List Widget
 */
class Atlas_Services_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'atlas_services',
            esc_html__( 'Atlas - Services', 'atlas-theme' ),
            array(
                'description' => esc_html__( 'Display a list of services.', 'atlas-theme' ),
            )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Services', 'atlas-theme' );
        $services = ! empty( $instance['services'] ) ? $instance['services'] : '';
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }
        
        echo '<ul class="footer-services-list">';
        
        if ( ! empty( $services ) ) {
            $services_array = explode( "\n", $services );
            foreach ( $services_array as $service ) {
                $service = trim( $service );
                if ( ! empty( $service ) ) {
                    // Check if service has URL (format: "Service Name|URL")
                    if ( strpos( $service, '|' ) !== false ) {
                        list( $service_name, $service_url ) = explode( '|', $service, 2 );
                        echo '<li><a href="' . esc_url( trim( $service_url ) ) . '">' . esc_html( trim( $service_name ) ) . '</a></li>';
                    } else {
                        echo '<li><a href="#' . sanitize_title( $service ) . '">' . esc_html( $service ) . '</a></li>';
                    }
                }
            }
        } else {
            // Default services
            $default_services = array(
                'Desenvolvimento Web',
                'WordPress',
                'E-commerce',
                'Consultoria',
                'Manutenção'
            );
            
            foreach ( $default_services as $service ) {
                echo '<li><a href="#' . sanitize_title( $service ) . '">' . esc_html( $service ) . '</a></li>';
            }
        }
        
        echo '</ul>';
        
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Services', 'atlas-theme' );
        $services = ! empty( $instance['services'] ) ? $instance['services'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'services' ) ); ?>"><?php esc_html_e( 'Services (one per line):', 'atlas-theme' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'services' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'services' ) ); ?>" rows="6"><?php echo esc_textarea( $services ); ?></textarea>
            <small><?php esc_html_e( 'Format: Service Name or Service Name|URL', 'atlas-theme' ); ?></small>
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['services'] = ( ! empty( $new_instance['services'] ) ) ? sanitize_textarea_field( $new_instance['services'] ) : '';
        
        return $instance;
    }
}

/**
 * Contact Info Widget
 */
class Atlas_Contact_Info_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'atlas_contact_info',
            esc_html__( 'Atlas - Contact Info', 'atlas-theme' ),
            array(
                'description' => esc_html__( 'Display contact information with icons.', 'atlas-theme' ),
            )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact', 'atlas-theme' );
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        $availability = ! empty( $instance['availability'] ) ? $instance['availability'] : '';
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }
        
        echo '<div class="contact-info">';
        
        if ( ! empty( $email ) ) {
            echo '<div class="contact-item">';
            echo '<i class="fas fa-envelope"></i>';
            echo '<span>' . esc_html( $email ) . '</span>';
            echo '</div>';
        }
        
        if ( ! empty( $phone ) ) {
            echo '<div class="contact-item">';
            echo '<i class="fas fa-phone"></i>';
            echo '<span>' . esc_html( $phone ) . '</span>';
            echo '</div>';
        }
        
        if ( ! empty( $address ) ) {
            echo '<div class="contact-item">';
            echo '<i class="fas fa-map-marker-alt"></i>';
            echo '<span>' . esc_html( $address ) . '</span>';
            echo '</div>';
        }
        
        if ( ! empty( $availability ) ) {
            echo '<div class="contact-item">';
            echo '<i class="fas fa-clock"></i>';
            echo '<span>' . esc_html( $availability ) . '</span>';
            echo '</div>';
        }
        
        echo '</div>';
        
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact', 'atlas-theme' );
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        $availability = ! empty( $instance['availability'] ) ? $instance['availability'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'availability' ) ); ?>"><?php esc_html_e( 'Availability:', 'atlas-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'availability' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'availability' ) ); ?>" type="text" value="<?php echo esc_attr( $availability ); ?>">
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? sanitize_text_field( $new_instance['address'] ) : '';
        $instance['availability'] = ( ! empty( $new_instance['availability'] ) ) ? sanitize_text_field( $new_instance['availability'] ) : '';
        
        return $instance;
    }
}

/**
 * Register Custom Widgets
 */
function atlas_theme_register_widgets() {
    register_widget( 'Atlas_Company_Info_Widget' );
    register_widget( 'Atlas_Services_Widget' );
    register_widget( 'Atlas_Contact_Info_Widget' );
}
add_action( 'widgets_init', 'atlas_theme_register_widgets' );
