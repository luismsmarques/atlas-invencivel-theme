# Case Studies — Atlas Invencível

> Rascunho/fonte do conteúdo. Gerado a partir do mesmo data-set que produz `case-studies.xml`.

> Estilo: **narrativa de construção** (decisões e porquês). Sem métricas inventadas.

> Mapeamento → meta: categoria→category · ano→date · função→client · stack→technologies · estado→status · resumo→excerpt · desafio→challenges · abordagem→conteúdo · solução→solutions · resultados→results · url→project_url.


---


## 01 · How To Invest
- **slug**: `how-to-invest`
- **url**: https://howtoinvest.pro/
- **repo**: https://github.com/luismsmarques/how-to-invest-v2
- **categoria**: FINTECH / EDTECH
- **ano**: 2025—26
- **função**: Eng · Produto · Full-stack
- **stack**: WordPress (FSE) · plugin hti-engine (PHP 8) · MySQL · JavaScript · API REST · Google Gemini · PDF em PHP · Brevo · GA4 · Cloudflare
- **estado**: ● em produção
- **resumo**: App de educação financeira reconstruída de React para WordPress, com um princípio firme: as regras decidem a alocação; a IA apenas explica.

**Desafio**

Investir assusta quem nunca o fez — e o mercado fala por jargão. O primeiro desafio era esse: dar a iniciados a confiança para o primeiro passo. O segundo era pessoal e técnico: usar esta era da IA para desenvolver novas competências — começar o produto em vibecoding (Base44) e, a partir daí, levá-lo a um desenvolvimento completo e próprio.

**Abordagem**

Trabalho com WordPress há mais de 15 anos, por isso a escolha foi óbvia: encaixava nas minhas competências e nas necessidades do projeto — em especial na distribuição. Queríamos que cada artigo e cada conceito fossem indexáveis e trouxessem tráfego orgânico composto.

A decisão de arquitetura mais importante foi de confiança: **as regras decidem (arquétipo + alocação); o LLM apenas explica.** A lógica de recomendação é determinística e auditável; o Gemini entra só para dar contexto em linguagem simples, nunca para escolher por ti.

A partir daí, as restrições escreveram-se sozinhas: output só por classes de ativos (nunca instrumentos nomeados), disclaimers em todos os resultados, a chave da IA sempre no servidor, e o RGPD (exportar/apagar dados) como prioridade desde o primeiro dia.

**Solução**

Um tema de blocos nativo (FSE) e um plugin próprio — o hti-engine — que expõe a API REST: recomendação, reclamar perfil, conta e exportação. Frontend em JavaScript vanilla, com gráficos leves só onde acrescentam e geração de PDF em PHP. Em torno do motor há um ecossistema: um plugin de notícias que agrega RSS e gera artigos, imagens sociais e reels; leitura de eventos interna e via GA4; e newsletters diárias e semanais ligadas ao Brevo. A camada de conteúdo — artigos e glossário — é editável sem código, porque é ela que alimenta o SEO.

**Resultados**

Online desde junho de 2025 (começou em Base44, hoje em desenvolvimento próprio). Os dados do GA4 (jan 2025 – jun 2026) mostram cerca de 3.300 utilizadores ativos e 28.369 eventos, com alcance em dezenas de países e conteúdo em vários idiomas (PT, EN, ES, FR, DE e mais). O questionário — o coração do produto — tem uma taxa de rejeição de apenas ~3%: quem entra, completa. A maior aprendizagem: a escolha de plataforma foi tanto uma decisão de marketing como de engenharia.

**Notas**: Dados de GA4 (jan 2025–jun 2026). Online desde junho de 2025 (Base44), hoje em WordPress próprio.

---

## 02 · ToS Summarizer
- **slug**: `tos-summarizer`
- **url**: https://tos.atlasinvencivel.pt/
- **repo**: https://github.com/luismsmarques/tos-privacy-summarizer
- **categoria**: IA / WEB
- **ano**: 2025
- **função**: Estratégia · Eng · Produto
- **stack**: JavaScript · Chrome Extension (Manifest V3) · Node.js · Express · Supabase/PostgreSQL · Google Gemini · Stripe · JWT · Cursor (IA) · Vercel
- **estado**: ● em produção
- **resumo**: Extensão Chrome que resume Termos de Serviço e Políticas de Privacidade com IA — e classifica o risco antes de aceitares.

**Desafio**

Tudo começou num post do Pedro Fonseca: e se a IA resumisse os Termos de Serviço? A ideia ficou-me — porque não trazer isso para o browser, a um clique? Havia dois desafios. O do utilizador: ninguém lê os ToS (longos, densos, jurídicos) e aceitamos cláusulas sobre os nossos dados às cegas. E o meu, pessoal: este foi o meu primeiro projeto construído inteiramente com IA, e quis usá-lo para provar que dominava uma integração completa de ponta a ponta — pagamentos, gestão segura de chaves e deploy real em produção.

**Abordagem**

O MVP nasceu depressa, com o Cursor como co-piloto. Mas percebi cedo o verdadeiro travão à adoção: obrigar cada pessoa a colar a sua própria chave de API era uma barreira. A meta passou a ser dupla — acessível a qualquer pessoa e, acima de tudo, seguro.

O “experimento” tornou-se o meu maior projeto até à data. Construí a infraestrutura à volta disso: deploy completo na Vercel, pagamentos por créditos com Stripe, um sistema de gestão segura das chaves de API (a chave nunca sai do servidor) e um dashboard de gestão. A análise é feita pelo Google Gemini; o histórico e as contas vivem em base de dados.

**Solução**

Sobre qualquer ToS ou política, devolve um resumo estruturado (visão geral, pontos-chave, alertas de privacidade) e classifica risco, complexidade e boas práticas de 1 a 10, com indicadores tipo semáforo. Escolhes o foco (privacidade, termos ou equilibrado), guardas histórico com filtros e exportas em JSON/CSV/TXT. Um sistema de créditos com Stripe e gestão segura de chaves deixa usar a API partilhada — sem cada pessoa configurar a sua — ou a própria chave Gemini. Tudo coroado por um dashboard de gestão.

**Resultados**

Mais do que adoção, este projeto provou capacidade — mas a adoção também apareceu. Publicada na Chrome Web Store, a extensão soma cerca de 356 instalações com apenas 3 desinstalações: retenção quase total. Foi o meu primeiro produto construído inteiramente com IA e a primeira vez que liguei, de ponta a ponta, pagamentos (Stripe), gestão segura de chaves de API e deploy em produção na Vercel. O método que daqui saiu — validar a ideia, construir com IA como co-piloto e levar à produção com segurança — passou a ser a base de tudo o que construí depois.

**Notas**: Estatísticas da Chrome Web Store: ~356 instalações e 3 desinstalações (desde out/2025). Primeiro projeto construído inteiramente com IA (Cursor), inspirado num post de Pedro Fonseca. Armazenamento em Supabase/Postgres (a confirmar).

---

## 03 · VibeSell
- **slug**: `vibesell`
- **url**: http://vibesell.atlasinvencivel.pt/
- **repo**: https://github.com/luismsmarques/vibesell
- **categoria**: IA / GROWTH
- **ano**: 2026
- **função**: Estratégia · Eng · Produto
- **stack**: JavaScript · HTML/CSS/JS vanilla · Node.js/Express (API REST) · API Anthropic (Claude) · auth por magic link · Stripe (SaaS) · Vercel
- **estado**: ● pré-lançamento
- **resumo**: Extensão Chrome que, ao clicar em “Engage” num post do Reddit, devolve três rascunhos de resposta humanos e personalizados ao produto — copia, edita e publica tu.

**Desafio**

O Reddit está inundado de comentários gerados por IA — slop óbvio, que ninguém respeita e que as comunidades penalizam. Mas continua a ser um dos sítios com maior intenção de compra. O desafio: ajudar product owners a participar de forma genuína e em escala, sem cair no spam — com uma pessoa sempre a decidir antes de publicar.

**Abordagem**

O princípio é o oposto do slop: **a ferramenta sugere, o humano decide.** Nada é publicado automaticamente. Um botão “Engage” nas threads gera três rascunhos curtos e relevantes (1–3 frases), personalizados ao produto e a um nível de diretividade à escolha — copias, ajustas e publicas tu.

A inteligência vem da API da Anthropic (Claude). Por baixo, uma arquitetura enxuta: site estático, backend Express com API REST, login por magic link e pagamentos Stripe para o modelo SaaS — tudo na Vercel, com deploy contínuo e limites de uso por plano.

**Solução**

Extensão Chrome de drafting dentro do Reddit, site institucional e área de conta com login por magic link, dashboard de plano e medidor de uso. Monetização SaaS com Stripe (planos e limites diários); o plano pago abre auto-discovery, voice match e direct mode.

**Resultados**

A prova veio do mundo real: usei a própria extensão para promover o meu projeto How To Invest no Reddit. Mesmo com um primeiro MVP, esse canal trouxe mais de 150 utilizadores e cerca de 200 sessões (GA4) — uma das maiores fontes de tráfego do projeto. É o argumento central do VibeSell: participação genuína, com controlo humano, gera visitas reais sem queimar a marca. O produto está em pré-lançamento, com a stack SaaS completa (extensão, auth, pagamentos).

**Notas**: IA via API Anthropic (Claude). Tração demonstrada por um teste real a promover o How To Invest (GA4: 150+ utilizadores / ~200 sessões via Reddit). Repo privado.

---

## 04 · Super Portistas
- **slug**: `super-portistas`
- **url**: https://superportistas.pt/
- **repo**: https://github.com/luismsmarques/super-portistas-wordpress-theme (+ plugins)
- **categoria**: WORDPRESS / MEDIA
- **ano**: 2014—26
- **função**: Co-fundador · Tema + 4 plugins · Eng
- **stack**: WordPress 6.2+ · PHP 8.2+ · MySQL · HTMX + Alpine.js · REST API (sp/v1) · Firebase (Auth + FCM) · Brevo · Google Gemini · SportMonks API · YouTube API · X API · RSS.app
- **estado**: ● em produção (comunidade em beta)
- **resumo**: A maior comunidade de adeptos do FC Porto, agora como plataforma própria: agregação RSS, artigos por IA, dados SportMonks, gamificação e push em WordPress.

**Desafio**

Este é o meu projeto-bebé há mais de 12 anos. Eu e o meu sócio Pedro Andrade comprámos a página de fãs no Facebook quando o mercado ainda não estava saturado; ele fê-la crescer até hoje, para mais de 400 mil seguidores — a maior comunidade de adeptos do FC Porto. Ao longo dos anos testámos, acertámos e errámos em várias versões do site. O desafio desta versão é o mais ambicioso: transformar uma audiência social gigante numa plataforma e comunidade próprias, e manter um meio desportivo de alto ritmo quase em piloto automático, sem perder qualidade editorial.

**Abordagem**

A decisão de base foi modular: um tema fino para a apresentação e quatro plugins próprios para o domínio, para que cada peça evoluísse sem partir as outras.
- **super-portistas-wordpress-theme** — apresentação (frontend HTMX + Alpine.js, sidebars contextuais, dashboard de utilizador, opções de tema). Depende do Core.
- **super-portistas-core** — domínio: REST API sp/v1, gamificação + leaderboard, prognósticos, sondagens, auth e push via Firebase, integração Brevo (double opt-in, resumos, alertas, conquistas).
- **rss-manager** — ingestão automática (WP Cron) de RSS, YouTube, X/Twitter e capas de jornais para o CPT ai_news_article, com deduplicação por hash, filtros, logs e proteção SSRF.
- **ai-news** — camada editorial de IA (Gemini): artigos pre/post-match a partir de dados de jogos, “Resumo do dia”, conteúdo curado e “Source Studio” (artigos a partir de URL/texto).
- **api-sportmonks** — ponte de dados: sincroniza jogos no CPT aps_jogo, mapeia equipas/ligas, minutos ao vivo, e helpers consumidos pelo tema e pelo AI News.

**Solução**

Pipeline automatizado ponta-a-ponta: api-sportmonks alimenta dados factuais → ai-news transforma-os em artigos com Gemini → rss-manager agrega notícias/vídeos/redes/capas → super-portistas-core trata da comunidade (gamificação, prognósticos, push, newsletter) → o tema serve tudo com frontend leve HTMX + Alpine.js. Os plugins comunicam por hooks/filtros e por uma API de helpers, com baixo acoplamento.

**Resultados**

Não é um projeto novo — é uma audiência provada ao longo de uma década. Mais de 400 mil seguidores no Facebook e, no GA4 (2016–2026), mais de 515 mil utilizadores, 1,2 milhões de page views e 854 mil sessões só de social orgânico. Esta versão é a aposta madura: converter essa audiência numa comunidade própria. A camada de registo, gamificação e push está em fase de beta — primeiros 10 registos e sinais promissores — assente numa base técnica (tema + 4 plugins) madura e documentada (changelogs, testes PHPUnit, segurança).

**Notas**: Co-fundado com Pedro Andrade. 400k+ seguidores no Facebook (maior comunidade de adeptos do FC Porto). GA4 2016–2026: 515k+ utilizadores, 1,2M page views, 854k sessões de social orgânico. Camada de comunidade/registo em beta (10 registos). Tema e 3 plugins privados; api-sportmonks público.

---

## 05 · Lotarias.pt
- **slug**: `lotarias-pt`
- **url**: https://lotarias.pt/
- **repo**: https://github.com/luismsmarques/lotarias.pt (privado)
- **categoria**: WEB APP / PWA
- **ano**: 2026
- **função**: Full-stack · Eng
- **stack**: React 18 + Vite 6 · Base44 (SDK + funções serverless TS) · Tailwind + shadcn/ui · TanStack Query · Stripe · hCaptcha · Brevo · OCR (web worker + LLM) · Web Push / Service Worker
- **estado**: ● em produção
- **resumo**: App web para jogadores de lotaria em Portugal: gerar números, guardar apostas, verificar talões por OCR e consultar resultados, estatísticas e alertas.

**Desafio**

Construir uma plataforma de lotarias completa para Portugal — gerar e verificar apostas, resultados sempre atualizados, estatísticas, alertas e uma camada premium — sem montar todo o backend de raiz nem comprometer a fiabilidade em produção.

**Abordagem**

A decisão que destravou tudo foi usar uma plataforma low-code (Base44) como backend — entidades, funções serverless e SDK — e investir o tempo no que diferencia: um frontend React/Vite próprio e a automação. Os resultados chegam por scraping agendado; as apostas guardadas são verificadas automaticamente; e os alertas saem por push e email (Brevo).

A leitura de talões combina OCR no cliente com extração por LLM. A monetização (Stripe) traz paywall, limites e um programa de referência.

**Solução**

Frontend com páginas dedicadas (Gerar, Verificar Talão, Resultados, Estatísticas, Premium, Perfil, Admin) e backend Base44 com ~20 entidades e ~40 funções serverless (scraping, verificação, alertas, newsletter, push, SSR, imagens OG, Stripe). Dashboard de administração com métricas, monitor de erros e estatísticas (frequências, hot/cold, pares, paridade) e previsões com IA. Jogo responsável e páginas legais incluídas.

**Resultados**

Aplicação funcional em produção com um conjunto alargado de funcionalidades. Foi conduzida uma auditoria interna 360º que identificou e documentou melhorias (ex.: race condition no resgate de promo-codes, tratamento de erros/timeout no OCR) com plano de correção — sinal de maturidade, não de fragilidade. Sem métricas públicas de utilização.

**Notas**: Existe app móvel "Lotarias" associada na Google Play. Repo integrado com o Base44 Builder.

---

## 06 · ReadyCV
- **slug**: `readycv`
- **url**: https://readycv.pro/
- **repo**: —
- **categoria**: VIBECODING / WEB
- **ano**: 2026
- **função**: Conceção & Dev (Base44)
- **stack**: Base44 (vibecoding / low-code) · construído por prompts
- **estado**: ● em produção
- **resumo**: Gerador de CV que entrega um currículo moderno e organizado — sem a paywall-surpresa de 99 cêntimos no momento do download.

**Desafio**

Nasceu de uma frustração real. A minha namorada andava a candidatar-se a empregos e quis modernizar o CV. Usámos um daqueles geradores “gratuitos” — e, no último passo, mesmo antes do download, apareceu a paywall: 99 cêntimos. Pensei: nesta era da IA, não pago isto. E se calhar mais gente tropeça no mesmo — quer um CV moderno e bem organizado e topa com um pedido de pagamento no fim.

**Abordagem**

Peguei na plataforma de vibecoding que andava a testar (Base44) e recriei o produto para resolver o meu próprio problema — e o de quem passa pelo mesmo. Foi também uma prova de conceito do quão rápido se constrói hoje: o projeto saiu em duas a três horas, só com prompts, e ficou 100% funcional.

**Solução**

Preenches os dados, escolhes um template moderno e descarregas o CV pronto — sem cobrança no momento do download. Simples, bonito e direto ao objetivo.

**Resultados**

Prova de conceito construída em 2–3 horas, apenas com prompts, e 100% funcional: gera e entrega currículos de ponta a ponta. Resolveu um problema real e imediato e fica disponível para quem procura um gerador bonito sem a armadilha do pagamento no fim. (Sem métricas de adoção.)

**Notas**: Projeto próprio. Prova de conceito em Base44 (vibecoding), construído em ~2–3h só com prompts. Nasceu de uma paywall de €0,99 num gerador “gratuito”. Ano a confirmar.

---

## 07 · Up and Go SUP
- **slug**: `up-and-go-sup`
- **url**: https://upandgosup.com/
- **repo**: —
- **categoria**: WORDPRESS / WEBSITE
- **ano**: —
- **função**: Cliente · Tema WordPress à medida · SEO
- **stack**: WordPress · tema à medida (PHP) · SEO local (migração de Wix)
- **estado**: ● em produção
- **resumo**: Migração de uma escola de surf e SUP do Wix para um tema WordPress à medida, com foco em SEO local e reservas online.

**Desafio**

O cliente — a escola de surf e SUP “Up and Go”, em Azurara — tinha o site no Wix e pagava caro para o manter online, com pouco controlo e fraca visibilidade. Precisava de uma presença mais barata de manter, verdadeiramente sua, e sobretudo mais encontrável por quem procura aulas e tours na zona.

**Abordagem**

Mais uma vez, a minha experiência de WordPress tornou a escolha óbvia: um tema à medida, com controlo total sobre o design e a estrutura — e com o SEO local no centro das decisões, porque é dele que depende um negócio de proximidade. Páginas dedicadas por serviço (Surf, Stand Up Paddle) e um fluxo de contacto/reserva direto.

**Solução**

Website WordPress à medida, otimizado para SEO local, com as experiências bem apresentadas (aulas, sessões ao pôr do sol, tours de SUP no Rio Paiva), localização (Praia da Azurara), certificação ASSUP e um canal de contacto/reserva online.

**Resultados**

A escola saiu de uma mensalidade alta no Wix para um site próprio, mais barato de manter e construído para ser encontrado — com presença consolidada (referida no turismo local e com avaliações positivas em plataformas de terceiros). (Sem métricas de tráfego disponíveis.)

**Notas**: Projeto para cliente (escola de surf/SUP). Migração de Wix para WordPress à medida, com foco em SEO local. Ano a confirmar.

---

## 08 · MVC Bio
- **slug**: `mvc-bio`
- **url**: http://mvcbio.com/
- **repo**: —
- **categoria**: VIBECODING / MENTORIA
- **ano**: —
- **função**: Mentoria · Formação · Dev
- **stack**: Base44 (vibecoding / low-code)
- **estado**: ● em produção
- **resumo**: Site profissional construído em conjunto com a cliente numa plataforma de vibecoding (Base44), com formação e mentoria incluídas.

**Desafio**

A cliente queria uma presença profissional online — e, mais do que um site entregue, queria aprender a fazê-lo e a mantê-lo sozinha.

**Abordagem**

Em vez de entregar e sair, construímos juntos. Pair-building numa plataforma de vibecoding (Base44), com formação e mentoria à medida que se avançava — para a cliente perceber as decisões e ganhar autonomia real sobre o seu site.

**Solução**

Site profissional publicado e, sobretudo, capacitação da cliente para autonomia na edição e evolução contínua do site.

**Resultados**

Site em produção e cliente autónoma para gerir e fazer evoluir a sua presença online. (Sem métricas.)

**Notas**: Projeto de mentoria + build em conjunto com a cliente (confirmado pelo Luís).

---
