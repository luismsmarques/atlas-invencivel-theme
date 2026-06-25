<?php
/**
 * Atlas Invencível — recetor de webhook do GitHub (deploy instantâneo, opcional).
 *
 * COMO USAR
 * 1. Copia este ficheiro para public_html/ (ex.: public_html/gh-deploy.php).
 * 2. Define o segredo: cria a variável de ambiente GH_WEBHOOK_SECRET
 *    (ex.: no .htaccess do public_html:  SetEnv GH_WEBHOOK_SECRET "o-teu-segredo")
 *    OU substitui o valor 'CHANGE_ME' abaixo.
 * 3. Confirma o caminho do script de deploy ($deploy) — pasta do clone Git.
 * 4. No GitHub: repo → Settings → Webhooks → Add webhook
 *      Payload URL:  https://atlasinvencivel.pt/gh-deploy.php
 *      Content type: application/json
 *      Secret:       o mesmo de GH_WEBHOOK_SECRET
 *      Events:       Just the push event
 *
 * Requer que shell_exec esteja disponível no alojamento. Se não estiver,
 * usa antes o método de Cron (dev-tools/auto-deploy.sh).
 */

$secret = getenv('GH_WEBHOOK_SECRET') ?: 'CHANGE_ME';
$deploy = '/home/atlasinv/repositories/atlas-invencivel-theme/dev-tools/auto-deploy.sh';
$branch = 'refs/heads/main';

// 1) Ler payload e validar assinatura HMAC do GitHub.
$payload = file_get_contents('php://input');
$sig     = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$calc    = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if ($secret === 'CHANGE_ME') {
    http_response_code(500);
    exit('Configura o GH_WEBHOOK_SECRET primeiro.');
}
if (!$sig || !hash_equals($calc, $sig)) {
    http_response_code(401);
    exit('Assinatura inválida.');
}

// 2) Só fazer deploy em push para o branch de produção.
$data = json_decode($payload, true);
if (($data['ref'] ?? '') !== $branch) {
    http_response_code(204);
    exit('Ignorado (não é ' . $branch . ').');
}

// 3) Disparar o deploy.
if (!function_exists('shell_exec')) {
    http_response_code(501);
    exit('shell_exec indisponível — usa o método de Cron.');
}
$out = shell_exec('/bin/bash ' . escapeshellarg($deploy) . ' 2>&1');
http_response_code(202);
echo "Deploy disparado.\n" . $out;
