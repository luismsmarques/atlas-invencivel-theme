# Auto-deploy — GitHub → cPanel

Mantém o site sincronizado com a `main` sem carregar manualmente em "Deploy".
Pré-requisito: já teres o repositório criado em **cPanel → Git™ Version Control**
(a clonar `https://github.com/luismsmarques/atlas-invencivel-theme.git` para
`/home/atlasinv/repositories/atlas-invencivel-theme`).

O deploy real continua a ser feito pelo `.cpanel.yml` (copia o tema do clone
para `wp-content/themes/atlas-invencivel-theme/`). Estes mecanismos só fazem o
`git pull` + disparam esse deploy automaticamente.

---

## Método A — Cron (recomendado, simples e fiável)

Corre a cada 5 min; só faz deploy se houver commits novos.

**cPanel → Cron Jobs → Add New Cron Job**

- Intervalo: `*/5 * * * *` (cada 5 minutos)
- Comando:
  ```
  /bin/bash /home/atlasinv/repositories/atlas-invencivel-theme/dev-tools/auto-deploy.sh >/dev/null 2>&1
  ```

Logs em `dev-tools/auto-deploy.log` dentro do clone. Não há endpoint público,
não há segredos — é o método mais seguro em alojamento partilhado.

---

## Método B — Webhook (deploy instantâneo, opcional)

Dispara o deploy no momento exato do push. Requer `shell_exec` ativo.

1. Copia `dev-tools/webhook-deploy.php` para `public_html/gh-deploy.php`.
2. Define o segredo (escolhe um aleatório). No `.htaccess` do `public_html`:
   ```
   SetEnv GH_WEBHOOK_SECRET "cola-aqui-um-segredo-aleatorio"
   ```
3. GitHub → repo → **Settings → Webhooks → Add webhook**
   - **Payload URL:** `https://atlasinvencivel.pt/gh-deploy.php`
   - **Content type:** `application/json`
   - **Secret:** o mesmo segredo
   - **Events:** *Just the push event*
4. O script valida a assinatura HMAC do GitHub, só atua em push para `main`,
   e chama o `auto-deploy.sh`.

Se o teu alojamento tiver `shell_exec` desativado, usa o **Método A**.

---

## Notas
- Os dois métodos chamam o mesmo `dev-tools/auto-deploy.sh`.
- O `auto-deploy.sh` faz `git reset --hard origin/main` no clone (a pasta do
  clone é gerida pelo Git; não edites ficheiros lá à mão).
- O deploy faz sempre backup do tema atual antes de copiar (ver `.cpanel.yml`).
- Para pausar o auto-deploy: desativa o Cron Job (ou apaga o webhook no GitHub).
