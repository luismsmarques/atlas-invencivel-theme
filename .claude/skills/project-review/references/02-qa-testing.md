# Perspetiva 2 — QA / Tester

Pergunta central: **funciona em todos os fluxos, línguas, browsers e tamanhos de ecrã, incluindo os estados de erro/vazio?**

## Plano de testes funcional (percorrer cada fluxo)

### Navegação e páginas
- [ ] Header: logo → home; menu (PT e EN); CTA de contacto; switcher PT|EN.
- [ ] Footer: links, redes sociais, ano dinâmico.
- [ ] Home: hero, bloco de código, serviços, trabalho, sobre/CV, contacto.
- [ ] Case study: hero, mockups (cover/tall/pares), meta bar, secções, "mais projetos".
- [ ] Página de contacto: formulário + sidebar (em **PT e EN** — a EN herda o template).
- [ ] 404, resultados de pesquisa (com e sem resultados), arquivo/categoria, post único.

### Estados (frequentemente esquecidos)
- [ ] **Vazio:** sem projetos, sem resultados de pesquisa, sem imagens no case study (fallback local).
- [ ] **Erro:** formulário sem plugin CF7, imagem em falta, 404.
- [ ] **Loading/lazy:** imagens lazy não partem o layout.

### Responsividade (usar viewport REAL, não janela mínima do headless)
The Chrome headless força largura mínima ~500px com `--window-size`. Para testar
mobile a sério, usa emulação de dispositivo via DevTools Protocol. Usa o script
incluído `scripts/shot.mjs` (emulação real + reporta overflow):
`NO_PROXY="*" node .claude/skills/project-review/scripts/shot.mjs "file://<preview>.html" out.png 390 2600`
- [ ] 360px e 390px (telemóvel): sem overflow horizontal (`document.scrollWidth == innerWidth`).
- [ ] 768px (tablet): transições de grid.
- [ ] ≥1200px (desktop): layout completo.
- [ ] Verificar cada secção: Serviços e Trabalho empilham em coluna única no mobile.

### i18n
- [ ] Trocar PT↔EN mantém a página equivalente (traduções ligadas no Polylang).
- [ ] Texto fixo muda de língua; nada fica meio-traduzido.
- [ ] URLs `/en/…` corretos; slugs de case study resolvem.

### Acessibilidade (mínimos)
- [ ] `alt` em imagens de conteúdo; `aria-label` em botões/ícones sem texto.
- [ ] Contraste suficiente (fundo Obsidian vs texto).
- [ ] Navegação por teclado no menu e no switcher; foco visível.
- [ ] Um único `<h1>` por página; hierarquia de headings coerente.

### Performance (rápido)
- [ ] Cache-bust por `filemtime` a funcionar (CSS/JS com `?ver=` que muda).
- [ ] Imagens dimensionadas (sizes do tema) e lazy onde faz sentido.
- [ ] Sem 404 de assets no `<head>` (ex.: editor-style.css já removido).

## Como verificar render sem acesso ao site
Montar um harness HTML local com o CSS real do tema e renderizar via Chromium
headless + emulação de dispositivo (file:// não precisa de rede). Medir
`document.documentElement.scrollWidth` para detetar overflow. Tirar screenshots
a 360/390/768/1280.

## Comandos úteis
```bash
php -l <ficheiro>            # sintaxe de cada PHP alterado
node --check assets/js/*.js  # sintaxe JS
xmllint --noout *.xml        # WXR válido
# desequilíbrio de chavetas CSS
for f in style.css assets/css/*.css; do echo "$f: {$(grep -o '{' $f|wc -l) }$(grep -o '}' $f|wc -l)"; done
```

## Saída desta perspetiva
Lista de **defeitos reproduzíveis** (passos → esperado → obtido), cada um com severidade e `ficheiro:linha` quando aplicável.
