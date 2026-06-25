<?php
/**
 * Template Functions for Atlas Invencível Theme
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Fallback menu for primary navigation
 */
function atlas_theme_fallback_menu() {
    $home = function_exists( 'atlas_home_url' ) ? atlas_home_url( '/' ) : home_url( '/' );
    $t    = function_exists( 'atlas_t' ) ? 'atlas_t' : null;
    echo '<ul class="menu">';
    echo '<li><a class="nav-link" href="' . esc_url( $home . '#sobre' ) . '">' . esc_html( $t ? atlas_t( 'sobre', 'about' ) : 'sobre' ) . '</a></li>';
    echo '<li><a class="nav-link" href="' . esc_url( $home . '#servicos' ) . '">' . esc_html( $t ? atlas_t( 'serviços', 'services' ) : 'serviços' ) . '</a></li>';
    echo '<li><a class="nav-link" href="' . esc_url( $home . '#trabalho' ) . '">' . esc_html( $t ? atlas_t( 'trabalho', 'work' ) : 'trabalho' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Custom Walker for Navigation Menu
 */
class Atlas_Theme_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Start the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a class="nav-link"' . $attributes .'>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Add Screen Reader Text Class
 */
function atlas_theme_screen_reader_text() {
    return 'screen-reader-text';
}
add_filter( 'screen_reader_text_class', 'atlas_theme_screen_reader_text' );

/**
 * Custom Search Form
 */
function atlas_theme_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
            <span class="screen-reader-text">' . esc_html__( 'Search for:', 'atlas-theme' ) . '</span>
            <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search...', 'atlas-theme' ) . '" value="' . get_search_query() . '" name="s" />
        </label>
        <input type="submit" class="search-submit" value="' . esc_attr__( 'Search', 'atlas-theme' ) . '" />
    </form>';
    
    return $form;
}
add_filter( 'get_search_form', 'atlas_theme_search_form' );

/**
 * Theme-bundled project images (fallback when no WP media is set).
 * Looks in assets/images/projects/{slug}/ for cover.{ext} and 01..08.{ext}.
 *
 * @param string $slug Project post slug.
 * @return array{cover:string, shots:string[]}
 */
function atlas_project_local_images( $slug ) {
    $rel  = '/assets/images/projects/' . sanitize_file_name( $slug ) . '/';
    $dir  = get_template_directory() . $rel;
    $uri  = get_template_directory_uri() . $rel;
    $exts = array( 'jpg', 'jpeg', 'png', 'webp' );

    $find = function ( $name ) use ( $dir, $uri, $exts ) {
        foreach ( $exts as $ext ) {
            if ( file_exists( $dir . $name . '.' . $ext ) ) {
                return $uri . $name . '.' . $ext;
            }
        }
        return '';
    };

    $shots = array();
    for ( $i = 1; $i <= 8; $i++ ) {
        $url = $find( sprintf( '%02d', $i ) );
        if ( $url ) {
            $shots[] = $url;
        }
    }

    return array(
        'cover' => $find( 'cover' ),
        'shots' => $shots,
    );
}

/**
 * Render a browser-window mockup frame around a project screenshot.
 *
 * @param string $img_url   Image URL.
 * @param string $domain    Domain shown in the URL bar (e.g. howtoinvest.pro).
 * @param string $variant   '' (cover) | 'tall' | 'short'.
 * @param bool   $with_mark Show the "A" brand mark in the bar.
 */
function atlas_render_mock( $img_url, $domain = '', $variant = '', $with_mark = true ) {
    if ( ! $img_url ) {
        return;
    }
    $classes = 'cs-mock' . ( $variant ? ' cs-mock-' . $variant : ' cs-mock-cover' );
    ?>
    <figure class="<?php echo esc_attr( $classes ); ?>">
        <div class="cs-mock-win">
            <div class="cs-mock-bar">
                <span class="cs-dots"><i></i><i></i><i></i></span>
                <span class="cs-url">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2D5BFF" stroke-width="2" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                    <?php if ( $domain ) : ?><b><?php echo esc_html( $domain ); ?></b><span>/</span><?php endif; ?>
                </span>
                <?php if ( $with_mark ) : ?><span class="cs-mark">A</span><?php endif; ?>
            </div>
            <div class="cs-mock-screen"><img src="<?php echo esc_url( $img_url ); ?>" alt="" loading="lazy"></div>
        </div>
    </figure>
    <?php
}
