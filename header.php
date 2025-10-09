<?php
/**
 * The header for our theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'atlas-theme' ); ?></a>

    <header id="masthead" class="site-header header">
        <div class="container">
            <div class="site-branding logo">
                <?php
                $custom_logo_id = get_option( 'custom_logo' );
                $logo_icon = get_option( 'atlas_logo_icon', 'A' );
                $logo_text = get_option( 'atlas_logo_text', get_bloginfo( 'name' ) );
                
                if ( $custom_logo_id ) {
                    $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( $logo ) {
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="custom-logo">';
                    }
                } else {
                    echo '<div class="logo-icon">' . esc_html( $logo_icon ) . '</div>';
                }
                ?>
                <span class="logo-text"><?php echo esc_html( $logo_text ); ?></span>
            </div>

            <nav id="site-navigation" class="main-navigation nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'atlas-theme' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'atlas_theme_fallback_menu',
                    'walker'         => new Atlas_Theme_Walker_Nav_Menu(),
                ) );
                ?>
            </nav>

            <div class="header-right">
                <div class="social-icons">
                    <?php
                    $linkedin_url = get_option( 'atlas_social_linkedin', '' );
                    $twitter_url = get_option( 'atlas_social_twitter', '' );
                    $dribbble_url = get_option( 'atlas_social_dribbble', '' );
                    $instagram_url = get_option( 'atlas_social_instagram', '' );
                    
                    if ( $linkedin_url ) {
                        echo '<a href="' . esc_url( $linkedin_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'LinkedIn', 'atlas-theme' ) . '"><i class="fab fa-linkedin-in"></i></a>';
                    }
                    if ( $twitter_url ) {
                        echo '<a href="' . esc_url( $twitter_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Twitter', 'atlas-theme' ) . '"><i class="fab fa-x-twitter"></i></a>';
                    }
                    if ( $dribbble_url ) {
                        echo '<a href="' . esc_url( $dribbble_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Dribbble', 'atlas-theme' ) . '"><i class="fab fa-dribbble"></i></a>';
                    }
                    if ( $instagram_url ) {
                        echo '<a href="' . esc_url( $instagram_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Instagram', 'atlas-theme' ) . '"><i class="fab fa-instagram"></i></a>';
                    }
                    ?>
                </div>
                
                <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle mobile menu', 'atlas-theme' ); ?>" aria-expanded="false">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        <button class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close mobile menu', 'atlas-theme' ); ?>">
            <i class="fas fa-times"></i>
        </button>
        <div class="mobile-menu-content">
            <nav class="mobile-menu-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'atlas_theme_fallback_menu',
                    'walker'         => new Atlas_Theme_Walker_Nav_Menu(),
                ) );
                ?>
            </nav>
            
            <div class="mobile-menu-social">
                <?php
                if ( $linkedin_url ) {
                    echo '<a href="' . esc_url( $linkedin_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'LinkedIn', 'atlas-theme' ) . '"><i class="fab fa-linkedin-in"></i></a>';
                }
                if ( $twitter_url ) {
                    echo '<a href="' . esc_url( $twitter_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Twitter', 'atlas-theme' ) . '"><i class="fab fa-x-twitter"></i></a>';
                }
                if ( $dribbble_url ) {
                    echo '<a href="' . esc_url( $dribbble_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Dribbble', 'atlas-theme' ) . '"><i class="fab fa-dribbble"></i></a>';
                }
                if ( $instagram_url ) {
                    echo '<a href="' . esc_url( $instagram_url ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr__( 'Instagram', 'atlas-theme' ) . '"><i class="fab fa-instagram"></i></a>';
                }
                ?>
            </div>
        </div>
    </div>

    <main id="primary" class="site-main">
