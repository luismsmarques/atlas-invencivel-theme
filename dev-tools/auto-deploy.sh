#!/bin/bash
# ---------------------------------------------------------------------------
# Atlas Invencível — auto-deploy
# Puxa o branch de produção e dispara o deploy do cPanel (.cpanel.yml).
# Pensado para correr via Cron Job do cPanel, ou via webhook-deploy.php.
#
# Não faz nada se não houver commits novos (idempotente / barato).
# ---------------------------------------------------------------------------
set -euo pipefail

# Raiz do repositório = pasta-pai deste script (dev-tools/..).
REPO="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
BRANCH="${DEPLOY_BRANCH:-main}"
LOG="$REPO/dev-tools/auto-deploy.log"

cd "$REPO"

git fetch origin "$BRANCH" --quiet
LOCAL="$(git rev-parse HEAD)"
REMOTE="$(git rev-parse "origin/$BRANCH")"

# Já está atualizado — sair sem ruído.
if [ "$LOCAL" = "$REMOTE" ]; then
    exit 0
fi

echo "[$(date '+%Y-%m-%d %H:%M:%S')] Novo commit $REMOTE no '$BRANCH' — a fazer deploy..." >> "$LOG"

# Alinhar o clone com o remoto.
git reset --hard "origin/$BRANCH" >> "$LOG" 2>&1

# Disparar o deployment do cPanel (corre as tasks do .cpanel.yml).
if command -v uapi >/dev/null 2>&1; then
    uapi VersionControlDeployment create repository_root="$REPO" >> "$LOG" 2>&1 || \
        echo "[$(date '+%Y-%m-%d %H:%M:%S')] AVISO: uapi falhou — verifica o deploy manual no cPanel." >> "$LOG"
else
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] AVISO: 'uapi' não disponível — corre 'Deploy HEAD Commit' no cPanel." >> "$LOG"
fi

echo "[$(date '+%Y-%m-%d %H:%M:%S')] Deploy concluído." >> "$LOG"
