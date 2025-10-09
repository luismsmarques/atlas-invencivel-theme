<?php
/**
 * The template for displaying the footer
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

    </main><!-- #primary -->

    <footer id="colophon" class="site-footer footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <?php
                    $copyright_text = get_option( 'atlas_footer_copyright', sprintf( esc_html__( '&copy; %d - %s', 'atlas-theme' ), date( 'Y' ), get_bloginfo( 'name' ) ) );
                    echo wp_kses_post( $copyright_text );
                    ?>
                </div>
                
                <div class="footer-center">
                    <div class="footer-logo">
                        <?php
                        $footer_logo_icon = get_option( 'atlas_footer_logo_icon', 'L' );
                        $footer_logo_text = get_option( 'atlas_footer_logo_text', 'LUIS MARQUES' );
                        ?>
                        <div class="footer-logo-icon"><?php echo esc_html( $footer_logo_icon ); ?></div>
                        <span class="footer-logo-text"><?php echo esc_html( $footer_logo_text ); ?></span>
                    </div>
                </div>
                
                <!-- <div class="footer-right">
                    <nav class="footer-navigation footer-nav" role="navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'atlas-theme' ); ?>">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => 'atlas_theme_footer_fallback_menu',
                            'depth'          => 1,
                        ) );
                        ?>
                    </nav>
                </div> -->
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
