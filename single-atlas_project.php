<?php
/**
 * Single Project Template - Case Study Page
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        
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
        
        // Get gallery images
        $gallery_images = array();
        if ( ! empty( $project_gallery ) ) {
            $image_ids = explode( ',', $project_gallery );
            foreach ( $image_ids as $image_id ) {
                $image_id = trim( $image_id );
                if ( is_numeric( $image_id ) ) {
                    $gallery_images[] = wp_get_attachment_image_src( $image_id, 'large' );
                }
            }
        }
        
        // Get technologies array
        $technologies_array = array();
        if ( ! empty( $project_technologies ) ) {
            $technologies_array = array_map( 'trim', explode( ',', $project_technologies ) );
        }
        ?>
        
        <!-- Hero Section -->
        <section class="case-study-hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <div class="project-meta">
                            <?php if ( $project_category ) : ?>
                                <span class="project-category"><?php echo esc_html( $project_category ); ?></span>
                            <?php endif; ?>
                            <?php if ( $project_date ) : ?>
                                <span class="project-date"><?php echo esc_html( $project_date ); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="project-title"><?php the_title(); ?></h1>
                        
                        <?php if ( $project_client ) : ?>
                            <p class="project-client">Client: <?php echo esc_html( $project_client ); ?></p>
                        <?php endif; ?>
                        
                        <?php if ( get_the_excerpt() ) : ?>
                            <div class="project-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( $project_url ) : ?>
                            <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i>
                                View Live Project
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="hero-visual scroll-reveal revealed">
                            <div class="extension-mockup">
                                <div class="mockup-browser">
                                    <div class="browser-header">
                                        <div class="browser-dots">
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </div>
                                        <div class="browser-url">
                                            <?php echo esc_html( $project_url ? parse_url( $project_url, PHP_URL_HOST ) : 'project-demo.com' ); ?>
                                        </div>
                                    </div>
                                    <div class="browser-content">
                                        <div class="project-image-container">
                                            <?php the_post_thumbnail( 'large', array( 'class' => 'project-featured-image' ) ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <!-- Project Overview -->
        <section class="project-overview">
            <div class="container">
                <div class="overview-grid">
                    <div class="overview-content">
                        <h2>Project Overview</h2>
                        <div class="project-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    
                    <div class="overview-sidebar">
                        <div class="project-details">
                            <h3>Project Details</h3>
                            
                            <?php if ( $project_client ) : ?>
                                <div class="detail-item">
                                    <strong>Client:</strong>
                                    <span><?php echo esc_html( $project_client ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $project_date ) : ?>
                                <div class="detail-item">
                                    <strong>Date:</strong>
                                    <span><?php echo esc_html( $project_date ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $project_category ) : ?>
                                <div class="detail-item">
                                    <strong>Category:</strong>
                                    <span><?php echo esc_html( $project_category ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $project_url ) : ?>
                                <div class="detail-item">
                                    <strong>Website:</strong>
                                    <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener">
                                        <?php echo esc_html( parse_url( $project_url, PHP_URL_HOST ) ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( ! empty( $technologies_array ) ) : ?>
                            <div class="technologies">
                                <h3>Technologies Used</h3>
                                <div class="tech-tags">
                                    <?php foreach ( $technologies_array as $tech ) : ?>
                                        <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Challenges Section -->
        <?php if ( $project_challenges ) : ?>
            <section class="project-challenges">
                <div class="container">
                    <div class="challenges-content">
                        <h2>Challenges</h2>
                        <div class="challenges-text">
                            <?php echo wp_kses_post( wpautop( $project_challenges ) ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Solutions Section -->
        <?php if ( $project_solutions ) : ?>
            <section class="project-solutions">
                <div class="container">
                    <div class="solutions-content">
                        <h2>Solutions</h2>
                        <div class="solutions-text">
                            <?php echo wp_kses_post( wpautop( $project_solutions ) ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Results Section -->
        <?php if ( $project_results ) : ?>
            <section class="project-results">
                <div class="container">
                    <div class="results-content">
                        <h2>Results</h2>
                        <div class="results-text">
                            <?php echo wp_kses_post( wpautop( $project_results ) ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Project Gallery -->
        <?php if ( ! empty( $gallery_images ) ) : ?>
            <section class="project-gallery">
                <div class="container">
                    <h2>Project Gallery</h2>
                    <div class="gallery-grid">
                        <?php foreach ( $gallery_images as $image ) : ?>
                            <?php if ( $image ) : ?>
                                <div class="gallery-item">
                                    <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Navigation -->
        <section class="project-navigation">
            <div class="container">
                <div class="nav-grid">
                    <div class="nav-item nav-prev">
                        <?php
                        $prev_post = get_previous_post( false, '', 'atlas_project' );
                        if ( $prev_post ) :
                        ?>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="nav-link">
                                <i class="fas fa-arrow-left"></i>
                                <div class="nav-content">
                                    <span class="nav-label">Previous Project</span>
                                    <span class="nav-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="nav-item nav-home">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span class="nav-label">Back to Home</span>
                        </a>
                    </div>
                    
                    <div class="nav-item nav-next">
                        <?php
                        $next_post = get_next_post( false, '', 'atlas_project' );
                        if ( $next_post ) :
                        ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="nav-link">
                                <div class="nav-content">
                                    <span class="nav-label">Next Project</span>
                                    <span class="nav-title"><?php echo esc_html( $next_post->post_title ); ?></span>
                                </div>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
