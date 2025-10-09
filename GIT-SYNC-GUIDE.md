# Guia de Sincronização Git - Atlas Invencível Theme

## 🚀 Configuração Inicial

### 1. Configurar GitHub Repository

O repositório [atlas-invencivel-theme](https://github.com/luismsmarques/atlas-invencivel-theme) já foi criado e está vazio.

**Passos para configurar:**

1. **Autenticação GitHub**:
   ```bash
   # Configurar credenciais (se ainda não fez)
   git config --global user.name "Luis Marques"
   git config --global user.email "seu-email@exemplo.com"
   ```

2. **Push inicial**:
   ```bash
   # No diretório do tema
   cd /Users/LuisMarques_1/Local\ Sites/atlas-invencivel/app/public/wp-content/themes/AtlasTheme
   
   # Push para GitHub
   git push -u origin main
   ```

### 2. Configurar Deploy no Servidor (cPanel)

#### Opção A: Deploy Manual via Git

1. **Acessar cPanel** do seu hosting
2. **Abrir Terminal** (se disponível) ou usar **File Manager**
3. **Navegar para o tema**:
   ```bash
   cd public_html/wp-content/themes/
   ```

4. **Clonar repositório**:
   ```bash
   git clone https://github.com/luismsmarques/atlas-invencivel-theme.git AtlasTheme
   ```

5. **Configurar pull automático**:
   ```bash
   cd AtlasTheme
   git pull origin main
   ```

#### Opção B: Deploy via cPanel File Manager

1. **Baixar ZIP do GitHub**:
   - Vá para https://github.com/luismsmarques/atlas-invencivel-theme
   - Clique em "Code" > "Download ZIP"

2. **Upload via cPanel**:
   - File Manager > public_html/wp-content/themes/
   - Upload e extrair o ZIP
   - Renomear pasta para `AtlasTheme`

## 🔄 Workflow de Sincronização

### Desenvolvimento Local → GitHub

```bash
# 1. Fazer alterações no tema local
# 2. Verificar mudanças
git status

# 3. Adicionar arquivos modificados
git add .

# 4. Commit com mensagem descritiva
git commit -m "feat: adicionar nova funcionalidade X"

# 5. Push para GitHub
git push origin main
```

### GitHub → Servidor (cPanel)

#### Método 1: Pull Manual
```bash
# No servidor via Terminal cPanel
cd public_html/wp-content/themes/AtlasTheme
git pull origin main
```

#### Método 2: Download e Upload
1. Baixar ZIP do GitHub
2. Extrair localmente
3. Upload via cPanel File Manager
4. Substituir arquivos existentes

### Servidor → GitHub (Backup)

```bash
# No servidor via Terminal cPanel
cd public_html/wp-content/themes/AtlasTheme

# Adicionar mudanças do servidor
git add .
git commit -m "backup: mudanças do servidor"
git push origin main
```

## 🛠️ Scripts de Automação

### Script de Deploy Local

Crie um arquivo `deploy.sh` no diretório do tema:

```bash
#!/bin/bash
echo "🚀 Deploying Atlas Theme..."

# Commit mudanças locais
git add .
git commit -m "deploy: $(date)"

# Push para GitHub
git push origin main

echo "✅ Deploy concluído!"
echo "📋 Próximo passo: Fazer pull no servidor"
```

### Script de Deploy no Servidor

Crie um arquivo `server-deploy.sh` no servidor:

```bash
#!/bin/bash
echo "🔄 Atualizando tema no servidor..."

cd public_html/wp-content/themes/AtlasTheme

# Backup antes da atualização
cp -r . ../AtlasTheme-backup-$(date +%Y%m%d)

# Pull do GitHub
git pull origin main

echo "✅ Tema atualizado!"
echo "🔍 Verificar site em funcionamento"
```

## 📋 Comandos Úteis

### Git Básico
```bash
# Verificar status
git status

# Ver histórico
git log --oneline

# Ver diferenças
git diff

# Reverter mudanças
git checkout -- arquivo.php

# Criar branch para feature
git checkout -b feature/nova-funcionalidade
```

### Backup e Restore
```bash
# Backup completo do tema
tar -czf atlas-theme-backup-$(date +%Y%m%d).tar.gz .

# Restaurar backup
tar -xzf atlas-theme-backup-20250109.tar.gz
```

## 🔧 Configurações Avançadas

### .gitignore para WordPress Theme

O arquivo `.gitignore` já está configurado com:

```gitignore
# WordPress specific
wp-config.php
wp-content/uploads/
wp-content/cache/

# Development files
dev-tools/*.log
*.tmp
*.bak

# OS files
.DS_Store
Thumbs.db
```

### Branches de Desenvolvimento

```bash
# Criar branch para desenvolvimento
git checkout -b develop

# Criar branch para hotfix
git checkout -b hotfix/correcao-urgente

# Merge para main
git checkout main
git merge develop
git push origin main
```

## 🚨 Troubleshooting

### Problemas Comuns

**1. Conflitos de Merge**
```bash
# Resolver conflitos
git status
# Editar arquivos com conflitos
git add .
git commit -m "resolve: conflitos de merge"
```

**2. Push Rejeitado**
```bash
# Fazer pull primeiro
git pull origin main
# Resolver conflitos se houver
git push origin main
```

**3. Arquivos Não Rastreados**
```bash
# Adicionar todos os arquivos
git add .
# Ou arquivos específicos
git add arquivo.php
```

### Backup de Segurança

**Antes de qualquer deploy:**
1. Fazer backup do tema atual no servidor
2. Testar mudanças em ambiente local
3. Fazer commit das mudanças
4. Deploy gradual

## 📞 Suporte

Para problemas com Git:
- [Documentação Git](https://git-scm.com/doc)
- [GitHub Help](https://help.github.com)
- [WordPress Git Workflow](https://make.wordpress.org/core/handbook/contribute/git/)

---

**Repositório**: https://github.com/luismsmarques/atlas-invencivel-theme  
**Tema**: Atlas Invencível v1.0.0  
**Última atualização**: Janeiro 2025
