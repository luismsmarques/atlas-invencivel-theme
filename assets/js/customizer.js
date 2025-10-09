/**
 * Customizer JavaScript for Atlas Invencível Theme
 * Live preview functionality for the WordPress Customizer
 */

(function($) {
    'use strict';

    // Wait for customizer to be ready
    wp.customize.bind('ready', function() {
        
        // Hero Section Controls
        wp.customize('atlas_hero_greeting', function(value) {
            value.bind(function(newval) {
                $('.hero-subtitle').text(newval);
            });
        });

        wp.customize('atlas_hero_name', function(value) {
            value.bind(function(newval) {
                $('.hero-title').html(function() {
                    var underlined = $('.underline-yellow').text();
                    return newval + ' <span class="underline-yellow">' + underlined + '</span>';
                });
            });
        });

        wp.customize('atlas_hero_underlined', function(value) {
            value.bind(function(newval) {
                $('.underline-yellow').text(newval);
            });
        });

        wp.customize('atlas_hero_role', function(value) {
            value.bind(function(newval) {
                $('.hero-role').text(newval);
            });
        });

        wp.customize('atlas_hero_image', function(value) {
            value.bind(function(newval) {
                if (newval) {
                    var attachment = wp.media.attachment(newval);
                    attachment.fetch().then(function() {
                        $('.profile-img').attr('src', attachment.get('url'));
                    });
                }
            });
        });

        // Logo Controls
        wp.customize('atlas_logo_icon', function(value) {
            value.bind(function(newval) {
                $('.logo-icon').text(newval);
            });
        });

        wp.customize('atlas_logo_text', function(value) {
            value.bind(function(newval) {
                $('.logo-text').text(newval);
            });
        });

        // Color Controls
        wp.customize('atlas_primary_color', function(value) {
            value.bind(function(newval) {
                $('.logo-icon, .social-icon, .timeline-dot, .footer-logo-icon').css('background-color', newval);
                $('.logo-text, .nav-link:hover, .nav-link.active, .section-title, .footer-logo-text').css('color', newval);
            });
        });

        wp.customize('atlas_secondary_color', function(value) {
            value.bind(function(newval) {
                $('.underline-yellow::after, .hero-image').css('background-color', newval);
            });
        });

        wp.customize('atlas_background_color', function(value) {
            value.bind(function(newval) {
                $('body, .skills, .projects, .company-logos, .education-experience, .footer').css('background-color', newval);
            });
        });

        // Social Links
        wp.customize('atlas_social_linkedin', function(value) {
            value.bind(function(newval) {
                updateSocialLink('linkedin', newval);
            });
        });

        wp.customize('atlas_social_twitter', function(value) {
            value.bind(function(newval) {
                updateSocialLink('twitter', newval);
            });
        });

        wp.customize('atlas_social_dribbble', function(value) {
            value.bind(function(newval) {
                updateSocialLink('dribbble', newval);
            });
        });

        wp.customize('atlas_social_instagram', function(value) {
            value.bind(function(newval) {
                updateSocialLink('instagram', newval);
            });
        });

        // Footer Controls
        wp.customize('atlas_footer_copyright', function(value) {
            value.bind(function(newval) {
                $('.footer-left p').html(newval);
            });
        });

        wp.customize('atlas_footer_logo_icon', function(value) {
            value.bind(function(newval) {
                $('.footer-logo-icon').text(newval);
            });
        });

        wp.customize('atlas_footer_logo_text', function(value) {
            value.bind(function(newval) {
                $('.footer-logo-text').text(newval);
            });
        });

        // Hero Stats Repeater
        wp.customize('atlas_hero_stats', function(value) {
            value.bind(function(newval) {
                updateHeroStats(newval);
            });
        });

    });

    /**
     * Update Social Link
     */
    function updateSocialLink(platform, url) {
        var $link = $('.social-icon[aria-label="' + platform.charAt(0).toUpperCase() + platform.slice(1) + '"]');
        
        if (url) {
            if ($link.length) {
                $link.attr('href', url);
            } else {
                // Create new social link
                var iconClass = getSocialIconClass(platform);
                var ariaLabel = platform.charAt(0).toUpperCase() + platform.slice(1);
                var newLink = '<a href="' + url + '" target="_blank" rel="noopener" class="social-icon" aria-label="' + ariaLabel + '"><i class="' + iconClass + '"></i></a>';
                $('.social-icons').append(newLink);
            }
        } else {
            $link.remove();
        }
    }

    /**
     * Get Social Icon Class
     */
    function getSocialIconClass(platform) {
        var icons = {
            'linkedin': 'fab fa-linkedin-in',
            'twitter': 'fab fa-x-twitter',
            'dribbble': 'fab fa-dribbble',
            'instagram': 'fab fa-instagram'
        };
        return icons[platform] || 'fab fa-link';
    }

    /**
     * Update Hero Stats
     */
    function updateHeroStats(stats) {
        var $statsContainer = $('.hero-right');
        $statsContainer.empty();

        if (stats && stats.length > 0) {
            $.each(stats, function(index, stat) {
                if (stat.label && stat.value) {
                    var statHtml = '<div class="stat">' +
                        '<p class="stat-label">' + stat.label + '</p>' +
                        '<p class="stat-value">' + stat.value + '</p>' +
                        '</div>';
                    $statsContainer.append(statHtml);
                }
            });
        }
    }

    /**
     * Initialize Customizer Preview
     */
    function initCustomizerPreview() {
        // Add smooth transitions for live preview
        $('body').addClass('customize-previewing');
        
        // Handle responsive preview
        if (wp.customize.previewedDevice) {
            $(document).on('click', '.preview-desktop, .preview-tablet, .preview-mobile', function() {
                setTimeout(function() {
                    // Trigger resize event for responsive adjustments
                    $(window).trigger('resize');
                }, 100);
            });
        }
    }

    // Initialize when document is ready
    $(document).ready(function() {
        initCustomizerPreview();
    });

    // Handle customizer refresh
    wp.customize.bind('preview-ready', function() {
        initCustomizerPreview();
    });

})(jQuery);
