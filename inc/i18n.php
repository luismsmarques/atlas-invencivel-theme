<?php
/**
 * Bilingual helpers (PT / EN) + Polylang integration.
 *
 * Fixed theme copy is handled in code via atlas_t() so switching language is
 * instant. Posts/pages/CPT are translated through Polylang as usual.
 *
 * @package AtlasTheme
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Current site language as a simple slug: 'en' or 'pt' (default).
 */
function atlas_lang() {
    if ( function_exists( 'pll_current_language' ) ) {
        $slug = pll_current_language( 'slug' );
        if ( $slug ) {
            return ( 0 === strpos( $slug, 'en' ) ) ? 'en' : 'pt';
        }
    }
    return ( 0 === strpos( get_locale(), 'en' ) ) ? 'en' : 'pt';
}

/**
 * Pick a string by language. atlas_t( 'PT', 'EN' ).
 * If $en is omitted, returns $pt for both languages.
 */
function atlas_t( $pt, $en = null ) {
    if ( null === $en ) {
        return $pt;
    }
    return ( 'en' === atlas_lang() ) ? $en : $pt;
}

/**
 * Echo helper for atlas_t().
 */
function atlas_te( $pt, $en = null ) {
    echo esc_html( atlas_t( $pt, $en ) );
}

/**
 * Language-aware home URL (Polylang-aware).
 */
function atlas_home_url( $path = '/' ) {
    if ( function_exists( 'pll_home_url' ) ) {
        return rtrim( pll_home_url(), '/' ) . '/' . ltrim( $path, '/' );
    }
    return home_url( $path );
}

/**
 * Find a page by a list of candidate slugs OR titles (any language).
 *
 * @param string|array $candidates Slugs and/or titles.
 * @return WP_Post|null
 */
function atlas_find_page( $candidates ) {
    // 1) Match by slug (sanitized, so titles passed in also work as slugs).
    foreach ( (array) $candidates as $c ) {
        $page = get_page_by_path( sanitize_title( $c ) );
        if ( $page ) {
            return $page;
        }
    }
    // 2) Fallback: match by exact title (covers slugs that don't follow the
    //    title, e.g. WordPress "-2" suffixes when a slug was already taken).
    foreach ( (array) $candidates as $c ) {
        $q = new WP_Query( array(
            'post_type'        => 'page',
            'title'            => $c,
            'posts_per_page'   => 1,
            'no_found_rows'    => true,
            'post_status'      => 'publish',
            'suppress_filters' => false,
            'lang'             => '', // search across all languages
        ) );
        if ( ! empty( $q->posts ) ) {
            return $q->posts[0];
        }
    }
    return null;
}

/**
 * Permalink of a page in the CURRENT language (Polylang-aware).
 *
 * Pass one or more candidate slugs and/or titles (PT and/or EN). The first
 * page found is resolved to its translation in the active language. Returns
 * the home URL if no matching page exists.
 *
 * @param string|array $candidates Candidate page slugs and/or titles.
 * @return string
 */
function atlas_page_url( $candidates ) {
    $page = atlas_find_page( $candidates );
    if ( ! $page ) {
        return atlas_home_url( '/' );
    }
    $id = $page->ID;
    if ( function_exists( 'pll_get_post' ) ) {
        $translated = pll_get_post( $id ); // current language
        if ( $translated ) {
            $id = $translated;
        }
    }
    return get_permalink( $id );
}

/**
 * Render the Polylang language switcher (no-op if Polylang is inactive
 * or only one language exists).
 */
function atlas_lang_switcher() {
    if ( ! function_exists( 'pll_the_languages' ) ) {
        return;
    }
    $langs = pll_the_languages( array( 'raw' => 1, 'hide_if_empty' => 0, 'hide_current' => 0 ) );
    if ( empty( $langs ) || count( $langs ) < 2 ) {
        return;
    }
    echo '<div class="lang-switch" role="navigation" aria-label="Language">';
    foreach ( $langs as $lang ) {
        $cls = 'lang-switch-item' . ( ! empty( $lang['current_lang'] ) ? ' current' : '' );
        printf(
            '<a class="%s" href="%s" hreflang="%s">%s</a>',
            esc_attr( $cls ),
            esc_url( $lang['url'] ),
            esc_attr( $lang['slug'] ),
            esc_html( strtoupper( $lang['slug'] ) )
        );
    }
    echo '</div>';
}

/**
 * Make the theme's custom post types & taxonomies translatable in Polylang.
 */
add_filter( 'pll_get_post_types', function ( $types, $is_settings ) {
    foreach ( array( 'atlas_project', 'atlas_skill', 'atlas_timeline', 'atlas_service' ) as $pt ) {
        $types[ $pt ] = $pt;
    }
    return $types;
}, 10, 2 );

add_filter( 'pll_get_taxonomies', function ( $taxes, $is_settings ) {
    foreach ( array( 'project_category', 'timeline_type' ) as $tax ) {
        $taxes[ $tax ] = $tax;
    }
    return $taxes;
}, 10, 2 );
