# Perspetiva 1 — Product Owner

Pergunta central: **o produto cumpre o objetivo do negócio? O que falta, o que está mal priorizado, o que está a mais?**

## Contexto a recolher
- Qual é o objetivo do site? (portfólio/estúdio "Atlas Invencível" — captar clientes, mostrar case studies, credibilidade.)
- Quem é o público e qual é a ação desejada (CTA): iniciar projeto / contactar.
- Lê `README.md`, `CHANGELOG.md`, `RELEASE-NOTES.md` e o guia de tom (`dev-tools/content-voice-guide.md`).

## Checklist

### Cobertura funcional (o que falta)
- [ ] Todas as páginas essenciais existem e estão ligadas? (Home, Case Study, Contacto, Termos, Privacidade, 404, Pesquisa, Blog/Arquivo.)
- [ ] O fluxo principal fecha? Home → CTA → página/secção de Contacto → formulário funcional.
- [ ] Os CTAs apontam para o sítio certo em **PT e EN** (a home usa Polylang).
- [ ] Case studies: todos os projetos previstos estão publicados, com imagens, meta (função/ano/stack/estado) e ligação ao projeto real?
- [ ] Existe versão EN completa (fixos + case studies traduzidos e ligados no Polylang)?
- [ ] Formulário de contacto entrega mesmo email (Contact Form 7 configurado, destino correto)?

### Conteúdo e mensagem
- [ ] O texto está alinhado com o guia de tom? Sem placeholders ("lorem", "sample", "TODO").
- [ ] Dados reais (sem métricas inventadas nos case studies).
- [ ] Consistência PT/EN (nada meio-traduzido).

### O que está a MAIS (âmbito inflado / legado)
- [ ] Templates, CPTs, opções ou páginas que já não servem o produto atual.
- [ ] Funcionalidades do tema antigo ainda visíveis no site ou no wp-admin.
- [ ] Ficheiros de documentação desatualizados que contradizem o estado real.

### Prioridade e risco de produto
- [ ] O que bloqueia o lançamento? (P0/P1)
- [ ] O que é "seria bom ter" mas não bloqueia? (P2/P3)
- [ ] Há dependência de passos manuais frágeis (deploy, import, config Polylang) que deviam estar documentados?

## Comandos úteis
```bash
# Placeholders/rascunhos esquecidos
grep -rniE "lorem|placeholder|sample|todo|fixme|xxx|dummy" --include='*.php' . | grep -v dev-tools
# Templates existentes
git ls-files '*.php' | sort
# Documentação vs realidade
ls *.md
```

## Saída desta perspetiva
Uma tabela "Estado do produto" com: **Feito** / **Falta** / **A mais** / **Risco de lançamento**, e o que é bloqueante.
