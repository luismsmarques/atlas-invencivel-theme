<?php
/**
 * ShortPixel Image Optimization Configuration
 * 
 * This script configures ShortPixel for optimal WebP conversion
 * and image optimization to achieve the 952 KiB savings identified
 * in PageSpeed Insights.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Configure ShortPixel Settings for Maximum Performance
 */
function atlas_configure_shortpixel() {
    // Only run if ShortPixel is active
    if ( ! class_exists( 'ShortPixel' ) ) {
        return;
    }
    
    // Configure ShortPixel settings for optimal performance
    $shortpixel_settings = array(
        // Enable WebP conversion
        'createWebp' => true,
        
        // Enable AVIF conversion (next-gen format)
        'createAvif' => true,
        
        // Compression level (1-5, 5 = maximum compression)
        'compressionType' => 2, // Lossy compression for better file sizes
        
        // Resize large images
        'resizeImages' => true,
        'resizeType' => 'fit',
        'resizeWidth' => 1920,
        'resizeHeight' => 1080,
        
        // Optimize thumbnails
        'optimizeThumbnails' => true,
        
        // Backup original images
        'backupImages' => true,
        
        // Exif data handling
        'keepExif' => false, // Remove EXIF to reduce file size
        
        // CMYK to RGB conversion
        'cmyk2rgb' => true,
        
        // Optimize PDFs
        'optimizePdfs' => false, // Disable if not needed
        
        // Optimize other files
        'optimizeOtherFiles' => false, // Disable if not needed
    );
    
    // Apply settings
    foreach ( $shortpixel_settings as $key => $value ) {
        update_option( 'shortpixel_' . $key, $value );
    }
    
    // Log the configuration
    error_log( 'Atlas Theme: ShortPixel configured for optimal performance' );
}

/**
 * Auto-optimize existing images
 */
function atlas_auto_optimize_images() {
    // Only run if ShortPixel is active
    if ( ! class_exists( 'ShortPixel' ) ) {
        return;
    }
    
    // Get all images that need optimization
    $images = get_posts( array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/png', 'image/gif' ),
        'numberposts' => -1,
        'post_status' => 'any',
        'meta_query' => array(
            array(
                'key' => '_shortpixel_status',
                'compare' => 'NOT EXISTS'
            )
        )
    ) );
    
    // Queue images for optimization
    if ( ! empty( $images ) ) {
        $image_ids = wp_list_pluck( $images, 'ID' );
        
        // Add to ShortPixel queue
        if ( method_exists( 'ShortPixel', 'addToQueue' ) ) {
            ShortPixel::addToQueue( $image_ids );
        }
        
        error_log( 'Atlas Theme: Queued ' . count( $image_ids ) . ' images for optimization' );
    }
}

/**
 * Add WebP serving support to theme
 */
function atlas_webp_serving() {
    // Add WebP support detection script
    ?>
    <script>
    // Enhanced WebP detection with fallback
    function supportsWebP() {
        var elem = document.createElement('canvas');
        if (!!(elem.getContext && elem.getContext('2d'))) {
            return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
        }
        return false;
    }
    
    // Add WebP class to HTML element
    if (supportsWebP()) {
        document.documentElement.classList.add('webp');
        document.documentElement.classList.remove('no-webp');
    } else {
        document.documentElement.classList.add('no-webp');
        document.documentElement.classList.remove('webp');
    }
    
    // Preload WebP images if supported
    if (supportsWebP()) {
        var webpImages = document.querySelectorAll('img[data-webp]');
        webpImages.forEach(function(img) {
            var webpSrc = img.getAttribute('data-webp');
            if (webpSrc) {
                img.src = webpSrc;
            }
        });
    }
    </script>
    <?php
}
add_action( 'wp_head', 'atlas_webp_serving', 1 );

/**
 * Modify image output to include WebP sources
 */
function atlas_add_webp_sources( $html, $attachment_id, $size, $icon, $attr ) {
    // Only for images, not icons
    if ( $icon ) {
        return $html;
    }
    
    // Get WebP version if available
    $webp_url = wp_get_attachment_image_url( $attachment_id, $size );
    if ( $webp_url ) {
        $webp_url = str_replace( array( '.jpg', '.jpeg', '.png' ), '.webp', $webp_url );
        
        // Check if WebP file exists
        $upload_dir = wp_upload_dir();
        $webp_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $webp_url );
        
        if ( file_exists( $webp_path ) ) {
            // Add data-webp attribute for JavaScript handling
            $html = str_replace( 'src=', 'data-webp="' . esc_url( $webp_url ) . '" src=', $html );
        }
    }
    
    return $html;
}
add_filter( 'wp_get_attachment_image', 'atlas_add_webp_sources', 10, 5 );

/**
 * Add responsive image sizes for better performance
 */
function atlas_add_responsive_image_sizes() {
    // Add more responsive sizes for better performance
    add_image_size( 'atlas-hero-xl', 1920, 1080, true );
    add_image_size( 'atlas-hero-lg', 1200, 675, true );
    add_image_size( 'atlas-hero-md', 768, 432, true );
    add_image_size( 'atlas-hero-sm', 480, 270, true );
    
    add_image_size( 'atlas-project-xl', 1200, 800, true );
    add_image_size( 'atlas-project-lg', 800, 533, true );
    add_image_size( 'atlas-project-md', 600, 400, true );
    add_image_size( 'atlas-project-sm', 400, 267, true );
    
    add_image_size( 'atlas-thumbnail-xl', 600, 400, true );
    add_image_size( 'atlas-thumbnail-lg', 400, 267, true );
    add_image_size( 'atlas-thumbnail-md', 300, 200, true );
    add_image_size( 'atlas-thumbnail-sm', 200, 133, true );
}
add_action( 'after_setup_theme', 'atlas_add_responsive_image_sizes' );

/**
 * Optimize specific problematic images identified in PageSpeed
 */
function atlas_optimize_problem_images() {
    // Only run if ShortPixel is active
    if ( ! class_exists( 'ShortPixel' ) ) {
        return;
    }
    
    // Problem images identified in PageSpeed Insights
    $problem_images = array(
        'Gemini_Generated_Image_emgcwsemgcwsemgc.png',
        'tos-768x505.png',
        'how-to-invest-768x525.png'
    );
    
    foreach ( $problem_images as $filename ) {
        $attachment = get_posts( array(
            'post_type' => 'attachment',
            'meta_query' => array(
                array(
                    'key' => '_wp_attached_file',
                    'value' => $filename,
                    'compare' => 'LIKE'
                )
            ),
            'numberposts' => 1
        ) );
        
        if ( ! empty( $attachment ) ) {
            $attachment_id = $attachment[0]->ID;
            
            // Force optimization
            if ( method_exists( 'ShortPixel', 'addToQueue' ) ) {
                ShortPixel::addToQueue( array( $attachment_id ) );
            }
            
            error_log( 'Atlas Theme: Queued problem image for optimization: ' . $filename );
        }
    }
}

/**
 * Initialize ShortPixel optimization on theme activation
 */
function atlas_init_shortpixel_optimization() {
    // Configure ShortPixel
    atlas_configure_shortpixel();
    
    // Auto-optimize existing images
    atlas_auto_optimize_images();
    
    // Optimize specific problem images
    atlas_optimize_problem_images();
    
    // Log completion
    error_log( 'Atlas Theme: ShortPixel optimization initialized' );
}

// Run optimization on theme activation
add_action( 'after_switch_theme', 'atlas_init_shortpixel_optimization' );

// Also run on admin init for manual trigger
add_action( 'admin_init', function() {
    if ( isset( $_GET['atlas_optimize_images'] ) && current_user_can( 'manage_options' ) ) {
        atlas_init_shortpixel_optimization();
        wp_redirect( admin_url( 'admin.php?page=shortpixel-settings&optimized=1' ) );
        exit;
    }
});

/**
 * Add admin notice for optimization status
 */
function atlas_shortpixel_admin_notice() {
    if ( isset( $_GET['optimized'] ) ) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>Atlas Theme:</strong> Image optimization initiated! Check ShortPixel dashboard for progress.</p>';
        echo '</div>';
    }
}
add_action( 'admin_notices', 'atlas_shortpixel_admin_notice' );

/**
 * Add optimization button to admin
 */
function atlas_add_optimization_button() {
    if ( current_user_can( 'manage_options' ) ) {
        echo '<div class="wrap">';
        echo '<h2>Atlas Theme Image Optimization</h2>';
        echo '<p>Click the button below to optimize all images with ShortPixel:</p>';
        echo '<a href="' . admin_url( 'admin.php?page=shortpixel-settings&atlas_optimize_images=1' ) . '" class="button button-primary">Optimize All Images</a>';
        echo '</div>';
    }
}
add_action( 'admin_menu', function() {
    add_options_page( 
        'Atlas Image Optimization', 
        'Atlas Images', 
        'manage_options', 
        'atlas-image-optimization', 
        'atlas_add_optimization_button' 
    );
});
