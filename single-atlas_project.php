<?php
/**
 * Single Project Template — Case Study (Atlas Invencível 2026)
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

    $cs_id           = get_the_ID();
    $cs_category     = get_post_meta( $cs_id, '_atlas_project_category', true );
    $cs_client       = get_post_meta( $cs_id, '_atlas_project_client', true );
    $cs_date         = get_post_meta( $cs_id, '_atlas_project_date', true );
    $cs_technologies = get_post_meta( $cs_id, '_atlas_project_technologies', true );
    $cs_challenges   = get_post_meta( $cs_id, '_atlas_project_challenges', true );
    $cs_solutions    = get_post_meta( $cs_id, '_atlas_project_solutions', true );
    $cs_results      = get_post_meta( $cs_id, '_atlas_project_results', true );
    $cs_url          = get_post_meta( $cs_id, '_atlas_project_url', true );
    $cs_gallery      = get_post_meta( $cs_id, '_atlas_project_gallery', true );
    $cs_status       = get_post_meta( $cs_id, '_atlas_project_status', true );

    // Build tag list from the category (split on / and ,).
    $cs_tags = array();
    if ( $cs_category ) {
        $cs_tags = array_filter( array_map( 'trim', preg_split( '#[/,]#', $cs_category ) ) );
    }

    // Gallery image URLs.
    $cs_gallery_urls = array();
    if ( ! empty( $cs_gallery ) ) {
        foreach ( array_map( 'trim', explode( ',', $cs_gallery ) ) as $cs_img_id ) {
            if ( is_numeric( $cs_img_id ) ) {
                $cs_src = wp_get_attachment_image_url( $cs_img_id, 'large' );
                if ( $cs_src ) {
                    $cs_gallery_urls[] = $cs_src;
                }
            }
        }
    }

    // Theme-bundled image fallback — reuse the PT slug so EN translations share images.
    $cs_img_slug = get_post_field( 'post_name', $cs_id );
    if ( function_exists( 'pll_get_post' ) && function_exists( 'pll_default_language' ) ) {
        $cs_pt_id = pll_get_post( $cs_id, pll_default_language() );
        if ( $cs_pt_id ) {
            $cs_img_slug = get_post_field( 'post_name', $cs_pt_id );
        }
    }
    $cs_img_slug = preg_replace( '/-en$/', '', $cs_img_slug );
    $cs_local = atlas_project_local_images( $cs_img_slug );

    // Cover: featured image first, then local cover.
    $cs_cover_url = has_post_thumbnail() ? get_the_post_thumbnail_url( $cs_id, 'atlas-project-large' ) : $cs_local['cover'];

    // Gallery: WP gallery first, then local shots.
    if ( empty( $cs_gallery_urls ) ) {
        $cs_gallery_urls = $cs_local['shots'];
    }

    // Domain shown in the browser-mockup bar.
    $cs_domain = $cs_url ? preg_replace( '#^www\.#', '', (string) wp_parse_url( $cs_url, PHP_URL_HOST ) ) : '';

    // Case number based on menu order / fallback to a short hash of the ID.
    $cs_number = get_post_field( 'menu_order', $cs_id );
    $cs_number = $cs_number ? (int) $cs_number : ( $cs_id % 1000 );
    ?>

    <article <?php post_class( 'cs' ); ?>>

        <!-- HERO -->
        <header class="cs-hero">
            <a href="<?php echo esc_url( atlas_home_url( '/#trabalho' ) ); ?>" class="cs-back">$ cd ../<?php atlas_te( 'trabalho', 'work' ); ?> <span class="muted">// <?php atlas_te( 'voltar', 'back' ); ?></span></a>

            <?php if ( ! empty( $cs_tags ) ) : ?>
                <div class="cs-tags">
                    <?php foreach ( $cs_tags as $cs_t => $cs_tag ) : ?>
                        <span class="cs-tag<?php echo 0 === $cs_t ? ' accent' : ''; ?>"><?php echo esc_html( strtoupper( $cs_tag ) ); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="cs-caseno">// case_<?php echo esc_html( sprintf( '%03d', $cs_number ) ); ?></div>
            <h1><?php the_title(); ?></h1>

            <?php if ( get_the_excerpt() ) : ?>
                <p class="cs-hero-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>

            <?php if ( $cs_cover_url ) : ?>
                <div class="cs-cover-wrap"><?php atlas_render_mock( $cs_cover_url, $cs_domain, '', true ); ?></div>
            <?php endif; ?>
        </header>

        <!-- META BAR -->
        <section class="cs-metabar">
            <div class="cs-meta-grid">
                <div class="cs-meta">
                    <div class="k"><?php atlas_te( 'FUNÇÃO', 'ROLE' ); ?></div>
                    <div class="v"><?php echo esc_html( $cs_client ? $cs_client : atlas_t( 'Estratégia · Eng · Produto', 'Strategy · Eng · Product' ) ); ?></div>
                </div>
                <div class="cs-meta">
                    <div class="k"><?php atlas_te( 'ANO', 'YEAR' ); ?></div>
                    <div class="v"><?php echo esc_html( $cs_date ? $cs_date : get_the_date( 'Y' ) ); ?></div>
                </div>
                <div class="cs-meta">
                    <div class="k">STACK</div>
                    <div class="v"><?php echo esc_html( $cs_technologies ? $cs_technologies : '—' ); ?></div>
                </div>
                <div class="cs-meta">
                    <div class="k"><?php atlas_te( 'ESTADO', 'STATUS' ); ?></div>
                    <div class="v accent"><?php echo esc_html( $cs_status ? $cs_status : atlas_t( '● em produção', '● in production' ) ); ?></div>
                </div>
            </div>
        </section>

        <!-- CHALLENGE -->
        <?php if ( $cs_challenges ) : ?>
            <section class="cs-section">
                <div class="cs-challenge-grid">
                    <div class="cs-label" style="margin-bottom:0;"><?php atlas_te( '// O_DESAFIO.md', '// THE_CHALLENGE.md' ); ?></div>
                    <div class="cs-body"><?php echo wp_kses_post( wpautop( $cs_challenges ) ); ?></div>
                </div>
            </section>
        <?php endif; ?>

        <!-- APPROACH / OVERVIEW (post body) -->
        <?php if ( trim( get_the_content() ) ) : ?>
            <section class="cs-section">
                <div class="cs-label"><?php atlas_te( '// A_ABORDAGEM.md', '// THE_APPROACH.md' ); ?></div>
                <div class="cs-body"><?php the_content(); ?></div>
            </section>
        <?php endif; ?>

        <!-- SOLUTION -->
        <?php if ( $cs_solutions || ! empty( $cs_gallery_urls ) ) : ?>
            <section class="cs-section">
                <div class="cs-label"><?php atlas_te( '// A_SOLUCAO.build', '// THE_SOLUTION.build' ); ?></div>

                <?php if ( $cs_solutions ) : ?>
                    <div class="cs-body" style="max-width:780px;margin-bottom:40px;"><?php echo wp_kses_post( wpautop( $cs_solutions ) ); ?></div>
                <?php endif; ?>

                <?php if ( ! empty( $cs_gallery_urls ) ) : ?>
                    <?php atlas_render_mock( $cs_gallery_urls[0], $cs_domain, 'tall', false ); ?>
                    <?php
                    $cs_rest = array_slice( $cs_gallery_urls, 1 );
                    if ( ! empty( $cs_rest ) ) {
                        foreach ( array_chunk( $cs_rest, 2 ) as $cs_pair ) {
                            if ( count( $cs_pair ) === 1 ) {
                                atlas_render_mock( $cs_pair[0], $cs_domain, 'tall', false );
                            } else {
                                echo '<div class="cs-shots-2">';
                                foreach ( $cs_pair as $cs_pair_url ) {
                                    echo '<div>';
                                    atlas_render_mock( $cs_pair_url, $cs_domain, 'short', false );
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <!-- RESULTS -->
        <?php if ( $cs_results ) : ?>
            <section class="cs-section">
                <div class="cs-label"><?php atlas_te( '// RESULTADOS.out', '// RESULTS.out' ); ?></div>
                <div class="cs-body" style="max-width:780px;"><?php echo wp_kses_post( wpautop( $cs_results ) ); ?></div>
                <?php if ( $cs_url ) : ?>
                    <a href="<?php echo esc_url( $cs_url ); ?>" target="_blank" rel="noopener" class="ai-btn ai-btn-primary" style="margin-top:40px;"><?php atlas_te( 'Ver projeto', 'View project' ); ?> &rarr;</a>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <!-- NEXT PROJECTS -->
        <?php
        $cs_more = new WP_Query( array(
            'post_type'      => 'atlas_project',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'post__not_in'   => array( $cs_id ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
        if ( $cs_more->have_posts() ) :
            ?>
            <section class="cs-section">
                <div class="cs-next-head">
                    <h2><?php atlas_te( 'Mais projetos', 'More projects' ); ?></h2>
                    <a href="<?php echo esc_url( atlas_home_url( '/#trabalho' ) ); ?>"><?php atlas_te( 'ver todos', 'see all' ); ?> &rarr;</a>
                </div>
                <?php
                $cs_k = 0;
                while ( $cs_more->have_posts() ) :
                    $cs_more->the_post();
                    $cs_k++;
                    $cs_more_cat = get_post_meta( get_the_ID(), '_atlas_project_category', true );
                    ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-next-row">
                        <span class="cs-next-id"><?php echo esc_html( sprintf( '%03d', $cs_k ) ); ?></span>
                        <div>
                            <div class="cs-next-title"><?php the_title(); ?></div>
                            <?php if ( get_the_excerpt() ) : ?>
                                <div class="cs-next-sub"><?php echo esc_html( get_the_excerpt() ); ?></div>
                            <?php endif; ?>
                        </div>
                        <span class="cs-next-cat"><?php echo esc_html( $cs_more_cat ? $cs_more_cat : atlas_t( 'PROJETO', 'PROJECT' ) ); ?></span>
                        <span class="cs-next-arrow">&rarr;</span>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </section>
        <?php endif; ?>

    </article>

    <?php
endwhile;

get_footer();
