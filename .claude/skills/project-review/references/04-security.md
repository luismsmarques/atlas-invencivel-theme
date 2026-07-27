# Perspetiva 4 — Segurança (Tema + Plugins + WordPress)

Pergunta central: **o código do tema é seguro, os plugins estão atualizados e sem vulnerabilidades conhecidas, e o WordPress está endurecido?**

> Âmbito: o **código do tema** é auditável nesta sessão. O **estado dos plugins
> e do servidor em produção NÃO é acessível** — para essa parte, dá ao
> utilizador os passos exatos para verificar no wp-admin/servidor.

## A) Segurança do CÓDIGO DO TEMA (auditar aqui)

### Escaping de saída (XSS)
- [ ] TODA a saída dinâmica é escapada no ponto de saída:
  `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()` para HTML permitido.
- [ ] Nada de `echo $var` direto de meta/opções/input sem escaping.
```bash
grep -rnE "echo \\\$|print \\\$|<\?=\\s*\\\$" --include='*.php' . | grep -viE "esc_|wp_kses|absint|intval|esc_url"
```

### Sanitização de entrada
- [ ] `$_POST`/`$_GET`/`$_REQUEST`/`$_SERVER` sempre sanitizados
  (`sanitize_text_field`, `absint`, `sanitize_email`, `esc_url_raw`, `wp_unslash`).
```bash
grep -rnE "\\\$_(POST|GET|REQUEST|SERVER|COOKIE)" --include='*.php' . | grep -viE "sanitize|absint|intval|esc_url|wp_verify_nonce|isset"
```

### Nonces + capacidades em ações de escrita
- [ ] Handlers de `save_post`, form submissions e AJAX verificam **nonce**
  (`wp_verify_nonce`/`check_admin_referer`) **e capacidade** (`current_user_can`).
- [ ] Autosave/permissões verificados antes de gravar meta.
```bash
grep -rnE "update_post_meta|update_option|wp_insert|wp_update|delete_" --include='*.php' inc
grep -rnE "current_user_can|wp_verify_nonce|check_admin_referer" --include='*.php' inc
```

### SQL
- [ ] Sem SQL concatenado; se usar `$wpdb`, sempre `$wpdb->prepare()`.
```bash
grep -rnE "\\\$wpdb->(query|get_results|get_var|get_row)" --include='*.php' . | grep -v prepare
```

### Execução / inclusão perigosa
- [ ] Sem `eval`, `base64_decode` de fontes externas, `create_function`,
  `extract`, `assert`, `system`, `exec`, `shell_exec`, `passthru`.
- [ ] Sem inclusão de ficheiros a partir de input (`include $_GET[...]`).
```bash
grep -rnE "\b(eval|create_function|assert|system|exec|shell_exec|passthru|popen|proc_open)\s*\(" --include='*.php' .
grep -rnE "base64_decode|gzinflate|str_rot13" --include='*.php' .
```

### Ficheiros / uploads
- [ ] Sem upload arbitrário sem validação de tipo/tamanho.
- [ ] `.htaccess`/config não expõem segredos; sem credenciais hardcoded.
```bash
grep -rniE "password|passwd|secret|api[_-]?key|token|Authorization" --include='*.php' . | grep -viE "nonce|esc_|placeholder"
```

### Webhooks / endpoints do tema
- [ ] Endpoints (ex.: `dev-tools/webhook-deploy.php`) validam assinatura HMAC,
  não estão publicamente acessíveis sem segredo, e não são deployados para produção.

## B) Segurança dos PLUGINS (o utilizador verifica no wp-admin)

Dar-lhe estes passos:
1. **Inventário:** wp-admin → Plugins. Listar todos, versão e ativo/inativo.
2. **Remover o que não se usa:** plugins inativos são superfície de ataque — apagar (não só desativar).
3. **Atualizações:** garantir todos atualizados. Ativar auto-updates para os de confiança.
4. **Vulnerabilidades conhecidas:** cruzar cada plugin+versão com uma base pública
   (WPScan / Patchstack / wpvulndb). Se houver CVE por corrigir → atualizar ou substituir.
5. **Origem:** só plugins do repositório oficial ou fornecedor reputado; nada "nulled".
6. **Plugins críticos deste site:** Polylang (i18n), Contact Form 7 (formulário),
   ShortPixel (imagens). Confirmar que estão atualizados e configurados.
7. **Se houver `wp-cli`:** `wp plugin list --fields=name,status,version,update` e
   `wp plugin update --all` (com backup antes).

## C) Hardening do WORDPRESS (verificar no servidor/wp-admin)
- [ ] WordPress core atualizado.
- [ ] Utilizadores: sem "admin" genérico; senhas fortes; 2FA nos admins; remover contas não usadas.
- [ ] `XML-RPC` desativado se não for preciso (o tema já filtra `xmlrpc_enabled`).
- [ ] Edição de ficheiros no admin desativada: `define('DISALLOW_FILE_EDIT', true);` no `wp-config.php`.
- [ ] `wp-config.php` fora da raiz web se possível; permissões 640/600; chaves `salt` únicas.
- [ ] Diretórios sem listagem; `xmlrpc.php`/`wp-login.php` protegidos (rate-limit/2FA).
- [ ] HTTPS forçado; HSTS; headers de segurança (o tema envia `X-Content-Type-Options`,
      `X-Frame-Options`, `X-XSS-Protection` — validar que chegam ao browser).
- [ ] Backups automáticos + testados (restore). cPanel/host.
- [ ] Firewall/WAF (ex.: Wordfence, Cloudflare) e monitorização de logins.

## Saída desta perspetiva
- **Achados no código do tema** (CONFIRMADOS, com `ficheiro:linha` e severidade).
- **Checklist de plugins/servidor** para o utilizador executar, com prioridade.
- Nunca reportar "seguro" sem ter corrido os greps; nunca reportar vuln de plugin
  sem indicar como o utilizador a confirma (não temos acesso ao site).
