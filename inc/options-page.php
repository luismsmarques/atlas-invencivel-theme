<?php
/**
 * Atlas Theme Options Page
 * Classic WordPress admin options page for homepage management
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Atlas Theme Options Page to Admin Menu
 */
function atlas_theme_add_options_page() {
    add_menu_page(
        __( 'Atlas Theme Options', 'atlas-theme' ),
        __( 'Atlas Theme', 'atlas-theme' ),
        'manage_options',
        'atlas-theme-options',
        'atlas_theme_options_page',
        'dashicons-admin-customizer',
        30
    );
}
add_action( 'admin_menu', 'atlas_theme_add_options_page' );

/**
 * Enqueue Admin Scripts for Options Page
 */
function atlas_theme_enqueue_admin_scripts( $hook ) {
    if ( 'toplevel_page_atlas-theme-options' !== $hook ) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script( 'jquery' );
}
add_action( 'admin_enqueue_scripts', 'atlas_theme_enqueue_admin_scripts' );

/**
 * Register Theme Options
 */
function atlas_theme_register_options() {
    // Hero Section Options
    register_setting( 'atlas_theme_options', 'atlas_hero_greeting', array(
        'default' => __( 'Hey, my name is', 'atlas-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_hero_name', array(
        'default' => 'LUIS MARQUES',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_hero_underlined', array(
        'default' => 'MARQUES',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_hero_role', array(
        'default' => 'WEBMASTER & BUILDER',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_hero_image', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_hero_stats', array(
        'default' => array(
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
        ),
        'sanitize_callback' => 'atlas_theme_sanitize_hero_stats',
    ) );
    
    // Logo Options
    register_setting( 'atlas_theme_options', 'atlas_logo_icon', array(
        'default' => 'A',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_logo_text', array(
        'default' => 'ATLAS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    // Color Options
    register_setting( 'atlas_theme_options', 'atlas_primary_color', array(
        'default' => '#134686',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_secondary_color', array(
        'default' => '#FEB21A',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_background_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    // Social Links
    register_setting( 'atlas_theme_options', 'atlas_social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_social_twitter', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_social_dribbble', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_social_instagram', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    // Footer Options
    register_setting( 'atlas_theme_options', 'atlas_footer_copyright', array(
        'default' => '© 2025 - Atlas Invencível - Lda',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_footer_logo_icon', array(
        'default' => 'A',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_footer_logo_text', array(
        'default' => 'ATLAS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    // Skills Options
    register_setting( 'atlas_theme_options', 'atlas_skills', array(
        'default' => array(
            array(
                'title' => __( 'WordPress', 'atlas-theme' ),
                'acronym' => 'WP',
                'color' => 'wordpress',
            ),
            array(
                'title' => __( 'Programming', 'atlas-theme' ),
                'acronym' => 'CODE',
                'color' => 'programming-atlas',
            ),
            array(
                'title' => __( 'Artificial Intelligence', 'atlas-theme' ),
                'acronym' => 'AI',
                'color' => 'artificial-intelligence',
            ),
            array(
                'title' => __( 'Digital Marketing', 'atlas-theme' ),
                'acronym' => 'DM',
                'color' => 'digital-marketing',
            ),
            array(
                'title' => __( 'Content Strategy', 'atlas-theme' ),
                'acronym' => 'STRAT',
                'color' => 'content-strategy',
            ),
        ),
        'sanitize_callback' => 'atlas_theme_sanitize_skills',
    ) );
    
    // Projects Options
    register_setting( 'atlas_theme_options', 'atlas_projects_title', array(
        'default' => __( 'MY LATEST PROJECTS', 'atlas-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_projects_description', array(
        'default' => __( 'Explore my journey as a webmaster, builder, and entrepreneur. From creating award-winning platforms to leading companies and investing in innovative startups.', 'atlas-theme' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_projects_limit', array(
        'default' => 4,
        'sanitize_callback' => 'absint',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_projects_show', array(
        'default' => 1,
        'sanitize_callback' => 'absint',
    ) );
    
    
    // Education/Experience Options
    register_setting( 'atlas_theme_options', 'atlas_timeline_title', array(
        'default' => __( 'MY JOURNEY', 'atlas-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    register_setting( 'atlas_theme_options', 'atlas_timeline_items', array(
        'default' => array(
            array(
                'year' => '2020 - Present',
                'title' => __( 'CEO & Founder', 'atlas-theme' ),
                'company' => __( 'Atlas Invencível', 'atlas-theme' ),
                'description' => __( 'Leading digital transformation initiatives...', 'atlas-theme' ),
                'type' => 'experience',
            ),
            array(
                'year' => '2018 - 2020',
                'title' => __( 'Lead Developer', 'atlas-theme' ),
                'company' => __( 'Tech Solutions Inc', 'atlas-theme' ),
                'description' => __( 'Developed scalable web applications...', 'atlas-theme' ),
                'type' => 'experience',
            ),
        ),
        'sanitize_callback' => 'atlas_theme_sanitize_timeline_items',
    ) );
}
add_action( 'admin_init', 'atlas_theme_register_options' );

/**
 * Sanitize Hero Stats
 */
function atlas_theme_sanitize_hero_stats( $input ) {
    if ( ! is_array( $input ) ) {
        return array();
    }
    
    $sanitized = array();
    foreach ( $input as $stat ) {
        if ( is_array( $stat ) && isset( $stat['label'] ) && isset( $stat['value'] ) ) {
            $sanitized[] = array(
                'label' => sanitize_text_field( $stat['label'] ),
                'value' => sanitize_text_field( $stat['value'] ),
            );
        }
    }
    
    return $sanitized;
}

/**
 * Sanitize Skills
 */
function atlas_theme_sanitize_skills( $input ) {
    if ( ! is_array( $input ) ) {
        return array();
    }
    
    $sanitized = array();
    foreach ( $input as $skill ) {
        if ( is_array( $skill ) && isset( $skill['title'] ) && isset( $skill['acronym'] ) && isset( $skill['color'] ) ) {
            $sanitized[] = array(
                'title' => sanitize_text_field( $skill['title'] ),
                'acronym' => sanitize_text_field( $skill['acronym'] ),
                'color' => sanitize_text_field( $skill['color'] ),
            );
        }
    }
    
    return $sanitized;
}


/**
 * Sanitize Timeline Items
 */
function atlas_theme_sanitize_timeline_items( $input ) {
    if ( ! is_array( $input ) ) {
        return array();
    }
    
    $sanitized = array();
    foreach ( $input as $item ) {
        if ( is_array( $item ) && isset( $item['year'] ) && isset( $item['title'] ) ) {
            $sanitized[] = array(
                'year' => sanitize_text_field( $item['year'] ),
                'title' => sanitize_text_field( $item['title'] ),
                'company' => sanitize_text_field( $item['company'] ?? '' ),
                'description' => sanitize_textarea_field( $item['description'] ?? '' ),
                'type' => sanitize_text_field( $item['type'] ?? 'experience' ),
            );
        }
    }
    
    return $sanitized;
}

/**
 * Atlas Theme Options Page HTML
 */
function atlas_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <form method="post" action="options.php">
            <?php
            settings_fields( 'atlas_theme_options' );
            do_settings_sections( 'atlas_theme_options' );
            ?>
            
            <div class="atlas-options-container">
                <div class="atlas-options-tabs">
                    <nav class="nav-tab-wrapper">
                        <a href="#hero-section" class="nav-tab nav-tab-active"><?php _e( 'Hero Section', 'atlas-theme' ); ?></a>
                        <a href="#skills-section" class="nav-tab"><?php _e( 'Skills', 'atlas-theme' ); ?></a>
                        <a href="#projects-section" class="nav-tab"><?php _e( 'Projects', 'atlas-theme' ); ?></a>
                        <a href="#timeline-section" class="nav-tab"><?php _e( 'Education/Experience', 'atlas-theme' ); ?></a>
                        <a href="#logo-section" class="nav-tab"><?php _e( 'Logo', 'atlas-theme' ); ?></a>
                        <a href="#colors-section" class="nav-tab"><?php _e( 'Colors', 'atlas-theme' ); ?></a>
                        <a href="#social-section" class="nav-tab"><?php _e( 'Social Links', 'atlas-theme' ); ?></a>
                        <a href="#footer-section" class="nav-tab"><?php _e( 'Footer', 'atlas-theme' ); ?></a>
                    </nav>
                </div>
                
                <div class="atlas-options-content">
                    <!-- Hero Section -->
                    <div id="hero-section" class="atlas-options-tab-content active">
                        <h2><?php _e( 'Hero Section Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Configure the main hero section content displayed on your homepage.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_greeting"><?php _e( 'Greeting Text', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_hero_greeting" name="atlas_hero_greeting" 
                                           value="<?php echo esc_attr( get_option( 'atlas_hero_greeting' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'The greeting text displayed above your name.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_name"><?php _e( 'Full Name', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_hero_name" name="atlas_hero_name" 
                                           value="<?php echo esc_attr( get_option( 'atlas_hero_name' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Your full name displayed in the hero section.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_underlined"><?php _e( 'Underlined Name Part', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_hero_underlined" name="atlas_hero_underlined" 
                                           value="<?php echo esc_attr( get_option( 'atlas_hero_underlined' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'The part of your name that will be underlined.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_role"><?php _e( 'Role/Title', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_hero_role" name="atlas_hero_role" 
                                           value="<?php echo esc_attr( get_option( 'atlas_hero_role' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Your professional title or role.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_image"><?php _e( 'Profile Image', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <?php
                                    $hero_image_id = get_option( 'atlas_hero_image' );
                                    $hero_image_url = '';
                                    if ( $hero_image_id ) {
                                        $hero_image_url = wp_get_attachment_url( $hero_image_id );
                                    }
                                    ?>
                                    <div class="atlas-image-upload">
                                        <input type="hidden" id="atlas_hero_image" name="atlas_hero_image" 
                                               value="<?php echo esc_attr( $hero_image_id ); ?>" />
                                        <div class="atlas-image-preview">
                                            <?php if ( $hero_image_url ) : ?>
                                                <img src="<?php echo esc_url( $hero_image_url ); ?>" 
                                                     alt="<?php _e( 'Profile Image Preview', 'atlas-theme' ); ?>" 
                                                     style="max-width: 150px; height: auto;" />
                                            <?php else : ?>
                                                <div class="atlas-no-image"><?php _e( 'No image selected', 'atlas-theme' ); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <button type="button" class="button atlas-upload-button">
                                            <?php _e( 'Select Image', 'atlas-theme' ); ?>
                                        </button>
                                        <button type="button" class="button atlas-remove-button" 
                                                style="<?php echo $hero_image_id ? '' : 'display: none;'; ?>">
                                            <?php _e( 'Remove Image', 'atlas-theme' ); ?>
                                        </button>
                                    </div>
                                    <p class="description"><?php _e( 'Upload your profile image for the hero section.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_hero_stats"><?php _e( 'Hero Statistics', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <?php
                                    $hero_stats = get_option( 'atlas_hero_stats', array() );
                                    if ( empty( $hero_stats ) ) {
                                        $hero_stats = array(
                                            array( 'label' => '', 'value' => '' ),
                                            array( 'label' => '', 'value' => '' ),
                                            array( 'label' => '', 'value' => '' ),
                                        );
                                    }
                                    ?>
                                    <div class="atlas-stats-repeater">
                                        <?php foreach ( $hero_stats as $index => $stat ) : ?>
                                            <div class="atlas-stat-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
                                                <div style="display: flex; gap: 10px; align-items: center;">
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Label', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_hero_stats[<?php echo $index; ?>][label]" 
                                                               value="<?php echo esc_attr( $stat['label'] ); ?>" 
                                                               class="regular-text" placeholder="<?php _e( 'Statistic label', 'atlas-theme' ); ?>" />
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Value', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_hero_stats[<?php echo $index; ?>][value]" 
                                                               value="<?php echo esc_attr( $stat['value'] ); ?>" 
                                                               class="regular-text" placeholder="<?php _e( 'Statistic value', 'atlas-theme' ); ?>" />
                                                    </div>
                                                    <div>
                                                        <button type="button" class="button atlas-remove-stat" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <button type="button" class="button atlas-add-stat"><?php _e( 'Add Statistic', 'atlas-theme' ); ?></button>
                                    </div>
                                    <p class="description"><?php _e( 'Add statistics to display in the hero section.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Skills Section -->
                    <div id="skills-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Skills Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Manage the skills displayed on your homepage.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_skills"><?php _e( 'Skills', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <?php
                                    $skills = get_option( 'atlas_skills', array() );
                                    if ( empty( $skills ) ) {
                                        $skills = array(
                                            array( 'title' => '', 'acronym' => '', 'color' => '' ),
                                            array( 'title' => '', 'acronym' => '', 'color' => '' ),
                                            array( 'title' => '', 'acronym' => '', 'color' => '' ),
                                        );
                                    }
                                    ?>
                                    <div class="atlas-skills-repeater">
                                        <?php foreach ( $skills as $index => $skill ) : ?>
                                            <div class="atlas-skill-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
                                                <div style="display: flex; gap: 10px; align-items: center;">
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Title', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_skills[<?php echo $index; ?>][title]" 
                                                               value="<?php echo esc_attr( $skill['title'] ); ?>" 
                                                               class="regular-text" placeholder="<?php _e( 'Skill title', 'atlas-theme' ); ?>" />
                                                    </div>
                                                    <div style="flex: 0 0 100px;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Acronym', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_skills[<?php echo $index; ?>][acronym]" 
                                                               value="<?php echo esc_attr( $skill['acronym'] ); ?>" 
                                                               class="regular-text" placeholder="WP" maxlength="10" />
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Color Class', 'atlas-theme' ); ?></label>
                                                        <select name="atlas_skills[<?php echo $index; ?>][color]" class="regular-text">
                                                            <option value="wordpress" <?php selected( $skill['color'], 'wordpress' ); ?>><?php _e( 'WordPress (Blue)', 'atlas-theme' ); ?></option>
                                                            <option value="programming-atlas" <?php selected( $skill['color'], 'programming-atlas' ); ?>><?php _e( 'Programming (Purple)', 'atlas-theme' ); ?></option>
                                                            <option value="artificial-intelligence" <?php selected( $skill['color'], 'artificial-intelligence' ); ?>><?php _e( 'AI (Green)', 'atlas-theme' ); ?></option>
                                                            <option value="digital-marketing" <?php selected( $skill['color'], 'digital-marketing' ); ?>><?php _e( 'Digital Marketing (Orange)', 'atlas-theme' ); ?></option>
                                                            <option value="content-strategy" <?php selected( $skill['color'], 'content-strategy' ); ?>><?php _e( 'Content Strategy (Red)', 'atlas-theme' ); ?></option>
                                                            <option value="custom" <?php selected( $skill['color'], 'custom' ); ?>><?php _e( 'Custom', 'atlas-theme' ); ?></option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="button atlas-remove-skill" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <button type="button" class="button atlas-add-skill"><?php _e( 'Add Skill', 'atlas-theme' ); ?></button>
                                    </div>
                                    <p class="description"><?php _e( 'Add skills to display in the skills section. Each skill will have a title, acronym, and color theme.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Projects Section -->
                    <div id="projects-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Projects Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Configure the projects section displayed on your homepage.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_projects_title"><?php _e( 'Projects Section Title', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_projects_title" name="atlas_projects_title" 
                                           value="<?php echo esc_attr( get_option( 'atlas_projects_title' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Title displayed above the projects section.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_projects_description"><?php _e( 'Projects Description', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <textarea id="atlas_projects_description" name="atlas_projects_description" 
                                              rows="3" cols="50" class="large-text"><?php echo esc_textarea( get_option( 'atlas_projects_description' ) ); ?></textarea>
                                    <p class="description"><?php _e( 'Description text displayed below the projects title.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_projects_limit"><?php _e( 'Projects Limit', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="number" id="atlas_projects_limit" name="atlas_projects_limit" 
                                           value="<?php echo esc_attr( get_option( 'atlas_projects_limit' ) ); ?>" 
                                           class="small-text" min="1" max="20" />
                                    <p class="description"><?php _e( 'Maximum number of projects to display.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_projects_show"><?php _e( 'Show Projects Section', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" id="atlas_projects_show" name="atlas_projects_show" 
                                               value="1" <?php checked( get_option( 'atlas_projects_show', 1 ), 1 ); ?> />
                                        <?php _e( 'Display the projects section on the frontend', 'atlas-theme' ); ?>
                                    </label>
                                    <p class="description"><?php _e( 'Check to show the projects section, uncheck to hide it completely.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Timeline Section -->
                    <div id="timeline-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Education/Experience Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Manage your career timeline displayed on the homepage.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_timeline_title"><?php _e( 'Timeline Section Title', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_timeline_title" name="atlas_timeline_title" 
                                           value="<?php echo esc_attr( get_option( 'atlas_timeline_title' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Title displayed above the timeline section.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_timeline_items"><?php _e( 'Timeline Items', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <?php
                                    $timeline_items = get_option( 'atlas_timeline_items', array() );
                                    if ( empty( $timeline_items ) ) {
                                        $timeline_items = array(
                                            array( 'year' => '', 'title' => '', 'company' => '', 'description' => '', 'type' => 'experience' ),
                                            array( 'year' => '', 'title' => '', 'company' => '', 'description' => '', 'type' => 'experience' ),
                                        );
                                    }
                                    ?>
                                    <div class="atlas-timeline-repeater">
                                        <?php foreach ( $timeline_items as $index => $item ) : ?>
                                            <div class="atlas-timeline-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
                                                <div style="display: flex; gap: 10px; align-items: flex-start;">
                                                    <div style="flex: 0 0 120px;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Year/Period', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_timeline_items[<?php echo $index; ?>][year]" 
                                                               value="<?php echo esc_attr( $item['year'] ); ?>" 
                                                               class="regular-text" placeholder="2020 - Present" />
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Title/Position', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_timeline_items[<?php echo $index; ?>][title]" 
                                                               value="<?php echo esc_attr( $item['title'] ); ?>" 
                                                               class="regular-text" placeholder="<?php _e( 'Job title', 'atlas-theme' ); ?>" />
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Company/Institution', 'atlas-theme' ); ?></label>
                                                        <input type="text" name="atlas_timeline_items[<?php echo $index; ?>][company]" 
                                                               value="<?php echo esc_attr( $item['company'] ); ?>" 
                                                               class="regular-text" placeholder="<?php _e( 'Company name', 'atlas-theme' ); ?>" />
                                                    </div>
                                                    <div style="flex: 0 0 100px;">
                                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Type', 'atlas-theme' ); ?></label>
                                                        <select name="atlas_timeline_items[<?php echo $index; ?>][type]" class="regular-text">
                                                            <option value="experience" <?php selected( $item['type'], 'experience' ); ?>><?php _e( 'Experience', 'atlas-theme' ); ?></option>
                                                            <option value="education" <?php selected( $item['type'], 'education' ); ?>><?php _e( 'Education', 'atlas-theme' ); ?></option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="button atlas-remove-timeline" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Description', 'atlas-theme' ); ?></label>
                                                    <textarea name="atlas_timeline_items[<?php echo $index; ?>][description]" 
                                                              rows="2" cols="50" class="large-text" 
                                                              placeholder="<?php _e( 'Brief description of your role or achievement', 'atlas-theme' ); ?>"><?php echo esc_textarea( $item['description'] ); ?></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <button type="button" class="button atlas-add-timeline"><?php _e( 'Add Timeline Item', 'atlas-theme' ); ?></button>
                                    </div>
                                    <p class="description"><?php _e( 'Add items to your career timeline. You can include both work experience and education.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Logo Section -->
                    <div id="logo-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Logo Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Configure your site logo displayed in the header.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_logo_icon"><?php _e( 'Logo Icon', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_logo_icon" name="atlas_logo_icon" 
                                           value="<?php echo esc_attr( get_option( 'atlas_logo_icon' ) ); ?>" 
                                           class="regular-text" maxlength="1" />
                                    <p class="description"><?php _e( 'Single character or symbol for your logo icon.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_logo_text"><?php _e( 'Logo Text', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_logo_text" name="atlas_logo_text" 
                                           value="<?php echo esc_attr( get_option( 'atlas_logo_text' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Text displayed next to your logo icon.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Colors Section -->
                    <div id="colors-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Color Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Customize the color scheme of your website.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_primary_color"><?php _e( 'Primary Color', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="color" id="atlas_primary_color" name="atlas_primary_color" 
                                           value="<?php echo esc_attr( get_option( 'atlas_primary_color' ) ); ?>" />
                                    <p class="description"><?php _e( 'Main brand color used throughout the site.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_secondary_color"><?php _e( 'Secondary Color', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="color" id="atlas_secondary_color" name="atlas_secondary_color" 
                                           value="<?php echo esc_attr( get_option( 'atlas_secondary_color' ) ); ?>" />
                                    <p class="description"><?php _e( 'Accent color for highlights and special elements.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_background_color"><?php _e( 'Background Color', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="color" id="atlas_background_color" name="atlas_background_color" 
                                           value="<?php echo esc_attr( get_option( 'atlas_background_color' ) ); ?>" />
                                    <p class="description"><?php _e( 'Main background color for sections.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Social Links Section -->
                    <div id="social-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Social Media Links', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Add your social media profiles to display in the footer.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_social_linkedin"><?php _e( 'LinkedIn URL', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="url" id="atlas_social_linkedin" name="atlas_social_linkedin" 
                                           value="<?php echo esc_attr( get_option( 'atlas_social_linkedin' ) ); ?>" 
                                           class="regular-text" placeholder="https://linkedin.com/in/yourprofile" />
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_social_twitter"><?php _e( 'Twitter/X URL', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="url" id="atlas_social_twitter" name="atlas_social_twitter" 
                                           value="<?php echo esc_attr( get_option( 'atlas_social_twitter' ) ); ?>" 
                                           class="regular-text" placeholder="https://twitter.com/yourprofile" />
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_social_dribbble"><?php _e( 'Dribbble URL', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="url" id="atlas_social_dribbble" name="atlas_social_dribbble" 
                                           value="<?php echo esc_attr( get_option( 'atlas_social_dribbble' ) ); ?>" 
                                           class="regular-text" placeholder="https://dribbble.com/yourprofile" />
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_social_instagram"><?php _e( 'Instagram URL', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="url" id="atlas_social_instagram" name="atlas_social_instagram" 
                                           value="<?php echo esc_attr( get_option( 'atlas_social_instagram' ) ); ?>" 
                                           class="regular-text" placeholder="https://instagram.com/yourprofile" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Footer Section -->
                    <div id="footer-section" class="atlas-options-tab-content">
                        <h2><?php _e( 'Footer Settings', 'atlas-theme' ); ?></h2>
                        <p><?php _e( 'Configure the footer content and branding.', 'atlas-theme' ); ?></p>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="atlas_footer_copyright"><?php _e( 'Copyright Text', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <textarea id="atlas_footer_copyright" name="atlas_footer_copyright" 
                                              rows="3" cols="50" class="large-text"><?php echo esc_textarea( get_option( 'atlas_footer_copyright' ) ); ?></textarea>
                                    <p class="description"><?php _e( 'Copyright text displayed in the footer.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_footer_logo_icon"><?php _e( 'Footer Logo Icon', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_footer_logo_icon" name="atlas_footer_logo_icon" 
                                           value="<?php echo esc_attr( get_option( 'atlas_footer_logo_icon' ) ); ?>" 
                                           class="regular-text" maxlength="1" />
                                    <p class="description"><?php _e( 'Logo icon for the footer.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="atlas_footer_logo_text"><?php _e( 'Footer Logo Text', 'atlas-theme' ); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="atlas_footer_logo_text" name="atlas_footer_logo_text" 
                                           value="<?php echo esc_attr( get_option( 'atlas_footer_logo_text' ) ); ?>" 
                                           class="regular-text" />
                                    <p class="description"><?php _e( 'Logo text for the footer.', 'atlas-theme' ); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <?php submit_button(); ?>
        </form>
    </div>
    
    <style>
    .atlas-options-container {
        max-width: 1200px;
    }
    
    .atlas-options-tab-content {
        display: none;
        padding: 20px 0;
    }
    
    .atlas-options-tab-content.active {
        display: block;
    }
    
    .atlas-image-upload {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .atlas-image-preview {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 4px;
        min-width: 150px;
        text-align: center;
    }
    
    .atlas-no-image {
        color: #666;
        font-style: italic;
        padding: 20px;
    }
    
    .form-table th {
        width: 200px;
    }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Tab functionality
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            var target = $(this).attr('href');
            
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            $('.atlas-options-tab-content').removeClass('active');
            $(target).addClass('active');
        });
        
        // Image upload functionality
        var mediaUploader;
        
        $('.atlas-upload-button').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var input = button.siblings('input[type="hidden"]');
            var preview = button.siblings('.atlas-image-preview');
            var removeButton = button.siblings('.atlas-remove-button');
            
            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            // Create the media frame
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Select Profile Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            // When an image is selected, run a callback
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                
                // Update the hidden input field
                input.val(attachment.id);
                
                // Update the preview
                preview.html('<img src="' + attachment.url + '" alt="Profile Image Preview" style="max-width: 150px; height: auto;" />');
                
                // Show the remove button
                removeButton.show();
            });
            
            // Open the uploader dialog
            mediaUploader.open();
        });
        
        $('.atlas-remove-button').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var input = button.siblings('input[type="hidden"]');
            var preview = button.siblings('.atlas-image-preview');
            
            // Clear the input value
            input.val('');
            
            // Reset the preview
            preview.html('<div class="atlas-no-image">No image selected</div>');
            
            // Hide the remove button
            button.hide();
        });
        
        // Stats repeater functionality
        var statIndex = <?php echo count( $hero_stats ); ?>;
        
        $('.atlas-add-stat').on('click', function() {
            var newStatHtml = '<div class="atlas-stat-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">' +
                '<div style="display: flex; gap: 10px; align-items: center;">' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Label', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_hero_stats[' + statIndex + '][label]" value="" class="regular-text" placeholder="<?php _e( 'Statistic label', 'atlas-theme' ); ?>" />' +
                    '</div>' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Value', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_hero_stats[' + statIndex + '][value]" value="" class="regular-text" placeholder="<?php _e( 'Statistic value', 'atlas-theme' ); ?>" />' +
                    '</div>' +
                    '<div>' +
                        '<button type="button" class="button atlas-remove-stat" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>' +
                    '</div>' +
                '</div>' +
            '</div>';
            
            $('.atlas-stats-repeater').append(newStatHtml);
            statIndex++;
        });
        
        $(document).on('click', '.atlas-remove-stat', function() {
            $(this).closest('.atlas-stat-item').remove();
        });
        
        // Skills repeater functionality
        var skillIndex = <?php echo count( $skills ); ?>;
        
        $('.atlas-add-skill').on('click', function() {
            var newSkillHtml = '<div class="atlas-skill-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">' +
                '<div style="display: flex; gap: 10px; align-items: center;">' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Title', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_skills[' + skillIndex + '][title]" value="" class="regular-text" placeholder="<?php _e( 'Skill title', 'atlas-theme' ); ?>" />' +
                    '</div>' +
                    '<div style="flex: 0 0 100px;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Acronym', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_skills[' + skillIndex + '][acronym]" value="" class="regular-text" placeholder="WP" maxlength="10" />' +
                    '</div>' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Color Class', 'atlas-theme' ); ?></label>' +
                        '<select name="atlas_skills[' + skillIndex + '][color]" class="regular-text">' +
                            '<option value="wordpress"><?php _e( 'WordPress (Blue)', 'atlas-theme' ); ?></option>' +
                            '<option value="programming-atlas"><?php _e( 'Programming (Purple)', 'atlas-theme' ); ?></option>' +
                            '<option value="artificial-intelligence"><?php _e( 'AI (Green)', 'atlas-theme' ); ?></option>' +
                            '<option value="digital-marketing"><?php _e( 'Digital Marketing (Orange)', 'atlas-theme' ); ?></option>' +
                            '<option value="content-strategy"><?php _e( 'Content Strategy (Red)', 'atlas-theme' ); ?></option>' +
                            '<option value="custom"><?php _e( 'Custom', 'atlas-theme' ); ?></option>' +
                        '</select>' +
                    '</div>' +
                    '<div>' +
                        '<button type="button" class="button atlas-remove-skill" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>' +
                    '</div>' +
                '</div>' +
            '</div>';
            
            $('.atlas-skills-repeater').append(newSkillHtml);
            skillIndex++;
        });
        
        $(document).on('click', '.atlas-remove-skill', function() {
            $(this).closest('.atlas-skill-item').remove();
        });
        
        
        // Timeline repeater functionality
        var timelineIndex = <?php echo count( $timeline_items ); ?>;
        
        $('.atlas-add-timeline').on('click', function() {
            var newTimelineHtml = '<div class="atlas-timeline-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">' +
                '<div style="display: flex; gap: 10px; align-items: flex-start;">' +
                    '<div style="flex: 0 0 120px;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Year/Period', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_timeline_items[' + timelineIndex + '][year]" value="" class="regular-text" placeholder="2020 - Present" />' +
                    '</div>' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Title/Position', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_timeline_items[' + timelineIndex + '][title]" value="" class="regular-text" placeholder="<?php _e( 'Job title', 'atlas-theme' ); ?>" />' +
                    '</div>' +
                    '<div style="flex: 1;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Company/Institution', 'atlas-theme' ); ?></label>' +
                        '<input type="text" name="atlas_timeline_items[' + timelineIndex + '][company]" value="" class="regular-text" placeholder="<?php _e( 'Company name', 'atlas-theme' ); ?>" />' +
                    '</div>' +
                    '<div style="flex: 0 0 100px;">' +
                        '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Type', 'atlas-theme' ); ?></label>' +
                        '<select name="atlas_timeline_items[' + timelineIndex + '][type]" class="regular-text">' +
                            '<option value="experience"><?php _e( 'Experience', 'atlas-theme' ); ?></option>' +
                            '<option value="education"><?php _e( 'Education', 'atlas-theme' ); ?></option>' +
                        '</select>' +
                    '</div>' +
                    '<div>' +
                        '<button type="button" class="button atlas-remove-timeline" style="margin-top: 20px;"><?php _e( 'Remove', 'atlas-theme' ); ?></button>' +
                    '</div>' +
                '</div>' +
                '<div style="margin-top: 10px;">' +
                    '<label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php _e( 'Description', 'atlas-theme' ); ?></label>' +
                    '<textarea name="atlas_timeline_items[' + timelineIndex + '][description]" rows="2" cols="50" class="large-text" placeholder="<?php _e( 'Brief description of your role or achievement', 'atlas-theme' ); ?>"></textarea>' +
                '</div>' +
            '</div>';
            
            $('.atlas-timeline-repeater').append(newTimelineHtml);
            timelineIndex++;
        });
        
        $(document).on('click', '.atlas-remove-timeline', function() {
            $(this).closest('.atlas-timeline-item').remove();
        });
    });
    </script>
    <?php
}
