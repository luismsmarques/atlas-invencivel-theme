<?php
/**
 * Enqueue Scripts and Styles for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Cache-busting version for a theme asset based on its file modification time.
 *
 * Falls back to ATLAS_THEME_VERSION if the file can't be read. Using filemtime
 * means every deploy that changes a file automatically busts browser/CDN cache
 * — no manual version bumps needed.
 *
 * @param string $relative_path Path relative to the theme root, e.g. '/assets/css/main.css'.
 * @return string
 */
function atlas_asset_ver( $relative_path ) {
    $file = get_template_directory() . $relative_path;
    $mtime = @filemtime( $file );
    return $mtime ? (string) $mtime : ATLAS_THEME_VERSION;
}

/**
 * Enqueue Theme Assets - SIMPLIFIED VERSION FOR DEBUGGING
 */
function atlas_theme_enqueue_assets() {
    // Google Fonts — Atlas Invencível 2026 type system
    wp_enqueue_style( 'atlas-theme-fonts', 'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap', array(), null );

    // Font Awesome for social icons
    wp_enqueue_style( 'atlas-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

    // Main stylesheet (WordPress requirement) - Critical CSS, load synchronously
    wp_enqueue_style( 'atlas-theme-style', get_stylesheet_uri(), array('atlas-theme-fonts'), atlas_asset_ver( '/style.css' ) );

    // Main CSS - Load synchronously for debugging
    wp_enqueue_style( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/css/main.css', array('atlas-theme-style'), atlas_asset_ver( '/assets/css/main.css' ) );

    // Contact page CSS and JS - Always load for debugging
    wp_enqueue_style( 'atlas-theme-contact', ATLAS_THEME_URI . '/assets/css/contact.css', array('atlas-theme-main'), atlas_asset_ver( '/assets/css/contact.css' ) );
    wp_enqueue_script( 'atlas-theme-contact', ATLAS_THEME_URI . '/assets/js/contact.js', array('jquery'), atlas_asset_ver( '/assets/js/contact.js' ), true );

    // Case study CSS - Load on single project pages
    if ( is_singular( 'atlas_project' ) ) {
        wp_enqueue_style( 'atlas-theme-case-study', ATLAS_THEME_URI . '/assets/css/case-study.css', array('atlas-theme-main'), atlas_asset_ver( '/assets/css/case-study.css' ) );
    }

    // Main JavaScript
    wp_enqueue_script( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/js/main.js', array(), atlas_asset_ver( '/assets/js/main.js' ), true );
    
    // Localize script for AJAX
    wp_localize_script( 'atlas-theme-main', 'atlas_theme_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'atlas_theme_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'atlas_theme_enqueue_assets' );

/**
 * Remove Unnecessary WordPress Assets
 */
function atlas_theme_remove_unnecessary_assets() {
    // Remove WordPress emoji scripts
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    // Remove WordPress generator meta tag
    remove_action( 'wp_head', 'wp_generator' );
    
    // Remove RSD link
    remove_action( 'wp_head', 'rsd_link' );
    
    // Remove wlwmanifest link
    remove_action( 'wp_head', 'wlwmanifest_link' );
    
    // Remove shortlink
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'atlas_theme_remove_unnecessary_assets' );

/**
 * Optimize WordPress Block Styles
 */
function atlas_theme_optimize_wp_styles() {
    // Defer WordPress block library styles
    add_filter( 'wp_enqueue_scripts', function() {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' );
        wp_dequeue_style( 'global-styles' );
    }, 20 );
    
    // Load block styles asynchronously
    add_filter( 'style_loader_tag', function( $html, $handle ) {
        $defer_wp_styles = array(
            'wp-block-library',
            'wp-block-library-theme', 
            'wc-block-style',
            'global-styles'
        );
        
        if ( in_array( $handle, $defer_wp_styles ) ) {
            return str_replace( 'rel=\'stylesheet\'', 'rel=\'preload\' as=\'style\' onload="this.onload=null;this.rel=\'stylesheet\'"', $html ) . 
                   '<noscript>' . str_replace( 'rel=\'preload\' as=\'style\' onload="this.onload=null;this.rel=\'stylesheet\'"', 'rel=\'stylesheet\'', $html ) . '</noscript>';
        }
        
        return $html;
    }, 10, 2 );
}
add_action( 'init', 'atlas_theme_optimize_wp_styles' );
