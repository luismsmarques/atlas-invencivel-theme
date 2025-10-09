/**
 * Services Grid Block JavaScript
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, RangeControl, ColorPicker, ToggleControl } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('atlas-theme/services-grid-block', {
        title: __('Services Grid', 'atlas-theme'),
        icon: 'admin-tools',
        category: 'atlas-theme',
        description: __('A grid displaying services with icons and descriptions', 'atlas-theme'),
        keywords: [
            __('services', 'atlas-theme'),
            __('grid', 'atlas-theme'),
            __('offerings', 'atlas-theme'),
        ],
        attributes: {
            columns: {
                type: 'number',
                default: 3,
            },
            backgroundColor: {
                type: 'string',
                default: '#FDF4E3',
            },
            textColor: {
                type: 'string',
                default: '#333333',
            },
            showFeatured: {
                type: 'boolean',
                default: true,
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { columns, backgroundColor, textColor, showFeatured } = attributes;

            const services = [
                { number: '01', icon: 'UX', title: 'UX DESIGN', featured: false },
                { number: '02', icon: 'UI', title: 'UI DESIGN', featured: false },
                { number: '03', icon: 'BRIEFCASE', title: 'GRAPHIC DESIGN', featured: true },
            ];

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Services Grid Settings', 'atlas-theme') },
                        el(RangeControl, {
                            label: __('Columns', 'atlas-theme'),
                            value: columns,
                            onChange: function(value) {
                                setAttributes({ columns: value });
                            },
                            min: 1,
                            max: 6,
                        }),
                        el(ToggleControl, {
                            label: __('Show Featured Service', 'atlas-theme'),
                            checked: showFeatured,
                            onChange: function(value) {
                                setAttributes({ showFeatured: value });
                            },
                        }),
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
                    className: 'services-grid-preview',
                    style: {
                        backgroundColor: backgroundColor,
                        color: textColor,
                        padding: '40px',
                        borderRadius: '8px',
                        margin: '20px 0'
                    }
                },
                    el('h2', { 
                        style: { 
                            textAlign: 'center', 
                            marginBottom: '30px',
                            fontSize: '24px',
                            fontWeight: 'bold'
                        } 
                    }, __('SERVICES', 'atlas-theme')),
                    el('div', {
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + columns + ', 1fr)',
                            gap: '20px'
                        }
                    },
                        services.map(function(service, index) {
                            return el('div', {
                                key: index,
                                style: {
                                    textAlign: 'center',
                                    padding: '30px 20px',
                                    border: '1px solid #ddd',
                                    borderRadius: '8px',
                                    backgroundColor: service.featured && showFeatured ? '#134686' : 'transparent',
                                    color: service.featured && showFeatured ? '#ffffff' : textColor,
                                    position: 'relative'
                                }
                            },
                                el('div', {
                                    style: {
                                        fontSize: '48px',
                                        marginBottom: '15px',
                                        fontWeight: 'bold'
                                    }
                                }, service.number),
                                el('div', {
                                    style: {
                                        fontSize: '18px',
                                        marginBottom: '10px',
                                        fontWeight: '600'
                                    }
                                }, service.icon),
                                el('h3', {
                                    style: {
                                        fontSize: '16px',
                                        fontWeight: 'bold',
                                        textTransform: 'uppercase',
                                        letterSpacing: '1px'
                                    }
                                }, service.title)
                            );
                        })
                    )
                )
            );
        },
        save: function() {
            return null; // Rendered server-side
        },
    });

})();