/**
 * Timeline Block JavaScript
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

(function() {
    'use strict';

    const { registerBlockType } = wp.blocks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, TextControl, ColorPicker, ToggleControl } = wp.components;
    const { __ } = wp.i18n;

    registerBlockType('atlas-theme/timeline-block', {
        title: __('Timeline', 'atlas-theme'),
        icon: 'clock',
        category: 'atlas-theme',
        description: __('A timeline displaying career milestones and achievements', 'atlas-theme'),
        keywords: [
            __('timeline', 'atlas-theme'),
            __('career', 'atlas-theme'),
            __('experience', 'atlas-theme'),
        ],
        attributes: {
            title: {
                type: 'string',
                default: __('MY JOURNEY', 'atlas-theme'),
            },
            backgroundColor: {
                type: 'string',
                default: '#ffffff',
            },
            textColor: {
                type: 'string',
                default: '#333333',
            },
            titleColor: {
                type: 'string',
                default: '#134686',
            },
            dotColor: {
                type: 'string',
                default: '#FEB21A',
            },
            showEducation: {
                type: 'boolean',
                default: true,
            },
            showExperience: {
                type: 'boolean',
                default: true,
            },
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { title, backgroundColor, textColor, titleColor, dotColor, showEducation, showExperience } = attributes;

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Timeline Settings', 'atlas-theme') },
                        el(TextControl, {
                            label: __('Title', 'atlas-theme'),
                            value: title,
                            onChange: function(value) {
                                setAttributes({ title: value });
                            },
                        }),
                        el(ToggleControl, {
                            label: __('Show Education', 'atlas-theme'),
                            checked: showEducation,
                            onChange: function(value) {
                                setAttributes({ showEducation: value });
                            },
                        }),
                        el(ToggleControl, {
                            label: __('Show Experience', 'atlas-theme'),
                            checked: showExperience,
                            onChange: function(value) {
                                setAttributes({ showExperience: value });
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
                        }),
                        el(ColorPicker, {
                            color: dotColor,
                            onChangeComplete: function(color) {
                                setAttributes({ dotColor: color.hex });
                            },
                        })
                    )
                ),
                el('div', {
                    className: 'timeline-preview',
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
                            marginBottom: '40px',
                            color: titleColor
                        } 
                    }, title),
                    el('div', {
                        style: {
                            position: 'relative',
                            paddingLeft: '30px'
                        }
                    },
                        el('div', {
                            style: {
                                position: 'absolute',
                                left: '0',
                                top: '0',
                                width: '12px',
                                height: '12px',
                                backgroundColor: dotColor,
                                borderRadius: '50%',
                                border: '3px solid ' + backgroundColor
                            }
                        }),
                        el('div', { style: { marginBottom: '30px' } },
                            el('h3', { style: { marginBottom: '10px', color: titleColor } }, __('2020 - Present', 'atlas-theme')),
                            el('h4', { style: { marginBottom: '5px' } }, __('CEO & Founder', 'atlas-theme')),
                            el('p', {}, __('Atlas Invencível - Leading digital transformation initiatives...', 'atlas-theme'))
                        ),
                        el('div', {
                            style: {
                                position: 'absolute',
                                left: '0',
                                top: '60px',
                                width: '12px',
                                height: '12px',
                                backgroundColor: dotColor,
                                borderRadius: '50%',
                                border: '3px solid ' + backgroundColor
                            }
                        }),
                        el('div', { style: { marginBottom: '30px' } },
                            el('h3', { style: { marginBottom: '10px', color: titleColor } }, __('2018 - 2020', 'atlas-theme')),
                            el('h4', { style: { marginBottom: '5px' } }, __('Lead Developer', 'atlas-theme')),
                            el('p', {}, __('Tech Solutions Inc - Developed scalable web applications...', 'atlas-theme'))
                        ),
                        el('div', {
                            style: {
                                position: 'absolute',
                                left: '0',
                                top: '120px',
                                width: '12px',
                                height: '12px',
                                backgroundColor: dotColor,
                                borderRadius: '50%',
                                border: '3px solid ' + backgroundColor
                            }
                        }),
                        el('div', { style: { marginBottom: '30px' } },
                            el('h3', { style: { marginBottom: '10px', color: titleColor } }, __('2015 - 2018', 'atlas-theme')),
                            el('h4', { style: { marginBottom: '5px' } }, __('Web Developer', 'atlas-theme')),
                            el('p', {}, __('Digital Agency - Created responsive websites and web applications...', 'atlas-theme'))
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