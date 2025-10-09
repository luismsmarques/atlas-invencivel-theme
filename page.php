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
    <section class="page-hero">
        <div class="page-hero-bg">
            <div class="wave-lines"></div>
        </div>
        <div class="container">
            <div class="page-hero-content">
                <!-- Breadcrumbs -->
                <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'atlas-theme' ); ?>">
                    <ol class="breadcrumb-list">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-link">
                                <i class="fas fa-home"></i>
                                <span><?php esc_html_e( 'Home', 'atlas-theme' ); ?></span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item current" aria-current="page">
                            <span><?php the_title(); ?></span>
                        </li>
                    </ol>
                </nav>
                
                <!-- Page Title -->
                <div class="page-hero-text">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if ( get_the_excerpt() ) : ?>
                        <p class="page-subtitle"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- Page Meta -->
                <div class="page-meta">
                    <div class="page-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span><?php echo esc_html( get_the_date() ); ?></span>
                    </div>
                    <?php if ( get_the_modified_date() !== get_the_date() ) : ?>
                        <div class="page-meta-item">
                            <i class="fas fa-edit"></i>
                            <span><?php esc_html_e( 'Updated:', 'atlas-theme' ); ?> <?php echo esc_html( get_the_modified_date() ); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ( get_edit_post_link() ) : ?>
                        <div class="page-meta-item">
                            <i class="fas fa-pencil-alt"></i>
                            <?php
                            edit_post_link(
                                esc_html__( 'Edit Page', 'atlas-theme' ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Page Content Section -->
    <section class="page-content-section">
        <div class="container">
            <div class="page-content-wrapper">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
                    <div class="page-content">
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
                            <h3 class="page-tags-title"><?php esc_html_e( 'Tags:', 'atlas-theme' ); ?></h3>
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
                
                <!-- Sidebar (if needed) -->
                <aside class="page-sidebar">
                    <!-- Related Pages -->
                    <?php
                    $related_pages = get_pages( array(
                        'parent' => wp_get_post_parent_id( get_the_ID() ),
                        'exclude' => array( get_the_ID() ),
                        'number' => 5,
                    ) );
                    
                    if ( $related_pages ) :
                    ?>
                        <div class="related-pages">
                            <h3 class="sidebar-title"><?php esc_html_e( 'Related Pages', 'atlas-theme' ); ?></h3>
                            <ul class="related-pages-list">
                                <?php foreach ( $related_pages as $page ) : ?>
                                    <li class="related-page-item">
                                        <a href="<?php echo esc_url( get_permalink( $page->ID ) ); ?>" class="related-page-link">
                                            <i class="fas fa-file-alt"></i>
                                            <span><?php echo esc_html( $page->post_title ); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Contact CTA -->
                    <div class="contact-cta">
                        <h3 class="sidebar-title"><?php esc_html_e( 'Get In Touch', 'atlas-theme' ); ?></h3>
                        <p class="contact-cta-text"><?php esc_html_e( 'Have questions or want to work together?', 'atlas-theme' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="contact-cta-button">
                            <i class="fas fa-envelope"></i>
                            <?php esc_html_e( 'Contact Me', 'atlas-theme' ); ?>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    
    <!-- Comments Section -->
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
    ?>
        <section class="page-comments-section">
            <div class="container">
                <div class="page-comments-wrapper">
                    <?php comments_template(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
