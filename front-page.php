<?php
/**
 * The front page template file
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-bg">
        <div class="wave-lines"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-left">
                <?php
                $hero_greeting = get_option( 'atlas_hero_greeting', esc_html__( 'Hey, my name is', 'atlas-theme' ) );
                $hero_name = get_option( 'atlas_hero_name', 'LUIS MARQUES' );
                $hero_underlined = get_option( 'atlas_hero_underlined', 'MARQUES' );
                $hero_role = get_option( 'atlas_hero_role', 'WEBMASTER & BUILDER' );
                ?>
                <p class="hero-subtitle"><?php echo esc_html( $hero_greeting ); ?></p>
                <h1 class="hero-title">
                    <?php echo esc_html( $hero_name ); ?>
                    <span class="underline-yellow"><?php echo esc_html( $hero_underlined ); ?></span>
                </h1>
                <p class="hero-role"><?php echo esc_html( $hero_role ); ?></p>
            </div>
            
            <div class="hero-center">
                <div class="hero-image">
                    <?php
                    $hero_image = get_option( 'atlas_hero_image' );
                    if ( $hero_image ) {
                        echo wp_get_attachment_image( $hero_image, 'atlas-hero', false, array( 'class' => 'profile-img' ) );
                    } else {
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/luis-marques-profile.png' ) . '" alt="' . esc_attr( $hero_name ) . '" class="profile-img">';
                    }
                    ?>
                </div>
            </div>
            
            <div class="hero-right">
                <?php
                $stats = get_option( 'atlas_hero_stats', array() );
                if ( ! empty( $stats ) ) {
                    foreach ( $stats as $stat ) {
                        if ( ! empty( $stat['label'] ) && ! empty( $stat['value'] ) ) {
                            echo '<div class="stat">';
                            echo '<p class="stat-label">' . esc_html( $stat['label'] ) . '</p>';
                            echo '<p class="stat-value">' . esc_html( $stat['value'] ) . '</p>';
                            echo '</div>';
                        }
                    }
                } else {
                    // Default stats
                    echo '<div class="stat">';
                    echo '<p class="stat-label">' . esc_html__( 'Years of experience in Tech & Digital', 'atlas-theme' ) . '</p>';
                    echo '<p class="stat-value">15+</p>';
                    echo '</div>';
                    
                    echo '<div class="stat">';
                    echo '<p class="stat-label">' . esc_html__( 'Companies Founded and Led', 'atlas-theme' ) . '</p>';
                    echo '<p class="stat-value">3</p>';
                    echo '</div>';
                    
                    echo '<div class="stat">';
                    echo '<p class="stat-label">' . esc_html__( 'Social Media Communities & Content Managed', 'atlas-theme' ) . '</p>';
                    echo '<p class="stat-value">10+</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="skills">
    <div class="container">
        <div class="skills-grid">
            <?php
            $skills_query = new WP_Query( array(
                'post_type'      => 'atlas_skill',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );
            
            if ( $skills_query->have_posts() ) {
                while ( $skills_query->have_posts() ) {
                    $skills_query->the_post();
                    
                    $skill_icon = get_post_meta( get_the_ID(), '_atlas_skill_icon', true );
                    $skill_abbreviation = get_post_meta( get_the_ID(), '_atlas_skill_abbreviation', true );
                    $skill_bg_color = get_post_meta( get_the_ID(), '_atlas_skill_bg_color', true );
                    
                    $icon_class = ! empty( $skill_icon ) ? $skill_icon : 'default-skill';
                    $abbreviation = ! empty( $skill_abbreviation ) ? $skill_abbreviation : substr( get_the_title(), 0, 4 );
                    $bg_color = ! empty( $skill_bg_color ) ? $skill_bg_color : '#134686';
                    ?>
                    <div class="skill-card">
                        <div class="skill-icon <?php echo esc_attr( $icon_class ); ?>" style="background-color: <?php echo esc_attr( $bg_color ); ?>">
                            <span><?php echo esc_html( $abbreviation ); ?></span>
                        </div>
                        <h3 class="skill-name"><?php the_title(); ?></h3>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
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
                        array( 'name' => 'WordPress', 'icon' => 'wordpress', 'abbr' => 'WP' ),
                        array( 'name' => 'Programming', 'icon' => 'programming-atlas', 'abbr' => 'CODE' ),
                        array( 'name' => 'Artificial Intelligence', 'icon' => 'artificial-intelligence', 'abbr' => 'AI' ),
                        array( 'name' => 'Digital Marketing', 'icon' => 'digital-marketing', 'abbr' => 'DM' ),
                        array( 'name' => 'Content Strategy', 'icon' => 'content-strategy', 'abbr' => 'STRAT' ),
                    );
                    
                    foreach ( $default_skills as $skill ) {
                        echo '<div class="skill-card">';
                        echo '<div class="skill-icon ' . esc_attr( $skill['icon'] ) . '">';
                        echo '<span>' . esc_html( $skill['abbr'] ) . '</span>';
                        echo '</div>';
                        echo '<h3 class="skill-name">' . esc_html( $skill['name'] ) . '</h3>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Projects Section -->
<?php if ( get_option( 'atlas_projects_show', 1 ) ) : ?>
<section id="projects" class="projects">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html( get_option( 'atlas_projects_title', __( 'MY LATEST PROJECTS', 'atlas-theme' ) ) ); ?></h2>
            <p class="section-description">
                <?php echo esc_html( get_option( 'atlas_projects_description', __( 'Explore my journey as a webmaster, builder, and entrepreneur. From creating award-winning platforms to leading companies and investing in innovative startups.', 'atlas-theme' ) ) ); ?>
            </p>
        </div>
        
        <div class="projects-grid">
            <?php
            $projects_query = new WP_Query( array(
                'post_type'      => 'atlas_project',
                'posts_per_page' => get_option( 'atlas_projects_limit', 4 ),
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            
            if ( $projects_query->have_posts() ) {
                while ( $projects_query->have_posts() ) {
                    $projects_query->the_post();
                    
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
                    <?php
                }
                wp_reset_postdata();
            } else {
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
            }
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Education & Experience Section -->
<section id="about" class="education-experience">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'EDUCATION & EXPERIENCE', 'atlas-theme' ); ?></h2>
        
        <div class="timeline-container">
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
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date"><?php echo esc_html( $timeline_date ); ?></div>
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
                        echo '<div class="timeline-dot"></div>';
                        echo '<div class="timeline-content">';
                        echo '<div class="timeline-date">' . esc_html( $item['date'] ) . '</div>';
                        echo '<h3 class="timeline-title">' . esc_html( $item['title'] ) . '</h3>';
                        echo '<p class="timeline-description">' . esc_html( $item['desc'] ) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            
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
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date"><?php echo esc_html( $timeline_date ); ?></div>
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
                        echo '<div class="timeline-dot"></div>';
                        echo '<div class="timeline-content">';
                        echo '<div class="timeline-date">' . esc_html( $item['date'] ) . '</div>';
                        echo '<h3 class="timeline-title">' . esc_html( $item['title'] ) . '</h3>';
                        echo '<p class="timeline-description">' . esc_html( $item['desc'] ) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
