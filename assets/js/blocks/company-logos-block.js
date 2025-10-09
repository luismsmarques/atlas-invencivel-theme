/**
 * Company Logos Block JavaScript
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, RangeControl, ColorPicker } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('atlas-theme/company-logos-block', {
        title: __('Company Logos', 'atlas-theme'),
        icon: 'building',
        category: 'atlas-theme',
        description: __('A grid displaying company logos and partnerships', 'atlas-theme'),
        keywords: [
            __('logos', 'atlas-theme'),
            __('companies', 'atlas-theme'),
            __('partners', 'atlas-theme'),
        ],
        attributes: {
            columns: {
                type: 'number',
                default: 5,
            },
            limit: {
                type: 'number',
                default: 10,
            },
            backgroundColor: {
                type: 'string',
                default: '#ffffff',
            },
            textColor: {
                type: 'string',
                default: '#333333',
            },
            hoverColor: {
                type: 'string',
                default: '#FEB21A',
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { columns, limit, backgroundColor, textColor, hoverColor } = attributes;

            const shapes = ['shape-1', 'shape-2', 'shape-3', 'shape-4', 'shape-5'];
            const letters = ['', 'S', '', 'W', ''];

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Company Logos Settings', 'atlas-theme') },
                        el(RangeControl, {
                            label: __('Columns', 'atlas-theme'),
                            value: columns,
                            onChange: function(value) {
                                setAttributes({ columns: value });
                            },
                            min: 1,
                            max: 10,
                        }),
                        el(RangeControl, {
                            label: __('Limit', 'atlas-theme'),
                            value: limit,
                            onChange: function(value) {
                                setAttributes({ limit: value });
                            },
                            min: 1,
                            max: 20,
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
                        }),
                        el(ColorPicker, {
                            color: hoverColor,
                            onChangeComplete: function(color) {
                                setAttributes({ hoverColor: color.hex });
                            },
                        })
                    )
                ),
                el('div', {
                    className: 'company-logos-preview',
                    style: {
                        backgroundColor: backgroundColor,
                        color: textColor,
                        padding: '40px',
                        borderRadius: '8px',
                        margin: '20px 0'
                    }
                },
                    el('div', {
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + columns + ', 1fr)',
                            gap: '20px',
                            alignItems: 'center',
                            justifyItems: 'center'
                        }
                    },
                        shapes.map(function(shape, index) {
                            return el('div', {
                                key: index,
                                style: {
                                    width: '80px',
                                    height: '80px',
                                    backgroundColor: hoverColor,
                                    borderRadius: '50%',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    fontSize: '24px',
                                    fontWeight: 'bold',
                                    color: '#ffffff',
                                    transition: 'transform 0.3s ease'
                                }
                            }, letters[index] || '?');
                        })
                    ),
                    el('p', {
                        style: {
                            textAlign: 'center',
                            marginTop: '20px',
                            fontSize: '14px',
                            opacity: '0.7'
                        }
                    }, __('Company logos will be displayed here', 'atlas-theme'))
                )
            );
        },
        save: function() {
            return null; // Rendered server-side
        },
    });

})();