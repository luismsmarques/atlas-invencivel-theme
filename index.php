<?php
/**
 * The main template file (blog index / fallback) — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$ai_blog_title = is_home() ? single_post_title( '', false ) : get_the_title( get_option( 'page_for_posts' ) );
if ( empty( $ai_blog_title ) ) {
    $ai_blog_title = __( 'Blog', 'atlas-theme' );
}
?>

<section class="ai-page">

    <header class="ai-page-header">
        <div class="ai-page-label">// BLOG.log</div>
        <h1 class="ai-page-title"><?php echo esc_html( $ai_blog_title ); ?></h1>
        <p class="ai-page-sub"><?php atlas_te( 'Notas sobre engenharia, produto e o que vamos construindo.', 'Notes on engineering, product and what we are building.' ); ?></p>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="ai-posts">
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/post', 'row' );
            endwhile;
            ?>
        </div>

        <div class="ai-pagination">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&larr;',
                'next_text' => '&rarr;',
            ) );
            ?>
        </div>
    <?php else : ?>
        <div class="ai-empty">
            <h2><?php atlas_te( 'Nada por aqui — ainda', 'Nothing here — yet' ); ?></h2>
            <p><?php atlas_te( 'Não há publicações de momento. Volta em breve.', 'No posts right now. Check back soon.' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>

</section>

<?php
get_footer();
