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
 * Enqueue Theme Assets - SIMPLIFIED VERSION FOR DEBUGGING
 */
function atlas_theme_enqueue_assets() {
    // Google Fonts - TEMPORARILY USING FOR DEBUGGING
    wp_enqueue_style( 'atlas-theme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null );
    
    // Font Awesome for social icons
    wp_enqueue_style( 'atlas-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
    
    // Main stylesheet (WordPress requirement) - Critical CSS, load synchronously
    wp_enqueue_style( 'atlas-theme-style', get_stylesheet_uri(), array('atlas-theme-fonts'), ATLAS_THEME_VERSION );
    
    // Main CSS - Load synchronously for debugging
    wp_enqueue_style( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/css/main.css', array('atlas-theme-style'), ATLAS_THEME_VERSION );
    
    // Main JavaScript
    wp_enqueue_script( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/js/main.js', array(), ATLAS_THEME_VERSION, true );
    
    // Services page specific assets
    if ( is_page_template( 'page-services.php' ) || is_page_template( 'template-services-integrated.php' ) ) {
        wp_enqueue_style( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/css/services.css', array('atlas-theme-main'), ATLAS_THEME_VERSION );
        wp_enqueue_script( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/js/services.js', array(), ATLAS_THEME_VERSION, true );
    }
    
    // Contact page specific assets
    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        wp_enqueue_style( 'atlas-theme-contact', ATLAS_THEME_URI . '/assets/css/contact.css', array('atlas-theme-main'), ATLAS_THEME_VERSION );
        wp_enqueue_script( 'atlas-theme-contact', ATLAS_THEME_URI . '/assets/js/contact.js', array(), ATLAS_THEME_VERSION, true );
    }
    
    // Localize script for AJAX
    wp_localize_script( 'atlas-theme-main', 'atlas_theme_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'atlas_theme_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'atlas_theme_enqueue_assets' );

/**
 * REMOVED: Block Editor Assets - Theme uses only PHP templates
 * All editor assets have been removed to disable FSE completely
 */

// Customizer assets removed - using classic options page instead

/**
 * Conditional Asset Loading
 */
function atlas_theme_conditional_assets() {
    // Load specific assets based on page type
    // REMOVED homepage.js - functionality is in main.js
    
    // Load case-study.css for project pages
    if ( is_singular( 'atlas_project' ) ) {
        wp_enqueue_style( 'atlas-theme-case-study', ATLAS_THEME_URI . '/assets/css/case-study.css', array(), ATLAS_THEME_VERSION );
        wp_enqueue_style( 'atlas-theme-project', ATLAS_THEME_URI . '/assets/css/project.css', array(), ATLAS_THEME_VERSION );
    }
    
    if ( is_singular( 'atlas_service' ) ) {
        wp_enqueue_style( 'atlas-theme-service', ATLAS_THEME_URI . '/assets/css/service.css', array(), ATLAS_THEME_VERSION );
    }
}
add_action( 'wp_enqueue_scripts', 'atlas_theme_conditional_assets' );

/**
 * Add loadCSS Polyfill and Async CSS Loading
 */
function atlas_theme_loadcss_polyfill() {
    ?>
    <script>
    /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
    (function(w){"use strict";if(!w.loadCSS){w.loadCSS=function(){}}
    var rp=loadCSS.relpreload={};rp.support=(function(){var ret;try{ret=w.document.createElement("link").relList.supports("preload")}catch(e){ret=false}return function(){return ret}})();rp.bindMediaToggle=function(link){var finalMedia=link.media||"all";function enableStylesheet(){link.media=finalMedia}if(link.addEventListener){link.addEventListener("load",enableStylesheet)}else if(link.attachEvent){link.attachEvent("onload",enableStylesheet)}setTimeout(function(){link.rel="stylesheet";link.media="only x"});setTimeout(enableStylesheet,3000)};rp.poly=function(){if(rp.support()){return}var links=w.document.getElementsByTagName("link");for(var i=0;i<links.length;i++){var link=links[i];if(link.rel==="preload"&&link.getAttribute("as")==="style"&&!link.getAttribute("data-loadcss")){link.setAttribute("data-loadcss",true);rp.bindMediaToggle(link)}}};if(!rp.support()){rp.poly();var run=w.setInterval(rp.poly,500);if(w.addEventListener){w.addEventListener("load",function(){rp.poly();w.clearInterval(run)})}else if(w.attachEvent){w.attachEvent("onload",function(){rp.poly();w.clearInterval(run)})}}if(typeof exports!=="undefined"){exports.loadCSS=loadCSS}else{w.loadCSS=loadCSS}}(typeof global!=="undefined"?global:this));
    </script>
    <?php
}
add_action( 'wp_head', 'atlas_theme_loadcss_polyfill', 1 );

/**
 * Convert CSS Links to Async Loading
 */
function atlas_theme_async_css_loading( $html, $handle, $href, $media ) {
    // List of CSS files to load asynchronously - TEMPORARILY DISABLED FOR DEBUGGING
    $async_css = array(
        // 'atlas-theme-main',
        // 'atlas-theme-fonts', 
        // 'atlas-theme-services',
        // 'atlas-theme-case-study',
        // 'atlas-theme-project',
        // 'atlas-theme-service'
    );
    
    if ( in_array( $handle, $async_css ) ) {
        // Use preload + loadCSS technique for async loading
        return '<link rel="preload" href="' . esc_url( $href ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . 
               '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
    }
    
    return $html;
}
add_filter( 'style_loader_tag', 'atlas_theme_async_css_loading', 10, 4 );

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
 * Optimize CSS Delivery - Critical CSS Inline - TEMPORARILY DISABLED
 */
function atlas_theme_optimize_css_delivery() {
    // DISABLED FOR DEBUGGING - Critical CSS inline removed
    // $critical_css = '
    //     /* Ultra-critical loading optimization only */
    //     /* Prevent FOUC (Flash of Unstyled Content) - REMOVED visibility:hidden */
    //     
    //     /* Critical font loading */
    //     @font-face{font-family:"Inter";font-style:normal;font-weight:400;font-display:swap;src:url("' . ATLAS_THEME_URI . '/assets/fonts/inter-regular.woff2") format("woff2")}
    //     @font-face{font-family:"Inter";font-style:normal;font-weight:700;font-display:swap;src:url("' . ATLAS_THEME_URI . '/assets/fonts/inter-bold.woff2") format("woff2")}
    // ';
    // 
    // echo '<style id="atlas-critical-css">' . $critical_css . '</style>' . "\n";
}
add_action( 'wp_head', 'atlas_theme_optimize_css_delivery', 2 );

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
