<?php
/**
 * Single Project Template - Case Study
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        
        <?php
        // Get project meta data
        $project_url = get_post_meta( get_the_ID(), '_atlas_project_url', true );
        $project_category = get_post_meta( get_the_ID(), '_atlas_project_category', true );
        $project_client = get_post_meta( get_the_ID(), '_atlas_project_client', true );
        $project_date = get_post_meta( get_the_ID(), '_atlas_project_date', true );
        $project_technologies = get_post_meta( get_the_ID(), '_atlas_project_technologies', true );
        $project_challenges = get_post_meta( get_the_ID(), '_atlas_project_challenges', true );
        $project_solutions = get_post_meta( get_the_ID(), '_atlas_project_solutions', true );
        $project_results = get_post_meta( get_the_ID(), '_atlas_project_results', true );
        $project_gallery = get_post_meta( get_the_ID(), '_atlas_project_gallery', true );
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'case-study' ); ?>>
            
            <!-- Hero Section -->
            <section class="case-study-hero">
                <div class="container">
                    <div class="case-study-hero-content">
                        <div class="case-study-meta">
                            <?php if ( $project_category ) : ?>
                                <span class="case-study-category"><?php echo esc_html( $project_category ); ?></span>
                            <?php endif; ?>
                            <?php if ( $project_date ) : ?>
                                <span class="case-study-date"><?php echo esc_html( $project_date ); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="case-study-title"><?php the_title(); ?></h1>
                        
                        <?php if ( $project_client ) : ?>
                            <p class="case-study-client">
                                <strong><?php esc_html_e( 'Client:', 'atlas-theme' ); ?></strong> 
                                <?php echo esc_html( $project_client ); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ( has_excerpt() ) : ?>
                            <div class="case-study-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( $project_url ) : ?>
                            <div class="case-study-actions">
                                <a href="<?php echo esc_url( $project_url ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
                                    <?php esc_html_e( 'View Live Project', 'atlas-theme' ); ?>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="case-study-hero-image">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Project Overview -->
            <section class="case-study-overview">
                <div class="container">
                    <div class="case-study-content">
                        <div class="case-study-main-content">
                            <h2><?php esc_html_e( 'Project Overview', 'atlas-theme' ); ?></h2>
                            <?php the_content(); ?>
                        </div>
                        
                        <div class="case-study-sidebar">
                            <?php if ( $project_technologies ) : ?>
                                <div class="case-study-info-box">
                                    <h3><?php esc_html_e( 'Technologies Used', 'atlas-theme' ); ?></h3>
                                    <div class="technologies-list">
                                        <?php 
                                        $technologies = explode( ',', $project_technologies );
                                        foreach ( $technologies as $tech ) {
                                            echo '<span class="tech-tag">' . esc_html( trim( $tech ) ) . '</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="case-study-info-box">
                                <h3><?php esc_html_e( 'Project Details', 'atlas-theme' ); ?></h3>
                                <ul class="project-details">
                                    <?php if ( $project_client ) : ?>
                                        <li>
                                            <strong><?php esc_html_e( 'Client:', 'atlas-theme' ); ?></strong>
                                            <span><?php echo esc_html( $project_client ); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( $project_date ) : ?>
                                        <li>
                                            <strong><?php esc_html_e( 'Date:', 'atlas-theme' ); ?></strong>
                                            <span><?php echo esc_html( $project_date ); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( $project_category ) : ?>
                                        <li>
                                            <strong><?php esc_html_e( 'Category:', 'atlas-theme' ); ?></strong>
                                            <span><?php echo esc_html( $project_category ); ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Challenges Section -->
            <?php if ( $project_challenges ) : ?>
                <section class="case-study-challenges">
                    <div class="container">
                        <div class="case-study-section">
                            <h2><?php esc_html_e( 'Challenges', 'atlas-theme' ); ?></h2>
                            <div class="case-study-text-content">
                                <?php echo wp_kses_post( wpautop( $project_challenges ) ); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Solutions Section -->
            <?php if ( $project_solutions ) : ?>
                <section class="case-study-solutions">
                    <div class="container">
                        <div class="case-study-section">
                            <h2><?php esc_html_e( 'Solutions', 'atlas-theme' ); ?></h2>
                            <div class="case-study-text-content">
                                <?php echo wp_kses_post( wpautop( $project_solutions ) ); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Results Section -->
            <?php if ( $project_results ) : ?>
                <section class="case-study-results">
                    <div class="container">
                        <div class="case-study-section">
                            <h2><?php esc_html_e( 'Results', 'atlas-theme' ); ?></h2>
                            <div class="case-study-text-content">
                                <?php echo wp_kses_post( wpautop( $project_results ) ); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Project Gallery -->
            <?php if ( $project_gallery ) : ?>
                <section class="case-study-gallery">
                    <div class="container">
                        <div class="case-study-section">
                            <h2><?php esc_html_e( 'Project Gallery', 'atlas-theme' ); ?></h2>
                            <div class="project-gallery">
                                <?php
                                $gallery_ids = explode( ',', $project_gallery );
                                foreach ( $gallery_ids as $image_id ) {
                                    $image = wp_get_attachment_image( $image_id, 'large' );
                                    if ( $image ) {
                                        echo '<div class="gallery-item">' . $image . '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Navigation -->
            <section class="case-study-navigation">
                <div class="container">
                    <div class="case-study-nav">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <?php if ( $prev_post ) : ?>
                            <div class="nav-previous">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="nav-link">
                                    <i class="fas fa-chevron-left"></i>
                                    <div class="nav-content">
                                        <span class="nav-label"><?php esc_html_e( 'Previous Project', 'atlas-theme' ); ?></span>
                                        <span class="nav-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="nav-back">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">
                                <i class="fas fa-home"></i>
                                <span><?php esc_html_e( 'Back to Home', 'atlas-theme' ); ?></span>
                            </a>
                        </div>
                        
                        <?php if ( $next_post ) : ?>
                            <div class="nav-next">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="nav-link">
                                    <div class="nav-content">
                                        <span class="nav-label"><?php esc_html_e( 'Next Project', 'atlas-theme' ); ?></span>
                                        <span class="nav-title"><?php echo esc_html( $next_post->post_title ); ?></span>
                                    </div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
