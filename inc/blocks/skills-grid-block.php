<?php
/**
 * Skills Grid Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Skills Grid Block
 */
function atlas_theme_register_skills_grid_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-skills-grid-block',
        ATLAS_THEME_URI . '/assets/js/blocks/skills-grid-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-skills-grid-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/skills-grid-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/skills-grid-block', array(
        'editor_script' => 'atlas-theme-skills-grid-block',
        'editor_style'  => 'atlas-theme-skills-grid-block-editor',
        'style'         => 'atlas-theme-skills-grid-block',
        'render_callback' => 'atlas_theme_render_skills_grid_block',
        'attributes' => array(
            'columns' => array(
                'type' => 'number',
                'default' => 5,
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#FDF4E3',
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#333333',
            ),
            'showAll' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'limit' => array(
                'type' => 'number',
                'default' => 5,
            ),
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_skills_grid_block' );

/**
 * Render Skills Grid Block
 */
function atlas_theme_render_skills_grid_block( $attributes ) {
    $columns = ! empty( $attributes['columns'] ) ? $attributes['columns'] : 5;
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#FDF4E3';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#333333';
    $show_all = ! empty( $attributes['showAll'] ) ? $attributes['showAll'] : true;
    $limit = ! empty( $attributes['limit'] ) ? $attributes['limit'] : 5;
    
    // Get skills from CPT
    $skills_query = new WP_Query( array(
        'post_type'      => 'atlas_skill',
        'posts_per_page' => $show_all ? -1 : $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
    
    ob_start();
    ?>
    <section class="skills atlas-skills-grid-block" style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="container">
            <div class="skills-grid" style="grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr( 100 / $columns ); ?>%, 1fr));">
                <?php if ( $skills_query->have_posts() ) : ?>
                    <?php while ( $skills_query->have_posts() ) : ?>
                        <?php $skills_query->the_post(); ?>
                        
                        <?php
                        $skill_icon = get_post_meta( get_the_ID(), '_atlas_skill_icon', true );
                        $skill_abbreviation = get_post_meta( get_the_ID(), '_atlas_skill_abbreviation', true );
                        $skill_bg_color = get_post_meta( get_the_ID(), '_atlas_skill_bg_color', true );
                        
                        $icon_class = ! empty( $skill_icon ) ? $skill_icon : 'default-skill';
                        $abbreviation = ! empty( $skill_abbreviation ) ? $skill_abbreviation : substr( get_the_title(), 0, 4 );
                        $icon_bg_color = ! empty( $skill_bg_color ) ? $skill_bg_color : '#134686';
                        ?>
                        <div class="skill-card">
                            <div class="skill-icon <?php echo esc_attr( $icon_class ); ?>" style="background-color: <?php echo esc_attr( $icon_bg_color ); ?>;">
                                <span><?php echo esc_html( $abbreviation ); ?></span>
                            </div>
                            <h3 class="skill-name"><?php the_title(); ?></h3>
                        </div>
                        
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php
                    // Get skills from theme options
                    $theme_skills = get_option( 'atlas_skills', array() );
                    
                    if ( ! empty( $theme_skills ) ) {
                        foreach ( $theme_skills as $skill ) {
                            if ( ! empty( $skill['title'] ) && ! empty( $skill['acronym'] ) && ! empty( $skill['color'] ) ) {
                                echo '<div class="skill-card">';
                                echo '<div class="skill-icon ' . esc_attr( $skill['color'] ) . '">';
                                echo '<span>' . esc_html( $skill['acronym'] ) . '</span>';
                                echo '</div>';
                                echo '<h3 class="skill-name">' . esc_html( $skill['title'] ) . '</h3>';
                                echo '</div>';
                            }
                        }
                    } else {
                        // Fallback to default skills if no options are set
                        $default_skills = array(
                            array( 'name' => 'WordPress', 'icon' => 'wordpress', 'abbr' => 'WP', 'color' => '#21759B' ),
                            array( 'name' => 'Programming', 'icon' => 'programming-atlas', 'abbr' => 'CODE', 'color' => '#FEB21A' ),
                            array( 'name' => 'Artificial Intelligence', 'icon' => 'artificial-intelligence', 'abbr' => 'AI', 'color' => '#1572B6' ),
                            array( 'name' => 'Digital Marketing', 'icon' => 'digital-marketing', 'abbr' => 'DM', 'color' => '#ED3F27' ),
                            array( 'name' => 'Content Strategy', 'icon' => 'content-strategy', 'abbr' => 'STRAT', 'color' => '#ED3F27' ),
                        );
                        
                        foreach ( $default_skills as $skill ) {
                            echo '<div class="skill-card">';
                            echo '<div class="skill-icon ' . esc_attr( $skill['icon'] ) . '" style="background-color: ' . esc_attr( $skill['color'] ) . ';">';
                            echo '<span>' . esc_html( $skill['abbr'] ) . '</span>';
                            echo '</div>';
                            echo '<h3 class="skill-name">' . esc_html( $skill['name'] ) . '</h3>';
                            echo '</div>';
                        }
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
