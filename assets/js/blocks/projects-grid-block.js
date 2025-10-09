/**
 * Projects Grid Block JavaScript
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, TextControl, RangeControl, ColorPicker, SelectControl } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('atlas-theme/projects-grid-block', {
        title: __('Projects Grid', 'atlas-theme'),
        icon: 'portfolio',
        category: 'atlas-theme',
        description: __('A grid displaying projects with images and descriptions', 'atlas-theme'),
        keywords: [
            __('projects', 'atlas-theme'),
            __('portfolio', 'atlas-theme'),
            __('work', 'atlas-theme'),
        ],
        attributes: {
            title: {
                type: 'string',
                default: __('MY LATEST PROJECTS', 'atlas-theme'),
            },
            description: {
                type: 'string',
                default: __('Explore my journey as a webmaster, builder, and entrepreneur. From creating award-winning platforms to leading companies and investing in innovative startups.', 'atlas-theme'),
            },
            columns: {
                type: 'number',
                default: 4,
            },
            limit: {
                type: 'number',
                default: 4,
            },
            category: {
                type: 'string',
                default: 'all',
            },
            backgroundColor: {
                type: 'string',
                default: '#FDF4E3',
            },
            textColor: {
                type: 'string',
                default: '#333333',
            },
            titleColor: {
                type: 'string',
                default: '#134686',
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { title, description, columns, limit, category, backgroundColor, textColor, titleColor } = attributes;

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Projects Grid Settings', 'atlas-theme') },
                        el(RangeControl, {
                            label: __('Columns', 'atlas-theme'),
                            value: columns,
                            onChange: function(value) {
                                setAttributes({ columns: value });
                            },
                            min: 1,
                            max: 6,
                        }),
                        el(RangeControl, {
                            label: __('Limit', 'atlas-theme'),
                            value: limit,
                            onChange: function(value) {
                                setAttributes({ limit: value });
                            },
                            min: 1,
                            max: 12,
                        }),
                        el(SelectControl, {
                            label: __('Category', 'atlas-theme'),
                            value: category,
                            options: [
                                { label: __('All Projects', 'atlas-theme'), value: 'all' },
                                { label: __('Web Development', 'atlas-theme'), value: 'web' },
                                { label: __('Mobile Apps', 'atlas-theme'), value: 'mobile' },
                                { label: __('Design', 'atlas-theme'), value: 'design' },
                            ],
                            onChange: function(value) {
                                setAttributes({ category: value });
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
                        }),
                        el(ColorPicker, {
                            color: titleColor,
                            onChangeComplete: function(color) {
                                setAttributes({ titleColor: color.hex });
                            },
                        })
                    )
                ),
                el('div', {
                    className: 'projects-grid-preview',
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
                            marginBottom: '20px',
                            color: titleColor
                        } 
                    }, title),
                    el('p', { 
                        style: { 
                            textAlign: 'center', 
                            marginBottom: '30px',
                            fontSize: '16px',
                            lineHeight: '1.6'
                        } 
                    }, description),
                    el('div', {
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + columns + ', 1fr)',
                            gap: '20px'
                        }
                    },
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { width: '100%', height: '150px', backgroundColor: '#f0f0f0', borderRadius: '4px', marginBottom: '15px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }, '📱'),
                            el('h3', {}, __('Project 1', 'atlas-theme')),
                            el('p', {}, __('Project description...', 'atlas-theme'))
                        ),
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { width: '100%', height: '150px', backgroundColor: '#f0f0f0', borderRadius: '4px', marginBottom: '15px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }, '💻'),
                            el('h3', {}, __('Project 2', 'atlas-theme')),
                            el('p', {}, __('Project description...', 'atlas-theme'))
                        ),
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { width: '100%', height: '150px', backgroundColor: '#f0f0f0', borderRadius: '4px', marginBottom: '15px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }, '🎨'),
                            el('h3', {}, __('Project 3', 'atlas-theme')),
                            el('p', {}, __('Project description...', 'atlas-theme'))
                        ),
                        el('div', { style: { textAlign: 'center', padding: '20px', border: '1px solid #ddd', borderRadius: '8px' } },
                            el('div', { style: { width: '100%', height: '150px', backgroundColor: '#f0f0f0', borderRadius: '4px', marginBottom: '15px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }, '🚀'),
                            el('h3', {}, __('Project 4', 'atlas-theme')),
                            el('p', {}, __('Project description...', 'atlas-theme'))
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