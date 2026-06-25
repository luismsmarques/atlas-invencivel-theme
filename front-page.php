<?php
/**
 * The front page template — Atlas Invencível 2026 (bilingual PT/EN)
 *
 * @package AtlasTheme
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$atlas_email = get_option( 'atlas_contact_email', 'lm@atlasinvencivel.pt' );
$atlas_hero_lead = get_option( 'atlas_hero_lead', atlas_t(
    'Estúdio de engenharia e produto. Construímos software que resolve problemas reais — e que aguenta o peso do mundo real.',
    'Engineering & product studio. We build software that solves real problems — and holds up under the weight of the real world.'
) );
?>

<!-- ============ HERO ============ -->
<header class="ai-hero" id="home">
    <div class="ai-hero-cmd">$ atlas --init <span class="accent">// helping people solve problems with code</span></div>
    <h1 class="ai-hero-title">ATLAS<span class="outline">INVENCÍVEL</span></h1>
    <div class="ai-hero-grid">
        <div>
            <p class="ai-hero-lead"><?php echo esc_html( $atlas_hero_lead ); ?></p>
            <div class="ai-hero-actions">
                <a href="#contacto" class="ai-btn ai-btn-primary"><?php atlas_te( 'Começar projeto', 'Start a project' ); ?> &rarr;</a>
                <a href="#trabalho" class="ai-btn ai-btn-ghost"><?php atlas_te( 'Ver trabalho', 'See work' ); ?></a>
            </div>
        </div>
        <div class="ai-code-card" aria-hidden="true">
            <div class="ai-code-bar"><span></span><span></span><span></span></div>
            <div class="ai-code-body">
                <span class="ln"><span class="kw">const</span> <span class="var">atlas</span> = {</span>
                <span class="ln ind"><?php atlas_te( 'anos', 'years' ); ?>: <span class="num"><?php echo esc_html( get_option( 'atlas_code_years', '15' ) ); ?></span>,</span>
                <span class="ln ind"><?php atlas_te( 'empresas', 'companies' ); ?>: <span class="num"><?php echo esc_html( get_option( 'atlas_code_companies', '5' ) ); ?></span>,</span>
                <span class="ln ind"><?php atlas_te( 'comunidades', 'communities' ); ?>: <span class="num"><?php echo esc_html( get_option( 'atlas_code_communities', '+50' ) ); ?></span>,</span>
                <span class="ln ind">stack: [<span class="str">'code'</span>, <span class="str">'AI'</span>, <span class="str">'growth'</span>],</span>
                <span class="ln">}<span class="ai-caret"></span></span>
            </div>
        </div>
    </div>
</header>

<!-- ============ SERVICES ============ -->
<?php
$atlas_services = new WP_Query( array(
    'post_type'      => 'atlas_skill',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$atlas_service_items = array();
if ( $atlas_services->have_posts() ) {
    while ( $atlas_services->have_posts() ) {
        $atlas_services->the_post();
        $atlas_abbr = get_post_meta( get_the_ID(), '_atlas_skill_abbreviation', true );
        $atlas_service_items[] = array(
            'tag'  => $atlas_abbr ? $atlas_abbr : strtoupper( substr( get_the_title(), 0, 4 ) ),
            'name' => get_the_title(),
            'desc' => wp_strip_all_tags( get_the_content() ),
        );
    }
    wp_reset_postdata();
} else {
    $atlas_service_items = array(
        array( 'tag' => 'WP',    'name' => atlas_t( 'WordPress & Web', 'WordPress & Web' ),              'desc' => atlas_t( 'Construímos sites e plataformas rápidos, fiáveis e fáceis de gerir.', 'We build fast, reliable sites and platforms that are easy to manage.' ) ),
        array( 'tag' => 'CODE',  'name' => atlas_t( 'Programação', 'Programming' ),                       'desc' => atlas_t( 'Desenvolvemos aplicações e automações à medida — da ideia ao deploy.', 'We develop custom apps and automations — from idea to deploy.' ) ),
        array( 'tag' => 'AI',    'name' => atlas_t( 'Inteligência Artificial', 'Artificial Intelligence' ), 'desc' => atlas_t( 'Integramos IA para automatizar tarefas e escalar produtos reais.', 'We integrate AI to automate tasks and scale real products.' ) ),
        array( 'tag' => 'DM',    'name' => atlas_t( 'Marketing Digital', 'Digital Marketing' ),           'desc' => atlas_t( 'Ligamos produto, audiência e resultados com estratégia digital.', 'We connect product, audience and results with digital strategy.' ) ),
        array( 'tag' => 'STRAT', 'name' => atlas_t( 'Estratégia de Conteúdo', 'Content Strategy' ),       'desc' => atlas_t( 'Criamos conteúdo e comunidade que constroem marca a longo prazo.', 'We create content and community that build brand over the long run.' ) ),
        array( 'tag' => 'ANGEL', 'name' => atlas_t( 'Investimento Anjo', 'Angel Investment' ),            'desc' => atlas_t( 'Investimos em startups com impacto real e potencial de escala.', 'We invest in startups with real impact and room to scale.' ) ),
    );
}
$atlas_service_count = count( $atlas_service_items );
?>
<section id="servicos" class="ai-section">
    <div class="ai-section-head">
        <span class="ai-label"><?php atlas_te( '// SERVICOS.spec', '// SERVICES.spec' ); ?></span>
        <span><?php echo esc_html( sprintf( '%02d MODULES', $atlas_service_count ) ); ?></span>
    </div>
    <?php $atlas_i = 0; foreach ( $atlas_service_items as $atlas_service ) : $atlas_i++; ?>
        <div class="ai-spec-row">
            <span class="ai-spec-tag"><?php echo esc_html( $atlas_service['tag'] ); ?></span>
            <h3><?php echo esc_html( $atlas_service['name'] ); ?></h3>
            <span class="ai-spec-desc"><?php echo esc_html( $atlas_service['desc'] ); ?></span>
            <span class="ai-spec-no"><?php echo esc_html( sprintf( '%02d', $atlas_i ) ); ?></span>
        </div>
    <?php endforeach; ?>
</section>

<!-- ============ WORK ============ -->
<?php
$atlas_projects = new WP_Query( array(
    'post_type'      => 'atlas_project',
    'posts_per_page' => get_option( 'atlas_projects_limit', 6 ),
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$atlas_work_items = array();
if ( $atlas_projects->have_posts() ) {
    while ( $atlas_projects->have_posts() ) {
        $atlas_projects->the_post();
        $atlas_cat  = get_post_meta( get_the_ID(), '_atlas_project_category', true );
        $atlas_date = get_post_meta( get_the_ID(), '_atlas_project_date', true );
        $atlas_work_items[] = array(
            'title' => get_the_title(),
            'sub'   => get_the_excerpt(),
            'cat'   => $atlas_cat ? $atlas_cat : atlas_t( 'PROJETO', 'PROJECT' ),
            'year'  => $atlas_date ? $atlas_date : get_the_date( 'Y' ),
            'url'   => get_permalink(),
        );
    }
    wp_reset_postdata();
} else {
    $atlas_work_items = array(
        array( 'title' => 'AI Tools',       'sub' => atlas_t( 'Plataforma que integra ferramentas de IA.', 'A platform that brings AI tools together.' ),        'cat' => 'IA / WEB', 'year' => '2024', 'url' => '#' ),
        array( 'title' => 'How To Invest',  'sub' => atlas_t( 'App financeira para investidores principiantes.', 'A finance app for first-time investors.' ),     'cat' => 'FINTECH', 'year' => '2025', 'url' => '#' ),
        array( 'title' => 'ToS Summarizer', 'sub' => atlas_t( 'IA que resume Termos de Serviço.', 'AI that summarizes Terms of Service.' ),                       'cat' => 'IA / WEB', 'year' => '2025', 'url' => '#' ),
    );
}
$atlas_work_count = count( $atlas_work_items );
?>
<section id="trabalho" class="ai-section">
    <div class="ai-section-head">
        <span class="ai-label"><?php atlas_te( '// TRABALHO.log', '// WORK.log' ); ?></span>
        <span><?php echo esc_html( sprintf( '%02d ENTRIES', $atlas_work_count ) ); ?></span>
    </div>
    <div class="ai-work-head">
        <span>ID</span><span><?php atlas_te( 'PROJETO', 'PROJECT' ); ?></span><span><?php atlas_te( 'CATEGORIA', 'CATEGORY' ); ?></span><span><?php atlas_te( 'ANO', 'YEAR' ); ?></span><span></span>
    </div>
    <?php $atlas_j = 0; foreach ( $atlas_work_items as $atlas_work ) : $atlas_j++; ?>
        <a href="<?php echo esc_url( $atlas_work['url'] ); ?>" class="ai-work-row">
            <span class="ai-work-id"><?php echo esc_html( sprintf( '%03d', $atlas_j ) ); ?></span>
            <div>
                <div class="ai-work-title"><?php echo esc_html( $atlas_work['title'] ); ?></div>
                <?php if ( $atlas_work['sub'] ) : ?>
                    <div class="ai-work-sub"><?php echo esc_html( $atlas_work['sub'] ); ?></div>
                <?php endif; ?>
            </div>
            <span class="ai-work-cat"><?php echo esc_html( $atlas_work['cat'] ); ?></span>
            <span class="ai-work-year"><?php echo esc_html( $atlas_work['year'] ); ?></span>
            <span class="ai-work-arrow">&rarr;</span>
        </a>
    <?php endforeach; ?>
</section>

<!-- ============ ABOUT ============ -->
<?php
$atlas_about_title = get_option( 'atlas_about_title', atlas_t(
    'Luís Marques — webmaster, builder & founder.',
    'Luís Marques — webmaster, builder & founder.'
) );
$atlas_about_text  = get_option( 'atlas_about_text', atlas_t(
    'Há mais de 12 anos a construir na interseção entre tecnologia e digital — de websites premiados a liderar empresas e investir em startups. Hoje, CEO da Atlas Invencível.',
    'More than 12 years building at the intersection of technology and digital — from award-winning websites to leading companies and investing in startups. Today, CEO of Atlas Invencível.'
) );

$atlas_about_img_id = get_option( 'atlas_about_image', get_option( 'atlas_hero_image' ) );
if ( $atlas_about_img_id ) {
    $atlas_about_img = wp_get_attachment_image_url( $atlas_about_img_id, 'atlas-hero' );
} else {
    $atlas_about_img = get_template_directory_uri() . '/assets/images/luis-marques-profile.png';
}

$atlas_cv = new WP_Query( array(
    'post_type'      => 'atlas_timeline',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'meta_query'     => array(
        array( 'key' => '_atlas_timeline_type', 'value' => 'experience' ),
    ),
    'orderby'        => 'meta_value',
    'meta_key'       => '_atlas_timeline_date',
    'order'          => 'DESC',
) );

$atlas_cv_items = array();
if ( $atlas_cv->have_posts() ) {
    while ( $atlas_cv->have_posts() ) {
        $atlas_cv->the_post();
        $atlas_cv_items[] = array(
            'date'  => get_post_meta( get_the_ID(), '_atlas_timeline_date', true ),
            'title' => get_the_title(),
        );
    }
    wp_reset_postdata();
} else {
    $atlas_cv_items = array(
        array( 'date' => '2025—',   'title' => atlas_t( 'CEO · Atlas Invencível', 'CEO · Atlas Invencível' ) ),
        array( 'date' => '2024—',   'title' => atlas_t( 'Angel Investor · AngelsWay', 'Angel Investor · AngelsWay' ) ),
        array( 'date' => '2021—25', 'title' => atlas_t( 'CTO & Marketer · MADS Network', 'CTO & Marketer · MADS Network' ) ),
        array( 'date' => '2014',    'title' => atlas_t( 'Vencedor · Prémios Novos', 'Winner · Prémios Novos' ) ),
    );
}
?>
<section id="sobre" class="ai-section">
    <div class="ai-about-grid">
        <div class="ai-about-photo">
            <img src="<?php echo esc_url( $atlas_about_img ); ?>" alt="<?php echo esc_attr( $atlas_about_title ); ?>" class="profile-image">
            <span class="filetag">USR_001.jpg</span>
        </div>
        <div>
            <div class="ai-label" style="margin-bottom:24px;"><?php atlas_te( '// SOBRE.md', '// ABOUT.md' ); ?></div>
            <h2 class="ai-about-title"><?php echo esc_html( $atlas_about_title ); ?></h2>
            <p class="ai-about-text"><?php echo esc_html( $atlas_about_text ); ?></p>
            <div class="ai-about-cv">
                <?php foreach ( $atlas_cv_items as $atlas_cv_item ) : ?>
                    <div><span class="yr"><?php echo esc_html( $atlas_cv_item['date'] ); ?></span><?php echo esc_html( $atlas_cv_item['title'] ); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============ CONTACT ============ -->
<?php
// Botão "enviar" → página de Contacto (na língua ativa); fallback para mailto.
$atlas_contact_page = function_exists( 'atlas_page_url' )
    ? atlas_page_url( array( 'contacto', 'contact', 'contact-2', 'contactos' ) )
    : '';
if ( ! $atlas_contact_page || ( function_exists( 'atlas_home_url' ) && $atlas_contact_page === atlas_home_url( '/' ) ) ) {
    $atlas_contact_page = 'mailto:' . $atlas_email;
}
?>
<section id="contacto" class="ai-contact">
    <div class="ai-label" style="margin-bottom:28px;"><?php atlas_te( '// CONTACTO.exec', '// CONTACT.exec' ); ?></div>
    <h2><?php atlas_te( 'Vamos construir algo invencível.', "Let's build something invincible." ); ?></h2>
    <div class="ai-contact-line">
        <span class="prompt">$</span>
        <a href="mailto:<?php echo esc_attr( $atlas_email ); ?>" class="mail"><?php echo esc_html( $atlas_email ); ?></a>
        <span class="ai-caret" style="height:17px;"></span>
        <a href="<?php echo esc_url( $atlas_contact_page ); ?>" class="ai-btn ai-btn-primary"><?php atlas_te( 'enviar', 'send' ); ?> &rarr;</a>
    </div>
</section>

<?php get_footer(); ?>
