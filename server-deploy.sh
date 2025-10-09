#!/bin/bash

# Atlas Invencível Theme - Server Deploy Script
# Este script atualiza o tema no servidor a partir do GitHub

echo "🔄 Atualizando Atlas Theme no servidor..."

# Verificar se estamos no diretório correto do tema
if [ ! -f "style.css" ]; then
    echo "❌ Erro: Execute este script no diretório do tema WordPress"
    echo "📁 Diretório correto: public_html/wp-content/themes/AtlasTheme"
    exit 1
fi

# Backup antes da atualização
echo "💾 Criando backup..."
BACKUP_DIR="../AtlasTheme-backup-$(date +%Y%m%d-%H%M%S)"
cp -r . "$BACKUP_DIR"
echo "✅ Backup criado em: $BACKUP_DIR"

# Verificar status do Git
echo "📋 Verificando status do Git..."
git status

# Pull do GitHub
echo "🌐 Baixando atualizações do GitHub..."
git pull origin main

if [ $? -eq 0 ]; then
    echo "✅ Tema atualizado com sucesso!"
    echo "🔍 Verificar site em funcionamento"
    echo "📋 Backup disponível em: $BACKUP_DIR"
    echo ""
    echo "🚀 Para reverter se necessário:"
    echo "   cp -r $BACKUP_DIR/* ."
else
    echo "❌ Erro na atualização. Verificar configurações do Git."
    echo "🔄 Para restaurar backup:"
    echo "   cp -r $BACKUP_DIR/* ."
    exit 1
fi
