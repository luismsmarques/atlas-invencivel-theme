<?php
/**
 * Search results template — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

global $wp_query;
$ai_found = (int) $wp_query->found_posts;
?>

<section class="ai-page">

    <header class="ai-page-header">
        <div class="ai-page-label">// PESQUISA.grep</div>
        <h1 class="ai-page-title">"<?php echo esc_html( get_search_query() ); ?>"</h1>
        <div class="ai-page-sub">
            <?php
            printf(
                esc_html( _n( '%s resultado encontrado.', '%s resultados encontrados.', $ai_found, 'atlas-theme' ) ),
                esc_html( number_format_i18n( $ai_found ) )
            );
            ?>
        </div>
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
            <h2><?php esc_html_e( 'Sem resultados', 'atlas-theme' ); ?></h2>
            <p><?php esc_html_e( 'Tenta outros termos de pesquisa.', 'atlas-theme' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>

</section>

<?php
get_footer();
