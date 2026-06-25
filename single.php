<?php
/**
 * Single post template (blog) — Atlas Invencível 2026
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

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ai-back">$ cd ~ <span class="muted">// início</span></a>

        <header class="ai-page-header">
            <div class="ai-page-label">// POST.md</div>
            <h1 class="ai-page-title"><?php the_title(); ?></h1>
            <div class="ai-postmeta">
                <span><?php echo esc_html( get_the_date() ); ?></span>
                <span>&middot; <?php the_author(); ?></span>
                <?php if ( has_category() ) : ?>
                    <span>&middot; <?php the_category( ', ' ); ?></span>
                <?php endif; ?>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="ai-feature"><?php the_post_thumbnail( 'atlas-project-large' ); ?></div>
        <?php endif; ?>

        <div class="ai-prose">
            <?php
            the_content();
            wp_link_pages( array(
                'before' => '<div class="ai-postmeta">' . esc_html( atlas_t( 'Páginas:', 'Pages:' ) ) . ' ',
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <?php if ( has_tag() ) : ?>
            <div class="ai-tags"><?php the_tags( '', '', '' ); ?></div>
        <?php endif; ?>

        <nav class="ai-postnav" aria-label="<?php esc_attr_e( 'Post navigation', 'atlas-theme' ); ?>">
            <?php
            $ai_prev = get_previous_post();
            $ai_next = get_next_post();
            if ( $ai_prev ) :
                ?>
                <a href="<?php echo esc_url( get_permalink( $ai_prev ) ); ?>" class="prv">
                    <span class="lbl"><?php echo esc_html( atlas_t( '← anterior', '← previous' ) ); ?></span>
                    <?php echo esc_html( get_the_title( $ai_prev ) ); ?>
                </a>
            <?php endif; ?>
            <?php if ( $ai_next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $ai_next ) ); ?>" class="nxt">
                    <span class="lbl"><?php echo esc_html( atlas_t( 'seguinte →', 'next →' ) ); ?></span>
                    <?php echo esc_html( get_the_title( $ai_next ) ); ?>
                </a>
            <?php endif; ?>
        </nav>

    </article>
    <?php
endwhile;

get_footer();
