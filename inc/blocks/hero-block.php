<?php
/**
 * Hero Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Hero Block
 */
function atlas_theme_register_hero_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-hero-block',
        ATLAS_THEME_URI . '/assets/js/blocks/hero-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-hero-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/hero-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/hero-block', array(
        'editor_script' => 'atlas-theme-hero-block',
        'editor_style'  => 'atlas-theme-hero-block-editor',
        'style'         => 'atlas-theme-hero-block',
        'render_callback' => 'atlas_theme_render_hero_block',
        'attributes' => array(
            'greeting' => array(
                'type' => 'string',
                'default' => esc_html__( 'Hey, my name is', 'atlas-theme' ),
            ),
            'name' => array(
                'type' => 'string',
                'default' => 'LUIS MARQUES',
            ),
            'underlined' => array(
                'type' => 'string',
                'default' => 'MARQUES',
            ),
            'role' => array(
                'type' => 'string',
                'default' => 'WEBMASTER & BUILDER',
            ),
            'imageId' => array(
                'type' => 'number',
                'default' => 0,
            ),
            'imageUrl' => array(
                'type' => 'string',
                'default' => '',
            ),
            'stats' => array(
                'type' => 'array',
                'default' => array(
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
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#134686',
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#ffffff',
            ),
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_hero_block' );

/**
 * Render Hero Block
 */
function atlas_theme_render_hero_block( $attributes ) {
    $greeting = ! empty( $attributes['greeting'] ) ? $attributes['greeting'] : esc_html__( 'Hey, my name is', 'atlas-theme' );
    $name = ! empty( $attributes['name'] ) ? $attributes['name'] : 'LUIS MARQUES';
    $underlined = ! empty( $attributes['underlined'] ) ? $attributes['underlined'] : 'MARQUES';
    $role = ! empty( $attributes['role'] ) ? $attributes['role'] : 'WEBMASTER & BUILDER';
    $image_url = ! empty( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : get_template_directory_uri() . '/assets/images/luis-marques-profile.png';
    $stats = ! empty( $attributes['stats'] ) ? $attributes['stats'] : array();
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#134686';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#ffffff';
    
    ob_start();
    ?>
    <section class="hero atlas-hero-block" style="background: linear-gradient(135deg, <?php echo esc_attr( $bg_color ); ?> 0%, <?php echo esc_attr( atlas_theme_darken_color( $bg_color, 20 ) ); ?> 100%); color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="hero-bg">
            <div class="wave-lines"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <p class="hero-subtitle"><?php echo esc_html( $greeting ); ?></p>
                    <h1 class="hero-title">
                        <?php echo esc_html( $name ); ?>
                        <span class="underline-yellow"><?php echo esc_html( $underlined ); ?></span>
                    </h1>
                    <p class="hero-role"><?php echo esc_html( $role ); ?></p>
                </div>
                
                <div class="hero-center">
                    <div class="hero-image">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="profile-img">
                    </div>
                </div>
                
                <div class="hero-right">
                    <?php if ( ! empty( $stats ) ) : ?>
                        <?php foreach ( $stats as $stat ) : ?>
                            <?php if ( ! empty( $stat['label'] ) && ! empty( $stat['value'] ) ) : ?>
                                <div class="stat">
                                    <p class="stat-label"><?php echo esc_html( $stat['label'] ); ?></p>
                                    <p class="stat-value"><?php echo esc_html( $stat['value'] ); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Helper function to darken color
 */
function atlas_theme_darken_color( $color, $percent ) {
    $color = ltrim( $color, '#' );
    
    if ( strlen( $color ) === 3 ) {
        $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
    }
    
    $r = hexdec( substr( $color, 0, 2 ) );
    $g = hexdec( substr( $color, 2, 2 ) );
    $b = hexdec( substr( $color, 4, 2 ) );
    
    $r = max( 0, min( 255, $r - ( $r * $percent / 100 ) ) );
    $g = max( 0, min( 255, $g - ( $g * $percent / 100 ) ) );
    $b = max( 0, min( 255, $b - ( $b * $percent / 100 ) ) );
    
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}
