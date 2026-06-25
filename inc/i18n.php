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
