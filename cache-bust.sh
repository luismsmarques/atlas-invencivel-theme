#!/bin/bash

# Atlas Theme Cache Busting Script
# Force cache refresh for contact page updates

echo "🚀 Atlas Theme Cache Busting Script"
echo "=================================="

# Get current directory
THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
echo "📁 Theme directory: $THEME_DIR"

# Update file timestamps to force cache refresh
echo "⏰ Updating file timestamps..."
touch "$THEME_DIR/page-contact.php"
touch "$THEME_DIR/assets/css/contact.css"
touch "$THEME_DIR/assets/js/contact.js"
touch "$THEME_DIR/inc/contact-form.php"
touch "$THEME_DIR/inc/cache-busting.php"

echo "✅ File timestamps updated"

# Create cache busting marker
CACHE_VERSION=$(date +%s)
echo "🏷️  Cache version: $CACHE_VERSION"

# Update WordPress options (if WP-CLI is available)
if command -v wp &> /dev/null; then
    echo "🔄 Updating WordPress cache version..."
    wp option update atlas_theme_cache_version $CACHE_VERSION --path="$THEME_DIR/../../.."
    wp cache flush --path="$THEME_DIR/../../.."
    echo "✅ WordPress cache cleared"
else
    echo "⚠️  WP-CLI not available, manual cache clearing may be needed"
fi

# Clear common cache directories
echo "🧹 Clearing cache directories..."

# W3 Total Cache
if [ -d "$THEME_DIR/../../../wp-content/cache" ]; then
    rm -rf "$THEME_DIR/../../../wp-content/cache/*"
    echo "✅ W3 Total Cache cleared"
fi

# WP Super Cache
if [ -d "$THEME_DIR/../../../wp-content/cache/supercache" ]; then
    rm -rf "$THEME_DIR/../../../wp-content/cache/supercache/*"
    echo "✅ WP Super Cache cleared"
fi

# WP Rocket
if [ -d "$THEME_DIR/../../../wp-content/cache/wp-rocket" ]; then
    rm -rf "$THEME_DIR/../../../wp-content/cache/wp-rocket/*"
    echo "✅ WP Rocket cleared"
fi

# LiteSpeed Cache
if [ -d "$THEME_DIR/../../../wp-content/cache/litespeed" ]; then
    rm -rf "$THEME_DIR/../../../wp-content/cache/litespeed/*"
    echo "✅ LiteSpeed Cache cleared"
fi

# Browser cache headers
echo "🌐 Setting cache headers..."
cat > "$THEME_DIR/assets/css/contact.css" << 'EOF'
/* Cache busting header - Contact page styles */
/* Version: $(date +%s) */
EOF

# Add cache busting comment to JS
echo "📝 Adding cache busting comments..."
echo "/* Cache busted: $(date) */" >> "$THEME_DIR/assets/js/contact.js"

echo ""
echo "🎉 Cache busting complete!"
echo "📋 Next steps:"
echo "   1. Clear browser cache (Ctrl+F5 or Cmd+Shift+R)"
echo "   2. Check contact page: /contact"
echo "   3. Verify new design is loading"
echo ""
echo "🔧 If still seeing old version:"
echo "   - Check server-side caching plugins"
echo "   - Clear CDN cache if using one"
echo "   - Contact hosting provider for server cache"
echo ""
