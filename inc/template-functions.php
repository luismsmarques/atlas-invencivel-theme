<?php
/**
 * Template Functions for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Fallback menu for primary navigation
 */
function atlas_theme_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="#home" class="nav-link active">' . esc_html__( 'Home', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#about" class="nav-link">' . esc_html__( 'About', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#projects" class="nav-link">' . esc_html__( 'Projects', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#contacts" class="nav-link">' . esc_html__( 'Contacts', 'atlas-theme' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Fallback menu for footer navigation
 */
function atlas_theme_footer_fallback_menu() {
    echo '<ul id="footer-menu" class="menu">';
    echo '<li><a href="#home" class="footer-nav-link">' . esc_html__( 'HOME', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#about" class="footer-nav-link">' . esc_html__( 'ABOUT', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#projects" class="footer-nav-link">' . esc_html__( 'PROJECTS', 'atlas-theme' ) . '</a></li>';
    echo '<li><a href="#contacts" class="footer-nav-link">' . esc_html__( 'CONTACTS', 'atlas-theme' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Custom Walker for Navigation Menu
 */
class Atlas_Theme_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Start the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a class="nav-link"' . $attributes .'>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Get Custom Post Type Posts
 */
function atlas_theme_get_posts( $post_type, $posts_per_page = -1, $meta_key = '', $meta_value = '' ) {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    if ( ! empty( $meta_key ) && ! empty( $meta_value ) ) {
        $args['meta_query'] = array(
            array(
                'key'   => $meta_key,
                'value' => $meta_value,
            ),
        );
    }
    
    return new WP_Query( $args );
}

/**
 * Get Hero Stats
 */
function atlas_theme_get_hero_stats() {
    $stats = get_option( 'atlas_hero_stats', array() );
    
    if ( empty( $stats ) ) {
        $stats = array(
            array(
                'label' => esc_html__( 'Years of experience in Tech & Digital', 'atlas-theme' ),
                'value' => '15+',
            ),
            array(
                'label' => esc_html__( 'Companies Founded and Led', 'atlas-theme' ),
                'value' => '3',
            ),
            array(
                'label' => esc_html__( 'Social Media Communities & Content Managed', 'atlas-theme' ),
                'value' => '10+',
            ),
        );
    }
    
    return $stats;
}

/**
 * Get Skills
 */
function atlas_theme_get_skills() {
    $skills_query = atlas_theme_get_posts( 'atlas_skill' );
    
    if ( $skills_query->have_posts() ) {
        $skills = array();
        while ( $skills_query->have_posts() ) {
            $skills_query->the_post();
            
            $skill_icon = get_post_meta( get_the_ID(), '_atlas_skill_icon', true );
            $skill_abbreviation = get_post_meta( get_the_ID(), '_atlas_skill_abbreviation', true );
            $skill_bg_color = get_post_meta( get_the_ID(), '_atlas_skill_bg_color', true );
            
            $skills[] = array(
                'id'            => get_the_ID(),
                'title'         => get_the_title(),
                'content'       => get_the_content(),
                'icon'          => $skill_icon,
                'abbreviation'  => $skill_abbreviation,
                'bg_color'      => $skill_bg_color,
            );
        }
        wp_reset_postdata();
        
        return $skills;
    }
    
    return array();
}

/**
 * Get Projects
 */
function atlas_theme_get_projects( $limit = 4 ) {
    $projects_query = atlas_theme_get_posts( 'atlas_project', $limit );
    
    if ( $projects_query->have_posts() ) {
        $projects = array();
        while ( $projects_query->have_posts() ) {
            $projects_query->the_post();
            
            $project_url = get_post_meta( get_the_ID(), '_atlas_project_url', true );
            $project_category = get_post_meta( get_the_ID(), '_atlas_project_category', true );
            
            $projects[] = array(
                'id'       => get_the_ID(),
                'title'    => get_the_title(),
                'content'  => get_the_content(),
                'excerpt'  => get_the_excerpt(),
                'url'      => $project_url,
                'category' => $project_category,
                'image'    => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
            );
        }
        wp_reset_postdata();
        
        return $projects;
    }
    
    return array();
}

/**
 * Get Timeline Items
 */
function atlas_theme_get_timeline_items( $type = '' ) {
    $args = array(
        'post_type'      => 'atlas_timeline',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'meta_value',
        'meta_key'       => '_atlas_timeline_date',
        'order'          => 'DESC',
    );
    
    if ( ! empty( $type ) ) {
        $args['meta_query'] = array(
            array(
                'key'   => '_atlas_timeline_type',
                'value' => $type,
            ),
        );
    }
    
    $timeline_query = new WP_Query( $args );
    
    if ( $timeline_query->have_posts() ) {
        $timeline_items = array();
        while ( $timeline_query->have_posts() ) {
            $timeline_query->the_post();
            
            $timeline_date = get_post_meta( get_the_ID(), '_atlas_timeline_date', true );
            $timeline_type = get_post_meta( get_the_ID(), '_atlas_timeline_type', true );
            
            $timeline_items[] = array(
                'id'          => get_the_ID(),
                'title'       => get_the_title(),
                'content'     => get_the_content(),
                'excerpt'     => get_the_excerpt(),
                'date'        => $timeline_date,
                'type'        => $timeline_type,
            );
        }
        wp_reset_postdata();
        
        return $timeline_items;
    }
    
    return array();
}

/**
 * Get Services
 */
function atlas_theme_get_services() {
    $services_query = atlas_theme_get_posts( 'atlas_service' );
    
    if ( $services_query->have_posts() ) {
        $services = array();
        while ( $services_query->have_posts() ) {
            $services_query->the_post();
            
            $service_number = get_post_meta( get_the_ID(), '_atlas_service_number', true );
            $service_icon_type = get_post_meta( get_the_ID(), '_atlas_service_icon_type', true );
            $service_featured = get_post_meta( get_the_ID(), '_atlas_service_featured', true );
            
            $services[] = array(
                'id'         => get_the_ID(),
                'title'      => get_the_title(),
                'content'    => get_the_content(),
                'number'     => $service_number,
                'icon_type'  => $service_icon_type,
                'featured'   => $service_featured === '1',
            );
        }
        wp_reset_postdata();
        
        return $services;
    }
    
    return array();
}

/**
 * Get Company Logos
 */
function atlas_theme_get_company_logos( $limit = 5 ) {
    $logos_query = atlas_theme_get_posts( 'atlas_company_logo', $limit );
    
    if ( $logos_query->have_posts() ) {
        $logos = array();
        while ( $logos_query->have_posts() ) {
            $logos_query->the_post();
            
            $logo_shape_type = get_post_meta( get_the_ID(), '_atlas_logo_shape_type', true );
            $logo_shape_letter = get_post_meta( get_the_ID(), '_atlas_logo_shape_letter', true );
            
            $logos[] = array(
                'id'            => get_the_ID(),
                'title'         => get_the_title(),
                'shape_type'    => $logo_shape_type,
                'shape_letter'  => $logo_shape_letter,
            );
        }
        wp_reset_postdata();
        
        return $logos;
    }
    
    return array();
}

/**
 * Services Shortcode
 */
function atlas_theme_services_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'limit' => -1,
    ), $atts, 'atlas_services' );
    
    $services = atlas_theme_get_services();
    
    if ( empty( $services ) ) {
        return '';
    }
    
    ob_start();
    ?>
    <section class="services">
        <div class="container">
            <div class="services-header">
                <h2 class="services-title"><?php esc_html_e( 'MY SERVICES', 'atlas-theme' ); ?></h2>
            </div>
            
            <div class="services-grid">
                <?php foreach ( $services as $service ) : ?>
                    <?php
                    $card_class = $service['featured'] ? 'service-card featured' : 'service-card';
                    $number_class = $service['featured'] ? 'service-number featured-number' : 'service-number';
                    $number = ! empty( $service['number'] ) ? $service['number'] : '01';
                    $icon_type = ! empty( $service['icon_type'] ) ? $service['icon_type'] : 'ux';
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
                        
                        <h3 class="service-title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <div class="service-description">
                            <?php echo wp_kses_post( $service['content'] ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'atlas_services', 'atlas_theme_services_shortcode' );

/**
 * Add Screen Reader Text Class
 */
function atlas_theme_screen_reader_text() {
    return 'screen-reader-text';
}
add_filter( 'screen_reader_text_class', 'atlas_theme_screen_reader_text' );

/**
 * Custom Search Form
 */
function atlas_theme_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
            <span class="screen-reader-text">' . esc_html__( 'Search for:', 'atlas-theme' ) . '</span>
            <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search...', 'atlas-theme' ) . '" value="' . get_search_query() . '" name="s" />
        </label>
        <input type="submit" class="search-submit" value="' . esc_attr__( 'Search', 'atlas-theme' ) . '" />
    </form>';
    
    return $form;
}
add_filter( 'get_search_form', 'atlas_theme_search_form' );
