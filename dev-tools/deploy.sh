#!/bin/bash

# Deploy Script for Atlas Theme
# This script copies the theme files to the WordPress local installation

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# WordPress installation paths
WP_PATHS=(
    "/Users/LuisMarques_1/Local Sites/atlas-invencivel/app/public/wp-content/themes"
    "/Users/LuisMarques_1/Local Sites/sports-news-theme/app/public/wp-content/themes"
    "/Users/LuisMarques_1/mads-wp-odds/wordpress/wp-content/themes"
)

# Current theme directory
THEME_DIR="$(pwd)"
THEME_NAME="AtlasTheme"

echo -e "${BLUE}🚀 Atlas Theme Deploy Script${NC}"
echo -e "${BLUE}==============================${NC}"
echo ""

# Function to check if directory exists
check_directory() {
    if [ -d "$1" ]; then
        return 0
    else
        return 1
    fi
}

# Function to deploy to a specific path
deploy_to_path() {
    local wp_path="$1"
    local target_path="$wp_path/$THEME_NAME"
    
    echo -e "${YELLOW}📁 Checking: $wp_path${NC}"
    
    if check_directory "$wp_path"; then
        echo -e "${GREEN}✅ WordPress themes directory found${NC}"
        
        # Create theme directory if it doesn't exist
        if [ ! -d "$target_path" ]; then
            echo -e "${YELLOW}📂 Creating theme directory: $target_path${NC}"
            mkdir -p "$target_path"
        fi
        
        # Copy theme files
        echo -e "${YELLOW}📋 Copying theme files...${NC}"
        
        # Copy all files except git and deploy files
        rsync -av --progress \
            --exclude='.git' \
            --exclude='.gitignore' \
            --exclude='deploy.sh' \
            --exclude='CASE-STUDY-GUIDE.md' \
            --exclude='CHANGELOG.md' \
            --exclude='FINAL-SUMMARY.md' \
            --exclude='INSTALLATION.md' \
            "$THEME_DIR/" "$target_path/"
        
        if [ $? -eq 0 ]; then
            echo -e "${GREEN}✅ Successfully deployed to: $target_path${NC}"
            
            # Set proper permissions
            echo -e "${YELLOW}🔐 Setting permissions...${NC}"
            chmod -R 755 "$target_path"
            find "$target_path" -type f -exec chmod 644 {} \;
            
            echo -e "${GREEN}🎉 Deployment completed successfully!${NC}"
            echo ""
            return 0
        else
            echo -e "${RED}❌ Failed to deploy to: $target_path${NC}"
            return 1
        fi
    else
        echo -e "${RED}❌ WordPress themes directory not found: $wp_path${NC}"
        return 1
    fi
}

# Main deployment process
echo -e "${YELLOW}🔍 Looking for WordPress installations...${NC}"
echo ""

success_count=0
total_paths=${#WP_PATHS[@]}

for wp_path in "${WP_PATHS[@]}"; do
    if deploy_to_path "$wp_path"; then
        ((success_count++))
    fi
    echo ""
done

# Summary
echo -e "${BLUE}📊 Deployment Summary${NC}"
echo -e "${BLUE}=====================${NC}"
echo -e "${GREEN}✅ Successful deployments: $success_count${NC}"
echo -e "${RED}❌ Failed deployments: $((total_paths - success_count))${NC}"
echo ""

if [ $success_count -gt 0 ]; then
    echo -e "${GREEN}🎉 Theme deployed successfully!${NC}"
    echo -e "${YELLOW}💡 Next steps:${NC}"
    echo "   1. Go to your WordPress admin"
    echo "   2. Navigate to Appearance > Themes"
    echo "   3. Activate the 'Atlas Theme'"
    echo "   4. Configure the theme settings"
    echo ""
    echo -e "${BLUE}📖 For case study setup, check the CASE-STUDY-GUIDE.md file${NC}"
else
    echo -e "${RED}❌ No successful deployments. Please check the paths and try again.${NC}"
fi

echo ""
echo -e "${BLUE}🏁 Deploy script completed${NC}"