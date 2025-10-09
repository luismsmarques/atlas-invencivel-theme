#!/bin/bash

# Atlas Theme Image Replacement Script
# This script replaces original images with optimized versions

echo "🔄 Starting image replacement process..."

# Set the uploads directory
UPLOADS_DIR="/Users/LuisMarques_1/Local Sites/atlas-invencivel/app/public/wp-content/uploads/2025/10"
cd "$UPLOADS_DIR"

# Function to replace image with optimized version
replace_image() {
    local original_file="$1"
    local optimized_file="$2"
    
    if [ -f "$optimized_file" ]; then
        echo "🔄 Replacing: $original_file"
        
        # Backup original
        cp "$original_file" "${original_file}.backup"
        
        # Replace with optimized version
        cp "$optimized_file" "$original_file"
        
        echo "✅ Replaced: $original_file"
        echo "   Backup created: ${original_file}.backup"
    else
        echo "⚠️  Optimized file not found: $optimized_file"
    fi
}

# Replace main problematic image
echo "🎯 Replacing main problematic image..."
replace_image "Gemini_Generated_Image_emgcwsemgcwsemgc.png" "Gemini_Generated_Image_emgcwsemgcwsemgc-optimized.png"

# Replace all optimized PNG images
echo "📸 Replacing PNG images..."
for optimized_png in *-optimized.png; do
    if [ -f "$optimized_png" ]; then
        original_png="${optimized_png%-optimized.png}.png"
        if [ -f "$original_png" ] && [ "$original_png" != "Gemini_Generated_Image_emgcwsemgcwsemgc.png" ]; then
            replace_image "$original_png" "$optimized_png"
        fi
    fi
done

# Replace all optimized JPG images
echo "📸 Replacing JPG images..."
for optimized_jpg in *-optimized.jpg; do
    if [ -f "$optimized_jpg" ]; then
        original_jpg="${optimized_jpg%-optimized.jpg}.jpg"
        if [ -f "$original_jpg" ]; then
            replace_image "$original_jpg" "$optimized_jpg"
        fi
    fi
done

# Calculate final savings
echo "📊 Calculating final savings..."
total_original=0
total_optimized=0

for backup_file in *.backup; do
    if [ -f "$backup_file" ]; then
        original_file="${backup_file%.backup}"
        if [ -f "$original_file" ]; then
            original_size=$(stat -f%z "$backup_file")
            optimized_size=$(stat -f%z "$original_file")
            total_original=$((total_original + original_size))
            total_optimized=$((total_optimized + optimized_size))
        fi
    fi
done

total_savings=$((total_original - total_optimized))
total_savings_percent=$((total_savings * 100 / total_original))

echo "🎉 Image Replacement Complete!"
echo "📈 Final Results:"
echo "   Original total size: $(echo $total_original | awk '{printf "%.1f KB", $1/1024}')"
echo "   Optimized total size: $(echo $total_optimized | awk '{printf "%.1f KB", $1/1024}')"
echo "   Total savings: $(echo $total_savings | awk '{printf "%.1f KB", $1/1024}') ($total_savings_percent%)"
echo ""
echo "📋 Next Steps:"
echo "1. ✅ Images optimized and replaced"
echo "2. 🔄 Test PageSpeed Insights to verify improvements"
echo "3. 🔄 Configure ShortPixel for future automatic optimization"
echo "4. 🔄 Update WordPress media library if needed"
echo ""
echo "💡 WebP files are ready for serving when browser supports it"
echo "💡 Backup files (.backup) can be removed after testing"
