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
    <div class="ai-404-line">$ atlas open <span class="accent">// página não encontrada</span></div>
    <div class="ai-404-line">&gt; Error: ENOENT — no such file or directory<span class="ai-caret"></span></div>

    <div style="margin-top:40px;display:flex;gap:12px;flex-wrap:wrap;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ai-btn ai-btn-primary"><?php esc_html_e( 'Voltar ao início', 'atlas-theme' ); ?> &rarr;</a>
        <a href="<?php echo esc_url( home_url( '/#trabalho' ) ); ?>" class="ai-btn ai-btn-ghost"><?php esc_html_e( 'Ver trabalho', 'atlas-theme' ); ?></a>
    </div>

    <div style="margin-top:48px;max-width:520px;">
        <?php get_search_form(); ?>
    </div>
</section>

<?php
get_footer();
