# Atlas Invencível WordPress Theme

A modern portfolio WordPress theme with Full Site Editing support, featuring dynamic content management through Custom Post Types and comprehensive Customizer controls.

## Overview

Atlas Invencível is a cutting-edge WordPress theme designed for professionals, entrepreneurs, and businesses looking to showcase their portfolio, services, and achievements. Built with WordPress 2025 best practices, this hybrid theme supports both classic templating and Full Site Editing (FSE).

## Key Features

- **Hybrid Architecture**: Supports both classic PHP templates and block-based Full Site Editing
- **Custom Post Types**: Projects, Skills, Timeline Items, Services, and Company Logos
- **Dynamic Content Management**: Easy-to-use admin interface for managing portfolio content
- **Comprehensive Customizer**: Extensive customization options for colors, typography, and content
- **Block Patterns**: Pre-designed layouts for quick page building
- **Custom Gutenberg Blocks**: Specialized blocks for portfolio sections
- **Responsive Design**: Mobile-first approach with perfect display on all devices
- **Accessibility Ready**: WCAG AA compliant with semantic HTML and ARIA labels
- **Translation Ready**: Full internationalization support with .pot file
- **Performance Optimized**: Clean code, optimized assets, and fast loading times

## Requirements

- WordPress 6.4 or higher
- PHP 7.4 or higher
- Modern web browser with JavaScript enabled

## Installation

1. Upload the theme files to the `/wp-content/themes/atlas-theme` directory
2. Activate the theme through the 'Appearance' screen in WordPress
3. Go to Appearance > Customize to configure the theme settings
4. Import the sample content (optional) using the provided XML file
5. Create your content using the Custom Post Types

## Quick Start

### 1. Configure Site Identity
- Go to Appearance > Customize > Site Identity
- Upload your logo
- Set site title and tagline

### 2. Customize Colors
- Go to Appearance > Customize > Colors
- Set primary color (default: #134686)
- Set secondary color (default: #FEB21A)
- Set background color (default: #FDF4E3)

### 3. Add Your Content

#### Projects
- Go to Projects > Add New
- Add project title, description, featured image
- Set project category and external URL (if applicable)

#### Skills
- Go to Skills > Add New
- Add skill name, abbreviation, icon, and background color

#### Timeline
- Go to Timeline > Add New
- Add timeline item (education or experience)
- Set dates, title, description, and location

#### Services
- Go to Services > Add New
- Add service title, description, icon, and number
- Mark as featured if desired

#### Company Logos
- Go to Company Logos > Add New
- Upload logo image and set shape variation

### 4. Build Your Pages

#### Using Block Editor (FSE)
- Create new pages using the block editor
- Use the provided block patterns for quick layouts
- Customize using the theme's custom blocks

#### Using Classic Templates
- Use the provided PHP templates as fallback
- Customize through the WordPress Customizer

## File Structure

```
atlas-theme/
├── style.css                 # Theme header and main styles
├── functions.php             # Theme setup and functionality
├── theme.json               # FSE configuration
├── readme.txt               # WordPress theme documentation
├── README.md                # This file
├── CHANGELOG.md             # Version history
├── LICENSE                  # GPL v2 license
├── screenshot.png           # Theme screenshot
├── sample-content.xml       # Demo content import
├── templates/               # FSE templates
│   ├── page.html
│   ├── single.html
│   ├── archive.html
│   └── index.html
├── parts/                   # FSE template parts
│   ├── header.html
│   └── footer.html
├── patterns/                # Block patterns
│   ├── hero-section.php
│   ├── skills-grid.php
│   ├── projects-showcase.php
│   ├── timeline.php
│   ├── company-logos.php
│   ├── services-grid.php
│   └── full-homepage.php
├── inc/                     # Theme functionality
│   ├── custom-post-types.php
│   ├── customizer.php
│   ├── enqueue.php
│   ├── template-functions.php
│   ├── options-page.php
│   └── blocks/              # Custom blocks
│       ├── hero-block.php
│       ├── skills-grid-block.php
│       ├── projects-grid-block.php
│       ├── timeline-block.php
│       ├── company-logos-block.php
│       └── services-grid-block.php
├── assets/                  # CSS, JS, images
│   ├── css/
│   │   ├── main.css
│   │   ├── editor-style.css
│   │   ├── services.css
│   │   ├── case-study.css
│   │   └── blocks/          # Block-specific styles
│   ├── js/
│   │   ├── main.js
│   │   ├── editor.js
│   │   ├── services.js
│   │   └── blocks/          # Block-specific scripts
│   └── images/
├── languages/               # Translation files
│   └── atlas-theme.pot
└── dev-tools/               # Development tools
    ├── create-projects.php
    ├── sample-project-data.php
    ├── deploy.sh
    ├── CASE-STUDY-GUIDE.md
    ├── FINAL-SUMMARY.md
    └── INSTALLATION.md
```

## Custom Post Types

### Projects
- **Purpose**: Showcase portfolio projects
- **Fields**: Title, description, featured image, category, external URL
- **Template**: `single-atlas_project.php`

### Skills
- **Purpose**: Display technical skills and competencies
- **Fields**: Name, abbreviation, icon, background color
- **Usage**: Skills grid block

### Timeline
- **Purpose**: Show education and work experience
- **Fields**: Type (education/experience), title, description, dates, location
- **Usage**: Timeline block

### Services
- **Purpose**: List offered services
- **Fields**: Title, description, icon, number, featured flag
- **Usage**: Services grid block

### Company Logos
- **Purpose**: Display client/partner logos
- **Fields**: Logo image, shape variation
- **Usage**: Company logos block

## Custom Blocks

### Hero Block
- **Purpose**: Main hero section with greeting, name, role, and stats
- **Features**: Editable content, stats repeater, background options

### Skills Grid Block
- **Purpose**: Display skills in a grid layout
- **Features**: Customizable columns, colors, responsive design

### Projects Grid Block
- **Purpose**: Showcase projects in a grid
- **Features**: Category filtering, layout options, hover effects

### Timeline Block
- **Purpose**: Display timeline items chronologically
- **Features**: Education/experience sections, date sorting

### Company Logos Block
- **Purpose**: Show client/partner logos
- **Features**: Shape variations, hover effects, responsive grid

### Services Grid Block
- **Purpose**: Display services in a grid
- **Features**: Featured service highlighting, icon support

## Block Patterns

The theme includes several pre-designed block patterns:

1. **Hero Section** - Main landing section
2. **Skills Grid** - Skills showcase
3. **Projects Showcase** - Portfolio display
4. **Timeline** - Experience timeline
5. **Company Logos** - Client logos
6. **Services Grid** - Services display
7. **Full Homepage** - Complete homepage layout

## Customization

### WordPress Customizer
- Site Identity (logo, title, tagline)
- Hero Section (greeting, name, role, image, stats)
- Colors (primary, secondary, background, text)
- Social Media Links
- Footer Settings

### CSS Customization
- Add custom CSS in Appearance > Customize > Additional CSS
- Override theme styles as needed
- Use CSS variables for consistent theming

### Child Theme
For extensive customizations, create a child theme:

1. Create a new directory: `atlas-theme-child`
2. Add `style.css` with theme header
3. Add `functions.php` to enqueue parent styles
4. Override templates as needed

## Performance

The theme is optimized for performance:

- **Clean Code**: Semantic HTML5, optimized CSS
- **Efficient Assets**: Conditional loading, proper enqueuing
- **Database Optimization**: Efficient queries, minimal database calls
- **Caching Ready**: Compatible with caching plugins
- **Image Optimization**: Responsive images, proper sizing

## Accessibility

The theme follows WCAG AA guidelines:

- **Semantic HTML**: Proper heading hierarchy, landmarks
- **ARIA Labels**: Screen reader support
- **Keyboard Navigation**: Full keyboard accessibility
- **Color Contrast**: Meets contrast requirements
- **Focus Management**: Visible focus indicators

## Translation

The theme is fully translation ready:

- **Text Domain**: `atlas-theme`
- **POT File**: `languages/atlas-theme.pot`
- **Translation Functions**: All strings wrapped
- **RTL Support**: Right-to-left language support

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Troubleshooting

### Common Issues

**Theme not activating:**
- Check WordPress version (6.4+)
- Check PHP version (7.4+)
- Verify file permissions

**Custom blocks not showing:**
- Clear cache
- Check for plugin conflicts
- Verify theme activation

**Styles not loading:**
- Check for CSS conflicts
- Clear browser cache
- Verify asset enqueuing

### Support

For support and documentation:
- Check the theme documentation
- Review the WordPress Codex
- Contact the developer

## Changelog

See `CHANGELOG.md` for detailed version history.

## Credits

- **Inter Font**: Rasmus Andersson
- **Font Awesome**: Icons
- **WordPress**: Block Editor team
- **Community**: WordPress contributors

## License

This theme is licensed under the GPL v2 or later.

## Copyright

© 2025 Luis Marques. All rights reserved.

---

**Version**: 1.0.0  
**Last Updated**: January 2025  
**WordPress Compatibility**: 6.4+  
**PHP Compatibility**: 7.4+
