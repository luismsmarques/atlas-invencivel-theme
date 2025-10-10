# Guia de Deploy para cPanel - Atlas Theme

## Visão Geral

Este guia explica como fazer deploy do tema Atlas para um servidor cPanel usando Git.

## Estrutura de Pastas no Servidor

```
/public_html/wp-content/themes/AtlasTheme/
├── .git/
├── .gitignore
├── .gitattributes
├── assets/
├── inc/
├── languages/
├── style.css
├── functions.php
├── index.php
└── ... (outros arquivos do tema)
```

## Métodos de Deploy

### Método 1: Clone Direto no Servidor (Recomendado)

1. **Acesse o cPanel**
   - Faça login no cPanel
   - Vá para "Terminal" ou "SSH Access"

2. **Navegue para a pasta de temas**
   ```bash
   cd /public_html/wp-content/themes/
   ```

3. **Clone o repositório**
   ```bash
   git clone https://github.com/luismsmarques/atlas-invencivel-theme.git AtlasTheme
   ```

4. **Configure as permissões**
   ```bash
   chmod -R 755 AtlasTheme/
   chown -R username:username AtlasTheme/
   ```

### Método 2: Upload via Git no cPanel

1. **Acesse o File Manager**
   - Vá para "File Manager" no cPanel
   - Navegue para `/public_html/wp-content/themes/`

2. **Crie a pasta do tema**
   - Clique em "New Folder"
   - Nome: `AtlasTheme`

3. **Clone via Terminal**
   ```bash
   cd AtlasTheme
   git clone https://github.com/luismsmarques/atlas-invencivel-theme.git .
   ```

### Método 3: Deploy Manual (Backup)

1. **Baixe o tema**
   ```bash
   git archive --format=zip --output=atlas-theme.zip HEAD
   ```

2. **Upload via cPanel**
   - Use o File Manager para fazer upload do arquivo
   - Extraia na pasta `/public_html/wp-content/themes/AtlasTheme/`

## Atualizações do Tema

### Atualização via Git Pull

1. **Acesse o terminal do servidor**
   ```bash
   cd /public_html/wp-content/themes/AtlasTheme/
   ```

2. **Atualize o tema**
   ```bash
   git pull origin main
   ```

3. **Verifique as permissões**
   ```bash
   chmod -R 755 .
   ```

### Script de Deploy Automatizado

Crie um arquivo `deploy.sh` no servidor:

```bash
#!/bin/bash
# Deploy script for Atlas Theme

echo "Starting Atlas Theme deployment..."

# Navigate to theme directory
cd /public_html/wp-content/themes/AtlasTheme/

# Pull latest changes
git pull origin main

# Set permissions
chmod -R 755 .

# Clear any caches (if using caching plugins)
# wp cache flush (if WP-CLI is available)

echo "Deployment completed successfully!"
```

## Configurações de Segurança

### 1. Proteger Arquivos Sensíveis

Adicione ao `.htaccess` na raiz do WordPress:

```apache
# Protect Git files
<Files ".git*">
    Order allow,deny
    Deny from all
</Files>

# Protect sensitive files
<FilesMatch "\.(env|log|bak|backup)$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### 2. Configurar Permissões

```bash
# Permissões corretas para WordPress
find /public_html/wp-content/themes/AtlasTheme/ -type f -exec chmod 644 {} \;
find /public_html/wp-content/themes/AtlasTheme/ -type d -exec chmod 755 {} \;

# Arquivos específicos
chmod 600 .gitignore
chmod 600 .gitattributes
```

## Troubleshooting

### Problema: Permissões Negadas
```bash
# Solução
sudo chown -R username:username /public_html/wp-content/themes/AtlasTheme/
chmod -R 755 /public_html/wp-content/themes/AtlasTheme/
```

### Problema: Git Não Encontrado
```bash
# Instalar Git no cPanel (se disponível)
# Ou usar método de upload manual
```

### Problema: Conflitos de Merge
```bash
# Reset para versão remota
git fetch origin
git reset --hard origin/main
```

## Backup e Rollback

### Backup Antes do Deploy
```bash
# Criar backup do tema atual
cp -r /public_html/wp-content/themes/AtlasTheme /public_html/wp-content/themes/AtlasTheme-backup-$(date +%Y%m%d)
```

### Rollback em Caso de Problemas
```bash
# Reverter para versão anterior
rm -rf /public_html/wp-content/themes/AtlasTheme
mv /public_html/wp-content/themes/AtlasTheme-backup-YYYYMMDD /public_html/wp-content/themes/AtlasTheme
```

## Monitoramento

### Verificar Status do Git
```bash
cd /public_html/wp-content/themes/AtlasTheme/
git status
git log --oneline -5
```

### Verificar Permissões
```bash
ls -la /public_html/wp-content/themes/AtlasTheme/
```

## Comandos Úteis

```bash
# Verificar última atualização
git log -1 --format="%H %an %ad %s" --date=short

# Verificar arquivos modificados
git diff --name-only HEAD~1

# Limpar cache do Git
git gc --prune=now

# Verificar tamanho do repositório
du -sh .git/
```

## Notas Importantes

1. **Sempre faça backup** antes de atualizar
2. **Teste em ambiente de desenvolvimento** primeiro
3. **Verifique as permissões** após cada deploy
4. **Monitore os logs** do servidor após deploy
5. **Mantenha o repositório atualizado** regularmente

## Suporte

Para problemas específicos:
1. Verifique os logs de erro do servidor
2. Confirme as permissões de arquivo
3. Teste em ambiente local primeiro
4. Consulte a documentação do cPanel
