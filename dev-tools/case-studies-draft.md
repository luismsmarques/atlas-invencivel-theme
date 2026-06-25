# Case Studies — Atlas Invencível

> Rascunho para revisão. Cada projeto mapeia diretamente para um `atlas_project`
> no WordPress. Quando aprovares o conteúdo, converto isto num ficheiro de
> importação (WXR/XML) pronto a carregar em **Ferramentas → Importar**.
>
> **Mapeamento dos campos → meta do projeto:**
> `categoria` → `_atlas_project_category` · `ano` → `_atlas_project_date` ·
> `função` → `_atlas_project_client` · `stack` → `_atlas_project_technologies` ·
> `estado` → `_atlas_project_status` · `resumo` → *Excerpt* ·
> `desafio` → `_atlas_project_challenges` · `abordagem` → *Conteúdo do post* ·
> `solução` → `_atlas_project_solutions` · `resultados` → `_atlas_project_results` ·
> `url` → `_atlas_project_url`
>
> **Notas factuais gerais:** os sites em produção bloqueiam o acesso automático
> (HTTP 403), por isso o conteúdo veio sobretudo dos repositórios e de pesquisa
> web. **Não há métricas públicas de adoção** em nenhum projeto — todos os
> "resultados" são qualitativos (sem números inventados). Confirma/edita os
> campos `ano` e `função` onde estão a "—" ou marcados como inferência.

---

## 01 · How To Invest
- **slug**: `how-to-invest`
- **url**: https://howtoinvest.pro/
- **repo**: https://github.com/luismsmarques/how-to-invest-v2
- **categoria**: FINTECH / EDTECH
- **ano**: 2026
- **função**: Conceção e desenvolvimento full-stack (arquitetura, motor de recomendação, engenharia WordPress)
- **stack**: WordPress (block theme/FSE) · plugin proprietário `hti-engine` (PHP 8.x) · MySQL/MariaDB · JavaScript vanilla · API REST · Google Gemini (JSON mode) · geração de PDF em PHP · Cloudflare
- **estado**: ● MVP em desenvolvimento ativo
- **resumo**: Apura o perfil de investidor por questionário e devolve uma alocação ilustrativa por classe de ativos, num enquadramento educativo.
- **desafio**: Os iniciados têm pouca confiança para investir devido à complexidade e ao medo de errar. A app original (React/Base44) tinha fraca descoberta orgânica, limitando a aquisição a canais pagos/diretos e travando o crescimento composto.
- **abordagem**: Reconstrução em WordPress com estratégia SEO-first para captar tráfego orgânico, sob um princípio de arquitetura não-negociável: **as regras decidem (arquétipo + alocação); o LLM apenas explica**. Lógica determinística governa os resultados; a IA dá só contexto. Restrições firmes: o output é por classes de ativos (nunca instrumentos nomeados), com disclaimers contextuais em todos os resultados, chave Gemini sempre server-side, e RGPD (export/delete) como prioridade.
- **solução**: Tema de blocos nativo (FSE) + plugin `hti-engine` que expõe endpoints REST (recomendação, reclamação de perfil, conta, exportação). Frontend em JavaScript vanilla com gráficos leves na página de resultados e geração de PDF em PHP. Contas WordPress opcionais para guardar perfis. Integração Gemini server-side (JSON mode validado por schema) para explicações. Conteúdo editável (artigos e glossário) a suportar o SEO.
- **resultados**: Em fase de MVP, com iteração intensa (centenas de commits). O PRD define *metas-alvo* — início de questionário ≥8%, conclusão ≥60%, sucesso do motor ≥98%, resultado <8s (p95) — que são objetivos documentados, **não desempenho medido**.
- **notas**: Ano 2026 (repo criado 06/2026). Multi-idioma (PT/EN) e login Google estavam em avaliação.

---

## 02 · ToS Summarizer
- **slug**: `tos-summarizer`
- **url**: https://tos.atlasinvencivel.pt/
- **repo**: https://github.com/luismsmarques/tos-privacy-summarizer
- **categoria**: IA / WEB
- **ano**: 2025
- **função**: Estratégia · Eng · Produto *(inferido — confirma)*
- **stack**: JavaScript vanilla · Chrome Extension (Manifest V3) · Node.js · Express · PostgreSQL (Vercel Postgres) · Google Gemini · Stripe · JWT · Vercel
- **estado**: ● em produção
- **resumo**: Extensão Chrome que resume Termos de Serviço e Políticas de Privacidade com IA — e classifica o risco antes de aceitares.
- **desafio**: Os Termos de Serviço e Políticas de Privacidade são longos, densos e jurídicos — quase ninguém os lê antes de aceitar. Aceita-se cláusulas sobre dados pessoais e partilha com terceiros sem perceber o que está em causa. O projeto ataca esse fosso de legibilidade no próprio contexto em que o utilizador encontra o documento.
- **abordagem**: Extensão Chrome em Manifest V3 (frontend JS vanilla, UI Material Design) suportada por backend Node/Express na Vercel. A análise é delegada à API Google Gemini; a persistência (histórico, contas, créditos) assenta em PostgreSQL. Autenticação por JWT e monetização via Stripe. Arquitetura modular (extensão, backend, dashboard) com processamento assíncrono. A v1.3.0 trouxe endurecimento de segurança (sem credenciais hardcoded, configuração por variáveis de ambiente).
- **solução**: Sobre um ToS/Política, o utilizador recebe um resumo estruturado em Markdown (visão geral, pontos-chave, alertas de privacidade). Um sistema classifica risco, complexidade e boas práticas (1–10) com indicadores tipo semáforo. Permite escolher o foco (privacidade/termos/equilibrado), gerir histórico com filtros e exportar (JSON/CSV/TXT). Sistema de créditos flexível (API partilhada ou chave Gemini pessoal) e dashboard administrativo.
- **resultados**: Em produção, distribuído via Chrome Web Store, com backend operacional na Vercel. Torna documentos legais imediatamente legíveis no contexto de navegação e dá ao utilizador controlo sobre foco, histórico e exportação. *(Sem métricas verificadas independentemente.)*
- **notas**: Licença do repo "Other". Função do Luís inferida (projeto solo Atlas Invencível).

---

## 03 · VibeSell
- **slug**: `vibesell`
- **url**: http://vibesell.atlasinvencivel.pt/
- **repo**: https://github.com/luismsmarques/vibesell
- **categoria**: IA / GROWTH
- **ano**: 2026
- **função**: Estratégia · Eng · Produto *(inferido — confirma)*
- **stack**: JavaScript · HTML/CSS/JS vanilla (sem SPA) · Node.js/Express (API REST) · auth por magic link + token Bearer · checkout/portal de faturação (padrão Stripe) · Vercel
- **estado**: ● pré-lançamento
- **resumo**: Extensão Chrome que, ao clicar em "Engage" num post do Reddit, devolve três rascunhos de resposta humanos e personalizados ao produto — copia, edita e publica tu.
- **desafio**: Fazer marketing orgânico no Reddit sem cair em spam nem violar regras de subreddits: respostas relevantes, curtas e credíveis em escala, mantendo o controlo editorial humano e evitando auto-publicação ou link-stuffing.
- **abordagem**: Manter o humano no comando — a ferramenta apenas sugere. Um botão "Engage" injetado nas threads gera três rascunhos de 1–3 frases a partir do contexto do produto (nome, one-liner, objetivo) e de um nível de diretividade (subtle/balanced/direct). O utilizador escolhe, ajusta, copia e publica. Modelo freemium com limites diários (5 grátis / 50 Pro) e funcionalidades avançadas no plano pago (auto-discovery, voice match, direct mode).
- **solução**: Extensão Chrome de drafting dentro do Reddit + site institucional (hero, how-it-works, features, pricing) + área de conta com login por magic link, dashboard de plano e medidor de uso. Backend Express serve a API REST de autenticação, perfil, uso e faturação; deploy contínuo na Vercel.
- **resultados**: Projeto em pré-lançamento (repo privado, sem métricas públicas). Qualitativamente: produto funcional com proposta de valor clara (engagement orgânico assistido, anti-spam, controlo humano) e arquitetura completa ponta-a-ponta (extensão, site, auth, faturação).
- **notas**: Ano 2026 (repo criado 06/2026). Stack do backend inferida de cabeçalhos HTTP e chamadas de API. Disclaimer explícito de não-afiliação com o Reddit.

---

## 04 · Super Portistas
- **slug**: `super-portistas`
- **url**: https://superportistas.pt/
- **repo**: https://github.com/luismsmarques/super-portistas-wordpress-theme *(+ plugins: super-portistas-core, rss-manager, ai-news, api-sportmonks)*
- **categoria**: WORDPRESS / MEDIA
- **ano**: 2026 *(baseado no conteúdo do site; sem data de lançamento documentada — confirma)*
- **função**: Tema + 4 plugins à medida · Arquitetura · Eng · Produto
- **stack**: WordPress 6.2+ · PHP 8.2+ · MySQL/MariaDB · HTMX + Alpine.js · REST API própria (`sp/v1`) · Firebase (Auth + FCM push) · Brevo (email/newsletter) · Google Gemini (`gemini-2.5-flash`) · SportMonks Football API · YouTube Data API v3 · X API v2 · RSS.app
- **estado**: ● em produção
- **resumo**: Portal WordPress dos adeptos do FC Porto que junta agregação RSS, geração editorial por IA, dados SportMonks, gamificação e push numa só plataforma.
- **desafio**: Manter um portal desportivo de alto débito com cobertura quase em tempo real (notícias, capas de jornais, vídeos, redes sociais e dados de jogos) sem trabalho manual constante, gerando conteúdo editorial consistente e fidelizando uma comunidade — tudo dentro do WordPress.
- **abordagem**: Arquitetura modular **tema + quatro plugins**, separando apresentação de lógica de domínio:
  - **super-portistas-wordpress-theme** — apresentação (frontend HTMX + Alpine.js, sidebars contextuais, dashboard de utilizador, opções de tema). Depende do Core.
  - **super-portistas-core** — domínio: REST API `sp/v1`, gamificação + leaderboard, prognósticos, sondagens, auth e push via Firebase, integração Brevo (double opt-in, resumos, alertas, conquistas). Tabelas `wp_sp_*`.
  - **rss-manager** — ingestão automática (WP Cron) de RSS, YouTube, X/Twitter e capas de jornais → CPT `ai_news_article`, com deduplicação por hash, filtros, logs e proteção SSRF.
  - **ai-news** — camada editorial de IA (Gemini): artigos pre/post-match a partir de dados de jogos (50+ variáveis), "Resumo do dia", conteúdo curado (similaridade de Jaccard) e "Source Studio" (artigos a partir de URL/texto). REST `ai-news/v1`.
  - **api-sportmonks** — ponte de dados: sincroniza jogos no CPT `aps_jogo`, mapeia equipas/ligas, minutos ao vivo, estádios/competições, e helpers consumidos pelo tema e pelo AI News.
- **solução**: Pipeline automatizado ponta-a-ponta: api-sportmonks alimenta dados factuais → ai-news transforma-os em artigos com Gemini → rss-manager agrega notícias/vídeos/redes/capas → super-portistas-core trata da comunidade (gamificação, prognósticos, push, newsletter) → o tema serve tudo com frontend leve HTMX + Alpine.js. Os plugins comunicam por hooks/filtros e por uma API de helpers, com baixo acoplamento.
- **resultados**: Site em produção e ativo, com cobertura diária do FC Porto (notícias, resumos, capas, vídeos, modalidades), prognósticos e newsletter. Conjunto de plugins maduro e mantido (changelogs, testes PHPUnit, documentação de arquitetura/REST, endurecimento de segurança). Métricas de audiência não disponíveis nas fontes.
- **notas**: Tema e 3 plugins em repos privados; só `api-sportmonks` é público. Roadmap do tema inclui fórum, PWA e app.

---

## 05 · Lotarias.pt
- **slug**: `lotarias-pt`
- **url**: https://lotarias.pt/
- **repo**: https://github.com/luismsmarques/lotarias.pt *(privado)*
- **categoria**: WEB APP / PWA
- **ano**: 2026
- **função**: Desenvolvimento full-stack (frontend, funções serverless e integrações)
- **stack**: React 18 + Vite 6 · plataforma low-code Base44 (SDK + funções serverless TS) · Tailwind + shadcn/ui (Radix) · TanStack Query · Stripe · hCaptcha · Brevo · OCR (web worker + LLM) · Web Push / Service Worker
- **estado**: ● em produção
- **resumo**: App web para jogadores de lotaria em Portugal: gerar números, guardar apostas, verificar talões por OCR e consultar resultados, estatísticas e alertas.
- **desafio**: Entregar uma plataforma de lotarias completa para o mercado português — geração e verificação de apostas, resultados sempre atualizados, estatísticas, notificações e camada premium paga — com fiabilidade em produção e sem construir todo o backend de raiz.
- **abordagem**: Backend sobre a plataforma low-code Base44 (entidades, funções serverless, SDK) com frontend React/Vite próprio e UI shadcn/ui. Resultados por scraping agendado (EuroMilhões/M1lhão), verificação automática das apostas guardadas e notificação por push e email (Brevo). Leitura de talões combina OCR no cliente (web worker) com extração por LLM. Monetização via Stripe (checkout, portal, webhooks) com paywall, limites e programa de referência.
- **solução**: Frontend com páginas dedicadas (Gerar, Verificar Talão, Resultados, Estatísticas, Premium, Perfil, Admin) e backend Base44 com ~20 entidades e ~40 funções serverless (scraping, verificação, alertas, newsletter, push, SSR, imagens OG, Stripe). Dashboard de administração com métricas, monitor de erros e estatísticas (frequências, hot/cold, pares, paridade) e previsões com IA. Jogo responsável e páginas legais incluídas.
- **resultados**: Aplicação funcional em produção com conjunto alargado de funcionalidades. Foi conduzida uma auditoria interna 360º que identificou e documentou melhorias (ex.: race condition no resgate de promo-codes, tratamento de erros/timeout no OCR) com plano de correção. Sem métricas públicas de utilização.
- **notas**: Existe app móvel "Lotarias" associada na Google Play. Repo integrado com o Base44 Builder.

---

## 06 · ReadyCV
- **slug**: `readycv`
- **url**: https://readycv.pro/
- **repo**: —
- **categoria**: SAAS / WEB
- **ano**: — *(a confirmar)*
- **função**: Desenvolvimento e produto (full-stack)
- **stack**: — *(não confirmado; o site não foi acessível para inspeção direta)*
- **estado**: ● em produção
- **resumo**: Construtor de CV que gera um perfil profissional partilhável como página pessoal ou exportável em PDF, com importação por IA e revisão por créditos.
- **desafio**: Permitir que candidatos criem rapidamente um CV profissional e uma presença online, sem fricção de subscrições e mantendo a versão sempre atualizada para recrutadores.
- **abordagem**: Importação de um CV em PDF preenchido automaticamente por IA (ou preenchimento manual), templates por área, e publicação simultânea numa página pessoal com ligação personalizada e num PDF coerente.
- **solução**: Plataforma com perfil/página pessoal indexável, exportação PDF, templates, analytics, e IA (revisão de CV com sugestões, versões adaptadas a vagas) através de um modelo de créditos sem subscrição nem renovação automática.
- **resultados**: Produto funcional em produção com camada gratuita (perfil, PDF, templates, analytics) e funcionalidades pagas por créditos; perfis públicos partilháveis e atualizáveis.
- **notas**: A pesquisa também devolveu readycv.org com conteúdo idêntico (possível domínio alternativo — a confirmar). Stack por confirmar.

---

## 07 · Up and Go SUP
- **slug**: `up-and-go-sup`
- **url**: https://upandgosup.com/
- **repo**: —
- **categoria**: WORDPRESS / WEBSITE
- **ano**: — *(a confirmar)*
- **função**: Tema WordPress à medida · Desenvolvimento web
- **stack**: WordPress · tema à medida (PHP)
- **estado**: ● em produção
- **resumo**: Site da escola de surf e Stand Up Paddle "Up and Go" em Azurara, Vila do Conde, com apresentação de aulas e tours e pedidos de reserva online.
- **desafio**: Dar presença online a uma escola náutica local, comunicar a oferta de aulas/experiências e captar reservas de clientes individuais e em grupo.
- **abordagem**: Site multi-página por serviço (Stand Up Paddle, Surf) e página de contactos/reservas, apresentando as atividades (aulas de surf, sessões ao pôr do sol, tours de SUP no Rio Paiva com visita à Ilha dos Amores) e canais de contacto.
- **solução**: Website multi-página com fluxo de reservas/contacto online, descrição das experiências, localização (Praia da Azurara) e referência à certificação pela ASSUP — Associação SUP Portugal.
- **resultados**: Escola com presença digital ativa e canal de reservas online; presença consolidada (referida em turismo local e com avaliações positivas em plataformas de terceiros).
- **notas**: Conteúdo confirmado por pesquisa web. Stack por confirmar.

---

## 08 · MVC Bio
- **slug**: `mvc-bio`
- **url**: http://mvcbio.com/
- **repo**: —
- **categoria**: VIBECODING / MENTORIA
- **ano**: — *(a confirmar)*
- **função**: Mentoria · Formação · Desenvolvimento conjunto
- **stack**: Base44 (vibecoding / low-code)
- **estado**: ● em produção
- **resumo**: Site profissional construído em conjunto com a cliente numa plataforma de vibecoding (Base44), com formação e mentoria incluídas.
- **desafio**: A cliente queria uma presença profissional online e, ao mesmo tempo, aprender a criar e manter o próprio site sem depender de terceiros.
- **abordagem**: Desenvolvimento colaborativo (pair-building) numa plataforma de vibecoding/low-code (Base44), com sessões de formação e mentoria sobre como conceber, construir e gerir um site nestas ferramentas — transferindo conhecimento à medida que se construía.
- **solução**: Site profissional publicado e, sobretudo, capacitação da cliente para autonomia na edição e evolução contínua do site.
- **resultados**: Site em produção e cliente autónoma para gerir e fazer evoluir a sua presença online. *(Sem métricas.)*
- **notas**: Confirmado pelo Luís — projeto de mentoria + build em conjunto com a cliente.

---

### Pendentes (atualizado)
- ✅ **MVC Bio** — descrito (vibecoding/Base44 + mentoria).
- ✅ **Up and Go SUP** — tema WordPress à medida.
- ✅ **Imagens de capa** — placeholders por agora (sem featured image; adicionas depois no WP).
- ✅ **Ordem** — confirmada.
- ⏳ **Anos** de ReadyCV / Up and Go SUP / MVC Bio ficam vazios (preenches no WP quando souberes).
