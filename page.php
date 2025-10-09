<?php
/**
 * The template for displaying all pages
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
    
    <!-- Page Hero Section -->
    <section class="hero">
        <div class="hero-bg">
            <div class="wave-lines"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    <?php if ( get_the_excerpt() ) : ?>
                        <p class="hero-role"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                    <?php endif; ?>
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
                    <?php if ( get_the_modified_date() !== get_the_date() ) : ?>
                        <div class="stat">
                            <p class="stat-label"><?php esc_html_e( 'Updated', 'atlas-theme' ); ?></p>
                            <p class="stat-value"><?php echo esc_html( get_the_modified_date() ); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ( get_edit_post_link() ) : ?>
                        <div class="stat">
                            <p class="stat-label"><?php esc_html_e( 'Edit', 'atlas-theme' ); ?></p>
                            <p class="stat-value">
                                <?php
                                edit_post_link(
                                    esc_html__( 'Edit Page', 'atlas-theme' ),
                                    '',
                                    ''
                                );
                                ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Page Content Section -->
    <section class="page-content">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e( 'CONTENT', 'atlas-theme' ); ?></h2>
                <p class="section-description">
                    <?php esc_html_e( 'Discover more about this topic and explore related information.', 'atlas-theme' ); ?>
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
                
                <!-- Page Tags/Categories if any -->
                <?php
                $page_tags = get_the_tags();
                if ( $page_tags ) :
                ?>
                    <div class="page-tags">
                        <h3 class="section-title"><?php esc_html_e( 'TAGS', 'atlas-theme' ); ?></h3>
                        <div class="page-tags-list">
                            <?php foreach ( $page_tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="page-tag">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
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
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
    ?>
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
