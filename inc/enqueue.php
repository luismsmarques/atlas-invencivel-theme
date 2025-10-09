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
 * Enqueue Theme Assets
 */
function atlas_theme_enqueue_assets() {
    // Main stylesheet
    wp_enqueue_style( 'atlas-theme-style', get_stylesheet_uri(), array(), ATLAS_THEME_VERSION );
    
    // Main CSS
    wp_enqueue_style( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/css/main.css', array(), ATLAS_THEME_VERSION );
    
    // Google Fonts
    wp_enqueue_style( 'atlas-theme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null );
    
    // Font Awesome
    wp_enqueue_style( 'atlas-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
    
    // Main JavaScript
    wp_enqueue_script( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/js/main.js', array(), ATLAS_THEME_VERSION, true );
    
    // Services page specific assets
    if ( is_page_template( 'page-services.php' ) || is_page_template( 'template-services-integrated.php' ) ) {
        wp_enqueue_style( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/css/services.css', array(), ATLAS_THEME_VERSION );
        wp_enqueue_script( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/js/services.js', array(), ATLAS_THEME_VERSION, true );
    }
    
    // Localize script for AJAX
    wp_localize_script( 'atlas-theme-main', 'atlas_theme_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'atlas_theme_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'atlas_theme_enqueue_assets' );

/**
 * Enqueue Block Editor Assets
 */
function atlas_theme_enqueue_editor_assets() {
    wp_enqueue_style( 'atlas-theme-editor', ATLAS_THEME_URI . '/assets/css/editor-style.css', array(), ATLAS_THEME_VERSION );
    wp_enqueue_script( 'atlas-theme-editor', ATLAS_THEME_URI . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), ATLAS_THEME_VERSION, true );
}
add_action( 'enqueue_block_editor_assets', 'atlas_theme_enqueue_editor_assets' );

// Customizer assets removed - using classic options page instead

/**
 * Conditional Asset Loading
 */
function atlas_theme_conditional_assets() {
    // Load specific assets based on page type
    if ( is_front_page() ) {
        wp_enqueue_script( 'atlas-theme-homepage', ATLAS_THEME_URI . '/assets/js/homepage.js', array( 'atlas-theme-main' ), ATLAS_THEME_VERSION, true );
    }
    
    if ( is_singular( 'atlas_project' ) ) {
        wp_enqueue_style( 'atlas-theme-project', ATLAS_THEME_URI . '/assets/css/project.css', array(), ATLAS_THEME_VERSION );
    }
    
    if ( is_singular( 'atlas_service' ) ) {
        wp_enqueue_style( 'atlas-theme-service', ATLAS_THEME_URI . '/assets/css/service.css', array(), ATLAS_THEME_VERSION );
    }
}
add_action( 'wp_enqueue_scripts', 'atlas_theme_conditional_assets' );

/**
 * Preload Critical Resources
 */
function atlas_theme_preload_resources() {
    // Preload Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    
    // Preload critical CSS
    echo '<link rel="preload" href="' . ATLAS_THEME_URI . '/assets/css/main.css" as="style">' . "\n";
}
add_action( 'wp_head', 'atlas_theme_preload_resources', 1 );

/**
 * Defer Non-Critical JavaScript
 */
function atlas_theme_defer_scripts( $tag, $handle, $src ) {
    $defer_scripts = array(
        'atlas-theme-main',
        'atlas-theme-services',
        'atlas-theme-homepage',
    );
    
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( '<script ', '<script defer ', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'atlas_theme_defer_scripts', 10, 3 );

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
 * Optimize CSS Delivery
 */
function atlas_theme_optimize_css_delivery() {
    // Inline critical CSS for above-the-fold content
    $critical_css = '
        .header { position: fixed; top: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); z-index: 1000; padding: 15px 0; }
        .hero { background: linear-gradient(135deg, #134686 0%, #0d2f5a 100%); min-height: 60vh; display: flex; align-items: center; position: relative; overflow: hidden; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    ';
    
    echo '<style id="atlas-critical-css">' . $critical_css . '</style>' . "\n";
}
add_action( 'wp_head', 'atlas_theme_optimize_css_delivery', 2 );

/**
 * Add Resource Hints
 */
function atlas_theme_resource_hints( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $urls[] = '//fonts.googleapis.com';
        $urls[] = '//fonts.gstatic.com';
        $urls[] = '//cdnjs.cloudflare.com';
    }
    
    if ( 'preconnect' === $relation_type ) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    
    return $urls;
}
add_filter( 'wp_resource_hints', 'atlas_theme_resource_hints', 10, 2 );
