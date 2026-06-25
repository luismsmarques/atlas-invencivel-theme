<?php
/**
 * Template Name: Contact Page
 * The template for displaying the contact page — Atlas Invencível 2026
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$ai_email    = get_option( 'atlas_contact_email', 'lm@atlasinvencivel.pt' );
$ai_location = get_option( 'atlas_contact_location', 'Porto, Portugal' );
$ai_cf7_id   = get_option( 'atlas_cf7_id', '5d3b3ca' );

$ai_socials = array(
    'linkedin' => get_option( 'atlas_social_linkedin', 'https://www.linkedin.com/in/luismsmarques/' ),
    'x'        => get_option( 'atlas_social_twitter', 'https://x.com/luismsmarques/' ),
    'github'   => get_option( 'atlas_social_github', 'https://github.com/luismsmarques' ),
);
?>

<section class="ai-contact-page">

    <header class="ai-page-header">
        <div class="ai-page-label">// CONTACTO.exec</div>
        <h1 class="ai-page-title"><?php esc_html_e( 'Vamos construir algo invencível.', 'atlas-theme' ); ?></h1>
        <p class="ai-page-sub"><?php esc_html_e( 'Tens um projeto em mente? Diz-me o que precisas — respondo em 24h.', 'atlas-theme' ); ?></p>
    </header>

    <div class="ai-contact-cols">

        <!-- Form -->
        <div class="ai-contact-form">
            <div class="ai-code-bar"><span></span><span></span><span></span></div>
            <div class="ai-contact-form-body">
                <div class="ai-contact-form-head">// new_message.send()</div>
                <?php
                if ( function_exists( 'wpcf7_contact_form' ) ) {
                    echo do_shortcode( '[contact-form-7 id="' . esc_attr( $ai_cf7_id ) . '" title="Contact"]' );
                } else {
                    ?>
                    <p class="ai-contact-fallback">
                        <?php esc_html_e( 'O plugin Contact Form 7 é necessário para o formulário. Em alternativa, escreve diretamente:', 'atlas-theme' ); ?>
                        <a href="mailto:<?php echo esc_attr( $ai_email ); ?>"><?php echo esc_html( $ai_email ); ?></a>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Info -->
        <aside class="ai-contact-info">
            <div class="ai-contact-item">
                <div class="k">EMAIL</div>
                <a class="v" href="mailto:<?php echo esc_attr( $ai_email ); ?>"><?php echo esc_html( $ai_email ); ?></a>
            </div>
            <div class="ai-contact-item">
                <div class="k">LOCALIZAÇÃO</div>
                <div class="v"><?php echo esc_html( $ai_location ); ?></div>
            </div>
            <div class="ai-contact-item">
                <div class="k">REDES</div>
                <div class="ai-contact-social">
                    <?php
                    foreach ( $ai_socials as $ai_label => $ai_url ) {
                        if ( ! empty( $ai_url ) ) {
                            echo '<a href="' . esc_url( $ai_url ) . '" target="_blank" rel="noopener">' . esc_html( $ai_label ) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ai-contact-note">
                <span class="prompt">$</span> <?php esc_html_e( 'helping people solve problems with code', 'atlas-theme' ); ?><span class="ai-caret"></span>
            </div>
        </aside>

    </div>

</section>

<?php
get_footer();
