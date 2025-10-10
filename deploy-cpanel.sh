#!/bin/bash

# =============================================================================
# Atlas Theme - Deploy Script for cPanel
# =============================================================================

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
THEME_DIR="/public_html/wp-content/themes/AtlasTheme"
BACKUP_DIR="/public_html/wp-content/themes/backups"
REPO_URL="https://github.com/luismsmarques/atlas-invencivel-theme.git"
BRANCH="main"

# Functions
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running as correct user
check_user() {
    if [[ $EUID -eq 0 ]]; then
        log_error "This script should not be run as root"
        exit 1
    fi
}

# Check if Git is available
check_git() {
    if ! command -v git &> /dev/null; then
        log_error "Git is not installed or not in PATH"
        exit 1
    fi
    log_success "Git is available"
}

# Create backup directory
create_backup_dir() {
    if [ ! -d "$BACKUP_DIR" ]; then
        mkdir -p "$BACKUP_DIR"
        log_info "Created backup directory: $BACKUP_DIR"
    fi
}

# Backup current theme
backup_theme() {
    if [ -d "$THEME_DIR" ]; then
        BACKUP_NAME="AtlasTheme-backup-$(date +%Y%m%d-%H%M%S)"
        cp -r "$THEME_DIR" "$BACKUP_DIR/$BACKUP_NAME"
        log_success "Theme backed up to: $BACKUP_DIR/$BACKUP_NAME"
    else
        log_warning "Theme directory does not exist, skipping backup"
    fi
}

# Deploy theme
deploy_theme() {
    log_info "Starting theme deployment..."
    
    # If theme directory exists, remove it
    if [ -d "$THEME_DIR" ]; then
        rm -rf "$THEME_DIR"
        log_info "Removed existing theme directory"
    fi
    
    # Clone the repository
    log_info "Cloning repository..."
    git clone -b "$BRANCH" "$REPO_URL" "$THEME_DIR"
    
    if [ $? -eq 0 ]; then
        log_success "Repository cloned successfully"
    else
        log_error "Failed to clone repository"
        exit 1
    fi
}

# Set permissions
set_permissions() {
    log_info "Setting file permissions..."
    
    # Set directory permissions
    find "$THEME_DIR" -type d -exec chmod 755 {} \;
    
    # Set file permissions
    find "$THEME_DIR" -type f -exec chmod 644 {} \;
    
    # Set specific permissions for important files
    chmod 600 "$THEME_DIR/.gitignore" 2>/dev/null || true
    chmod 600 "$THEME_DIR/.gitattributes" 2>/dev/null || true
    
    log_success "Permissions set successfully"
}

# Verify deployment
verify_deployment() {
    log_info "Verifying deployment..."
    
    # Check if essential files exist
    ESSENTIAL_FILES=(
        "style.css"
        "functions.php"
        "index.php"
        "assets/css/main.css"
        "inc/custom-post-types.php"
    )
    
    for file in "${ESSENTIAL_FILES[@]}"; do
        if [ -f "$THEME_DIR/$file" ]; then
            log_success "✓ $file exists"
        else
            log_error "✗ $file is missing"
            return 1
        fi
    done
    
    log_success "Deployment verification completed"
}

# Clean up old backups
cleanup_backups() {
    log_info "Cleaning up old backups (keeping last 5)..."
    
    if [ -d "$BACKUP_DIR" ]; then
        cd "$BACKUP_DIR"
        ls -t | tail -n +6 | xargs -r rm -rf
        log_success "Old backups cleaned up"
    fi
}

# Main deployment function
main() {
    echo "=========================================="
    echo "Atlas Theme - cPanel Deploy Script"
    echo "=========================================="
    echo
    
    # Pre-deployment checks
    check_user
    check_git
    create_backup_dir
    
    # Deployment process
    backup_theme
    deploy_theme
    set_permissions
    
    # Post-deployment verification
    if verify_deployment; then
        log_success "Deployment completed successfully!"
        cleanup_backups
        
        echo
        echo "=========================================="
        echo "Deployment Summary:"
        echo "=========================================="
        echo "Theme Directory: $THEME_DIR"
        echo "Backup Directory: $BACKUP_DIR"
        echo "Repository: $REPO_URL"
        echo "Branch: $BRANCH"
        echo "Deployment Time: $(date)"
        echo "=========================================="
        
    else
        log_error "Deployment verification failed!"
        log_info "You may need to restore from backup"
        exit 1
    fi
}

# Run main function
main "$@"
