<?php
/**
 * Projects Grid Block for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Projects Grid Block
 */
function atlas_theme_register_projects_grid_block() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    
    wp_register_script(
        'atlas-theme-projects-grid-block',
        ATLAS_THEME_URI . '/assets/js/blocks/projects-grid-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        ATLAS_THEME_VERSION,
        true
    );
    
    wp_register_style(
        'atlas-theme-projects-grid-block-editor',
        ATLAS_THEME_URI . '/assets/css/blocks/projects-grid-block-editor.css',
        array( 'wp-edit-blocks' ),
        ATLAS_THEME_VERSION
    );
    
    register_block_type( 'atlas-theme/projects-grid-block', array(
        'editor_script' => 'atlas-theme-projects-grid-block',
        'editor_style'  => 'atlas-theme-projects-grid-block-editor',
        'style'         => 'atlas-theme-projects-grid-block',
        'render_callback' => 'atlas_theme_render_projects_grid_block',
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => esc_html__( 'MY LATEST PROJECTS', 'atlas-theme' ),
            ),
            'description' => array(
                'type' => 'string',
                'default' => esc_html__( 'Explore my journey as a webmaster, builder, and entrepreneur. From creating award-winning platforms to leading companies and investing in innovative startups.', 'atlas-theme' ),
            ),
            'columns' => array(
                'type' => 'number',
                'default' => 4,
            ),
            'limit' => array(
                'type' => 'number',
                'default' => 4,
            ),
            'category' => array(
                'type' => 'string',
                'default' => '',
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
        ),
    ) );
}
add_action( 'init', 'atlas_theme_register_projects_grid_block' );

/**
 * Render Projects Grid Block
 */
function atlas_theme_render_projects_grid_block( $attributes ) {
    $title = ! empty( $attributes['title'] ) ? $attributes['title'] : get_option( 'atlas_projects_title', esc_html__( 'MY LATEST PROJECTS', 'atlas-theme' ) );
    $description = ! empty( $attributes['description'] ) ? $attributes['description'] : get_option( 'atlas_projects_description', esc_html__( 'Explore my journey as a webmaster, builder, and entrepreneur. From creating award-winning platforms to leading companies and investing in innovative startups.', 'atlas-theme' ) );
    $columns = ! empty( $attributes['columns'] ) ? $attributes['columns'] : 4;
    $limit = ! empty( $attributes['limit'] ) ? $attributes['limit'] : get_option( 'atlas_projects_limit', 4 );
    $category = ! empty( $attributes['category'] ) ? $attributes['category'] : '';
    $bg_color = ! empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#FDF4E3';
    $text_color = ! empty( $attributes['textColor'] ) ? $attributes['textColor'] : '#333333';
    $title_color = ! empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#134686';
    
    // Build query args
    $query_args = array(
        'post_type'      => 'atlas_project',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    // Add category filter if specified
    if ( ! empty( $category ) ) {
        $query_args['meta_query'] = array(
            array(
                'key'   => '_atlas_project_category',
                'value' => $category,
            ),
        );
    }
    
    $projects_query = new WP_Query( $query_args );
    
    ob_start();
    ?>
    <section class="projects atlas-projects-grid-block" style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $title ); ?></h2>
                <p class="section-description"><?php echo esc_html( $description ); ?></p>
            </div>
            
            <div class="projects-grid" style="grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr( 100 / $columns ); ?>%, 1fr));">
                <?php if ( $projects_query->have_posts() ) : ?>
                    <?php while ( $projects_query->have_posts() ) : ?>
                        <?php $projects_query->the_post(); ?>
                        
                        <?php
                        $project_url = get_post_meta( get_the_ID(), '_atlas_project_url', true );
                        $project_category = get_post_meta( get_the_ID(), '_atlas_project_category', true );
                        $project_link = ! empty( $project_url ) ? $project_url : get_permalink();
                        ?>
                        <div class="project-card">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="project-link">
                                <div class="project-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'atlas-project' ); ?>
                                    <?php else : ?>
                                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&h=400&fit=crop&q=80" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                    
                                    <div class="project-overlay">
                                        <h3 class="project-title"><?php the_title(); ?></h3>
                                        <p class="project-category">
                                            <?php echo esc_html( $project_category ? $project_category : get_the_excerpt() ); ?>
                                        </p>
                                        <div class="project-read-more">
                                            <span><?php esc_html_e( 'View Case Study', 'atlas-theme' ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php
                    // Default projects if none exist
                    $default_projects = array(
                        array( 'title' => 'MUSICAL COVERS', 'category' => 'Web Platform | Music Industry' ),
                        array( 'title' => 'MADS NETWORK', 'category' => 'CTO & Digital Marketing' ),
                        array( 'title' => 'ANGELSWAY INVESTMENT', 'category' => 'Angel Investor | Startups' ),
                        array( 'title' => 'ATLAS INVENCÍVEL', 'category' => 'CEO | Company Leadership' ),
                    );
                    
                    foreach ( $default_projects as $index => $project ) {
                        // Create a placeholder URL for default projects
                        $project_slug = sanitize_title( $project['title'] );
                        $project_url = home_url( '/project/' . $project_slug . '/' );
                        
                        echo '<div class="project-card">';
                        echo '<a href="' . esc_url( $project_url ) . '" class="project-link">';
                        echo '<div class="project-image">';
                        echo '<img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&h=400&fit=crop&q=80" alt="' . esc_attr( $project['title'] ) . '">';
                        echo '<div class="project-overlay">';
                        echo '<h3 class="project-title">' . esc_html( $project['title'] ) . '</h3>';
                        echo '<p class="project-category">' . esc_html( $project['category'] ) . '</p>';
                        echo '<div class="project-read-more">';
                        echo '<span>' . esc_html__( 'View Case Study', 'atlas-theme' ) . '</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
