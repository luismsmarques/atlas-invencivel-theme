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
        <!-- Footer Main Content -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <!-- Company Info Widget Area -->
                    <div class="footer-section footer-about">
                        <?php
                        if ( is_active_sidebar( 'footer-about' ) ) {
                            dynamic_sidebar( 'footer-about' );
                        } else {
                            // Fallback content if no widgets are added
                            ?>
                            <div class="footer-logo">
                                <?php
                                $footer_logo_icon = get_option( 'atlas_footer_logo_icon', 'A' );
                                $footer_logo_text = get_option( 'atlas_footer_logo_text', 'Atlas Invencível' );
                                ?>
                                <div class="footer-logo-icon"><?php echo esc_html( $footer_logo_icon ); ?></div>
                                <span class="footer-logo-text"><?php echo esc_html( $footer_logo_text ); ?></span>
                            </div>
                            
                            <p class="footer-description">
                                Desenvolvedor apaixonado criando soluções inovadoras e compartilhando conhecimento através de código e conteúdo.
                            </p>
                            
                            <div class="footer-social">
                                <?php
                                $linkedin_url = get_option( 'atlas_social_linkedin', 'https://www.linkedin.com/in/luismsmarques/' );
                                $twitter_url = get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques' );
                                $github_url = get_option( 'atlas_social_github', 'https://github.com/luismsmarques' );
                                $instagram_url = get_option( 'atlas_social_instagram', '' );
                                
                                if ( $linkedin_url ) {
                                    echo '<a href="' . esc_url( $linkedin_url ) . '" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>';
                                }
                                if ( $twitter_url ) {
                                    echo '<a href="' . esc_url( $twitter_url ) . '" target="_blank" rel="noopener" class="social-link" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>';
                                }
                                if ( $github_url ) {
                                    echo '<a href="' . esc_url( $github_url ) . '" target="_blank" rel="noopener" class="social-link" aria-label="GitHub"><i class="fab fa-github"></i></a>';
                                }
                                if ( $instagram_url ) {
                                    echo '<a href="' . esc_url( $instagram_url ) . '" target="_blank" rel="noopener" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Quick Links Widget Area -->
                    <div class="footer-section footer-links">
                        <?php
                        if ( is_active_sidebar( 'footer-links' ) ) {
                            dynamic_sidebar( 'footer-links' );
                        } else {
                            // Fallback content
                            ?>
                            <h3 class="footer-title">Links Rápidos</h3>
                            <nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'atlas-theme' ); ?>">
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
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Services Widget Area -->
                    <div class="footer-section footer-services">
                        <?php
                        if ( is_active_sidebar( 'footer-services' ) ) {
                            dynamic_sidebar( 'footer-services' );
                        } else {
                            // Fallback content
                            ?>
                            <h3 class="footer-title">Serviços</h3>
                            <ul class="footer-services-list">
                                <li><a href="#web-development">Desenvolvimento Web</a></li>
                                <li><a href="#wordpress">WordPress</a></li>
                                <li><a href="#ecommerce">E-commerce</a></li>
                                <li><a href="#consulting">Consultoria</a></li>
                                <li><a href="#maintenance">Manutenção</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Contact Info Widget Area -->
                    <div class="footer-section footer-contact">
                        <?php
                        if ( is_active_sidebar( 'footer-contact' ) ) {
                            dynamic_sidebar( 'footer-contact' );
                        } else {
                            // Fallback content
                            ?>
                            <h3 class="footer-title">Contacto</h3>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php echo esc_html( get_option( 'atlas_contact_email', 'luis@atlasinvencivel.com' ) ); ?></span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo esc_html( get_option( 'atlas_contact_phone', '+351 123 456 789' ) ); ?></span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo esc_html( get_option( 'atlas_contact_address', 'Portugal' ) ); ?></span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Disponível para projetos</span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        <?php
                        $copyright_text = get_option( 'atlas_footer_copyright', sprintf( esc_html__( '© %d %s. Todos os direitos reservados.', 'atlas-theme' ), date( 'Y' ), get_bloginfo( 'name' ) ) );
                        echo wp_kses_post( $copyright_text );
                        ?>
                    </div>
                    
                    <div class="footer-bottom-links">
                        <a href="/privacy-policy/">Política de Privacidade</a>
                        <a href="/terms-of-service/">Termos de Serviço</a>
                        <a href="/cookies/">Política de Cookies</a>
                        <a href="/sitemap/">Mapa do Site</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
