<?php
/**
 * Reusable blog post row — Atlas Invencível 2026
 * Used by index.php, archive.php and search.php inside the loop.
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$ai_has_thumb = has_post_thumbnail();
?>
<article <?php post_class( 'ai-post-row' . ( $ai_has_thumb ? '' : ' no-thumb' ) ); ?>>
    <?php if ( $ai_has_thumb ) : ?>
        <a class="ai-post-thumb" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'atlas-thumbnail-large' ); ?>
        </a>
    <?php endif; ?>
    <div class="ai-post-body">
        <div class="ai-postmeta">
            <span><?php echo esc_html( get_the_date() ); ?></span>
            <span>&middot; <?php the_author(); ?></span>
            <?php if ( has_category() ) : ?>
                <span>&middot; <?php the_category( ', ' ); ?></span>
            <?php endif; ?>
        </div>
        <h2 class="ai-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="ai-post-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28, '…' ) ); ?></p>
        <a class="ai-post-more" href="<?php the_permalink(); ?>"><?php atlas_te( 'ler mais', 'read more' ); ?> &rarr;</a>
    </div>
</article>
