/**
 * Skills Grid Block JavaScript
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

    registerBlockType('atlas-theme/skills-grid-block', {
        title: __('Skills Grid', 'atlas-theme'),
        icon: 'grid-view',
        category: 'atlas-theme',
        description: __('A grid displaying skills with icons and descriptions', 'atlas-theme'),
        keywords: [
            __('skills', 'atlas-theme'),
            __('grid', 'atlas-theme'),
            __('abilities', 'atlas-theme'),
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
            showAll: {
                type: 'boolean',
                default: true,
            },
            limit: {
                type: 'number',
                default: 6,
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { columns, backgroundColor, textColor, showAll, limit } = attributes;

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Skills Grid Settings', 'atlas-theme') },
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
                            label: __('Show All Skills', 'atlas-theme'),
                            checked: showAll,
                            onChange: function(value) {
                                setAttributes({ showAll: value });
                            },
                        }),
                        !showAll && el(RangeControl, {
                            label: __('Limit', 'atlas-theme'),
                            value: limit,
                            onChange: function(value) {
                                setAttributes({ limit: value });
                            },
                            min: 1,
                            max: 12,
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
                    className: 'skills-grid-preview',
                    style: {
                        backgroundColor: backgroundColor,
                        color: textColor,
                        padding: '40px',
                        borderRadius: '8px',
                        margin: '20px 0'
                    }
                },
                    el('h2', { style: { textAlign: 'center', marginBottom: '30px' } }, __('Skills Grid Preview', 'atlas-theme')),
                    el('div', {
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + columns + ', 1fr)',
                            gap: '20px'
                        }
                    },
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { fontSize: '2em', marginBottom: '10px' } }, '🎨'),
                            el('h3', {}, __('Design', 'atlas-theme')),
                            el('p', {}, __('UI/UX Design', 'atlas-theme'))
                        ),
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { fontSize: '2em', marginBottom: '10px' } }, '💻'),
                            el('h3', {}, __('Development', 'atlas-theme')),
                            el('p', {}, __('Web Development', 'atlas-theme'))
                        ),
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { fontSize: '2em', marginBottom: '10px' } }, '📱'),
                            el('h3', {}, __('Mobile', 'atlas-theme')),
                            el('p', {}, __('Mobile Apps', 'atlas-theme'))
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Rendered server-side
        },
    });

})();