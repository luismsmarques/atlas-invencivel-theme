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
 * Enqueue Theme Assets with Async CSS Loading
 */
function atlas_theme_enqueue_assets() {
    // Main stylesheet (WordPress requirement)
    wp_enqueue_style( 'atlas-theme-style', get_stylesheet_uri(), array(), ATLAS_THEME_VERSION );
    
    // Self-hosted fonts with font-display: swap
    wp_enqueue_style( 'atlas-theme-fonts', ATLAS_THEME_URI . '/assets/css/fonts.css', array(), ATLAS_THEME_VERSION );
    
    // Main CSS - Load asynchronously using preload + loadCSS
    wp_enqueue_style( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/css/main.css', array(), ATLAS_THEME_VERSION );
    
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
    // List of CSS files to load asynchronously
    $async_css = array(
        'atlas-theme-main',
        'atlas-theme-fonts', 
        'atlas-theme-services',
        'atlas-theme-case-study',
        'atlas-theme-project',
        'atlas-theme-service'
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
 * Optimize CSS Delivery - Critical CSS Inline
 */
function atlas_theme_optimize_css_delivery() {
    // Comprehensive critical CSS for above-the-fold content
    $critical_css = '
        /* Reset and Base Styles */
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:"Inter",sans-serif;line-height:1.6;color:#333;background-color:#fff}
        img{max-width:100%;height:auto}
        
        /* Container */
        .container{max-width:1200px;margin:0 auto;padding:0 20px}
        
        /* Header Critical Styles */
        .header{position:fixed;top:0;left:0;right:0;background:rgba(255,255,255,0.95);backdrop-filter:blur(10px);z-index:1000;padding:15px 0;border-bottom:1px solid rgba(0,0,0,0.1)}
        .header .container{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:20px}
        .logo{display:flex;align-items:center;gap:10px}
        .logo-link{display:flex;align-items:center;gap:10px;text-decoration:none;color:inherit}
        .logo-icon{width:40px;height:40px;background:#134686;color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:18px;border-radius:8px}
        .logo-text{font-weight:700;font-size:20px;color:#134686}
        .nav{display:flex;justify-content:center;gap:30px}
        .main-navigation ul{list-style:none;margin:0;padding:0;display:flex;gap:30px}
        .main-navigation a{text-decoration:none;color:#333;font-weight:500;padding:8px 0;display:block}
        .header-right{display:flex;align-items:center;gap:20px}
        .social-icons{display:flex;gap:15px}
        .social-icon{width:35px;height:35px;background:#134686;color:white;display:flex;align-items:center;justify-content:center;border-radius:50%;text-decoration:none}
        .mobile-menu-toggle{display:none;flex-direction:column;justify-content:space-around;width:30px;height:30px;background:transparent;border:none;cursor:pointer;padding:0;z-index:1001}
        .hamburger-line{width:25px;height:3px;background:#134686;transition:all 0.3s ease;transform-origin:center}
        
        /* Hero Section Critical Styles */
        .hero{background:linear-gradient(135deg,#134686 0%,#0d2f5a 100%);min-height:60vh;display:flex;align-items:center;position:relative;overflow:hidden}
        .hero-bg{position:absolute;top:0;left:0;right:0;bottom:0;z-index:1}
        .hero-content{position:relative;z-index:2;color:white;text-align:center;max-width:800px;margin:0 auto;padding:0 20px}
        .hero h1{font-size:3.5rem;font-weight:800;margin-bottom:20px;line-height:1.2}
        .hero p{font-size:1.25rem;margin-bottom:30px;opacity:0.9}
        .hero-buttons{display:flex;gap:20px;justify-content:center;flex-wrap:wrap}
        .btn{display:inline-block;padding:15px 30px;text-decoration:none;border-radius:50px;font-weight:600;transition:all 0.3s ease;border:none;cursor:pointer}
        .btn-primary{background:#FEB21A;color:#134686}
        .btn-secondary{background:transparent;color:white;border:2px solid white}
        
        /* Mobile Responsive Critical */
        @media (max-width:768px){
            .header .container{grid-template-columns:auto 1fr auto;gap:15px}
            .main-navigation{display:none}
            .mobile-menu-toggle{display:flex}
            .hero h1{font-size:2.5rem}
            .hero p{font-size:1.1rem}
            .hero-buttons{flex-direction:column;align-items:center}
            .btn{padding:12px 25px;font-size:16px}
        }
    ';
    
    echo '<style id="atlas-critical-css">' . $critical_css . '</style>' . "\n";
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
