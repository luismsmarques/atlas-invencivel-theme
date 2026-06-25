<?php
/**
 * Atlas Theme Options Page
 *
 * Classic WordPress admin options page. Holds only the settings the theme
 * actually reads — kept in sync with the templates.
 *
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Atlas Theme Options Page to Admin Menu
 */
function atlas_theme_add_options_page() {
    add_menu_page(
        __( 'Atlas Theme Options', 'atlas-theme' ),
        __( 'Atlas Theme', 'atlas-theme' ),
        'manage_options',
        'atlas-theme-options',
        'atlas_theme_options_page',
        'dashicons-admin-customizer',
        30
    );
}
add_action( 'admin_menu', 'atlas_theme_add_options_page' );

/**
 * Enqueue Admin Scripts for Options Page (media uploader for image fields)
 */
function atlas_theme_enqueue_admin_scripts( $hook ) {
    if ( 'toplevel_page_atlas-theme-options' !== $hook ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script( 'jquery' );
}
add_action( 'admin_enqueue_scripts', 'atlas_theme_enqueue_admin_scripts' );

/**
 * Register Theme Options — only what the templates read.
 */
function atlas_theme_register_options() {
    $text     = array( 'sanitize_callback' => 'sanitize_text_field' );
    $textarea = array( 'sanitize_callback' => 'sanitize_textarea_field' );
    $email    = array( 'sanitize_callback' => 'sanitize_email' );
    $int      = array( 'sanitize_callback' => 'absint' );
    $url      = array( 'sanitize_callback' => 'esc_url_raw' );

    // Hero / About
    register_setting( 'atlas_theme_options', 'atlas_hero_lead', $textarea );
    register_setting( 'atlas_theme_options', 'atlas_hero_image', $int );
    register_setting( 'atlas_theme_options', 'atlas_about_title', $text );
    register_setting( 'atlas_theme_options', 'atlas_about_text', $textarea );
    register_setting( 'atlas_theme_options', 'atlas_about_image', $int );
    register_setting( 'atlas_theme_options', 'atlas_code_years', $text );
    register_setting( 'atlas_theme_options', 'atlas_code_companies', $text );
    register_setting( 'atlas_theme_options', 'atlas_code_communities', $text );

    // Branding
    register_setting( 'atlas_theme_options', 'atlas_logo_icon', $text );
    register_setting( 'atlas_theme_options', 'atlas_logo_text', $text );
    register_setting( 'atlas_theme_options', 'atlas_footer_logo_text', $text );
    register_setting( 'atlas_theme_options', 'atlas_footer_description', $text );

    // Work
    register_setting( 'atlas_theme_options', 'atlas_projects_limit', $int );

    // Contact
    register_setting( 'atlas_theme_options', 'atlas_contact_email', $email );
    register_setting( 'atlas_theme_options', 'atlas_contact_location', $text );
    register_setting( 'atlas_theme_options', 'atlas_cf7_id', $text );

    // Social
    register_setting( 'atlas_theme_options', 'atlas_social_linkedin', $url );
    register_setting( 'atlas_theme_options', 'atlas_social_twitter', $url );
    register_setting( 'atlas_theme_options', 'atlas_social_github', $url );
    register_setting( 'atlas_theme_options', 'atlas_social_peerlist', $url );

    // SEO
    register_setting( 'atlas_theme_options', 'atlas_site_description', $textarea );
}
add_action( 'admin_init', 'atlas_theme_register_options' );

/**
 * Render a simple text/email/number/url field row.
 */
function atlas_opt_field( $name, $label, $default = '', $type = 'text', $desc = '' ) {
    $value = get_option( $name, $default );
    $class = ( 'textarea' === $type ) ? 'large-text' : 'regular-text';
    echo '<tr><th scope="row"><label for="' . esc_attr( $name ) . '">' . esc_html( $label ) . '</label></th><td>';
    if ( 'textarea' === $type ) {
        echo '<textarea id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" rows="3" class="' . $class . '">' . esc_textarea( $value ) . '</textarea>';
    } else {
        echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" class="' . $class . '" />';
    }
    if ( $desc ) {
        echo '<p class="description">' . esc_html( $desc ) . '</p>';
    }
    echo '</td></tr>';
}

/**
 * Render a media (image) picker field row.
 */
function atlas_opt_image_field( $name, $label, $desc = '' ) {
    $id  = get_option( $name );
    $url = $id ? wp_get_attachment_url( $id ) : '';
    ?>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
        <td>
            <div class="atlas-image-upload">
                <input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $id ); ?>" />
                <div class="atlas-image-preview">
                    <?php if ( $url ) : ?>
                        <img src="<?php echo esc_url( $url ); ?>" alt="" style="max-width:150px;height:auto;" />
                    <?php else : ?>
                        <div class="atlas-no-image"><?php esc_html_e( 'No image selected', 'atlas-theme' ); ?></div>
                    <?php endif; ?>
                </div>
                <button type="button" class="button atlas-upload-button"><?php esc_html_e( 'Select Image', 'atlas-theme' ); ?></button>
                <button type="button" class="button atlas-remove-button" style="<?php echo $id ? '' : 'display:none;'; ?>"><?php esc_html_e( 'Remove', 'atlas-theme' ); ?></button>
            </div>
            <?php if ( $desc ) : ?><p class="description"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
        </td>
    </tr>
    <?php
}

/**
 * Render the Options Page
 */
function atlas_theme_options_page() {
    ?>
    <div class="wrap atlas-options-container">
        <h1><?php esc_html_e( 'Atlas Theme Options', 'atlas-theme' ); ?></h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'atlas_theme_options' ); ?>

            <h2 class="nav-tab-wrapper atlas-options-tabs">
                <a href="#hero-section" class="nav-tab nav-tab-active"><?php esc_html_e( 'Hero / Sobre', 'atlas-theme' ); ?></a>
                <a href="#branding-section" class="nav-tab"><?php esc_html_e( 'Marca', 'atlas-theme' ); ?></a>
                <a href="#work-section" class="nav-tab"><?php esc_html_e( 'Trabalho', 'atlas-theme' ); ?></a>
                <a href="#contact-section" class="nav-tab"><?php esc_html_e( 'Contacto', 'atlas-theme' ); ?></a>
                <a href="#social-section" class="nav-tab"><?php esc_html_e( 'Social', 'atlas-theme' ); ?></a>
                <a href="#seo-section" class="nav-tab"><?php esc_html_e( 'SEO', 'atlas-theme' ); ?></a>
            </h2>

            <!-- HERO / ABOUT -->
            <div id="hero-section" class="atlas-options-tab-content active">
                <h2><?php esc_html_e( 'Hero & Sobre', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_hero_lead', __( 'Texto do hero', 'atlas-theme' ), 'Estúdio de engenharia e produto. Construímos software que resolve problemas reais — e que aguenta o peso do mundo real.', 'textarea', __( 'Subtítulo abaixo do título ATLAS INVENCÍVEL.', 'atlas-theme' ) );
                    atlas_opt_field( 'atlas_code_years', __( 'Anos (bloco código)', 'atlas-theme' ), '15' );
                    atlas_opt_field( 'atlas_code_companies', __( 'Empresas (bloco código)', 'atlas-theme' ), '5' );
                    atlas_opt_field( 'atlas_code_communities', __( 'Comunidades (bloco código)', 'atlas-theme' ), '+50' );
                    atlas_opt_field( 'atlas_about_title', __( 'Título "Sobre"', 'atlas-theme' ), 'Luís Marques — webmaster, builder & founder.' );
                    atlas_opt_field( 'atlas_about_text', __( 'Texto "Sobre"', 'atlas-theme' ), '', 'textarea' );
                    atlas_opt_image_field( 'atlas_about_image', __( 'Imagem "Sobre"', 'atlas-theme' ), __( 'Foto de perfil da secção Sobre.', 'atlas-theme' ) );
                    atlas_opt_image_field( 'atlas_hero_image', __( 'Imagem do hero (fallback)', 'atlas-theme' ) );
                    ?>
                </tbody></table>
            </div>

            <!-- BRANDING -->
            <div id="branding-section" class="atlas-options-tab-content">
                <h2><?php esc_html_e( 'Marca', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_logo_icon', __( 'Ícone do logo', 'atlas-theme' ), 'A', 'text', __( 'Letra mostrada no quadrado do logo (se não houver logo de imagem).', 'atlas-theme' ) );
                    atlas_opt_field( 'atlas_logo_text', __( 'Texto do logo', 'atlas-theme' ), 'atlas.invencivel' );
                    atlas_opt_field( 'atlas_footer_logo_text', __( 'Wordmark do footer', 'atlas-theme' ), 'ATLAS INVENCÍVEL' );
                    atlas_opt_field( 'atlas_footer_description', __( 'Tagline do footer', 'atlas-theme' ), 'helping people solve problems with code' );
                    ?>
                </tbody></table>
                <p class="description"><?php esc_html_e( 'O logo de imagem define-se em Personalizar → Identidade do site.', 'atlas-theme' ); ?></p>
            </div>

            <!-- WORK -->
            <div id="work-section" class="atlas-options-tab-content">
                <h2><?php esc_html_e( 'Trabalho', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_projects_limit', __( 'Nº de projetos na homepage', 'atlas-theme' ), '6', 'number' );
                    ?>
                </tbody></table>
                <p class="description"><?php esc_html_e( 'Os projetos são geridos em Projects. Os serviços em Skills e o percurso em Timeline.', 'atlas-theme' ); ?></p>
            </div>

            <!-- CONTACT -->
            <div id="contact-section" class="atlas-options-tab-content">
                <h2><?php esc_html_e( 'Contacto', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_contact_email', __( 'Email de contacto', 'atlas-theme' ), 'lm@atlasinvencivel.pt', 'email' );
                    atlas_opt_field( 'atlas_contact_location', __( 'Localização', 'atlas-theme' ), 'Porto, Portugal' );
                    atlas_opt_field( 'atlas_cf7_id', __( 'ID do formulário (Contact Form 7)', 'atlas-theme' ), '5d3b3ca', 'text', __( 'ID do shortcode do Contact Form 7 usado na página de contacto.', 'atlas-theme' ) );
                    ?>
                </tbody></table>
            </div>

            <!-- SOCIAL -->
            <div id="social-section" class="atlas-options-tab-content">
                <h2><?php esc_html_e( 'Redes sociais', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_social_linkedin', 'LinkedIn', 'https://www.linkedin.com/in/luismsmarques/', 'url' );
                    atlas_opt_field( 'atlas_social_twitter', 'X / Twitter', 'https://x.com/luismsmarques/', 'url' );
                    atlas_opt_field( 'atlas_social_github', 'GitHub', 'https://github.com/luismsmarques', 'url' );
                    atlas_opt_field( 'atlas_social_peerlist', 'Peerlist', 'https://peerlist.io/luismsmarques', 'url' );
                    ?>
                </tbody></table>
            </div>

            <!-- SEO -->
            <div id="seo-section" class="atlas-options-tab-content">
                <h2><?php esc_html_e( 'SEO', 'atlas-theme' ); ?></h2>
                <table class="form-table"><tbody>
                    <?php
                    atlas_opt_field( 'atlas_site_description', __( 'Meta description do site', 'atlas-theme' ), 'Estúdio de engenharia e produto. Construímos software que resolve problemas reais — e que aguenta o peso do mundo real.', 'textarea', __( 'Usada na meta description / Open Graph quando não há plugin de SEO ativo.', 'atlas-theme' ) );
                    ?>
                </tbody></table>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <style>
        .atlas-options-container { max-width: 1100px; }
        .atlas-options-tab-content { display: none; padding: 16px 0; }
        .atlas-options-tab-content.active { display: block; }
        .atlas-image-upload { display: flex; align-items: center; gap: 10px; }
        .atlas-image-preview { border: 1px solid #ddd; padding: 8px; border-radius: 4px; min-width: 120px; text-align: center; }
        .atlas-no-image { color: #777; font-style: italic; padding: 14px; }
        .form-table th { width: 220px; }
    </style>

    <script>
    jQuery(document).ready(function($) {
        // Tabs
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.atlas-options-tab-content').removeClass('active');
            $(target).addClass('active');
        });

        // Media uploader (works for every image field on the page)
        $('.atlas-upload-button').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var input = button.siblings('input[type="hidden"]');
            var preview = button.siblings('.atlas-image-preview');
            var removeButton = button.siblings('.atlas-remove-button');

            var frame = wp.media({
                title: '<?php echo esc_js( __( 'Selecionar imagem', 'atlas-theme' ) ); ?>',
                button: { text: '<?php echo esc_js( __( 'Usar imagem', 'atlas-theme' ) ); ?>' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                input.val(attachment.id);
                preview.html('<img src="' + attachment.url + '" alt="" style="max-width:150px;height:auto;" />');
                removeButton.show();
            });
            frame.open();
        });

        $('.atlas-remove-button').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            button.siblings('input[type="hidden"]').val('');
            button.siblings('.atlas-image-preview').html('<div class="atlas-no-image"><?php echo esc_js( __( 'No image selected', 'atlas-theme' ) ); ?></div>');
            button.hide();
        });
    });
    </script>
    <?php
}
