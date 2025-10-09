<?php
/**
 * The main template file
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Blog Hero Section -->
<section class="hero">
    <div class="hero-bg">
        <div class="wave-lines"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-left">
                <h1 class="hero-title"><?php esc_html_e( 'Blog', 'atlas-theme' ); ?></h1>
                <p class="hero-role"><?php esc_html_e( 'Latest insights, tutorials, and thoughts on web development and technology.', 'atlas-theme' ); ?></p>
            </div>
            
            <div class="hero-center">
                <div class="hero-image">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/luis-marques-profile.png' ); ?>" alt="<?php esc_attr_e( 'Blog', 'atlas-theme' ); ?>" class="profile-img">
                </div>
            </div>
            
            <div class="hero-right">
                <div class="stat">
                    <p class="stat-label"><?php esc_html_e( 'Posts Found', 'atlas-theme' ); ?></p>
                    <p class="stat-value"><?php echo esc_html( $wp_query->found_posts ); ?></p>
                </div>
                
                <div class="stat">
                    <p class="stat-label"><?php esc_html_e( 'Page', 'atlas-theme' ); ?></p>
                    <p class="stat-value"><?php echo esc_html( get_query_var( 'paged' ) ?: '1' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content Section -->
<section class="page-content">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'ARTICLES', 'atlas-theme' ); ?></h2>
            <p class="section-description">
                <?php esc_html_e( 'Explore our latest articles and insights on web development, technology, and digital innovation.', 'atlas-theme' ); ?>
            </p>
        </div>
        
        <div class="archive-posts">
            <?php if ( have_posts() ) : ?>
                <div class="archive-posts-list">
                    <?php while ( have_posts() ) : ?>
                        <?php the_post(); ?>
                        
                        <div class="archive-post-item">
                            <div class="archive-post-content">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="archive-post-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="archive-post-text">
                                    <h2 class="archive-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    
                                    <div class="archive-post-meta">
                                        <span class="archive-post-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?php echo esc_html( get_the_date() ); ?>
                                        </span>
                                        
                                        <span class="archive-post-author">
                                            <i class="fas fa-user"></i>
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                        
                                        <?php if ( has_category() ) : ?>
                                            <span class="archive-post-category">
                                                <i class="fas fa-folder"></i>
                                                <?php the_category( ', ' ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="archive-post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <div class="archive-post-footer">
                                        <?php if ( has_tag() ) : ?>
                                            <div class="archive-post-tags">
                                                <?php the_tags( '', '', '' ); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <a href="<?php the_permalink(); ?>" class="archive-read-more">
                                            <?php esc_html_e( 'Read More', 'atlas-theme' ); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <div class="archive-pagination">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> ' . esc_html__( 'Previous', 'atlas-theme' ),
                        'next_text' => esc_html__( 'Next', 'atlas-theme' ) . ' <i class="fas fa-chevron-right"></i>',
                    ) );
                    ?>
                </div>
                
            <?php else : ?>
                <div class="no-posts">
                    <h2><?php esc_html_e( 'Nothing Found', 'atlas-theme' ); ?></h2>
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'atlas-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="contact-cta-section">
    <div class="container">
        <div class="contact-cta-wrapper">
            <div class="contact-cta-content">
                <h2 class="section-title"><?php esc_html_e( 'GET IN TOUCH', 'atlas-theme' ); ?></h2>
                <p class="contact-cta-text"><?php esc_html_e( 'Have questions or want to work together?', 'atlas-theme' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="contact-cta-button">
                    <i class="fas fa-envelope"></i>
                    <?php esc_html_e( 'Contact Me', 'atlas-theme' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
