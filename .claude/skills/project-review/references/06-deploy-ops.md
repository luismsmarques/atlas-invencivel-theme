# Perspetiva 6 — Deploy / Ops

Pergunta central: **o deploy, cache, git e backups são fiáveis e reproduzíveis?**

## Checklist

### Git / fluxo
- [ ] Fluxo claro: feature → `development` (teste local) → `main` (produção).
- [ ] `main` e `development` sincronizadas (sem trabalho perdido).
- [ ] Sem ficheiros gerados/segredos commitados; `.gitignore` adequado.
- [ ] Mensagens de commit descritivas.

### cPanel Git Version Control + `.cpanel.yml`
- [ ] O repositório está clonado **fora de `public_html`** (senão o rsync recorre
  infinitamente → deploy "in progress" eterno). Confirmar o caminho no cPanel.
- [ ] `.cpanel.yml` tem guardas anti-recursão (aborta se origem/destino se sobrepuserem).
- [ ] `DEPLOYPATH` correto (`/home/<user>/public_html/wp-content/themes/<tema>/`).
- [ ] Deploy rápido: sem `cp -R` recursivo pesado nem `find -exec chmod` ficheiro-a-ficheiro; usar `rsync --chmod`.
- [ ] Exclusões corretas (`.git`, `dev-tools`, `*.xml`, `*.sh`, `.htaccess`).

### Cache-busting (causa comum de "não atualiza")
- [ ] Assets versionados por `filemtime` (qualquer alteração rebenta a cache).
- [ ] Se houver plugin de cache (WP Rocket/LiteSpeed/W3TC) ou Cloudflare: documentar o "purge" pós-deploy.

### Auto-deploy (opcional)
- [ ] Se existir cron/webhook (`dev-tools/auto-deploy.sh`, `webhook-deploy.php`):
  o webhook valida HMAC; o script só atua no branch de produção; logs existem.

### Backups e recuperação
- [ ] Backup automático do site+BD (host/cPanel) e **restore testado**.
- [ ] Estratégia de rollback (o git permite; e há backup do tema antes do deploy?).

### Configuração de ambiente
- [ ] O container/sessão remoto é efémero — nada de valor só local; tudo commitado.
- [ ] Documentar passos manuais pós-deploy (import WXR, ligar traduções Polylang, menus por idioma, ficheiros de favicon na raiz).

## Comandos úteis
```bash
git fetch origin main development
git log --oneline origin/main..origin/development   # pendente para produção
git status --short
sed -n '1,40p' .cpanel.yml
grep -nE "filemtime|ATLAS_THEME_VERSION" inc/enqueue.php functions.php
```

## Saída desta perspetiva
Estado do pipeline (git ↔ development ↔ main ↔ cPanel), riscos de deploy/cache/backup, e passos manuais que deviam estar documentados ou automatizados.
