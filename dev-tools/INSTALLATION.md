# Atlas Invencível - Installation Guide

## Quick Start

### 1. Theme Installation

1. **Upload the theme:**
   - Download the theme files
   - Upload to `/wp-content/themes/atlas-theme/` directory
   - Or install through WordPress admin: Appearance > Themes > Add New > Upload Theme

2. **Activate the theme:**
   - Go to Appearance > Themes
   - Click "Activate" on Atlas Invencível theme

### 2. Initial Setup

1. **Configure Customizer:**
   - Go to Appearance > Customize
   - Set up your site identity (logo, colors, etc.)
   - Configure hero section with your information
   - Add social media links
   - Customize footer settings

2. **Create Menus:**
   - Go to Appearance > Menus
   - Create a primary menu with links to: Home, About, Projects, Contacts
   - Assign to "Primary Navigation" location
   - Create a footer menu and assign to "Footer Navigation" location

3. **Add Sample Content (Optional):**
   - Go to Tools > Import
   - Install WordPress Importer if needed
   - Upload `sample-content.xml` file
   - Import all content to see the theme in action

### 3. Content Management

#### Adding Projects
1. Go to Projects > Add New
2. Add title, description, and featured image
3. Set project URL and category in meta box
4. Publish

#### Adding Skills
1. Go to Skills > Add New
2. Add skill name and description
3. Set icon class, abbreviation, and background color
4. Publish

#### Adding Timeline Items
1. Go to Timeline > Add New
2. Add title and description
3. Set date/period and type (education/experience)
4. Publish

#### Adding Services
1. Go to Services > Add New
2. Add service title and description
3. Set service number, icon type, and featured flag
4. Publish

#### Adding Company Logos
1. Go to Company Logos > Add New
2. Add company name
3. Set shape type and letter/icon
4. Publish

### 4. Page Templates

#### Services Page Options
- **Separate Services Page:** Use "Services Page" template
- **Integrated Services:** Use "Services Integrated" template
- **Shortcode:** Use `[atlas_services]` in any page or post

### 5. Block Editor Usage

#### Using Custom Blocks
1. Edit any page or post
2. Click "+" to add blocks
3. Search for "Atlas" to find custom blocks:
   - Hero Block
   - Skills Grid Block
   - Projects Grid Block
   - Timeline Block
   - Company Logos Block
   - Services Grid Block

#### Using Block Patterns
1. Edit any page or post
2. Click "+" to add blocks
3. Go to "Patterns" tab
4. Look for "Atlas Theme" category
5. Insert pre-designed layouts

### 6. Full Site Editing (FSE)

#### Using FSE Templates
1. Go to Appearance > Theme Editor
2. Edit templates and template parts
3. Use block editor to customize layouts
4. Save changes

#### Template Structure
- `templates/index.html` - Homepage template
- `templates/page.html` - Page template
- `templates/single.html` - Single post template
- `templates/archive.html` - Archive template
- `parts/header.html` - Header template part
- `parts/footer.html` - Footer template part

## Customization

### Colors
- Primary Color: Used for logos, links, and accents
- Secondary Color: Used for highlights and call-to-action elements
- Background Color: Main background color
- Text Color: Default text color

### Typography
- Font Family: Inter (Google Fonts)
- Font Sizes: Small, Medium, Large, Extra Large, Huge, Gigantic
- Line Height: 1.6 (default)

### Layout
- Content Width: 1200px
- Wide Width: 1400px
- Container Padding: 20px (mobile: 15px)

## Troubleshooting

### Common Issues

1. **Custom Post Types not showing:**
   - Make sure theme is activated
   - Check if posts are published
   - Verify menu order is set

2. **Customizer changes not saving:**
   - Check file permissions
   - Clear any caching plugins
   - Verify theme files are complete

3. **Blocks not appearing:**
   - Make sure WordPress is 6.4+
   - Check if block editor is enabled
   - Verify theme files are uploaded correctly

4. **Images not loading:**
   - Check image file paths
   - Verify file permissions
   - Clear browser cache

### Support

For support and questions:
- Check the theme documentation
- Review WordPress.org theme guidelines
- Contact the theme developer

## Performance Tips

1. **Optimize Images:**
   - Use appropriate image sizes
   - Compress images before uploading
   - Use WebP format when possible

2. **Caching:**
   - Install a caching plugin
   - Enable browser caching
   - Use CDN for static assets

3. **Database:**
   - Regularly clean up unused content
   - Optimize database tables
   - Remove unused plugins

## Security

1. **Keep Updated:**
   - Update WordPress core regularly
   - Update theme when new versions are released
   - Update plugins regularly

2. **File Permissions:**
   - Set correct file permissions (644 for files, 755 for directories)
   - Restrict access to sensitive files

3. **Backup:**
   - Regular backups of files and database
   - Test backup restoration process
   - Store backups securely

## Development

### File Structure
```
atlas-theme/
├── style.css (theme header)
├── functions.php (main functionality)
├── theme.json (FSE configuration)
├── header.php (site header)
├── footer.php (site footer)
├── templates/ (FSE templates)
├── parts/ (FSE template parts)
├── patterns/ (block patterns)
├── inc/ (theme includes)
├── assets/ (CSS, JS, images)
└── languages/ (translation files)
```

### Hooks and Filters
- `atlas_theme_setup` - Theme setup hook
- `atlas_theme_scripts` - Script enqueuing
- `atlas_theme_customize_register` - Customizer registration
- `atlas_theme_body_classes` - Body class filter

### Customization
- Child theme recommended for customizations
- Use WordPress hooks and filters
- Follow WordPress coding standards
- Test changes thoroughly

## License

This theme is licensed under GPL v2 or later.

## Credits

- Inter font family by Rasmus Andersson
- Font Awesome icons
- WordPress Block Editor team
- WordPress community
