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
- **stack**: JavaScript · Chrome Extension (Manifest V3) · Node.js · Express · PostgreSQL · Google Gemini · Stripe · JWT · Vercel
- **estado**: ● em produção
- **resumo**: Extensão Chrome que resume Termos de Serviço e Políticas de Privacidade com IA — e classifica o risco antes de aceitares.

**Desafio**

Ninguém lê os Termos de Serviço — são longos, densos e escritos em jurídico. Aceitamos cláusulas sobre os nossos dados sem perceber o que estamos a dar. O desafio era fechar esse fosso de legibilidade no momento e no sítio onde ele acontece: o browser, mesmo antes do clique em “aceitar”.

**Abordagem**

A primeira decisão foi de formato: em vez de mais um site, uma extensão Chrome (Manifest V3) que aparece onde o problema está. O trabalho pesado fica no servidor — um backend Node/Express na Vercel — para a extensão ser leve e a chave da IA nunca sair do servidor.

A análise é delegada ao Google Gemini; o histórico, as contas e os créditos vivem em PostgreSQL. A monetização (Stripe) e a autenticação (JWT) entraram cedo, e a v1.3.0 fez uma limpeza de segurança — fora credenciais no código, tudo por variáveis de ambiente.

**Solução**

Sobre qualquer ToS ou política, devolve um resumo estruturado (visão geral, pontos-chave, alertas de privacidade) e classifica risco, complexidade e boas práticas de 1 a 10, com indicadores tipo semáforo. Escolhes o foco (privacidade, termos ou equilibrado), guardas histórico com filtros e exportas em JSON/CSV/TXT. O sistema de créditos aceita a API partilhada ou a tua própria chave Gemini.

**Resultados**

Em produção e publicada na Chrome Web Store, com backend a correr na Vercel. Transforma um documento que ninguém lê num resumo de risco em segundos, sem tirar o utilizador do contexto. (Sem métricas públicas de adoção verificadas.)

**Notas**: Licença do repo "Other". Função inferida (projeto solo Atlas Invencível).

---

## 03 · VibeSell
- **slug**: `vibesell`
- **url**: http://vibesell.atlasinvencivel.pt/
- **repo**: https://github.com/luismsmarques/vibesell
- **categoria**: IA / GROWTH
- **ano**: 2026
- **função**: Estratégia · Eng · Produto
- **stack**: JavaScript · HTML/CSS/JS vanilla · Node.js/Express (API REST) · auth por magic link + token Bearer · checkout/portal de faturação · Vercel
- **estado**: ● pré-lançamento
- **resumo**: Extensão Chrome que, ao clicar em “Engage” num post do Reddit, devolve três rascunhos de resposta humanos e personalizados ao produto — copia, edita e publica tu.

**Desafio**

Marketing orgânico no Reddit é um campo minado: uma resposta que cheire a spam queima a marca e viola as regras do subreddit. O desafio era ajudar a participar em escala sem perder a credibilidade nem o controlo humano.

**Abordagem**

O princípio veio primeiro: **a ferramenta sugere, o humano decide.** Nada é publicado automaticamente. Um botão “Engage” nas threads gera três rascunhos curtos (1–3 frases) a partir do contexto do produto e de um nível de diretividade à escolha.

Por baixo, uma arquitetura enxuta: site estático, backend Express com API REST, login por magic link e faturação no padrão Stripe — tudo na Vercel, com deploy contínuo. Modelo freemium com limites diários para alinhar valor e custo de IA.

**Solução**

Extensão Chrome de drafting dentro do Reddit, site institucional e área de conta com login por magic link, dashboard de plano e medidor de uso. O plano pago abre auto-discovery, voice match e direct mode.

**Resultados**

Em pré-lançamento, com a arquitetura completa de ponta a ponta (extensão, site, auth, faturação) e um posicionamento claro: engagement orgânico assistido, anti-spam, com o humano sempre no comando. (Sem métricas públicas.)

**Notas**: Repo privado. Stack do backend inferida de cabeçalhos HTTP e chamadas de API. Disclaimer de não-afiliação com o Reddit.

---

## 04 · Super Portistas
- **slug**: `super-portistas`
- **url**: https://superportistas.pt/
- **repo**: https://github.com/luismsmarques/super-portistas-wordpress-theme (+ plugins)
- **categoria**: WORDPRESS / MEDIA
- **ano**: 2026
- **função**: Tema + 4 plugins · Eng · Produto
- **stack**: WordPress 6.2+ · PHP 8.2+ · MySQL · HTMX + Alpine.js · REST API (sp/v1) · Firebase (Auth + FCM) · Brevo · Google Gemini · SportMonks API · YouTube API · X API · RSS.app
- **estado**: ● em produção
- **resumo**: Portal WordPress dos adeptos do FC Porto que junta agregação RSS, geração editorial por IA, dados SportMonks, gamificação e push numa só plataforma.

**Desafio**

Um portal desportivo vive de ritmo: notícias, capas de jornais, vídeos, redes e dados de jogos, quase em tempo real. Fazer isto à mão é insustentável. O desafio era manter um meio completo do FC Porto — com comunidade fiel — praticamente em piloto automático, sem perder qualidade editorial.

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

Em produção e ativo, com cobertura diária do FC Porto (notícias, resumos, capas, vídeos, modalidades), prognósticos e newsletter. Conjunto de plugins maduro e mantido (changelogs, testes PHPUnit, documentação de arquitetura/REST, endurecimento de segurança). Métricas de audiência não disponíveis nas fontes.

**Notas**: Tema e 3 plugins em repos privados; só api-sportmonks é público. Roadmap do tema inclui fórum, PWA e app.

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
- **categoria**: SAAS / WEB
- **ano**: —
- **função**: Eng · Produto
- **stack**: —
- **estado**: ● em produção
- **resumo**: Construtor de CV que gera um perfil profissional partilhável como página pessoal ou exportável em PDF, com importação por IA e revisão por créditos.

**Desafio**

Criar um CV profissional e uma presença online continua a ser trabalhoso e cheio de subscrições. O desafio era reduzir isso a minutos — e manter a versão sempre atual para quem recruta.

**Abordagem**

A aposta foi tirar a fricção: importar um PDF e deixar a IA preencher o perfil, escolher um template por área, e publicar ao mesmo tempo uma página pessoal (com ligação própria) e um PDF coerente. Sem subscrição nem renovação automática — um modelo de créditos para quem quer a camada de IA.

**Solução**

Plataforma com perfil/página pessoal indexável, exportação PDF, templates, analytics, e IA (revisão de CV com sugestões e versões adaptadas a vagas) através de um modelo de créditos.

**Resultados**

Produto funcional em produção com camada gratuita (perfil, PDF, templates, analytics) e funcionalidades pagas por créditos; perfis públicos partilháveis e atualizáveis a qualquer momento.

**Notas**: A pesquisa também devolveu readycv.org com conteúdo idêntico (possível domínio alternativo — a confirmar). Stack por confirmar.

---

## 07 · Up and Go SUP
- **slug**: `up-and-go-sup`
- **url**: https://upandgosup.com/
- **repo**: —
- **categoria**: WORDPRESS / WEBSITE
- **ano**: —
- **função**: Tema WordPress à medida · Dev
- **stack**: WordPress · tema à medida (PHP)
- **estado**: ● em produção
- **resumo**: Site da escola de surf e Stand Up Paddle “Up and Go” em Azurara, Vila do Conde, com apresentação de aulas e tours e pedidos de reserva online.

**Desafio**

Uma escola de surf e SUP precisava de existir online: comunicar as experiências e captar reservas, sem depender de plataformas de terceiros nem de construtores fechados.

**Abordagem**

Optei por um tema WordPress à medida — controlo total sobre o design e a estrutura, e autonomia para a escola gerir o conteúdo. Páginas por serviço (Surf, Stand Up Paddle) e um fluxo de contacto/reserva direto, a apresentar as experiências (aulas, sessões ao pôr do sol, tours de SUP no Rio Paiva com visita à Ilha dos Amores).

**Solução**

Website multi-página com fluxo de reservas/contacto online, descrição das experiências, localização (Praia da Azurara) e referência à certificação pela ASSUP — Associação SUP Portugal.

**Resultados**

Escola com presença digital ativa e canal de reservas online; presença consolidada (referida em turismo local e com avaliações positivas em plataformas de terceiros).

**Notas**: Tema WordPress à medida (confirmado pelo Luís).

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
