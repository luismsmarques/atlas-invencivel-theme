<?php
/**
 * The template for displaying the footer — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$atlas_year = date( 'Y' );
$atlas_tagline = get_option( 'atlas_footer_description', 'helping people solve problems with code' );
$atlas_wordmark = get_option( 'atlas_footer_logo_text', 'ATLAS INVENCÍVEL' );

$atlas_footer_socials = array(
    'linkedin' => get_option( 'atlas_social_linkedin', 'https://www.linkedin.com/in/luismsmarques/' ),
    'x'        => get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques/' ),
    'github'   => get_option( 'atlas_social_github', 'https://github.com/luismsmarques' ),
    'peerlist' => get_option( 'atlas_social_peerlist', 'https://peerlist.io/luismsmarques' ),
);
?>

    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="footer-inner">
            <span class="footer-wordmark"><?php echo esc_html( $atlas_wordmark ); ?></span>

            <span class="footer-social">
                <?php
                foreach ( $atlas_footer_socials as $atlas_label => $atlas_url ) {
                    if ( ! empty( $atlas_url ) ) {
                        echo '<a href="' . esc_url( $atlas_url ) . '" target="_blank" rel="noopener">' . esc_html( $atlas_label ) . '</a>';
                    }
                }
                ?>
            </span>

            <span class="footer-tagline">&copy; <?php echo esc_html( $atlas_year ); ?> &middot; <?php echo esc_html( $atlas_tagline ); ?></span>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
