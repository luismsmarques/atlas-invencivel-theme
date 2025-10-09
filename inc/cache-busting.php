<?php
/**
 * Cache Busting for Atlas Invencível Theme
 * Force cache refresh for contact page updates
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add cache busting version to theme assets
 */
function atlas_theme_cache_busting_version() {
    // Use file modification time for cache busting
    $theme_version = get_option( 'atlas_theme_cache_version', '1.0.0' );
    
    // Update version if contact page files were modified
    $contact_files = array(
        get_template_directory() . '/page-contact.php',
        get_template_directory() . '/assets/css/contact.css',
        get_template_directory() . '/assets/js/contact.js',
        get_template_directory() . '/inc/contact-form.php'
    );
    
    $latest_modification = 0;
    foreach ( $contact_files as $file ) {
        if ( file_exists( $file ) ) {
            $latest_modification = max( $latest_modification, filemtime( $file ) );
        }
    }
    
    // Update cache version if files were modified
    if ( $latest_modification > get_option( 'atlas_theme_last_modification', 0 ) ) {
        update_option( 'atlas_theme_cache_version', time() );
        update_option( 'atlas_theme_last_modification', $latest_modification );
    }
    
    return get_option( 'atlas_theme_cache_version', '1.0.0' );
}

/**
 * Force cache refresh for contact page
 */
function atlas_theme_force_cache_refresh() {
    // Clear WordPress object cache
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }
    
    // Clear popular caching plugins
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }
    
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
        wp_cache_clear_cache();
    }
    
    if ( function_exists( 'rocket_clean_domain' ) ) {
        rocket_clean_domain();
    }
    
    if ( function_exists( 'litespeed_purge_all' ) ) {
        litespeed_purge_all();
    }
    
    // Clear browser cache headers
    header( 'Cache-Control: no-cache, no-store, must-revalidate' );
    header( 'Pragma: no-cache' );
    header( 'Expires: 0' );
}

/**
 * Add cache busting to CSS and JS files
 */
function atlas_theme_add_cache_busting( $html, $handle, $href, $media ) {
    $cache_version = atlas_theme_cache_busting_version();
    
    // Add version parameter to contact page assets
    if ( strpos( $handle, 'contact' ) !== false ) {
        $separator = strpos( $href, '?' ) !== false ? '&' : '?';
        $html = str_replace( $href, $href . $separator . 'v=' . $cache_version, $html );
    }
    
    return $html;
}
add_filter( 'style_loader_tag', 'atlas_theme_add_cache_busting', 10, 4 );
add_filter( 'script_loader_tag', 'atlas_theme_add_cache_busting', 10, 4 );

/**
 * Add meta tags to prevent caching on contact page
 */
function atlas_theme_prevent_contact_page_cache() {
    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">' . "\n";
        echo '<meta http-equiv="Pragma" content="no-cache">' . "\n";
        echo '<meta http-equiv="Expires" content="0">' . "\n";
        echo '<!-- Contact page cache busting: ' . atlas_theme_cache_busting_version() . ' -->' . "\n";
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

/**
 * Add cache busting query parameter to contact page URL
 */
function atlas_theme_contact_page_cache_busting( $url ) {
    if ( strpos( $url, '/contact' ) !== false || strpos( $url, 'page-contact' ) !== false ) {
        $separator = strpos( $url, '?' ) !== false ? '&' : '?';
        $url .= $separator . 'cb=' . atlas_theme_cache_busting_version();
    }
    return $url;
}
add_filter( 'page_link', 'atlas_theme_contact_page_cache_busting' );

/**
 * Force refresh contact page assets
 */
function atlas_theme_refresh_contact_assets() {
    // Update cache version
    update_option( 'atlas_theme_cache_version', time() );
    
    // Clear caches
    atlas_theme_force_cache_refresh();
    
    return true;
}

// Auto-refresh on theme activation
add_action( 'after_switch_theme', 'atlas_theme_refresh_contact_assets' );
