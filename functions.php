<?php
/**
 * Atlas Invencível Theme Functions
 *
 * @package AtlasTheme
 * @since 1.0.0
 * 
 * NOTE: This theme uses ONLY PHP templates and does NOT support FSE (Full Site Editor).
 * All block editor features, templates, patterns, and parts have been removed.
 * The theme uses traditional WordPress template hierarchy with .php files.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme constants
define( 'ATLAS_THEME_VERSION', '1.0.0' );
define( 'ATLAS_THEME_DIR', get_template_directory() );
define( 'ATLAS_THEME_URI', get_template_directory_uri() );
define( 'ATLAS_THEME_INC', ATLAS_THEME_DIR . '/inc' );

/**
 * Theme Setup
 */
function atlas_theme_setup() {
    // Add theme support for various features
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // REMOVED: FSE support - Theme uses only PHP templates
    // add_theme_support( 'wp-block-styles' );
    // add_theme_support( 'align-wide' );
    // add_theme_support( 'editor-styles' );
    // add_theme_support( 'responsive-embeds' );
    // add_theme_support( 'custom-spacing' );
    // add_theme_support( 'custom-units' );
    // add_theme_support( 'appearance-tools' );
    
    // REMOVED: Editor styles - Theme uses only PHP templates
    // add_editor_style( 'assets/css/editor-style.css' );
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
    
    // Load text domain for translations
    load_theme_textdomain( 'atlas-theme', ATLAS_THEME_DIR . '/languages' );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Navigation', 'atlas-theme' ),
        'footer'  => esc_html__( 'Footer Navigation', 'atlas-theme' ),
        'footer-shop' => esc_html__( 'Footer 1 Menu', 'atlas-theme' ),
        'footer-press' => esc_html__( 'Footer 2 Menu', 'atlas-theme' ),
        'footer-about' => esc_html__( 'Footer 3 Menu', 'atlas-theme' ),
        'footer-legal' => esc_html__( 'Footer Legal Menu', 'atlas-theme' ),
    ) );
    
    // Register footer widget areas
    register_sidebar( array(
        'name'          => esc_html__( 'Footer About', 'atlas-theme' ),
        'id'            => 'footer-about',
        'description'   => esc_html__( 'Widget area for company information and description.', 'atlas-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Links', 'atlas-theme' ),
        'id'            => 'footer-links',
        'description'   => esc_html__( 'Widget area for quick links and navigation.', 'atlas-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Services', 'atlas-theme' ),
        'id'            => 'footer-services',
        'description'   => esc_html__( 'Widget area for services list.', 'atlas-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Contact', 'atlas-theme' ),
        'id'            => 'footer-contact',
        'description'   => esc_html__( 'Widget area for contact information.', 'atlas-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Add custom image sizes for better image quality
    add_image_size( 'atlas-hero', 500, 700, true ); // Hero profile image
    add_image_size( 'atlas-project', 600, 400, true ); // Project cards
    add_image_size( 'atlas-project-large', 1200, 800, true ); // Project detail pages
    add_image_size( 'atlas-thumbnail', 300, 200, true ); // Small thumbnails
}
add_action( 'after_setup_theme', 'atlas_theme_setup' );

/**
 * Image Optimization and Lazy Loading
 */
function atlas_theme_image_optimization() {
    // Add native lazy loading to images
    add_filter( 'wp_get_attachment_image_attributes', function( $attr, $attachment, $size ) {
        // Skip lazy loading for above-the-fold images (hero, logo, etc.)
        $skip_lazy_classes = array( 'hero-image', 'logo', 'custom-logo', 'profile-image' );
        
        if ( isset( $attr['class'] ) ) {
            foreach ( $skip_lazy_classes as $skip_class ) {
                if ( strpos( $attr['class'], $skip_class ) !== false ) {
                    return $attr;
                }
            }
        }
        
        // Add lazy loading to other images
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
        
        return $attr;
    }, 10, 3 );
    
    // Add responsive image sizes
    add_image_size( 'atlas-hero-large', 1920, 1080, true );
    add_image_size( 'atlas-hero-medium', 1200, 675, true );
    add_image_size( 'atlas-hero-small', 768, 432, true );
    
    add_image_size( 'atlas-project-large', 1200, 800, true );
    add_image_size( 'atlas-project-medium', 800, 533, true );
    add_image_size( 'atlas-project-small', 400, 267, true );
    
    add_image_size( 'atlas-thumbnail-large', 600, 400, true );
    add_image_size( 'atlas-thumbnail-medium', 300, 200, true );
    add_image_size( 'atlas-thumbnail-small', 150, 100, true );
}
add_action( 'init', 'atlas_theme_image_optimization' );

/**
 * Add WebP Support Detection
 */
function atlas_theme_webp_support() {
    ?>
    <script>
    // Detect WebP support
    function supportsWebP() {
        var elem = document.createElement('canvas');
        if (!!(elem.getContext && elem.getContext('2d'))) {
            return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
        }
        return false;
    }
    
    // Add webp class to body if supported
    if (supportsWebP()) {
        document.documentElement.classList.add('webp');
    } else {
        document.documentElement.classList.add('no-webp');
    }
    </script>
    <?php
}
add_action( 'wp_head', 'atlas_theme_webp_support', 1 );

/**
 * Regenerate image sizes on theme activation
 */
function atlas_regenerate_image_sizes() {
    if ( ! get_option( 'atlas_image_sizes_regenerated' ) ) {
        // Regenerate all image sizes
        if ( function_exists( 'wp_generate_attachment_metadata' ) ) {
            $attachments = get_posts( array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'numberposts' => -1,
                'post_status' => 'any'
            ) );
            
            foreach ( $attachments as $attachment ) {
                wp_generate_attachment_metadata( $attachment->ID, get_attached_file( $attachment->ID ) );
            }
        }
        
        update_option( 'atlas_image_sizes_regenerated', true );
    }
}
add_action( 'after_switch_theme', 'atlas_regenerate_image_sizes' );

/**
 * Enqueue Scripts and Styles - DISABLED
 * Using inc/enqueue.php instead for better organization
 */
// function atlas_theme_scripts() {
//     // Main stylesheet
//     wp_enqueue_style( 'atlas-theme-style', get_stylesheet_uri(), array(), ATLAS_THEME_VERSION );
//     
//     // Main CSS
//     wp_enqueue_style( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/css/main.css', array(), ATLAS_THEME_VERSION );
//     
//     // Google Fonts
//     wp_enqueue_style( 'atlas-theme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null );
//     
//     // Font Awesome
//     wp_enqueue_style( 'atlas-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
//     
//     // Main JavaScript
//     wp_enqueue_script( 'atlas-theme-main', ATLAS_THEME_URI . '/assets/js/main.js', array(), ATLAS_THEME_VERSION, true );
//     
//     // Services page specific assets
//     if ( is_page_template( 'page-services.php' ) || is_page_template( 'template-services-integrated.php' ) ) {
//         wp_enqueue_style( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/css/services.css', array(), ATLAS_THEME_VERSION );
//         wp_enqueue_script( 'atlas-theme-services', ATLAS_THEME_URI . '/assets/js/services.js', array(), ATLAS_THEME_VERSION, true );
//     }
//     
//     // Localize script for AJAX
//     wp_localize_script( 'atlas-theme-main', 'atlas_theme_ajax', array(
//         'ajax_url' => admin_url( 'admin-ajax.php' ),
//         'nonce'    => wp_create_nonce( 'atlas_theme_nonce' ),
//     ) );
// }
// add_action( 'wp_enqueue_scripts', 'atlas_theme_scripts' );

/**
 * Enqueue Block Editor Assets
 */
function atlas_theme_editor_assets() {
    wp_enqueue_style( 'atlas-theme-editor', ATLAS_THEME_URI . '/assets/css/editor-style.css', array(), ATLAS_THEME_VERSION );
    wp_enqueue_script( 'atlas-theme-editor', ATLAS_THEME_URI . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), ATLAS_THEME_VERSION, true );
}
add_action( 'enqueue_block_editor_assets', 'atlas_theme_editor_assets' );

/**
 * Include Theme Files
 */
require_once ATLAS_THEME_INC . '/custom-post-types.php';
// require_once ATLAS_THEME_INC . '/customizer.php'; // Removed - using classic options page instead
require_once ATLAS_THEME_INC . '/options-page.php'; // Classic options page
require_once ATLAS_THEME_INC . '/template-functions.php';
require_once ATLAS_THEME_INC . '/enqueue.php';
require_once ATLAS_THEME_INC . '/widgets.php';
require_once ATLAS_THEME_INC . '/shortpixel-optimization.php'; // ShortPixel image optimization

// Include block files
require_once ATLAS_THEME_INC . '/blocks/hero-block.php';
require_once ATLAS_THEME_INC . '/blocks/skills-grid-block.php';
require_once ATLAS_THEME_INC . '/blocks/projects-grid-block.php';
require_once ATLAS_THEME_INC . '/blocks/timeline-block.php';
require_once ATLAS_THEME_INC . '/blocks/company-logos-block.php';
require_once ATLAS_THEME_INC . '/blocks/services-grid-block.php';

/**
 * Register Block Patterns
 */
function atlas_theme_register_block_patterns() {
    if ( function_exists( 'register_block_pattern' ) ) {
        // Hero Section Pattern
        register_block_pattern(
            'atlas-theme/hero-section',
            array(
                'title'       => esc_html__( 'Hero Section', 'atlas-theme' ),
                'description' => esc_html__( 'A hero section with name, role, and profile image', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/hero-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
        
        // Skills Grid Pattern
        register_block_pattern(
            'atlas-theme/skills-grid',
            array(
                'title'       => esc_html__( 'Skills Grid', 'atlas-theme' ),
                'description' => esc_html__( 'A grid of skill cards with icons', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/skills-grid-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
        
        // Projects Showcase Pattern
        register_block_pattern(
            'atlas-theme/projects-showcase',
            array(
                'title'       => esc_html__( 'Projects Showcase', 'atlas-theme' ),
                'description' => esc_html__( 'A showcase of portfolio projects', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/projects-grid-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
        
        // Timeline Pattern
        register_block_pattern(
            'atlas-theme/timeline',
            array(
                'title'       => esc_html__( 'Timeline', 'atlas-theme' ),
                'description' => esc_html__( 'Education and experience timeline', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/timeline-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
        
        // Company Logos Pattern
        register_block_pattern(
            'atlas-theme/company-logos',
            array(
                'title'       => esc_html__( 'Company Logos', 'atlas-theme' ),
                'description' => esc_html__( 'A grid of company logos with hover effects', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/company-logos-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
        
        // Services Grid Pattern
        register_block_pattern(
            'atlas-theme/services-grid',
            array(
                'title'       => esc_html__( 'Services Grid', 'atlas-theme' ),
                'description' => esc_html__( 'A grid of service cards with featured service', 'atlas-theme' ),
                'content'     => '<!-- wp:atlas-theme/services-grid-block /-->',
                'categories'  => array( 'atlas-theme' ),
            )
        );
    }
}
// REMOVED: Block patterns disabled - Theme uses only PHP templates
// add_action( 'init', 'atlas_theme_register_block_patterns' );

/**
 * Register Block Pattern Categories
 */
function atlas_theme_register_block_pattern_categories() {
    if ( function_exists( 'register_block_pattern_category' ) ) {
        register_block_pattern_category(
            'atlas-theme',
            array( 'label' => esc_html__( 'Atlas Theme', 'atlas-theme' ) )
        );
    }
}
// REMOVED: Block pattern categories disabled - Theme uses only PHP templates
// add_action( 'init', 'atlas_theme_register_block_pattern_categories' );

/**
 * Add Custom Body Classes
 */
function atlas_theme_body_classes( $classes ) {
    // Add page template class
    if ( is_page_template() ) {
        $template = get_page_template_slug();
        $classes[] = 'page-template-' . sanitize_html_class( str_replace( '.php', '', $template ) );
    }
    
    // Add custom post type classes
    if ( is_singular( 'atlas_project' ) ) {
        $classes[] = 'single-project';
    }
    if ( is_singular( 'atlas_service' ) ) {
        $classes[] = 'single-service';
    }
    
    return $classes;
}
add_filter( 'body_class', 'atlas_theme_body_classes' );

/**
 * Custom Excerpt Length
 */
function atlas_theme_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'atlas_theme_excerpt_length' );

/**
 * Custom Excerpt More
 */
function atlas_theme_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'atlas_theme_excerpt_more' );

/**
 * Add Security Headers
 */
function atlas_theme_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
    }
}
add_action( 'send_headers', 'atlas_theme_security_headers' );

/**
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove WordPress Version from Head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove RSD Link
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Remove WLW Manifest Link
 */
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Include Sample Project Data (Development Only)
 * Note: This file has been moved to dev-tools/ for production
 */
// require_once ATLAS_THEME_DIR . '/dev-tools/sample-project-data.php';

/**
 * Create sample projects on theme activation
 * Note: Function moved to dev-tools/sample-project-data.php for production
 */
function atlas_theme_create_sample_projects_on_activation() {
    // Sample projects creation is now handled via sample-content.xml import
    // This function is kept for compatibility but does nothing
    return;
}
add_action( 'after_switch_theme', 'atlas_theme_create_sample_projects_on_activation' );

/**
 * Force create sample projects (temporary function)
 * Note: Function moved to dev-tools/sample-project-data.php for production
 */
function atlas_theme_force_create_sample_projects() {
    // Sample projects creation is now handled via sample-content.xml import
    // This function is kept for compatibility but does nothing
    return;
}
add_action( 'admin_init', 'atlas_theme_force_create_sample_projects' );
