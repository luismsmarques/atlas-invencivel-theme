/**
 * Hero Block JavaScript
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, TextControl, ColorPicker, MediaUpload, MediaUploadCheck } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('atlas-theme/hero-block', {
        title: __('Hero Section', 'atlas-theme'),
        icon: 'admin-users',
        category: 'atlas-theme',
        description: __('A hero section with name, role, and profile image', 'atlas-theme'),
        keywords: [
            __('hero', 'atlas-theme'),
            __('profile', 'atlas-theme'),
            __('introduction', 'atlas-theme'),
        ],
        attributes: {
            greeting: {
                type: 'string',
                default: __('Hey, my name is', 'atlas-theme'),
            },
            name: {
                type: 'string',
                default: 'LUIS MARQUES',
            },
            underlined: {
                type: 'string',
                default: 'MARQUES',
            },
            role: {
                type: 'string',
                default: 'WEBMASTER & BUILDER',
            },
            imageId: {
                type: 'number',
                default: 0,
            },
            imageUrl: {
                type: 'string',
                default: '',
            },
            stats: {
                type: 'array',
                default: [
                    {
                        label: __('Years of experience in Tech & Digital', 'atlas-theme'),
                        value: '15+',
                    },
                    {
                        label: __('Companies Founded and Led', 'atlas-theme'),
                        value: '3',
                    },
                    {
                        label: __('Social Media Communities & Content Managed', 'atlas-theme'),
                        value: '10+',
                    },
                ],
            },
            backgroundColor: {
                type: 'string',
                default: '#134686',
            },
            textColor: {
                type: 'string',
                default: '#ffffff',
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { greeting, name, underlined, role, imageId, imageUrl, backgroundColor, textColor } = attributes;

            const onSelectImage = function(media) {
                setAttributes({
                    imageId: media.id,
                    imageUrl: media.url,
                });
            };

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Hero Settings', 'atlas-theme') },
                        el(TextControl, {
                            label: __('Greeting Text', 'atlas-theme'),
                            value: greeting,
                            onChange: function(value) {
                                setAttributes({ greeting: value });
                            },
                        }),
                        el(TextControl, {
                            label: __('Full Name', 'atlas-theme'),
                            value: name,
                            onChange: function(value) {
                                setAttributes({ name: value });
                            },
                        }),
                        el(TextControl, {
                            label: __('Underlined Name Part', 'atlas-theme'),
                            value: underlined,
                            onChange: function(value) {
                                setAttributes({ underlined: value });
                            },
                        }),
                        el(TextControl, {
                            label: __('Role/Title', 'atlas-theme'),
                            value: role,
                            onChange: function(value) {
                                setAttributes({ role: value });
                            },
                            placeholder: 'WEBMASTER & BUILDER'
                        }),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: onSelectImage,
                                allowedTypes: ['image'],
                                value: imageId,
                                render: function(obj) {
                                    return el('button', {
                                        className: 'button button-large',
                                        onClick: obj.open
                                    }, imageId ? __('Change Image', 'atlas-theme') : __('Select Image', 'atlas-theme'));
                                }
                            })
                        ),
                        el(ColorPicker, {
                            color: backgroundColor,
                            onChangeComplete: function(color) {
                                setAttributes({ backgroundColor: color.hex });
                            },
                        }),
                        el(ColorPicker, {
                            color: textColor,
                            onChangeComplete: function(color) {
                                setAttributes({ textColor: color.hex });
                            },
                        })
                    )
                ),
                el('div', {
                    className: 'hero-block-preview',
                    style: {
                        backgroundColor: backgroundColor,
                        color: textColor,
                        padding: '40px',
                        textAlign: 'center',
                        borderRadius: '8px',
                        margin: '20px 0'
                    }
                },
                    el('p', { className: 'hero-greeting' }, greeting),
                    el('h1', { className: 'hero-name' }, name),
                    el('p', { className: 'hero-role' }, role),
                    imageUrl && el('img', {
                        src: imageUrl,
                        alt: name,
                        style: { maxWidth: '200px', borderRadius: '50%', marginTop: '20px' }
                    })
                )
            );
        },
        save: function() {
            return null; // Rendered server-side
        },
    });

})();