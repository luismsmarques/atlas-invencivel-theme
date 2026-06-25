<?php
/**
 * Archive template (category / tag / author / date) — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<section class="ai-page">

    <header class="ai-page-header">
        <div class="ai-page-label">// ARQUIVO.log</div>
        <h1 class="ai-page-title"><?php the_archive_title(); ?></h1>
        <?php
        $ai_desc = get_the_archive_description();
        if ( $ai_desc ) :
            ?>
            <div class="ai-page-sub"><?php echo wp_kses_post( $ai_desc ); ?></div>
        <?php endif; ?>
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
            <h2><?php atlas_te( 'Nada encontrado', 'Nothing found' ); ?></h2>
            <p><?php atlas_te( 'Não há conteúdo neste arquivo.', 'There is no content in this archive.' ); ?></p>
        </div>
    <?php endif; ?>

</section>

<?php
get_footer();
