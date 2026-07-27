# Perspetiva 3 — Qualidade de Código

Pergunta central: **o código está limpo, consistente, sem código morto, e segue as normas do WordPress?**

## Checklist

### Código morto / duplicado
- [ ] Funções definidas mas nunca chamadas (fora do próprio ficheiro).
- [ ] `require`/`include` duplicados.
- [ ] Blocos comentados grandes ("DISABLED", "REMOVED", "TEMPORARILY").
- [ ] Assets enfileirados que não existem (404).
- [ ] CPTs, taxonomias, menus, widget areas registados mas não usados por nenhum template.
- [ ] Opções gravadas na options-page que nenhum template lê (e vice-versa: lidas mas sem campo).

### Normas WordPress
- [ ] `if ( ! defined( 'ABSPATH' ) ) exit;` no topo de cada ficheiro PHP.
- [ ] Prefixo consistente (`atlas_`) em funções, hooks, opções, handles.
- [ ] Text domain consistente (`atlas-theme`) e strings traduzíveis (`__`, `esc_html__`).
- [ ] Enfileiramento via `wp_enqueue_*` (não `<link>`/`<script>` à mão no template).
- [ ] Versão de assets para cache-busting (idealmente `filemtime`).

### Estrutura e consistência
- [ ] Separação clara: `inc/` (lógica), templates (view), `assets/` (css/js).
- [ ] Estilo de indentação e nomes coerente entre ficheiros.
- [ ] Sem lógica pesada nos templates (queries complexas → helpers).
- [ ] Constantes do tema (`ATLAS_THEME_*`) usadas em vez de caminhos repetidos.

### Documentação
- [ ] `README`/guias refletem o estado real (não o tema antigo).
- [ ] Ficheiros `*-GUIDE.md` desatualizados marcados ou removidos.

## Comandos úteis
```bash
# Funções definidas vs usadas
for fn in $(grep -rhoE "^function [a-z_]+" --include='*.php' inc | awk '{print $2}'); do
  uses=$(grep -rEl "\b$fn\b" --include='*.php' . | grep -v -c "$(grep -rl "function $fn" --include='*.php' .)")
  echo "$fn"
done
# require duplicados
grep -rnE "require_once|include_once" --include='*.php' . | sort
# blocos desativados
grep -rniE "DISABLED|REMOVED|TEMPORARILY|deprecated|// function" --include='*.php' .
# ABSPATH guard em falta
for f in $(git ls-files '*.php'); do grep -q "ABSPATH" "$f" || echo "SEM guard: $f"; done
# opções: lidas vs registadas
grep -rhoE "get_option\(\s*'atlas[a-z_]*'" --include='*.php' . | sort -u
grep -rhoE "register_setting\([^,]+,\s*'atlas[a-z_]*'" inc/options-page.php | sort -u
```

## Saída desta perspetiva
Lista de itens de limpeza por severidade, com contagem de linhas removíveis e confirmação de que nada em uso é afetado.
