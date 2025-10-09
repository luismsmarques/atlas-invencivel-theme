<?php
/**
 * Services Grid Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Services Grid Block
 */
function atlas_theme_register_services_grid_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-services-grid-block',
        ATLAS_THEME_URI . '/assets/js/blocks/services-grid-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-services-grid-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/services-grid-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/services-grid-block', array(
        'editor_script' => 'atlas-theme-services-grid-block',
        'editor_style'  => 'atlas-theme-services-grid-block-editor',
        'style'         => 'atlas-theme-services-grid-block',
        'render_callback' => 'atlas_theme_render_services_grid_block',
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => esc_html__( 'MY SERVICES', 'atlas-theme' ),
            ),
            'columns' => array(
                'type' => 'number',
                'default' => 3,
            ),
            'limit' => array(
                'type' => 'number',
                'default' => -1,
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#ffffff',
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#333333',
            ),
            'titleColor' => array(
                'type' => 'string',
                'default' => '#2D5A5A',
            ),
            'featuredBackgroundColor' => array(
                'type' => 'string',
                'default' => '#2D5A5A',
            ),
            'featuredTextColor' => array(
                'type' => 'string',
                'default' => '#ffffff',
            ),
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_services_grid_block' );

/**
 * Render Services Grid Block
 */
function atlas_theme_render_services_grid_block( $attributes ) {
    $title = ! empty( $attributes['title'] ) ? $attributes['title'] : esc_html__( 'MY SERVICES', 'atlas-theme' );
    $columns = ! empty( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $limit = ! empty( $attributes['limit'] ) ? $attributes['limit'] : -1;
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#ffffff';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#333333';
    $title_color = ! empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#2D5A5A';
    $featured_bg_color = ! empty( $attributes['featuredBackgroundColor'] ) ? $attributes['featuredBackgroundColor'] : '#2D5A5A';
    $featured_text_color = ! empty( $attributes['featuredTextColor'] ) ? $attributes['featuredTextColor'] : '#ffffff';
    
    // Get services from CPT
    $services_query = new WP_Query( array(
        'post_type'      => 'atlas_service',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'meta_value_num',
        'meta_key'       => '_atlas_service_number',
        'order'          => 'ASC',
    ) );
    
    ob_start();
    ?>
    <section class="services atlas-services-grid-block" style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="container">
            <div class="services-header">
                <h2 class="services-title" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $title ); ?></h2>
            </div>
            
            <div class="services-grid" style="grid-template-columns: repeat(<?php echo esc_attr( $columns ); ?>, 1fr);">
                <?php if ( $services_query->have_posts() ) : ?>
                    <?php while ( $services_query->have_posts() ) : ?>
                        <?php $services_query->the_post(); ?>
                        
                        <?php
                        $service_number = get_post_meta( get_the_ID(), '_atlas_service_number', true );
                        $service_icon_type = get_post_meta( get_the_ID(), '_atlas_service_icon_type', true );
                        $service_featured = get_post_meta( get_the_ID(), '_atlas_service_featured', true );
                        
                        $number = ! empty( $service_number ) ? $service_number : '01';
                        $icon_type = ! empty( $service_icon_type ) ? $service_icon_type : 'ux';
                        $is_featured = $service_featured === '1';
                        
                        $card_class = $is_featured ? 'service-card featured' : 'service-card';
                        $number_class = $is_featured ? 'service-number featured-number' : 'service-number';
                        ?>
                        <div class="<?php echo esc_attr( $card_class ); ?>" <?php if ( $is_featured ) : ?>style="background: linear-gradient(135deg, <?php echo esc_attr( $featured_bg_color ); ?> 0%, <?php echo esc_attr( atlas_theme_darken_color( $featured_bg_color, 20 ) ); ?> 100%); color: <?php echo esc_attr( $featured_text_color ); ?>;"<?php endif; ?>>
                            <div class="<?php echo esc_attr( $number_class ); ?>"><?php echo esc_html( sprintf( '%02d.', $number ) ); ?></div>
                            
                            <div class="service-icon <?php echo esc_attr( $icon_type ); ?>-icon">
                                <?php if ( $icon_type === 'graphic' ) : ?>
                                    <div class="icon-briefcase">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                <?php else : ?>
                                    <div class="icon-square">
                                        <span><?php echo esc_html( strtoupper( $icon_type ) ); ?></span>
                                        <div class="icon-arrow"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="service-title"><?php the_title(); ?></h3>
                            <div class="service-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php
                    // Default services if none exist
                    $default_services = array(
                        array( 'number' => '01', 'icon' => 'ux', 'title' => 'UX DESIGN', 'featured' => false ),
                        array( 'number' => '02', 'icon' => 'ui', 'title' => 'UI DESIGN', 'featured' => false ),
                        array( 'number' => '03', 'icon' => 'graphic', 'title' => 'GRAPHIC DESIGN', 'featured' => true ),
                    );
                    
                    foreach ( $default_services as $service ) {
                        $card_class = $service['featured'] ? 'service-card featured' : 'service-card';
                        $number_class = $service['featured'] ? 'service-number featured-number' : 'service-number';
                        $card_style = $service['featured'] ? 'style="background: linear-gradient(135deg, ' . esc_attr( $featured_bg_color ) . ' 0%, ' . esc_attr( atlas_theme_darken_color( $featured_bg_color, 20 ) ) . ' 100%); color: ' . esc_attr( $featured_text_color ) . ';"' : '';
                        
                        echo '<div class="' . esc_attr( $card_class ) . '" ' . $card_style . '>';
                        echo '<div class="' . esc_attr( $number_class ) . '">' . esc_html( $service['number'] ) . '.</div>';
                        echo '<div class="service-icon ' . esc_attr( $service['icon'] ) . '-icon">';
                        
                        if ( $service['icon'] === 'graphic' ) {
                            echo '<div class="icon-briefcase">';
                            echo '<i class="fas fa-briefcase"></i>';
                            echo '</div>';
                        } else {
                            echo '<div class="icon-square">';
                            echo '<span>' . esc_html( strtoupper( $service['icon'] ) ) . '</span>';
                            echo '<div class="icon-arrow"></div>';
                            echo '</div>';
                        }
                        
                        echo '</div>';
                        echo '<h3 class="service-title">' . esc_html( $service['title'] ) . '</h3>';
                        echo '<div class="service-description">';
                        echo '<p>Etiam facilisis ligula nec velit posuere egestas. Nam dictum lectus, sed dignissim purus luctus quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
