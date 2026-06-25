<?php
/**
 * Custom Post Types for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types
 */
function atlas_theme_register_post_types() {
    
    // Projects Post Type
    register_post_type( 'atlas_project', array(
        'labels' => array(
            'name'                  => esc_html__( 'Projects', 'atlas-theme' ),
            'singular_name'         => esc_html__( 'Project', 'atlas-theme' ),
            'menu_name'             => esc_html__( 'Projects', 'atlas-theme' ),
            'name_admin_bar'        => esc_html__( 'Project', 'atlas-theme' ),
            'add_new'               => esc_html__( 'Add New', 'atlas-theme' ),
            'add_new_item'          => esc_html__( 'Add New Project', 'atlas-theme' ),
            'new_item'              => esc_html__( 'New Project', 'atlas-theme' ),
            'edit_item'             => esc_html__( 'Edit Project', 'atlas-theme' ),
            'view_item'             => esc_html__( 'View Project', 'atlas-theme' ),
            'all_items'             => esc_html__( 'All Projects', 'atlas-theme' ),
            'search_items'          => esc_html__( 'Search Projects', 'atlas-theme' ),
            'parent_item_colon'     => esc_html__( 'Parent Projects:', 'atlas-theme' ),
            'not_found'             => esc_html__( 'No projects found.', 'atlas-theme' ),
            'not_found_in_trash'    => esc_html__( 'No projects found in Trash.', 'atlas-theme' ),
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'project' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-portfolio',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'          => true,
    ) );

    // Skills Post Type
    register_post_type( 'atlas_skill', array(
        'labels' => array(
            'name'                  => esc_html__( 'Skills', 'atlas-theme' ),
            'singular_name'         => esc_html__( 'Skill', 'atlas-theme' ),
            'menu_name'             => esc_html__( 'Skills', 'atlas-theme' ),
            'name_admin_bar'        => esc_html__( 'Skill', 'atlas-theme' ),
            'add_new'               => esc_html__( 'Add New', 'atlas-theme' ),
            'add_new_item'          => esc_html__( 'Add New Skill', 'atlas-theme' ),
            'new_item'              => esc_html__( 'New Skill', 'atlas-theme' ),
            'edit_item'             => esc_html__( 'Edit Skill', 'atlas-theme' ),
            'view_item'             => esc_html__( 'View Skill', 'atlas-theme' ),
            'all_items'             => esc_html__( 'All Skills', 'atlas-theme' ),
            'search_items'          => esc_html__( 'Search Skills', 'atlas-theme' ),
            'parent_item_colon'     => esc_html__( 'Parent Skills:', 'atlas-theme' ),
            'not_found'             => esc_html__( 'No skills found.', 'atlas-theme' ),
            'not_found_in_trash'    => esc_html__( 'No skills found in Trash.', 'atlas-theme' ),
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'skill' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-star-filled',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'show_in_rest'          => true,
    ) );

    // Timeline Items Post Type
    register_post_type( 'atlas_timeline', array(
        'labels' => array(
            'name'                  => esc_html__( 'Timeline Items', 'atlas-theme' ),
            'singular_name'         => esc_html__( 'Timeline Item', 'atlas-theme' ),
            'menu_name'             => esc_html__( 'Timeline', 'atlas-theme' ),
            'name_admin_bar'        => esc_html__( 'Timeline Item', 'atlas-theme' ),
            'add_new'               => esc_html__( 'Add New', 'atlas-theme' ),
            'add_new_item'          => esc_html__( 'Add New Timeline Item', 'atlas-theme' ),
            'new_item'              => esc_html__( 'New Timeline Item', 'atlas-theme' ),
            'edit_item'             => esc_html__( 'Edit Timeline Item', 'atlas-theme' ),
            'view_item'             => esc_html__( 'View Timeline Item', 'atlas-theme' ),
            'all_items'             => esc_html__( 'All Timeline Items', 'atlas-theme' ),
            'search_items'          => esc_html__( 'Search Timeline Items', 'atlas-theme' ),
            'parent_item_colon'     => esc_html__( 'Parent Timeline Items:', 'atlas-theme' ),
            'not_found'             => esc_html__( 'No timeline items found.', 'atlas-theme' ),
            'not_found_in_trash'    => esc_html__( 'No timeline items found in Trash.', 'atlas-theme' ),
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'timeline' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-calendar-alt',
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'show_in_rest'          => true,
    ) );

}
add_action( 'init', 'atlas_theme_register_post_types' );

/**
 * Register Custom Taxonomies
 */
function atlas_theme_register_taxonomies() {
    
    // Project Categories
    register_taxonomy( 'project_category', 'atlas_project', array(
        'labels' => array(
            'name'              => esc_html__( 'Project Categories', 'atlas-theme' ),
            'singular_name'     => esc_html__( 'Project Category', 'atlas-theme' ),
            'search_items'      => esc_html__( 'Search Project Categories', 'atlas-theme' ),
            'all_items'         => esc_html__( 'All Project Categories', 'atlas-theme' ),
            'parent_item'       => esc_html__( 'Parent Project Category', 'atlas-theme' ),
            'parent_item_colon' => esc_html__( 'Parent Project Category:', 'atlas-theme' ),
            'edit_item'         => esc_html__( 'Edit Project Category', 'atlas-theme' ),
            'update_item'       => esc_html__( 'Update Project Category', 'atlas-theme' ),
            'add_new_item'      => esc_html__( 'Add New Project Category', 'atlas-theme' ),
            'new_item_name'     => esc_html__( 'New Project Category Name', 'atlas-theme' ),
            'menu_name'         => esc_html__( 'Categories', 'atlas-theme' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-category' ),
        'show_in_rest'      => true,
    ) );

    // Timeline Types
    register_taxonomy( 'timeline_type', 'atlas_timeline', array(
        'labels' => array(
            'name'              => esc_html__( 'Timeline Types', 'atlas-theme' ),
            'singular_name'     => esc_html__( 'Timeline Type', 'atlas-theme' ),
            'search_items'      => esc_html__( 'Search Timeline Types', 'atlas-theme' ),
            'all_items'         => esc_html__( 'All Timeline Types', 'atlas-theme' ),
            'parent_item'       => esc_html__( 'Parent Timeline Type', 'atlas-theme' ),
            'parent_item_colon' => esc_html__( 'Parent Timeline Type:', 'atlas-theme' ),
            'edit_item'         => esc_html__( 'Edit Timeline Type', 'atlas-theme' ),
            'update_item'       => esc_html__( 'Update Timeline Type', 'atlas-theme' ),
            'add_new_item'      => esc_html__( 'Add New Timeline Type', 'atlas-theme' ),
            'new_item_name'     => esc_html__( 'New Timeline Type Name', 'atlas-theme' ),
            'menu_name'         => esc_html__( 'Types', 'atlas-theme' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'timeline-type' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'atlas_theme_register_taxonomies' );

/**
 * Add Custom Meta Boxes
 */
function atlas_theme_add_meta_boxes() {
    
    // Project Meta Box
    add_meta_box(
        'atlas_project_meta',
        esc_html__( 'Project Details', 'atlas-theme' ),
        'atlas_theme_project_meta_callback',
        'atlas_project',
        'normal',
        'high'
    );

    // Skill Meta Box
    add_meta_box(
        'atlas_skill_meta',
        esc_html__( 'Skill Details', 'atlas-theme' ),
        'atlas_theme_skill_meta_callback',
        'atlas_skill',
        'normal',
        'high'
    );

    // Timeline Meta Box
    add_meta_box(
        'atlas_timeline_meta',
        esc_html__( 'Timeline Details', 'atlas-theme' ),
        'atlas_theme_timeline_meta_callback',
        'atlas_timeline',
        'normal',
        'high'
    );

}
add_action( 'add_meta_boxes', 'atlas_theme_add_meta_boxes' );

/**
 * Project Meta Box Callback
 */
function atlas_theme_project_meta_callback( $post ) {
    wp_nonce_field( 'atlas_theme_project_meta', 'atlas_theme_project_meta_nonce' );
    
    $project_url = get_post_meta( $post->ID, '_atlas_project_url', true );
    $project_category = get_post_meta( $post->ID, '_atlas_project_category', true );
    $project_client = get_post_meta( $post->ID, '_atlas_project_client', true );
    $project_date = get_post_meta( $post->ID, '_atlas_project_date', true );
    $project_technologies = get_post_meta( $post->ID, '_atlas_project_technologies', true );
    $project_challenges = get_post_meta( $post->ID, '_atlas_project_challenges', true );
    $project_solutions = get_post_meta( $post->ID, '_atlas_project_solutions', true );
    $project_results = get_post_meta( $post->ID, '_atlas_project_results', true );
    $project_gallery = get_post_meta( $post->ID, '_atlas_project_gallery', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="atlas_project_url"><?php esc_html_e( 'Project URL', 'atlas-theme' ); ?></label></th>
            <td><input type="url" id="atlas_project_url" name="atlas_project_url" value="<?php echo esc_attr( $project_url ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="atlas_project_category"><?php esc_html_e( 'Project Category', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_project_category" name="atlas_project_category" value="<?php echo esc_attr( $project_category ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="atlas_project_client"><?php esc_html_e( 'Client Name', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_project_client" name="atlas_project_client" value="<?php echo esc_attr( $project_client ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="atlas_project_date"><?php esc_html_e( 'Project Date', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_project_date" name="atlas_project_date" value="<?php echo esc_attr( $project_date ); ?>" class="regular-text" placeholder="e.g., 2023, Q1 2023, January 2023" /></td>
        </tr>
        <tr>
            <th><label for="atlas_project_technologies"><?php esc_html_e( 'Technologies Used', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_project_technologies" name="atlas_project_technologies" value="<?php echo esc_attr( $project_technologies ); ?>" class="regular-text" placeholder="e.g., WordPress, PHP, JavaScript, CSS" /></td>
        </tr>
        <tr>
            <th><label for="atlas_project_challenges"><?php esc_html_e( 'Challenges', 'atlas-theme' ); ?></label></th>
            <td><textarea id="atlas_project_challenges" name="atlas_project_challenges" rows="5" class="large-text"><?php echo esc_textarea( $project_challenges ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="atlas_project_solutions"><?php esc_html_e( 'Solutions', 'atlas-theme' ); ?></label></th>
            <td><textarea id="atlas_project_solutions" name="atlas_project_solutions" rows="5" class="large-text"><?php echo esc_textarea( $project_solutions ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="atlas_project_results"><?php esc_html_e( 'Results', 'atlas-theme' ); ?></label></th>
            <td><textarea id="atlas_project_results" name="atlas_project_results" rows="5" class="large-text"><?php echo esc_textarea( $project_results ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="atlas_project_gallery"><?php esc_html_e( 'Gallery Image IDs', 'atlas-theme' ); ?></label></th>
            <td>
                <input type="text" id="atlas_project_gallery" name="atlas_project_gallery" value="<?php echo esc_attr( $project_gallery ); ?>" class="regular-text" placeholder="e.g., 123,456,789" />
                <p class="description"><?php esc_html_e( 'Enter comma-separated image attachment IDs for the project gallery.', 'atlas-theme' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Skill Meta Box Callback
 */
function atlas_theme_skill_meta_callback( $post ) {
    wp_nonce_field( 'atlas_theme_skill_meta', 'atlas_theme_skill_meta_nonce' );
    
    $skill_icon = get_post_meta( $post->ID, '_atlas_skill_icon', true );
    $skill_abbreviation = get_post_meta( $post->ID, '_atlas_skill_abbreviation', true );
    $skill_bg_color = get_post_meta( $post->ID, '_atlas_skill_bg_color', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="atlas_skill_icon"><?php esc_html_e( 'Icon Class', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_skill_icon" name="atlas_skill_icon" value="<?php echo esc_attr( $skill_icon ); ?>" class="regular-text" placeholder="e.g., wordpress, programming-atlas" /></td>
        </tr>
        <tr>
            <th><label for="atlas_skill_abbreviation"><?php esc_html_e( 'Abbreviation', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_skill_abbreviation" name="atlas_skill_abbreviation" value="<?php echo esc_attr( $skill_abbreviation ); ?>" class="regular-text" placeholder="e.g., WP, CODE, AI" /></td>
        </tr>
        <tr>
            <th><label for="atlas_skill_bg_color"><?php esc_html_e( 'Background Color', 'atlas-theme' ); ?></label></th>
            <td><input type="color" id="atlas_skill_bg_color" name="atlas_skill_bg_color" value="<?php echo esc_attr( $skill_bg_color ); ?>" /></td>
        </tr>
    </table>
    <?php
}

/**
 * Timeline Meta Box Callback
 */
function atlas_theme_timeline_meta_callback( $post ) {
    wp_nonce_field( 'atlas_theme_timeline_meta', 'atlas_theme_timeline_meta_nonce' );
    
    $timeline_date = get_post_meta( $post->ID, '_atlas_timeline_date', true );
    $timeline_type = get_post_meta( $post->ID, '_atlas_timeline_type', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="atlas_timeline_date"><?php esc_html_e( 'Date/Period', 'atlas-theme' ); ?></label></th>
            <td><input type="text" id="atlas_timeline_date" name="atlas_timeline_date" value="<?php echo esc_attr( $timeline_date ); ?>" class="regular-text" placeholder="e.g., 2020-2021, 2025 - Present" /></td>
        </tr>
        <tr>
            <th><label for="atlas_timeline_type"><?php esc_html_e( 'Type', 'atlas-theme' ); ?></label></th>
            <td>
                <select id="atlas_timeline_type" name="atlas_timeline_type">
                    <option value="education" <?php selected( $timeline_type, 'education' ); ?>><?php esc_html_e( 'Education', 'atlas-theme' ); ?></option>
                    <option value="experience" <?php selected( $timeline_type, 'experience' ); ?>><?php esc_html_e( 'Experience', 'atlas-theme' ); ?></option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Meta Box Data
 */
function atlas_theme_save_meta_boxes( $post_id ) {
    
    // Check if this is an autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check if user has permissions to save data
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save Project Meta
    if ( isset( $_POST['atlas_theme_project_meta_nonce'] ) && wp_verify_nonce( $_POST['atlas_theme_project_meta_nonce'], 'atlas_theme_project_meta' ) ) {
        if ( isset( $_POST['atlas_project_url'] ) ) {
            update_post_meta( $post_id, '_atlas_project_url', sanitize_url( $_POST['atlas_project_url'] ) );
        }
        if ( isset( $_POST['atlas_project_category'] ) ) {
            update_post_meta( $post_id, '_atlas_project_category', sanitize_text_field( $_POST['atlas_project_category'] ) );
        }
        if ( isset( $_POST['atlas_project_client'] ) ) {
            update_post_meta( $post_id, '_atlas_project_client', sanitize_text_field( $_POST['atlas_project_client'] ) );
        }
        if ( isset( $_POST['atlas_project_date'] ) ) {
            update_post_meta( $post_id, '_atlas_project_date', sanitize_text_field( $_POST['atlas_project_date'] ) );
        }
        if ( isset( $_POST['atlas_project_technologies'] ) ) {
            update_post_meta( $post_id, '_atlas_project_technologies', sanitize_text_field( $_POST['atlas_project_technologies'] ) );
        }
        if ( isset( $_POST['atlas_project_challenges'] ) ) {
            update_post_meta( $post_id, '_atlas_project_challenges', sanitize_textarea_field( $_POST['atlas_project_challenges'] ) );
        }
        if ( isset( $_POST['atlas_project_solutions'] ) ) {
            update_post_meta( $post_id, '_atlas_project_solutions', sanitize_textarea_field( $_POST['atlas_project_solutions'] ) );
        }
        if ( isset( $_POST['atlas_project_results'] ) ) {
            update_post_meta( $post_id, '_atlas_project_results', sanitize_textarea_field( $_POST['atlas_project_results'] ) );
        }
        if ( isset( $_POST['atlas_project_gallery'] ) ) {
            update_post_meta( $post_id, '_atlas_project_gallery', sanitize_text_field( $_POST['atlas_project_gallery'] ) );
        }
    }
    
    // Save Skill Meta
    if ( isset( $_POST['atlas_theme_skill_meta_nonce'] ) && wp_verify_nonce( $_POST['atlas_theme_skill_meta_nonce'], 'atlas_theme_skill_meta' ) ) {
        if ( isset( $_POST['atlas_skill_icon'] ) ) {
            update_post_meta( $post_id, '_atlas_skill_icon', sanitize_text_field( $_POST['atlas_skill_icon'] ) );
        }
        if ( isset( $_POST['atlas_skill_abbreviation'] ) ) {
            update_post_meta( $post_id, '_atlas_skill_abbreviation', sanitize_text_field( $_POST['atlas_skill_abbreviation'] ) );
        }
        if ( isset( $_POST['atlas_skill_bg_color'] ) ) {
            update_post_meta( $post_id, '_atlas_skill_bg_color', sanitize_hex_color( $_POST['atlas_skill_bg_color'] ) );
        }
    }
    
    // Save Timeline Meta
    if ( isset( $_POST['atlas_theme_timeline_meta_nonce'] ) && wp_verify_nonce( $_POST['atlas_theme_timeline_meta_nonce'], 'atlas_theme_timeline_meta' ) ) {
        if ( isset( $_POST['atlas_timeline_date'] ) ) {
            update_post_meta( $post_id, '_atlas_timeline_date', sanitize_text_field( $_POST['atlas_timeline_date'] ) );
        }
        if ( isset( $_POST['atlas_timeline_type'] ) ) {
            update_post_meta( $post_id, '_atlas_timeline_type', sanitize_text_field( $_POST['atlas_timeline_type'] ) );
        }
    }
    
}
add_action( 'save_post', 'atlas_theme_save_meta_boxes' );
