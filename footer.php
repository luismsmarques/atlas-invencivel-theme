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

    <?php
    // Links de páginas (contacto / termos / privacidade), resolvidos para a
    // língua ativa via Polylang. Só aparecem se a página existir.
    $atlas_footer_pages = array();
    if ( function_exists( 'atlas_page_url' ) ) {
        $atlas_footer_candidates = array(
            array(
                'label' => atlas_t( 'Contacto', 'Contact' ),
                'slugs' => array( 'contacto', 'contact', 'contact-2' ),
            ),
            array(
                'label' => atlas_t( 'Termos e Condições', 'Terms & Conditions' ),
                'slugs' => array( 'termos-e-condicoes', 'terms-and-conditions', 'terms-conditions', 'termos' ),
            ),
            array(
                'label' => atlas_t( 'Privacidade', 'Privacy' ),
                'slugs' => array( 'politica-de-privacidade', 'privacy-policy', 'privacidade' ),
            ),
        );
        foreach ( $atlas_footer_candidates as $atlas_c ) {
            $atlas_u = atlas_page_url( $atlas_c['slugs'] );
            // atlas_page_url devolve a home se não encontrar a página — ignorar nesse caso.
            if ( $atlas_u && $atlas_u !== atlas_home_url( '/' ) ) {
                $atlas_footer_pages[] = array( 'label' => $atlas_c['label'], 'url' => $atlas_u );
            }
        }
    }
    ?>

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

        <?php if ( ! empty( $atlas_footer_pages ) ) : ?>
            <nav class="footer-legal" aria-label="<?php echo esc_attr( atlas_t( 'Ligações de rodapé', 'Footer links' ) ); ?>">
                <?php
                foreach ( $atlas_footer_pages as $atlas_page ) {
                    echo '<a href="' . esc_url( $atlas_page['url'] ) . '">' . esc_html( $atlas_page['label'] ) . '</a>';
                }
                ?>
            </nav>
        <?php endif; ?>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
