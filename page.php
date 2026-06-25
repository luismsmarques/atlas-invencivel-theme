<?php
/**
 * Generic page template — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <article <?php post_class( 'ai-page narrow' ); ?>>

        <header class="ai-page-header">
            <div class="ai-page-label">// <?php echo esc_html( sanitize_title( get_the_title() ) ); ?>.md</div>
            <h1 class="ai-page-title"><?php the_title(); ?></h1>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="ai-feature"><?php the_post_thumbnail( 'atlas-project-large' ); ?></div>
        <?php endif; ?>

        <div class="ai-prose">
            <?php
            the_content();
            wp_link_pages( array(
                'before' => '<div class="ai-postmeta">' . esc_html__( 'Páginas:', 'atlas-theme' ) . ' ',
                'after'  => '</div>',
            ) );
            ?>
        </div>

    </article>
    <?php
endwhile;

get_footer();
