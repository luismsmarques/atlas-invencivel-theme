# Perspetiva 5 — Completude de Design

Pergunta central: **o que foi implementado corresponde ao handoff de design? Faltam ecrãs, estados ou componentes?**

## Fontes de verdade do design
- Ficheiros `*.dc.html` do handoff (Website, Website Mobile, Brand System, Case Study, Mockups, Merch).
- Zips em `/root/.claude/uploads/…` (versões de handoff).
- Screenshots aprovados pelo utilizador.
- Tokens em `style.css` (`:root`): Obsidian `#0A0E17`/`#06090F`, Cobalt `#2D5BFF`,
  fontes Space Grotesk + IBM Plex Sans + IBM Plex Mono, grelha de engenharia,
  marca "A" com "load line" cobalto.

## Checklist

### Paridade ecrã a ecrã (design → implementação)
- [ ] Cada secção do design do Website existe no tema (hero, serviços, trabalho, sobre, contacto).
- [ ] Versão Mobile do design refletida no CSS responsivo (não só "encolher").
- [ ] Brand System aplicado: cores, tipografia, marca, grelha, tom.
- [ ] Case Study: estrutura + mockups (frames de browser cover/tall/short) fiéis.
- [ ] Aplicações do brand (assinatura de email, social kit, cartões, merch) — implementadas onde previsto.

### Estados e componentes muitas vezes em falta
- [ ] Estados **hover/focus/active** em botões e links.
- [ ] Estado **vazio** (sem projetos, sem resultados) desenhado, não em branco.
- [ ] Estado de **erro** (formulário, 404) coerente com o design.
- [ ] **Loading/skeleton** se o design previr.
- [ ] Dark/light — o tema é dark; confirmar que nada assume light por engano.
- [ ] Favicon / theme-color / manifest presentes.

### Fidelidade visual
- [ ] Fontes corretas carregadas; fallbacks aceitáveis.
- [ ] Espaçamentos/tamanhos próximos do design (não "quase").
- [ ] Imagens/mockups com fundo distinto para não se confundirem com o site.
- [ ] Sem overflow horizontal no mobile (bug clássico de título grande).

### O que falta / o que está a mais
- [ ] Ecrãs no design ainda **não implementados** → listar.
- [ ] Elementos implementados que **já não estão no design** → candidatos a remover.
- [ ] Designs **pedidos mas ainda não entregues** pelo utilizador (ex.: novos mockups).

## Como comparar sem o site
Renderizar um harness local com o CSS real e screenshots a 360/390/768/1280 (ver
perspetiva QA), depois comparar lado a lado com os `*.dc.html`/screenshots do handoff.

## Saída desta perspetiva
Tabela **Design → Estado** (Implementado / Parcial / Em falta / A mais) por ecrã e componente, com o que é bloqueante para "fiel ao design".
