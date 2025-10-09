<?php
/**
 * Company Logos Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Company Logos Block
 */
function atlas_theme_register_company_logos_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-company-logos-block',
        ATLAS_THEME_URI . '/assets/js/blocks/company-logos-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-company-logos-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/company-logos-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/company-logos-block', array(
        'editor_script' => 'atlas-theme-company-logos-block',
        'editor_style'  => 'atlas-theme-company-logos-block-editor',
        'style'         => 'atlas-theme-company-logos-block',
        'render_callback' => 'atlas_theme_render_company_logos_block',
        'attributes' => array(
            'columns' => array(
                'type' => 'number',
                'default' => 5,
            ),
            'limit' => array(
                'type' => 'number',
                'default' => 5,
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#FDF4E3',
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#134686',
            ),
            'hoverColor' => array(
                'type' => 'string',
                'default' => '#134686',
            ),
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_company_logos_block' );

/**
 * Render Company Logos Block
 */
function atlas_theme_render_company_logos_block( $attributes ) {
    $columns = ! empty( $attributes['columns'] ) ? $attributes['columns'] : 5;
    $limit = ! empty( $attributes['limit'] ) ? $attributes['limit'] : 5;
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#FDF4E3';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#134686';
    $hover_color = ! empty( $attributes['hoverColor'] ) ? $attributes['hoverColor'] : '#134686';
    
    // Get company logos from CPT
    $logos_query = new WP_Query( array(
        'post_type'      => 'atlas_company_logo',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
    
    ob_start();
    ?>
    <section class="company-logos atlas-company-logos-block" style="background-color: <?php echo esc_attr( $bg_color ); ?>;">
        <div class="container">
            <div class="logos-grid" style="grid-template-columns: repeat(<?php echo esc_attr( $columns ); ?>, 1fr);">
                <?php if ( $logos_query->have_posts() ) : ?>
                    <?php while ( $logos_query->have_posts() ) : ?>
                        <?php $logos_query->the_post(); ?>
                        
                        <?php
                        $logo_shape_type = get_post_meta( get_the_ID(), '_atlas_logo_shape_type', true );
                        $logo_shape_letter = get_post_meta( get_the_ID(), '_atlas_logo_shape_letter', true );
                        $company_name = get_the_title();
                        
                        $shape_class = ! empty( $logo_shape_type ) ? $logo_shape_type : 'shape-1';
                        ?>
                        <div class="logo-item">
                            <div class="logo-icon-shape <?php echo esc_attr( $shape_class ); ?>" style="color: <?php echo esc_attr( $text_color ); ?>;">
                                <?php if ( ! empty( $logo_shape_letter ) ) : ?>
                                    <?php echo esc_html( $logo_shape_letter ); ?>
                                <?php endif; ?>
                            </div>
                            <p class="logo-text" style="color: <?php echo esc_attr( $text_color ); ?>;"><?php echo esc_html( $company_name ); ?></p>
                        </div>
                        
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php
                    // Default logos if none exist
                    $default_logos = array(
                        array( 'shape' => 'shape-1', 'letter' => '', 'name' => 'COMPANY NAME' ),
                        array( 'shape' => 'shape-2', 'letter' => 'S', 'name' => 'COMPANY NAME' ),
                        array( 'shape' => 'shape-3', 'letter' => '', 'name' => 'COMPANY NAME' ),
                        array( 'shape' => 'shape-4', 'letter' => 'W', 'name' => 'COMPANY NAME' ),
                        array( 'shape' => 'shape-5', 'letter' => '', 'name' => 'COMPANY NAME' ),
                    );
                    
                    foreach ( $default_logos as $logo ) {
                        echo '<div class="logo-item">';
                        echo '<div class="logo-icon-shape ' . esc_attr( $logo['shape'] ) . '" style="color: ' . esc_attr( $text_color ) . ';">';
                        if ( ! empty( $logo['letter'] ) ) {
                            echo esc_html( $logo['letter'] );
                        }
                        echo '</div>';
                        echo '<p class="logo-text" style="color: ' . esc_attr( $text_color ) . ';">' . esc_html( $logo['name'] ) . '</p>';
                        echo '</div>';
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
        
        <style>
        .atlas-company-logos-block .logo-item:hover .logo-icon-shape {
            background-color: <?php echo esc_attr( $hover_color ); ?> !important;
            color: white !important;
        }
        </style>
    </section>
    <?php
    return ob_get_clean();
}
