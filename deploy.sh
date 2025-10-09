#!/bin/bash

# Atlas Invencível Theme - Deploy Script
# Este script faz deploy do tema para o GitHub

echo "🚀 Iniciando deploy do Atlas Invencível Theme..."

# Verificar se estamos no diretório correto
if [ ! -f "style.css" ]; then
    echo "❌ Erro: Execute este script no diretório do tema"
    exit 1
fi

# Verificar status do Git
echo "📋 Verificando status do Git..."
git status

# Adicionar todos os arquivos
echo "📦 Adicionando arquivos..."
git add .

# Fazer commit
echo "💾 Fazendo commit..."
git commit -m "deploy: $(date '+%Y-%m-%d %H:%M:%S') - Atlas Theme v1.0.0"

# Push para GitHub
echo "🌐 Enviando para GitHub..."
git push origin main

if [ $? -eq 0 ]; then
    echo "✅ Deploy concluído com sucesso!"
    echo "📋 Próximos passos:"
    echo "   1. Acessar cPanel do servidor"
    echo "   2. Fazer pull do repositório no servidor"
    echo "   3. Verificar funcionamento do site"
    echo ""
    echo "🔗 Repositório: https://github.com/luismsmarques/atlas-invencivel-theme"
else
    echo "❌ Erro no deploy. Verifique as configurações do Git."
    exit 1
fi
