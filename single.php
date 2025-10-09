<?php
/**
 * The template for displaying all single posts
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<?php while ( have_posts() ) : ?>
    <?php the_post(); ?>
    
    <!-- Single Hero Section -->
    <section class="hero">
        <div class="hero-bg">
            <div class="wave-lines"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    <p class="hero-role"><?php esc_html_e( 'Blog Post', 'atlas-theme' ); ?></p>
                </div>
                
                <div class="hero-center">
                    <div class="hero-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', array( 'class' => 'profile-img' ) ); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/luis-marques-profile.png' ); ?>" alt="<?php the_title_attribute(); ?>" class="profile-img">
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="hero-right">
                    <div class="stat">
                        <p class="stat-label"><?php esc_html_e( 'Published', 'atlas-theme' ); ?></p>
                        <p class="stat-value"><?php echo esc_html( get_the_date() ); ?></p>
                    </div>
                    
                    <div class="stat">
                        <p class="stat-label"><?php esc_html_e( 'Author', 'atlas-theme' ); ?></p>
                        <p class="stat-value"><?php the_author(); ?></p>
                    </div>
                    
                    <?php if ( has_category() ) : ?>
                        <div class="stat">
                            <p class="stat-label"><?php esc_html_e( 'Category', 'atlas-theme' ); ?></p>
                            <p class="stat-value"><?php the_category( ', ' ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Single Content Section -->
    <section class="page-content">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e( 'ARTICLE', 'atlas-theme' ); ?></h2>
                <p class="section-description">
                    <?php esc_html_e( 'Read the full article and discover valuable insights.', 'atlas-theme' ); ?>
                </p>
            </div>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
                <div class="page-content-wrapper">
                    <?php
                    the_content();
                    
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlas-theme' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
                
                <?php if ( has_tag() ) : ?>
                    <div class="page-tags">
                        <h3 class="section-title"><?php esc_html_e( 'TAGS', 'atlas-theme' ); ?></h3>
                        <div class="page-tags-list">
                            <?php the_tags( '', '', '' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Post Navigation -->
                <div class="post-navigation">
                    <?php
                    the_post_navigation( array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'atlas-theme' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'atlas-theme' ) . '</span> <span class="nav-title">%title</span>',
                    ) );
                    ?>
                </div>
            </article>
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
    
    <!-- Comments Section -->
    <?php if ( comments_open() || get_comments_number() ) : ?>
        <section class="comments-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php esc_html_e( 'COMMENTS', 'atlas-theme' ); ?></h2>
                    <p class="section-description">
                        <?php esc_html_e( 'Share your thoughts and join the conversation.', 'atlas-theme' ); ?>
                    </p>
                </div>
                <div class="comments-wrapper">
                    <?php comments_template(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
