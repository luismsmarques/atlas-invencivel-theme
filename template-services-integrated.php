<?php
/**
 * Template Name: Services Integrated
 * The template for displaying services as an integrated section
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="content-area">
    <div class="container">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>
                
                <div class="page-content">
                    <?php
                    the_content();
                    
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlas-theme' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
            </article>
            
        <?php endwhile; ?>
    </div>
</div>

<!-- Services Section -->
<section class="services">
    <div class="container">
        <div class="services-header">
            <h2 class="services-title"><?php esc_html_e( 'MY SERVICES', 'atlas-theme' ); ?></h2>
            <button class="view-all-btn"><?php esc_html_e( 'VIEW ALL', 'atlas-theme' ); ?></button>
        </div>
        
        <div class="services-grid">
            <?php
            $services_query = new WP_Query( array(
                'post_type'      => 'atlas_service',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => 'meta_value_num',
                'meta_key'       => '_atlas_service_number',
                'order'          => 'ASC',
            ) );
            
            if ( $services_query->have_posts() ) {
                while ( $services_query->have_posts() ) {
                    $services_query->the_post();
                    
                    $service_number = get_post_meta( get_the_ID(), '_atlas_service_number', true );
                    $service_icon_type = get_post_meta( get_the_ID(), '_atlas_service_icon_type', true );
                    $service_featured = get_post_meta( get_the_ID(), '_atlas_service_featured', true );
                    
                    $number = ! empty( $service_number ) ? $service_number : '01';
                    $icon_type = ! empty( $service_icon_type ) ? $service_icon_type : 'ux';
                    $is_featured = $service_featured === '1';
                    
                    $card_class = $is_featured ? 'service-card featured' : 'service-card';
                    $number_class = $is_featured ? 'service-number featured-number' : 'service-number';
                    ?>
                    <div class="<?php echo esc_attr( $card_class ); ?>">
                        <div class="<?php echo esc_attr( $number_class ); ?>"><?php echo esc_html( sprintf( '%02d.', $number ) ); ?></div>
                        
                        <div class="service-icon <?php echo esc_attr( $icon_type ); ?>-icon">
                            <?php if ( $icon_type === 'graphic' ) : ?>
                                <div class="icon-briefcase">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            <?php else : ?>
                                <div class="icon-square">
                                    <span><?php echo esc_html( strtoupper( $icon_type ) ); ?></span>
                                    <div class="icon-arrow"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <div class="service-description">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                // Default services if none exist
                $default_services = array(
                    array( 'number' => '01', 'icon' => 'ux', 'title' => 'UX DESIGN', 'featured' => false ),
                    array( 'number' => '02', 'icon' => 'ui', 'title' => 'UI DESIGN', 'featured' => false ),
                    array( 'number' => '03', 'icon' => 'graphic', 'title' => 'GRAPHIC DESIGN', 'featured' => true ),
                );
                
                foreach ( $default_services as $service ) {
                    $card_class = $service['featured'] ? 'service-card featured' : 'service-card';
                    $number_class = $service['featured'] ? 'service-number featured-number' : 'service-number';
                    
                    echo '<div class="' . esc_attr( $card_class ) . '">';
                    echo '<div class="' . esc_attr( $number_class ) . '">' . esc_html( $service['number'] ) . '.</div>';
                    echo '<div class="service-icon ' . esc_attr( $service['icon'] ) . '-icon">';
                    
                    if ( $service['icon'] === 'graphic' ) {
                        echo '<div class="icon-briefcase">';
                        echo '<i class="fas fa-briefcase"></i>';
                        echo '</div>';
                    } else {
                        echo '<div class="icon-square">';
                        echo '<span>' . esc_html( strtoupper( $service['icon'] ) ) . '</span>';
                        echo '<div class="icon-arrow"></div>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '<h3 class="service-title">' . esc_html( $service['title'] ) . '</h3>';
                    echo '<div class="service-description">';
                    echo '<p>Etiam facilisis ligula nec velit posuere egestas. Nam dictum lectus, sed dignissim purus luctus quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <div class="cta-circle">
                <p class="cta-subtitle"><?php esc_html_e( 'Have a great idea?', 'atlas-theme' ); ?></p>
                <h2 class="cta-title"><?php esc_html_e( 'LET\'S TALK ABOUT YOUR PROJECT', 'atlas-theme' ); ?></h2>
                <button class="cta-button"><?php esc_html_e( 'CONTACT ME', 'atlas-theme' ); ?></button>
            </div>
            <div class="cta-image">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop&crop=face" alt="<?php esc_attr_e( 'Contact Me', 'atlas-theme' ); ?>" class="cta-img">
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
