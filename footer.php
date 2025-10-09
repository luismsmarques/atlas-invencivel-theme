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
            <!-- Top Section - 4 Columns -->
            <div class="footer-top">
                <div class="footer-columns">
                    <!-- Company Info Column -->
                    <div class="footer-column footer-company">
                        <h3 class="footer-column-title">
                            <?php echo esc_html( get_option( 'atlas_footer_logo_text', 'Atlas Invencível' ) ); ?>
                        </h3>
                        <p class="footer-description">
                            <?php echo esc_html( get_option( 'atlas_footer_description', 'Helping people solve problems with code.' ) ); ?>
                        </p>
                    </div>
                    
                    <!-- Footer 1 Column -->
                    <div class="footer-column footer-shop">
                        <?php
                        if ( has_nav_menu( 'footer-shop' ) ) {
                            $menu = wp_get_nav_menu_object( get_nav_menu_locations()['footer-shop'] );
                            $menu_title = $menu ? $menu->name : 'Shop';
                            echo '<h3 class="footer-column-title">' . esc_html( $menu_title ) . '</h3>';
                            
                            wp_nav_menu( array(
                                'theme_location' => 'footer-shop',
                                'menu_id'        => 'footer-shop-menu',
                                'container'      => false,
                                'fallback_cb'    => 'atlas_theme_footer_shop_fallback_menu',
                                'depth'          => 1,
                            ) );
                        } else {
                            // Fallback content
                            echo '<h3 class="footer-column-title">Shop</h3>';
                            ?>
                            <ul class="footer-links">
                                <li><a href="#sell-online">Sell online</a></li>
                                <li><a href="#features">Features</a></li>
                                <li><a href="#examples">Examples</a></li>
                                <li><a href="#website-editors">Website editors</a></li>
                                <li><a href="#online-retail">Online retail</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Footer 2 Column -->
                    <div class="footer-column footer-press">
                        <?php
                        if ( has_nav_menu( 'footer-press' ) ) {
                            $menu = wp_get_nav_menu_object( get_nav_menu_locations()['footer-press'] );
                            $menu_title = $menu ? $menu->name : 'Press';
                            echo '<h3 class="footer-column-title">' . esc_html( $menu_title ) . '</h3>';
                            
                            wp_nav_menu( array(
                                'theme_location' => 'footer-press',
                                'menu_id'        => 'footer-press-menu',
                                'container'      => false,
                                'fallback_cb'    => 'atlas_theme_footer_press_fallback_menu',
                                'depth'          => 1,
                            ) );
                        } else {
                            // Fallback content
                            echo '<h3 class="footer-column-title">Press</h3>';
                            ?>
                            <ul class="footer-links">
                                <li><a href="#events">Events</a></li>
                                <li><a href="#news">News</a></li>
                                <li><a href="#awards">Awards</a></li>
                                <li><a href="#testimonials">Testimonials</a></li>
                                <li><a href="#online-retail">Online retail</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Footer 3 Column -->
                    <div class="footer-column footer-about">
                        <?php
                        if ( has_nav_menu( 'footer-about' ) ) {
                            $menu = wp_get_nav_menu_object( get_nav_menu_locations()['footer-about'] );
                            $menu_title = $menu ? $menu->name : 'About';
                            echo '<h3 class="footer-column-title">' . esc_html( $menu_title ) . '</h3>';
                            
                            wp_nav_menu( array(
                                'theme_location' => 'footer-about',
                                'menu_id'        => 'footer-about-menu',
                                'container'      => false,
                                'fallback_cb'    => 'atlas_theme_footer_about_fallback_menu',
                                'depth'          => 1,
                            ) );
                        } else {
                            // Fallback content
                            echo '<h3 class="footer-column-title">About</h3>';
                            ?>
                            <ul class="footer-links">
                                <li><a href="#contact">Contact</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#team">Team</a></li>
                                <li><a href="#career">Career</a></li>
                                <li><a href="#contacts">Contacts</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Middle Section - Legal Links & Social Media -->
            <div class="footer-middle">
                <div class="footer-middle-content">
                    <!-- Legal Links -->
                    <div class="footer-legal">
                        <?php
                        if ( has_nav_menu( 'footer-legal' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'footer-legal',
                                'menu_id'        => 'footer-legal-menu',
                                'container'      => false,
                                'fallback_cb'    => 'atlas_theme_footer_legal_fallback_menu',
                                'depth'          => 1,
                            ) );
                        } else {
                            // Fallback content
                            ?>
                            <a href="/privacy-policy/">Privacy Policy</a>
                            <a href="/terms-conditions/">Terms & Conditions</a>
                            <a href="/code-conduct/">Code of Conduct</a>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="footer-social">
                        <?php
                        $social_links = array(
                            'twitter' => array(
                                'url' => get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques' ),
                                'icon' => 'fab fa-x-twitter',
                                'label' => 'X (Twitter)'
                            ),
                            'linkedin' => array(
                                'url' => get_option( 'atlas_social_linkedin', 'https://linkedin.com/in/luismsmarques' ),
                                'icon' => 'fab fa-linkedin-in',
                                'label' => 'LinkedIn'
                            ),
                            'github' => array(
                                'url' => get_option( 'atlas_social_github', 'https://github.com/luismsmarques' ),
                                'icon' => 'fab fa-github',
                                'label' => 'GitHub'
                            ),
                            'instagram' => array(
                                'url' => get_option( 'atlas_social_instagram', '' ),
                                'icon' => 'fab fa-instagram',
                                'label' => 'Instagram'
                            ),
                        );
                        
                        foreach ( $social_links as $platform => $data ) {
                            if ( ! empty( $data['url'] ) ) {
                                echo '<a href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener" class="social-icon" aria-label="' . esc_attr( $data['label'] ) . '">';
                                echo '<i class="' . esc_attr( $data['icon'] ) . '"></i>';
                                echo '</a>';
                            }
                        }
                        
                        // Debug: Show if Font Awesome is loaded
                        if ( current_user_can( 'manage_options' ) ) {
                            echo '<!-- Font Awesome loaded: ' . ( wp_style_is( 'atlas-theme-fontawesome', 'done' ) ? 'Yes' : 'No' ) . ' -->';
                        }
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
