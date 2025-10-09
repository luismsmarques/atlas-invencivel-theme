<?php
/**
 * The template for displaying archive pages
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Archive Hero Section -->
<section class="archive-hero">
    <div class="archive-hero-bg">
        <div class="wave-lines"></div>
    </div>
    <div class="container">
        <div class="archive-hero-content">
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
                        <span><?php single_term_title(); ?></span>
                    </li>
                </ol>
            </nav>
            
            <!-- Archive Title -->
            <div class="archive-hero-text">
                <?php
                the_archive_title( '<h1 class="archive-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Archive Content Section -->
<section class="archive-content-section">
    <div class="container">
        <div class="archive-content-wrapper">
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
            
            <!-- Sidebar -->
            <aside class="archive-sidebar">
                <!-- Categories -->
                <div class="archive-categories">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Categories', 'atlas-theme' ); ?></h3>
                    <div class="category-cloud">
                        <?php wp_list_categories( array(
                            'title_li' => '',
                            'show_count' => true,
                            'style' => 'none',
                        ) ); ?>
                    </div>
                </div>
                
                <!-- Tags -->
                <div class="archive-tags">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Popular Tags', 'atlas-theme' ); ?></h3>
                    <div class="tag-cloud">
                        <?php wp_tag_cloud( array(
                            'smallest' => 12,
                            'largest' => 16,
                            'unit' => 'px',
                            'number' => 20,
                        ) ); ?>
                    </div>
                </div>
                
                <!-- Search -->
                <div class="archive-search">
                    <h3 class="sidebar-title"><?php esc_html_e( 'Search Posts', 'atlas-theme' ); ?></h3>
                    <form role="search" method="get" class="archive-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search posts...', 'atlas-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
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

<?php get_footer(); ?>
