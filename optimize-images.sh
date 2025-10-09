#!/bin/bash

# Atlas Theme Image Optimization Script
# This script optimizes the problematic images identified in PageSpeed Insights

echo "🚀 Starting Atlas Theme Image Optimization..."

# Set the uploads directory
UPLOADS_DIR="/Users/LuisMarques_1/Local Sites/atlas-invencivel/app/public/wp-content/uploads/2025/10"
cd "$UPLOADS_DIR"

# Function to optimize PNG images
optimize_png() {
    local input_file="$1"
    local output_file="$2"
    
    echo "📸 Optimizing PNG: $input_file"
    
    # Use sips (macOS built-in tool) to optimize PNG
    sips -s format png -s formatOptions 70 "$input_file" --out "$output_file"
    
    # Get file sizes
    original_size=$(stat -f%z "$input_file")
    optimized_size=$(stat -f%z "$output_file")
    savings=$((original_size - optimized_size))
    savings_percent=$((savings * 100 / original_size))
    
    echo "✅ Optimized: $input_file"
    echo "   Original: $(numfmt --to=iec $original_size)"
    echo "   Optimized: $(numfmt --to=iec $optimized_size)"
    echo "   Savings: $(numfmt --to=iec $savings) ($savings_percent%)"
    echo ""
}

# Function to optimize JPG images
optimize_jpg() {
    local input_file="$1"
    local output_file="$2"
    
    echo "📸 Optimizing JPG: $input_file"
    
    # Use sips to optimize JPG with quality 85
    sips -s format jpeg -s formatOptions 85 "$input_file" --out "$output_file"
    
    # Get file sizes
    original_size=$(stat -f%z "$input_file")
    optimized_size=$(stat -f%z "$output_file")
    savings=$((original_size - optimized_size))
    savings_percent=$((savings * 100 / original_size))
    
    echo "✅ Optimized: $input_file"
    echo "   Original: $(numfmt --to=iec $original_size)"
    echo "   Optimized: $(numfmt --to=iec $optimized_size)"
    echo "   Savings: $(numfmt --to=iec $savings) ($savings_percent%)"
    echo ""
}

# Function to create WebP version
create_webp() {
    local input_file="$1"
    local webp_file="${input_file%.*}.webp"
    
    echo "🔄 Creating WebP: $webp_file"
    
    # Check if cwebp is available
    if command -v cwebp &> /dev/null; then
        cwebp -q 85 "$input_file" -o "$webp_file"
        echo "✅ WebP created: $webp_file"
    else
        echo "⚠️  cwebp not found. Install with: brew install webp"
        echo "   You can create WebP files manually using online tools like squoosh.app"
    fi
    echo ""
}

# Optimize the main problematic image
echo "🎯 Optimizing main problematic image..."
optimize_png "Gemini_Generated_Image_emgcwsemgcwsemgc.png" "Gemini_Generated_Image_emgcwsemgcwsemgc-optimized.png"

# Create WebP version
create_webp "Gemini_Generated_Image_emgcwsemgcwsemgc.png"

# Optimize all other PNG images
echo "📸 Optimizing all PNG images..."
for png_file in *.png; do
    if [ -f "$png_file" ] && [ "$png_file" != "Gemini_Generated_Image_emgcwsemgcwsemgc.png" ]; then
        optimized_file="${png_file%.*}-optimized.png"
        optimize_png "$png_file" "$optimized_file"
        create_webp "$png_file"
    fi
done

# Optimize all JPG images
echo "📸 Optimizing all JPG images..."
for jpg_file in *.jpg; do
    if [ -f "$jpg_file" ]; then
        optimized_file="${jpg_file%.*}-optimized.jpg"
        optimize_jpg "$jpg_file" "$optimized_file"
        create_webp "$jpg_file"
    fi
done

# Calculate total savings
echo "📊 Calculating total savings..."
total_original=0
total_optimized=0

for optimized_file in *-optimized.*; do
    if [ -f "$optimized_file" ]; then
        original_file="${optimized_file%-optimized.*}.${optimized_file##*.}"
        if [ -f "$original_file" ]; then
            original_size=$(stat -f%z "$original_file")
            optimized_size=$(stat -f%z "$optimized_file")
            total_original=$((total_original + original_size))
            total_optimized=$((total_optimized + optimized_size))
        fi
    fi
done

total_savings=$((total_original - total_optimized))
total_savings_percent=$((total_savings * 100 / total_original))

echo "🎉 Optimization Complete!"
echo "📈 Total Results:"
echo "   Original total size: $(numfmt --to=iec $total_original)"
echo "   Optimized total size: $(numfmt --to=iec $total_optimized)"
echo "   Total savings: $(numfmt --to=iec $total_savings) ($total_savings_percent%)"
echo ""
echo "📋 Next Steps:"
echo "1. Replace original images with optimized versions"
echo "2. Update WordPress media library"
echo "3. Test PageSpeed Insights again"
echo "4. Configure ShortPixel for automatic future optimization"
echo ""
echo "🔧 To replace images automatically, run:"
echo "   ./replace-optimized-images.sh"
