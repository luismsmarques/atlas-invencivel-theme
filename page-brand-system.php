<?php
/**
 * Template Name: Brand System
 * Description: Atlas Invencível brand & identity guidelines page.
 *
 * @package AtlasTheme
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$brand_year = date( 'Y' );
?>

<div class="brand-page">

    <!-- UTILITY BAR -->
    <div class="brand-utility">
        <span>Atlas Invencível</span>
        <span>Brand &amp; Identity System</span>
        <span>V1.0 — <?php echo esc_html( $brand_year ); ?></span>
    </div>

    <!-- 01 COVER -->
    <section class="brand-cover">
        <span class="ring ring-1"></span>
        <span class="ring ring-2"></span>
        <div class="brand-cover-inner">
            <div class="brand-cover-eyebrow">&#9094; Identidade Visual &middot; Visual Identity</div>
            <h1>ATLAS</h1>
            <h1 class="outline">INVENCÍVEL</h1>
            <p class="brand-cover-lead">Helping people solve problems with code.</p>
            <div class="brand-cover-toc">
                <span>01 — Wordmark</span><span>02 — Cor</span><span>03 — Tipo</span><span>04 — Aplicações</span>
            </div>
        </div>
    </section>

    <!-- 02 CONTENTS -->
    <section class="brand-sec light">
        <div class="brand-eyebrow">Índice — Contents</div>
        <div class="brand-index">
            <div class="row"><span><b>01</b>Posicionamento &amp; Essência</span><span class="en">Strategy</span></div>
            <div class="row indent"><span><b>02</b>Logótipo &amp; Variações</span><span class="en">Logo</span></div>
            <div class="row"><span><b>03</b>Sistema de Cor</span><span class="en">Color</span></div>
            <div class="row indent"><span><b>04</b>Tipografia</span><span class="en">Type</span></div>
            <div class="row"><span><b>05</b>Voz &amp; Tom</span><span class="en">Voice</span></div>
            <div class="row indent"><span><b>06</b>Aplicações</span><span class="en">Apps</span></div>
        </div>
    </section>

    <!-- 03 POSITIONING -->
    <section class="brand-sec dark">
        <div class="brand-eyebrow">01 — Posicionamento &middot; Positioning</div>
        <h2 class="brand-h2">Construímos com código aquilo que sustenta negócios. <span class="muted">We build, with code, what holds businesses up.</span></h2>
        <p class="brand-lead">A Atlas Invencível resolve problemas reais com engenharia, estratégia e produto. Combinamos a solidez de um parceiro de confiança com a ambição de quem constrói para escalar.</p>
        <div class="brand-cards-3">
            <div class="brand-card">
                <div class="pno">P/01</div>
                <h3>Engenharia</h3>
                <p>Código como ferramenta, não como fim. Precisão, robustez e manutenção a longo prazo.</p>
            </div>
            <div class="brand-card">
                <div class="pno">P/02</div>
                <h3>Visão</h3>
                <p>Mentalidade de startup e de investidor. Vemos produto, mercado e oportunidade.</p>
            </div>
            <div class="brand-card">
                <div class="pno">P/03</div>
                <h3>Confiança</h3>
                <p>Um Atlas que aguenta o peso. Compromisso, transparência e entrega que não cede.</p>
            </div>
        </div>
    </section>

    <!-- 04 LOGO -->
    <section class="brand-sec light">
        <div class="brand-eyebrow">02 — Logótipo &middot; Wordmark</div>

        <div class="brand-lockup">
            <div class="brand-lockup-row">
                <div class="brand-mark-box">
                    <span>A</span>
                    <span class="load"></span>
                </div>
                <div class="brand-wordmark">
                    <div class="top">ATLAS</div>
                    <div class="bottom">INVENCÍVEL</div>
                </div>
            </div>
            <div class="corner">PRIMARY LOCKUP</div>
        </div>

        <div class="brand-logo-grid">
            <div class="brand-logo-cell dark">
                <div><div class="top" style="color:#F2EEE4;">ATLAS</div><div class="bottom" style="color:#2D5BFF;">INVENCÍVEL</div></div>
            </div>
            <div class="brand-logo-cell bone">
                <div><div class="top" style="color:#0A0E17;">ATLAS</div><div class="bottom" style="color:#9A9484;">INVENCÍVEL</div></div>
            </div>
            <div class="brand-logo-cell accent">
                <div><div class="top" style="color:#fff;">ATLAS</div><div class="bottom" style="color:rgba(255,255,255,.7);">INVENCÍVEL</div></div>
            </div>
        </div>
    </section>

    <!-- 05 COLOR -->
    <section class="brand-sec dark">
        <div class="brand-eyebrow">03 — Sistema de Cor &middot; Color</div>
        <div class="brand-swatches">
            <div class="brand-swatch">
                <div class="chip" style="background:#0A0E17;"></div>
                <div class="meta"><div class="name">Obsidian</div><div class="use">Fundação &middot; base escura</div><div class="hex">#0A0E17<br>oklch(.16 .02 260)</div></div>
            </div>
            <div class="brand-swatch">
                <div class="chip" style="background:#141B29;"></div>
                <div class="meta"><div class="name">Graphite</div><div class="use">Superfícies &middot; cartões</div><div class="hex">#141B29<br>oklch(.22 .03 262)</div></div>
            </div>
            <div class="brand-swatch">
                <div class="chip" style="background:#6C7689;"></div>
                <div class="meta"><div class="name">Steel</div><div class="use">Texto secundário &middot; linhas</div><div class="hex">#6C7689<br>oklch(.54 .03 258)</div></div>
            </div>
            <div class="brand-swatch">
                <div class="chip" style="background:#F2EEE4;"></div>
                <div class="meta"><div class="name">Bone</div><div class="use">Papel &middot; fundos claros</div><div class="hex">#F2EEE4<br>oklch(.95 .01 85)</div></div>
            </div>
        </div>

        <div class="brand-accent-feature">
            <div class="brand-accent-box">
                <div class="lbl">SIGNAL — COR PRIMÁRIA</div>
                <div>
                    <div class="big">Cobalt</div>
                    <div class="code">#2D5BFF &middot; oklch(.56 .23 264)</div>
                    <p>A única cor de marca. Usar com intenção: CTAs, links, destaques, a linha de carga. Nunca como fundo de grandes áreas de texto.</p>
                </div>
            </div>
            <div class="brand-ratio">
                <div class="lbl">PROPORÇÃO DE USO</div>
                <div class="bar">
                    <i style="flex:62;background:#0A0E17;border:1px solid #2A3346;"></i>
                    <i style="flex:28;background:#F2EEE4;"></i>
                    <i style="flex:10;background:#2D5BFF;"></i>
                </div>
                <div class="legend"><span>Obsidian 60%</span><span>Bone 30%</span><span style="color:#2D5BFF;">Cobalt 10%</span></div>
                <p>Disciplina cromática: muito neutro, pouco sinal. É isto que dá o ar premium e engenheirado.</p>
            </div>
        </div>
    </section>

    <!-- 06 TYPOGRAPHY -->
    <section class="brand-sec light">
        <div class="brand-eyebrow">04 — Tipografia &middot; Type</div>
        <div class="brand-type-3">
            <div class="brand-type-card">
                <div class="aa" style="font-family:var(--font-display);font-weight:700;">Aa</div>
                <div class="tag">DISPLAY</div>
                <div class="fam">Space Grotesk</div>
                <p>Wordmark, títulos, números. Geométrica, técnica, memorável.</p>
            </div>
            <div class="brand-type-card">
                <div class="aa" style="font-family:var(--font-body);font-weight:600;">Aa</div>
                <div class="tag">TEXTO</div>
                <div class="fam">IBM Plex Sans</div>
                <p>Corpo de texto, UI. Neutra, legível, excelente em Português.</p>
            </div>
            <div class="brand-type-card dark">
                <div class="aa" style="font-family:var(--font-mono);font-weight:500;">Aa</div>
                <div class="tag">MONO</div>
                <div class="fam">IBM Plex Mono</div>
                <p>Labels, metadados, código. O sinal de engenharia.</p>
            </div>
        </div>
    </section>

    <!-- 07 VOICE -->
    <section class="brand-sec dark">
        <div class="brand-eyebrow">05 — Voz &amp; Tom &middot; Voice</div>
        <div class="brand-voice-3">
            <div><h3>Direto</h3><p>Sem jargão de consultoria. Dizemos o que fazemos e o que custa. Clareza é respeito.</p></div>
            <div><h3>Confiante</h3><p>Falamos com a calma de quem entrega. Nunca arrogante, sempre seguro.</p></div>
            <div><h3>Construtor</h3><p>Linguagem de quem cria: problema, solução, resultado. Verbos, não adjetivos.</p></div>
        </div>
        <div class="brand-voice-2">
            <div class="cell say"><div class="lbl">✓ DIZEMOS</div><p>"Construímos a plataforma em 6 semanas e reduzimos o churn em 18%."</p></div>
            <div class="cell avoid"><div class="lbl">✕ EVITAMOS</div><p>"Soluções inovadoras e disruptivas que potenciam sinergias digitais de excelência."</p></div>
        </div>
    </section>

    <!-- COLOPHON -->
    <section class="brand-colophon">
        <div>
            <div class="word">ATLAS <span class="outline">INVENCÍVEL</span></div>
            <div class="tag">Helping people solve problems with code.</div>
        </div>
        <div class="meta">BRAND SYSTEM V1.0<br>&copy; <?php echo esc_html( $brand_year ); ?> ATLAS INVENCÍVEL</div>
    </section>

</div>

<?php get_footer(); ?>
