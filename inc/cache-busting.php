<?php
/**
 * Cache Busting for Atlas Invencível Theme
 * Simplified version to prevent errors
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add meta tags to prevent caching on contact page
 */
function atlas_theme_prevent_contact_page_cache() {
    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">' . "\n";
        echo '<meta http-equiv="Pragma" content="no-cache">' . "\n";
        echo '<meta http-equiv="Expires" content="0">' . "\n";
    }
}
add_action( 'wp_head', 'atlas_theme_prevent_contact_page_cache', 1 );

/**
 * Admin notice for cache refresh
 */
function atlas_theme_cache_refresh_notice() {
    if ( current_user_can( 'manage_options' ) ) {
        $screen = get_current_screen();
        if ( $screen && ( $screen->id === 'page' || $screen->id === 'themes' ) ) {
            echo '<div class="notice notice-info is-dismissible">';
            echo '<p><strong>Atlas Theme:</strong> If you\'re seeing outdated content, try clearing your browser cache or any caching plugins.</p>';
            echo '</div>';
        }
    }
}
add_action( 'admin_notices', 'atlas_theme_cache_refresh_notice' );