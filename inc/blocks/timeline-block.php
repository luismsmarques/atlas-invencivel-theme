<?php
/**
 * Timeline Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Timeline Block
 */
function atlas_theme_register_timeline_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-timeline-block',
        ATLAS_THEME_URI . '/assets/js/blocks/timeline-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-timeline-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/timeline-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/timeline-block', array(
        'editor_script' => 'atlas-theme-timeline-block',
        'editor_style'  => 'atlas-theme-timeline-block-editor',
        'style'         => 'atlas-theme-timeline-block',
        'render_callback' => 'atlas_theme_render_timeline_block',
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => esc_html__( 'EDUCATION & EXPERIENCE', 'atlas-theme' ),
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#FDF4E3',
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#333333',
            ),
            'titleColor' => array(
                'type' => 'string',
                'default' => '#134686',
            ),
            'dotColor' => array(
                'type' => 'string',
                'default' => '#134686',
            ),
            'showEducation' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'showExperience' => array(
                'type' => 'boolean',
                'default' => true,
            ),
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_timeline_block' );

/**
 * Render Timeline Block
 */
function atlas_theme_render_timeline_block( $attributes ) {
    $title = ! empty( $attributes['title'] ) ? $attributes['title'] : esc_html__( 'EDUCATION & EXPERIENCE', 'atlas-theme' );
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#FDF4E3';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#333333';
    $title_color = ! empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#134686';
    $dot_color = ! empty( $attributes['dotColor'] ) ? $attributes['dotColor'] : '#134686';
    $show_education = ! empty( $attributes['showEducation'] ) ? $attributes['showEducation'] : true;
    $show_experience = ! empty( $attributes['showExperience'] ) ? $attributes['showExperience'] : true;
    
    ob_start();
    ?>
    <section class="education-experience atlas-timeline-block" style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="container">
            <h2 class="section-title" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $title ); ?></h2>
            
            <div class="timeline-container">
                <?php if ( $show_education ) : ?>
                    <div class="timeline-column">
                        <?php
                        $education_query = new WP_Query( array(
                            'post_type'      => 'atlas_timeline',
                            'posts_per_page' => -1,
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                array(
                                    'key'   => '_atlas_timeline_type',
                                    'value' => 'education',
                                ),
                            ),
                            'orderby'        => 'meta_value',
                            'order'          => 'DESC',
                        ) );
                        
                        if ( $education_query->have_posts() ) {
                            while ( $education_query->have_posts() ) {
                                $education_query->the_post();
                                
                                $timeline_date = get_post_meta( get_the_ID(), '_atlas_timeline_date', true );
                                ?>
                                <div class="timeline-item">
                                    <div class="timeline-dot" style="background-color: <?php echo esc_attr( $dot_color ); ?>;"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $timeline_date ); ?></div>
                                        <h3 class="timeline-title"><?php the_title(); ?></h3>
                                        <p class="timeline-description"><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        } else {
                            // Default education items
                            $default_education = array(
                                array( 'date' => '2020-2021', 'title' => 'EDIT. - DISRUPTIVE DIGITAL EDUCATION', 'desc' => 'Digital Marketing & Strategy' ),
                                array( 'date' => '2012-2013', 'title' => 'ISMAI - INSTITUTO SUPERIOR DA MAIA', 'desc' => 'Aplicações de Informática Gestão' ),
                                array( 'date' => '2014', 'title' => 'PRÉMIOS NOVOS - INTERNET', 'desc' => 'Vencedor na categoria de Internet com o projeto Musical Covers' ),
                            );
                            
                            foreach ( $default_education as $item ) {
                                echo '<div class="timeline-item">';
                                echo '<div class="timeline-dot" style="background-color: ' . esc_attr( $dot_color ) . ';"></div>';
                                echo '<div class="timeline-content">';
                                echo '<div class="timeline-date" style="color: ' . esc_attr( $title_color ) . ';">' . esc_html( $item['date'] ) . '</div>';
                                echo '<h3 class="timeline-title">' . esc_html( $item['title'] ) . '</h3>';
                                echo '<p class="timeline-description">' . esc_html( $item['desc'] ) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $show_experience ) : ?>
                    <div class="timeline-column">
                        <?php
                        $experience_query = new WP_Query( array(
                            'post_type'      => 'atlas_timeline',
                            'posts_per_page' => -1,
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                array(
                                    'key'   => '_atlas_timeline_type',
                                    'value' => 'experience',
                                ),
                            ),
                            'orderby'        => 'meta_value',
                            'order'          => 'DESC',
                        ) );
                        
                        if ( $experience_query->have_posts() ) {
                            while ( $experience_query->have_posts() ) {
                                $experience_query->the_post();
                                
                                $timeline_date = get_post_meta( get_the_ID(), '_atlas_timeline_date', true );
                                ?>
                                <div class="timeline-item">
                                    <div class="timeline-dot" style="background-color: <?php echo esc_attr( $dot_color ); ?>;"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $timeline_date ); ?></div>
                                        <h3 class="timeline-title"><?php the_title(); ?></h3>
                                        <p class="timeline-description"><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        } else {
                            // Default experience items
                            $default_experience = array(
                                array( 'date' => '2025 - Present', 'title' => 'CEO - ATLAS INVENCÍVEL', 'desc' => 'Leading company strategy and business development' ),
                                array( 'date' => '2024 - Present', 'title' => 'ANGEL INVESTOR - ANGELSWAY', 'desc' => 'Supporting innovative startups with social impact and scalable growth' ),
                                array( 'date' => '2021-2025', 'title' => 'CTO & DIGITAL MARKETER - MADS NETWORK', 'desc' => 'Developed content marketing strategies and guided website architecture' ),
                                array( 'date' => '2015-2021', 'title' => 'WEBMASTER - CLEVER ADVERTISING', 'desc' => 'Built functional websites and collaborated on digital campaigns' ),
                            );
                            
                            foreach ( $default_experience as $item ) {
                                echo '<div class="timeline-item">';
                                echo '<div class="timeline-dot" style="background-color: ' . esc_attr( $dot_color ) . ';"></div>';
                                echo '<div class="timeline-content">';
                                echo '<div class="timeline-date" style="color: ' . esc_attr( $title_color ) . ';">' . esc_html( $item['date'] ) . '</div>';
                                echo '<h3 class="timeline-title">' . esc_html( $item['title'] ) . '</h3>';
                                echo '<p class="timeline-description">' . esc_html( $item['desc'] ) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
