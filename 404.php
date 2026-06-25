<?php
/**
 * 404 template — Atlas Invencível 2026
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
    <p class="ai-404-code">404</p>
    <div class="ai-404-line">$ atlas open <span class="accent">// <?php atlas_te( 'página não encontrada', 'page not found' ); ?></span></div>
    <div class="ai-404-line">&gt; Error: ENOENT — no such file or directory<span class="ai-caret"></span></div>

    <p style="max-width:560px;margin:24px 0 0;font-family:var(--font-body);font-size:17px;line-height:1.7;color:var(--ai-text-muted);">
        <?php atlas_te( 'Esta página não existe ou mudou de sítio. Sem problema — vamos pôr-te de volta no caminho.', 'This page does not exist or has moved. No problem — let us get you back on track.' ); ?>
    </p>

    <div style="margin-top:40px;display:flex;gap:12px;flex-wrap:wrap;">
        <a href="<?php echo esc_url( atlas_home_url( '/' ) ); ?>" class="ai-btn ai-btn-primary"><?php atlas_te( 'Voltar ao início', 'Back home' ); ?> &rarr;</a>
        <a href="<?php echo esc_url( atlas_home_url( '/#trabalho' ) ); ?>" class="ai-btn ai-btn-ghost"><?php atlas_te( 'Ver trabalho', 'See work' ); ?></a>
    </div>

    <div style="margin-top:48px;max-width:520px;">
        <?php get_search_form(); ?>
    </div>
</section>

<?php
get_footer();
