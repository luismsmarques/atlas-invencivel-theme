<?php
/**
 * The header for our theme — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$atlas_logo_icon = get_option( 'atlas_logo_icon', 'A' );
$atlas_logo_text = get_option( 'atlas_logo_text', 'atlas.invencivel' );
$atlas_custom_logo_id = get_option( 'custom_logo' );
$atlas_contact_url = atlas_home_url( '/#contacto' );
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

    <header id="masthead" class="site-header">
        <div class="nav-inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="brand">
                <span class="brand-mark">
                    <?php
                    if ( $atlas_custom_logo_id ) {
                        $atlas_logo = wp_get_attachment_image_src( $atlas_custom_logo_id, 'full' );
                        if ( $atlas_logo ) {
                            echo '<img src="' . esc_url( $atlas_logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
                        }
                    } else {
                        echo esc_html( $atlas_logo_icon );
                    }
                    ?>
                </span>
                <span class="brand-name"><?php echo esc_html( $atlas_logo_text ); ?></span>
            </a>

            <nav id="site-navigation" class="primary-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'atlas-theme' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'menu',
                    'container'      => false,
                    'fallback_cb'    => 'atlas_theme_fallback_menu',
                    'walker'         => new Atlas_Theme_Walker_Nav_Menu(),
                ) );
                ?>
                <a href="<?php echo esc_url( $atlas_contact_url ); ?>" class="nav-cta"><?php echo esc_html( atlas_t( './contacto', './contact' ) ); ?></a>
                <?php atlas_lang_switcher(); ?>
            </nav>

            <button class="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'atlas-theme' ); ?>" aria-expanded="false" aria-controls="mobile-menu-overlay">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        <button class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'atlas-theme' ); ?>"><?php echo esc_html( atlas_t( '[ fechar ]', '[ close ]' ) ); ?></button>
        <nav class="mobile-menu-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'atlas-theme' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'mobile-primary-menu',
                'menu_class'     => 'menu',
                'container'      => false,
                'fallback_cb'    => 'atlas_theme_fallback_menu',
                'walker'         => new Atlas_Theme_Walker_Nav_Menu(),
            ) );
            ?>
        </nav>
        <div class="mobile-menu-social">
            <?php
            $atlas_socials = array(
                'linkedin' => get_option( 'atlas_social_linkedin', 'https://www.linkedin.com/in/luismsmarques/' ),
                'x'        => get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques/' ),
                'github'   => get_option( 'atlas_social_github', 'https://github.com/luismsmarques' ),
            );
            foreach ( $atlas_socials as $atlas_label => $atlas_url ) {
                if ( ! empty( $atlas_url ) ) {
                    echo '<a href="' . esc_url( $atlas_url ) . '" target="_blank" rel="noopener">' . esc_html( $atlas_label ) . '</a>';
                }
            }
            ?>
        </div>
        <?php atlas_lang_switcher(); ?>
    </div>

    <main id="primary" class="site-main">
