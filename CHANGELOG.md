# Changelog

All notable changes to the Atlas Invencível WordPress theme will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-01-27

### Added
- Initial release of Atlas Invencível WordPress theme
- Hybrid theme architecture supporting both classic PHP templates and Full Site Editing (FSE)
- Custom Post Types for dynamic content management:
  - Projects with categories and external URLs
  - Skills with icons, abbreviations, and background colors
  - Timeline items for education and experience
  - Services with numbers, icon types, and featured flags
  - Company logos with shape variations
- Comprehensive WordPress Customizer integration:
  - Site identity controls (logo, text)
  - Hero section customization (greeting, name, role, image, stats)
  - Color scheme controls (primary, secondary, background, text)
  - Social media links (LinkedIn, Twitter/X, Dribbble, Instagram)
  - Footer settings (copyright, logo, navigation)
- Custom Gutenberg blocks:
  - Hero block with editable content and stats repeater
  - Skills grid block with customizable columns and colors
  - Projects grid block with category filtering and layout options
  - Timeline block with education/experience sections
  - Company logos block with shape variations and hover effects
  - Services grid block with featured service highlighting
- Block patterns for quick page building:
  - Hero section pattern
  - Skills grid pattern
  - Projects showcase pattern
  - Timeline pattern
  - Company logos pattern
  - Services grid pattern
  - Full homepage layout pattern
- FSE templates and template parts:
  - Block-based homepage template
  - Block-based page template
  - Block-based single post template
  - Block-based archive template
  - Header and footer template parts
- Template files:
  - `front-page.php` - Complete homepage with all sections
  - `page-services.php` - Dedicated services page
  - `template-services-integrated.php` - Services as integrated section
  - Standard WordPress templates (index, single, archive, page)
- Navigation system:
  - Primary and footer menu locations
  - Custom walker class for smooth scroll navigation
  - Active state highlighting on scroll
- Asset management:
  - Proper WordPress enqueuing with conditional loading
  - Google Fonts and Font Awesome integration
  - Editor-specific styles and scripts
  - Customizer preview assets
- Internationalization support:
  - Text domain: `atlas-theme`
  - Translation-ready with `.pot` file
  - All strings wrapped in translation functions
- Accessibility features:
  - Semantic HTML5 elements
  - ARIA labels for navigation and social links
  - Skip to content link
  - Screen reader text support
  - Proper heading hierarchy
- Security measures:
  - Proper escaping throughout (`esc_html()`, `esc_url()`, `esc_attr()`)
  - Input sanitization for all customizer controls
  - Nonces for forms and AJAX requests
  - Security headers implementation
- Performance optimizations:
  - Deferred JavaScript loading
  - Resource hints for external assets
  - Conditional asset loading
  - Optimized database queries
- Sample content:
  - XML import file with demo data
  - Sample projects, skills, timeline items, services, and company logos
- Responsive design:
  - Mobile-first approach
  - Breakpoints: 480px, 768px, 1024px
  - Touch-friendly navigation
  - Optimized images for different screen sizes

### Technical Details
- WordPress compatibility: 6.4+
- PHP compatibility: 7.4+
- Theme structure follows WordPress 2025 best practices
- Clean, semantic code with proper documentation
- Cross-browser compatibility (Chrome, Firefox, Safari, Edge)
- Mobile device optimization

### Files Structure
```
atlas-theme/
├── style.css (theme header and main styles)
├── functions.php (theme setup and functionality)
├── theme.json (FSE configuration)
├── readme.txt (theme documentation)
├── header.php (site header)
├── footer.php (site footer)
├── index.php (main fallback template)
├── front-page.php (homepage template)
├── page.php (default page template)
├── single.php (single post template)
├── archive.php (archive template)
├── page-services.php (services page template)
├── template-services-integrated.php (integrated services template)
├── templates/ (FSE templates)
├── parts/ (FSE template parts)
├── patterns/ (block patterns)
├── inc/ (theme functionality)
├── assets/ (CSS, JS, images)
├── languages/ (translation files)
└── sample-content.xml (demo content)
```

### Credits
- Inter font family by Rasmus Andersson
- Font Awesome icons
- WordPress Block Editor team
- WordPress community
