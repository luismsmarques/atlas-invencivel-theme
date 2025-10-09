<?php
/**
 * Customizer Controls for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer Settings and Controls
 */
function atlas_theme_customize_register( $wp_customize ) {
    
    /**
     * Custom Repeater Control Class
     */
    class Atlas_Theme_Repeater_Control extends WP_Customize_Control {
        
        public $type = 'atlas-repeater';
        public $fields = array();
        
        public function render_content() {
            if ( empty( $this->fields ) ) {
                return;
            }
            
            $value = $this->value();
            if ( ! is_array( $value ) ) {
                $value = array();
            }
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </label>
            
            <div class="atlas-repeater-control">
                <div class="atlas-repeater-items">
                    <?php foreach ( $value as $index => $item ) : ?>
                        <div class="atlas-repeater-item" data-index="<?php echo esc_attr( $index ); ?>">
                            <div class="atlas-repeater-item-header">
                                <h4 class="atlas-repeater-item-title"><?php echo esc_html( sprintf( __( 'Item %d', 'atlas-theme' ), $index + 1 ) ); ?></h4>
                                <button type="button" class="atlas-repeater-item-remove"><?php esc_html_e( 'Remove', 'atlas-theme' ); ?></button>
                            </div>
                            <div class="atlas-repeater-item-content">
                                <?php foreach ( $this->fields as $field_key => $field ) : ?>
                                    <div class="atlas-repeater-field">
                                        <label><?php echo esc_html( $field['label'] ); ?></label>
                                        <?php if ( ! empty( $field['description'] ) ) : ?>
                                            <span class="description"><?php echo esc_html( $field['description'] ); ?></span>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $field_value = isset( $item[ $field_key ] ) ? $item[ $field_key ] : '';
                                        $field_name = $this->get_field_name( $field_key, $index );
                                        
                                        switch ( $field['type'] ) {
                                            case 'textarea':
                                                echo '<textarea name="' . esc_attr( $field_name ) . '" rows="3">' . esc_textarea( $field_value ) . '</textarea>';
                                                break;
                                            case 'select':
                                                echo '<select name="' . esc_attr( $field_name ) . '">';
                                                if ( ! empty( $field['choices'] ) ) {
                                                    foreach ( $field['choices'] as $choice_value => $choice_label ) {
                                                        echo '<option value="' . esc_attr( $choice_value ) . '" ' . selected( $field_value, $choice_value, false ) . '>' . esc_html( $choice_label ) . '</option>';
                                                    }
                                                }
                                                echo '</select>';
                                                break;
                                            default:
                                                echo '<input type="text" name="' . esc_attr( $field_name ) . '" value="' . esc_attr( $field_value ) . '" />';
                                                break;
                                        }
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <button type="button" class="atlas-repeater-add"><?php esc_html_e( 'Add Item', 'atlas-theme' ); ?></button>
                
                <input type="hidden" class="atlas-repeater-value" <?php $this->link(); ?> />
            </div>
            
            <script type="text/javascript">
            jQuery(document).ready(function($) {
                var control = $('.atlas-repeater-control');
                var addButton = control.find('.atlas-repeater-add');
                var itemsContainer = control.find('.atlas-repeater-items');
                var hiddenInput = control.find('.atlas-repeater-value');
                
                // Add item
                addButton.on('click', function() {
                    var index = itemsContainer.find('.atlas-repeater-item').length;
                    var newItem = createRepeaterItem(index);
                    itemsContainer.append(newItem);
                    updateHiddenInput();
                });
                
                // Remove item
                control.on('click', '.atlas-repeater-item-remove', function() {
                    $(this).closest('.atlas-repeater-item').remove();
                    updateHiddenInput();
                });
                
                // Update on input change
                control.on('input change', 'input, textarea, select', function() {
                    updateHiddenInput();
                });
                
                function createRepeaterItem(index) {
                    var itemHtml = '<div class="atlas-repeater-item" data-index="' + index + '">';
                    itemHtml += '<div class="atlas-repeater-item-header">';
                    itemHtml += '<h4 class="atlas-repeater-item-title"><?php echo esc_js( __( 'Item', 'atlas-theme' ) ); ?> ' + (index + 1) + '</h4>';
                    itemHtml += '<button type="button" class="atlas-repeater-item-remove"><?php echo esc_js( __( 'Remove', 'atlas-theme' ) ); ?></button>';
                    itemHtml += '</div>';
                    itemHtml += '<div class="atlas-repeater-item-content">';
                    
                    <?php foreach ( $this->fields as $field_key => $field ) : ?>
                        itemHtml += '<div class="atlas-repeater-field">';
                        itemHtml += '<label><?php echo esc_js( $field['label'] ); ?></label>';
                        <?php if ( ! empty( $field['description'] ) ) : ?>
                            itemHtml += '<span class="description"><?php echo esc_js( $field['description'] ); ?></span>';
                        <?php endif; ?>
                        
                        <?php
                        $field_name = $this->get_field_name( $field_key, 'INDEX_PLACEHOLDER' );
                        switch ( $field['type'] ) {
                            case 'textarea':
                                echo 'itemHtml += \'<textarea name="' . esc_js( str_replace( 'INDEX_PLACEHOLDER', '\' + index + \'', $field_name ) ) . '" rows="3"></textarea>\';';
                                break;
                            case 'select':
                                echo 'itemHtml += \'<select name="' . esc_js( str_replace( 'INDEX_PLACEHOLDER', '\' + index + \'', $field_name ) ) . '">\';';
                                if ( ! empty( $field['choices'] ) ) {
                                    foreach ( $field['choices'] as $choice_value => $choice_label ) {
                                        echo 'itemHtml += \'<option value="' . esc_js( $choice_value ) . '">' . esc_js( $choice_label ) . '</option>\';';
                                    }
                                }
                                echo 'itemHtml += \'</select>\';';
                                break;
                            default:
                                echo 'itemHtml += \'<input type="text" name="' . esc_js( str_replace( 'INDEX_PLACEHOLDER', '\' + index + \'', $field_name ) ) . '" value="" />\';';
                                break;
                        }
                        ?>
                        
                        itemHtml += '</div>';
                    <?php endforeach; ?>
                    
                    itemHtml += '</div>';
                    itemHtml += '</div>';
                    
                    return itemHtml;
                }
                
                function updateHiddenInput() {
                    var data = [];
                    itemsContainer.find('.atlas-repeater-item').each(function() {
                        var item = {};
                        $(this).find('input, textarea, select').each(function() {
                            var name = $(this).attr('name');
                            var key = name.match(/\[(\w+)\]$/)[1];
                            item[key] = $(this).val();
                        });
                        data.push(item);
                    });
                    hiddenInput.val(JSON.stringify(data)).trigger('change');
                }
            });
            </script>
            <?php
        }
        
        private function get_field_name( $field_key, $index ) {
            return $this->get_field_name() . '[' . $index . '][' . $field_key . ']';
        }
    }
    
    // Remove default sections
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'background_image' );
    
    // Add Atlas Theme Panel
    $wp_customize->add_panel( 'atlas_theme_panel', array(
        'title'    => esc_html__( 'Atlas Theme Options', 'atlas-theme' ),
        'priority' => 30,
    ) );
    
    // Site Identity Section
    atlas_theme_add_site_identity_section( $wp_customize );
    
    // Header Section
    atlas_theme_add_header_section( $wp_customize );
    
    // Hero Section
    atlas_theme_add_hero_section( $wp_customize );
    
    // Colors Section
    atlas_theme_add_colors_section( $wp_customize );
    
    // Social Links Section
    atlas_theme_add_social_section( $wp_customize );
    
    // Footer Section
    atlas_theme_add_footer_section( $wp_customize );
}

/**
 * Add Site Identity Section
 */
function atlas_theme_add_site_identity_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_site_identity', array(
        'title'    => esc_html__( 'Site Identity', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 10,
    ) );
    
    // Logo Icon
    $wp_customize->add_setting( 'atlas_logo_icon', array(
        'default'           => 'A',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_logo_icon', array(
        'label'       => esc_html__( 'Logo Icon', 'atlas-theme' ),
        'description' => esc_html__( 'Single letter or character for the logo icon', 'atlas-theme' ),
        'section'     => 'atlas_site_identity',
        'type'        => 'text',
    ) );
    
    // Logo Text
    $wp_customize->add_setting( 'atlas_logo_text', array(
        'default'           => get_bloginfo( 'name' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_logo_text', array(
        'label'       => esc_html__( 'Logo Text', 'atlas-theme' ),
        'description' => esc_html__( 'Text displayed next to the logo icon', 'atlas-theme' ),
        'section'     => 'atlas_site_identity',
        'type'        => 'text',
    ) );
}

/**
 * Add Header Section
 */
function atlas_theme_add_header_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_header', array(
        'title'    => esc_html__( 'Header Settings', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 20,
    ) );
    
    // Header Background Color
    $wp_customize->add_setting( 'atlas_header_bg_color', array(
        'default'           => 'rgba(255, 255, 255, 0.95)',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atlas_header_bg_color', array(
        'label'   => esc_html__( 'Header Background Color', 'atlas-theme' ),
        'section' => 'atlas_header',
    ) ) );
}

/**
 * Add Hero Section
 */
function atlas_theme_add_hero_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_hero', array(
        'title'    => esc_html__( 'Hero Section', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 30,
    ) );
    
    // Hero Greeting
    $wp_customize->add_setting( 'atlas_hero_greeting', array(
        'default'           => esc_html__( 'Hey, my name is', 'atlas-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'atlas_hero_greeting', array(
        'label'   => esc_html__( 'Greeting Text', 'atlas-theme' ),
        'section' => 'atlas_hero',
        'type'    => 'text',
    ) );
    
    // Hero Name
    $wp_customize->add_setting( 'atlas_hero_name', array(
        'default'           => 'LUIS MARQUES',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'atlas_hero_name', array(
        'label'   => esc_html__( 'Full Name', 'atlas-theme' ),
        'section' => 'atlas_hero',
        'type'    => 'text',
    ) );
    
    // Hero Underlined Name
    $wp_customize->add_setting( 'atlas_hero_underlined', array(
        'default'           => 'MARQUES',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'atlas_hero_underlined', array(
        'label'   => esc_html__( 'Underlined Name Part', 'atlas-theme' ),
        'section' => 'atlas_hero',
        'type'    => 'text',
    ) );
    
    // Hero Role
    $wp_customize->add_setting( 'atlas_hero_role', array(
        'default'           => 'WEBMASTER & BUILDER',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'atlas_hero_role', array(
        'label'   => esc_html__( 'Role/Title', 'atlas-theme' ),
        'section' => 'atlas_hero',
        'type'    => 'text',
    ) );
    
    // Hero Image
    $wp_customize->add_setting( 'atlas_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'atlas_hero_image', array(
        'label'     => esc_html__( 'Profile Image', 'atlas-theme' ),
        'section'   => 'atlas_hero',
        'mime_type' => 'image',
    ) ) );
    
    // Hero Stats Repeater
    $wp_customize->add_setting( 'atlas_hero_stats', array(
        'default'           => array(
            array(
                'label' => esc_html__( 'Years of experience in Tech & Digital', 'atlas-theme' ),
                'value' => '15+',
            ),
            array(
                'label' => esc_html__( 'Companies Founded and Led', 'atlas-theme' ),
                'value' => '3',
            ),
            array(
                'label' => esc_html__( 'Social Media Communities & Content Managed', 'atlas-theme' ),
                'value' => '10+',
            ),
        ),
        'sanitize_callback' => 'atlas_theme_sanitize_repeater',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new Atlas_Theme_Repeater_Control( $wp_customize, 'atlas_hero_stats', array(
        'label'   => esc_html__( 'Hero Stats', 'atlas-theme' ),
        'section' => 'atlas_hero',
        'fields'  => array(
            'label' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Label', 'atlas-theme' ),
                'description' => esc_html__( 'Stat label text', 'atlas-theme' ),
            ),
            'value' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Value', 'atlas-theme' ),
                'description' => esc_html__( 'Stat value', 'atlas-theme' ),
            ),
        ),
    ) ) );
}

/**
 * Add Colors Section
 */
function atlas_theme_add_colors_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_colors', array(
        'title'    => esc_html__( 'Colors', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 40,
    ) );
    
    // Primary Color
    $wp_customize->add_setting( 'atlas_primary_color', array(
        'default'           => '#134686',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atlas_primary_color', array(
        'label'   => esc_html__( 'Primary Color', 'atlas-theme' ),
        'section' => 'atlas_colors',
    ) ) );
    
    // Secondary Color
    $wp_customize->add_setting( 'atlas_secondary_color', array(
        'default'           => '#FEB21A',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atlas_secondary_color', array(
        'label'   => esc_html__( 'Secondary Color', 'atlas-theme' ),
        'section' => 'atlas_colors',
    ) ) );
    
    // Background Color
    $wp_customize->add_setting( 'atlas_background_color', array(
        'default'           => '#FDF4E3',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atlas_background_color', array(
        'label'   => esc_html__( 'Background Color', 'atlas-theme' ),
        'section' => 'atlas_colors',
    ) ) );
    
    // Text Color
    $wp_customize->add_setting( 'atlas_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atlas_text_color', array(
        'label'   => esc_html__( 'Text Color', 'atlas-theme' ),
        'section' => 'atlas_colors',
    ) ) );
}

/**
 * Add Social Links Section
 */
function atlas_theme_add_social_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_social', array(
        'title'    => esc_html__( 'Social Links', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 50,
    ) );
    
    // LinkedIn URL
    $wp_customize->add_setting( 'atlas_social_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_social_linkedin', array(
        'label'   => esc_html__( 'LinkedIn URL', 'atlas-theme' ),
        'section' => 'atlas_social',
        'type'    => 'url',
    ) );
    
    // Twitter URL
    $wp_customize->add_setting( 'atlas_social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_social_twitter', array(
        'label'   => esc_html__( 'Twitter/X URL', 'atlas-theme' ),
        'section' => 'atlas_social',
        'type'    => 'url',
    ) );
    
    // Dribbble URL
    $wp_customize->add_setting( 'atlas_social_dribbble', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_social_dribbble', array(
        'label'   => esc_html__( 'Dribbble URL', 'atlas-theme' ),
        'section' => 'atlas_social',
        'type'    => 'url',
    ) );
    
    // Instagram URL
    $wp_customize->add_setting( 'atlas_social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_social_instagram', array(
        'label'   => esc_html__( 'Instagram URL', 'atlas-theme' ),
        'section' => 'atlas_social',
        'type'    => 'url',
    ) );
    
    // Add Contact Section
    atlas_theme_add_contact_section( $wp_customize );
}

/**
 * Add Contact Section
 */
function atlas_theme_add_contact_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_contact', array(
        'title'    => esc_html__( 'Contact Settings', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 50,
    ) );
    
    // Contact Email
    $wp_customize->add_setting( 'atlas_contact_email', array(
        'default'           => 'hello@atlasinvencivel.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_email', array(
        'label'   => esc_html__( 'Contact Email', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'email',
    ) );
    
    // Contact Phone
    $wp_customize->add_setting( 'atlas_contact_phone', array(
        'default'           => '+351 123 456 789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_phone', array(
        'label'   => esc_html__( 'Contact Phone', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
    
    // Contact Location
    $wp_customize->add_setting( 'atlas_contact_location', array(
        'default'           => 'Porto, Portugal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_location', array(
        'label'   => esc_html__( 'Contact Location', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
    
    // Contact Availability
    $wp_customize->add_setting( 'atlas_contact_availability', array(
        'default'           => 'Monday - Friday: 9:00 AM - 6:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_availability', array(
        'label'   => esc_html__( 'Availability', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
    
    // Contact Response Time
    $wp_customize->add_setting( 'atlas_contact_response_time', array(
        'default'           => 'Within 24 hours',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_contact_response_time', array(
        'label'   => esc_html__( 'Response Time', 'atlas-theme' ),
        'section' => 'atlas_contact',
        'type'    => 'text',
    ) );
}

/**
 * Add Footer Section
 */
function atlas_theme_add_footer_section( $wp_customize ) {
    $wp_customize->add_section( 'atlas_footer', array(
        'title'    => esc_html__( 'Footer Settings', 'atlas-theme' ),
        'panel'    => 'atlas_theme_panel',
        'priority' => 60,
    ) );
    
    // Footer Copyright
    $wp_customize->add_setting( 'atlas_footer_copyright', array(
        'default'           => sprintf( esc_html__( '&copy; %d - %s', 'atlas-theme' ), date( 'Y' ), get_bloginfo( 'name' ) ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_footer_copyright', array(
        'label'   => esc_html__( 'Copyright Text', 'atlas-theme' ),
        'section' => 'atlas_footer',
        'type'    => 'textarea',
    ) );
    
    // Footer Logo Icon
    $wp_customize->add_setting( 'atlas_footer_logo_icon', array(
        'default'           => 'L',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_footer_logo_icon', array(
        'label'   => esc_html__( 'Footer Logo Icon', 'atlas-theme' ),
        'section' => 'atlas_footer',
        'type'    => 'text',
    ) );
    
    // Footer Logo Text
    $wp_customize->add_setting( 'atlas_footer_logo_text', array(
        'default'           => 'LUIS MARQUES',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( 'atlas_footer_logo_text', array(
        'label'   => esc_html__( 'Footer Logo Text', 'atlas-theme' ),
        'section' => 'atlas_footer',
        'type'    => 'text',
    ) );
}

/**
 * Sanitize Repeater Field
 */
function atlas_theme_sanitize_repeater( $input ) {
    if ( ! is_array( $input ) ) {
        return array();
    }
    
    $sanitized = array();
    foreach ( $input as $item ) {
        if ( is_array( $item ) ) {
            $sanitized_item = array();
            foreach ( $item as $key => $value ) {
                $sanitized_item[ $key ] = sanitize_text_field( $value );
            }
            $sanitized[] = $sanitized_item;
        }
    }
    
    return $sanitized;
}


// Register customizer
add_action( 'customize_register', 'atlas_theme_customize_register' );
