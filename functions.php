<?php
/**
 * Atlas Invencível Theme Functions
 *
 * @package AtlasTheme
 * @since 1.0.0
 *
 * Pure PHP classic theme (no FSE / block templates). Uses the standard
 * WordPress template hierarchy.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme constants
define( 'ATLAS_THEME_VERSION', '2.1.0' );
define( 'ATLAS_THEME_DIR', get_template_directory() );
define( 'ATLAS_THEME_URI', get_template_directory_uri() );
define( 'ATLAS_THEME_INC', ATLAS_THEME_DIR . '/inc' );

/**
 * Include Theme Files
 */
require_once ATLAS_THEME_INC . '/i18n.php';
require_once ATLAS_THEME_INC . '/enqueue.php';
require_once ATLAS_THEME_INC . '/custom-post-types.php';
require_once ATLAS_THEME_INC . '/template-functions.php';
require_once ATLAS_THEME_INC . '/options-page.php';
require_once ATLAS_THEME_INC . '/shortpixel-optimization.php';

/**
 * Theme Setup
 */
function atlas_theme_setup() {
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

    // Set content width
    $GLOBALS['content_width'] = 1200;

    // Load text domain for translations
    load_theme_textdomain( 'atlas-theme', ATLAS_THEME_DIR . '/languages' );

    // Register navigation menus (only the primary menu is rendered by the theme)
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Navigation', 'atlas-theme' ),
    ) );

    // Custom image sizes
    add_image_size( 'atlas-hero', 500, 700, true );          // Hero profile image
    add_image_size( 'atlas-project', 600, 400, true );       // Project cards
    add_image_size( 'atlas-project-large', 1200, 800, true ); // Project detail pages
    add_image_size( 'atlas-thumbnail', 300, 200, true );     // Small thumbnails
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
        $attr['loading']  = 'lazy';
        $attr['decoding'] = 'async';

        return $attr;
    }, 10, 3 );

    // Responsive image sizes used by the templates
    add_image_size( 'atlas-thumbnail-large', 600, 400, true );
}
add_action( 'init', 'atlas_theme_image_optimization' );

/**
 * SEO: meta description + Open Graph / Twitter Card
 *
 * Skipped automatically when a dedicated SEO plugin (Yoast, RankMath, AIOSEO,
 * SEOPress) is active, to avoid duplicate tags.
 */
function atlas_theme_meta_tags() {
    if (
        defined( 'WPSEO_VERSION' ) ||                 // Yoast SEO
        class_exists( 'RankMath' ) ||                 // Rank Math
        defined( 'AIOSEO_VERSION' ) ||                // All in One SEO
        defined( 'SEOPRESS_VERSION' )                 // SEOPress
    ) {
        return;
    }

    $default_desc = get_option(
        'atlas_site_description',
        __( 'Estúdio de engenharia e produto. Construímos software que resolve problemas reais — e que aguenta o peso do mundo real.', 'atlas-theme' )
    );

    $description = $default_desc;
    $og_type     = 'website';
    $url         = home_url( add_query_arg( null, null ) );
    $image       = '';

    if ( is_singular() ) {
        $og_type = is_singular( 'post' ) ? 'article' : 'website';
        $url     = get_permalink();

        $excerpt = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
        $excerpt = trim( preg_replace( '/\s+/', ' ', (string) $excerpt ) );
        if ( $excerpt ) {
            $description = wp_html_excerpt( $excerpt, 155, '…' );
        }

        if ( has_post_thumbnail() ) {
            $thumb = wp_get_attachment_image_url( get_post_thumbnail_id(), 'atlas-project-large' );
            if ( $thumb ) {
                $image = $thumb;
            }
        }
    } elseif ( is_archive() ) {
        $arch = wp_strip_all_tags( get_the_archive_description() );
        if ( $arch ) {
            $description = wp_html_excerpt( trim( $arch ), 155, '…' );
        }
        $url = home_url( add_query_arg( null, null ) );
    }

    if ( ! $image ) {
        $image = get_template_directory_uri() . '/screenshot.png';
    }

    $title = wp_get_document_title();

    echo "\n<!-- Atlas SEO -->\n";
    printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
    printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
    printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
    printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $og_type ) );
    printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
    printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
    printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
    printf( '<meta name="twitter:card" content="%s">' . "\n", 'summary_large_image' );
    printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
    printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
    printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
    echo "<!-- /Atlas SEO -->\n";
}
add_action( 'wp_head', 'atlas_theme_meta_tags', 5 );

/**
 * Regenerate image sizes on theme activation
 */
function atlas_regenerate_image_sizes() {
    if ( ! get_option( 'atlas_image_sizes_regenerated' ) ) {
        if ( function_exists( 'wp_generate_attachment_metadata' ) ) {
            $attachments = get_posts( array(
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'numberposts'    => -1,
                'post_status'    => 'any',
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
 * Add Custom Body Classes
 */
function atlas_theme_body_classes( $classes ) {
    if ( is_page_template() ) {
        $template  = get_page_template_slug();
        $classes[] = 'page-template-' . sanitize_html_class( str_replace( '.php', '', $template ) );
    }

    if ( is_singular( 'atlas_project' ) ) {
        $classes[] = 'single-project';
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
