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
    <section class="single-hero">
        <div class="single-hero-bg">
            <div class="wave-lines"></div>
        </div>
        <div class="container">
            <div class="single-hero-content">
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
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="breadcrumb-link">
                                <span><?php esc_html_e( 'Blog', 'atlas-theme' ); ?></span>
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
                
                <!-- Post Title -->
                <div class="single-hero-text">
                    <h1 class="single-title"><?php the_title(); ?></h1>
                    
                    <!-- Post Meta -->
                    <div class="single-meta">
                        <div class="single-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span><?php echo esc_html( get_the_date() ); ?></span>
                        </div>
                        
                        <div class="single-meta-item">
                            <i class="fas fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>
                        
                        <?php if ( has_category() ) : ?>
                            <div class="single-meta-item">
                                <i class="fas fa-folder"></i>
                                <span><?php the_category( ', ' ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Single Content Section -->
    <section class="single-content-section">
        <div class="container">
            <div class="single-content-wrapper">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="single-featured-image">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="single-content">
                        <?php
                        the_content();
                        
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlas-theme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>
                    
                    <?php if ( has_tag() ) : ?>
                        <div class="single-tags-wrapper">
                            <h3 class="single-tags-title"><?php esc_html_e( 'Tags:', 'atlas-theme' ); ?></h3>
                            <div class="single-tags-list">
                                <?php the_tags( '', '', '' ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Post Navigation -->
                    <div class="single-navigation">
                        <?php
                        the_post_navigation( array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'atlas-theme' ) . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'atlas-theme' ) . '</span> <span class="nav-title">%title</span>',
                        ) );
                        ?>
                    </div>
                </article>
                
                <!-- Sidebar -->
                <aside class="single-sidebar">
                    <!-- Author Bio -->
                    <div class="author-bio">
                        <div class="author-info">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
                            <h3 class="author-name"><?php the_author(); ?></h3>
                            <p class="author-bio-text"><?php echo get_the_author_meta( 'description' ); ?></p>
                        </div>
                    </div>
                    
                    <!-- Related Posts -->
                    <div class="related-posts">
                        <h3 class="sidebar-title"><?php esc_html_e( 'Related Posts', 'atlas-theme' ); ?></h3>
                        <?php
                        $related_posts = get_posts( array(
                            'category__in' => wp_get_post_categories( get_the_ID() ),
                            'numberposts' => 3,
                            'post__not_in' => array( get_the_ID() ),
                        ) );
                        
                        if ( $related_posts ) :
                        ?>
                            <div class="related-posts-list">
                                <?php foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
                                    <div class="related-post-item">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="related-post-content">
                                            <h4 class="related-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <span class="related-post-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
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
    <?php if ( comments_open() || get_comments_number() ) : ?>
        <section class="single-comments-section">
            <div class="container">
                <div class="single-comments-wrapper">
                    <?php comments_template(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
