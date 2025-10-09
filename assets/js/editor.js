/**
 * Editor JavaScript for Atlas Invencível Theme
 * Block editor enhancements and customizations
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        // Initialize editor enhancements
        initBlockStyles();
        initColorPalette();
        initFontSizes();
        initSpacingControls();
    }

    /**
     * Initialize custom block styles
     */
    function initBlockStyles() {
        // Add custom styles to blocks if needed
        const blocks = wp.blocks;
        
        if (blocks) {
            // Register custom block styles
            blocks.registerBlockStyle('core/paragraph', {
                name: 'atlas-highlight',
                label: wp.i18n.__('Highlight', 'atlas-theme'),
                isDefault: false
            });

            blocks.registerBlockStyle('core/heading', {
                name: 'atlas-gradient',
                label: wp.i18n.__('Gradient', 'atlas-theme'),
                isDefault: false
            });

            blocks.registerBlockStyle('core/button', {
                name: 'atlas-primary',
                label: wp.i18n.__('Primary', 'atlas-theme'),
                isDefault: true
            });

            blocks.registerBlockStyle('core/button', {
                name: 'atlas-secondary',
                label: wp.i18n.__('Secondary', 'atlas-theme'),
                isDefault: false
            });
        }
    }

    /**
     * Initialize color palette
     */
    function initColorPalette() {
        const { addFilter } = wp.hooks;
        const { createHigherOrderComponent } = wp.compose;
        const { Fragment } = wp.element;
        const { InspectorControls } = wp.blockEditor;
        const { PanelBody, ColorPalette } = wp.components;

        // Add custom color palette to blocks
        const withColorPalette = createHigherOrderComponent((BlockEdit) => {
            return (props) => {
                const { name, attributes, setAttributes } = props;
                
                // Only add to specific blocks
                const blocksWithColors = ['core/paragraph', 'core/heading', 'core/button'];
                
                if (!blocksWithColors.includes(name)) {
                    return wp.element.createElement(BlockEdit, props);
                }

                const colors = [
                    { name: 'primary', color: '#134686' },
                    { name: 'secondary', color: '#FEB21A' },
                    { name: 'background', color: '#FDF4E3' },
                    { name: 'foreground', color: '#333333' },
                    { name: 'white', color: '#ffffff' }
                ];

                return wp.element.createElement(
                    Fragment,
                    {},
                    wp.element.createElement(BlockEdit, props),
                    wp.element.createElement(
                        InspectorControls,
                        {},
                        wp.element.createElement(
                            PanelBody,
                            { title: wp.i18n.__('Atlas Colors', 'atlas-theme') },
                            wp.element.createElement(ColorPalette, {
                                colors: colors,
                                value: attributes.textColor || attributes.color,
                                onChange: (color) => {
                                    if (name === 'core/button') {
                                        setAttributes({ backgroundColor: color });
                                    } else {
                                        setAttributes({ textColor: color });
                                    }
                                }
                            })
                        )
                    )
                );
            };
        }, 'withColorPalette');

        addFilter('editor.BlockEdit', 'atlas-theme/color-palette', withColorPalette);
    }

    /**
     * Initialize font size controls
     */
    function initFontSizes() {
        const { addFilter } = wp.hooks;
        const { createHigherOrderComponent } = wp.compose;
        const { Fragment } = wp.element;
        const { InspectorControls } = wp.blockEditor;
        const { PanelBody, SelectControl } = wp.components;

        const withFontSizes = createHigherOrderComponent((BlockEdit) => {
            return (props) => {
                const { name, attributes, setAttributes } = props;
                
                // Only add to text blocks
                const textBlocks = ['core/paragraph', 'core/heading'];
                
                if (!textBlocks.includes(name)) {
                    return wp.element.createElement(BlockEdit, props);
                }

                const fontSizes = [
                    { label: wp.i18n.__('Small', 'atlas-theme'), value: 'small' },
                    { label: wp.i18n.__('Medium', 'atlas-theme'), value: 'medium' },
                    { label: wp.i18n.__('Large', 'atlas-theme'), value: 'large' },
                    { label: wp.i18n.__('Extra Large', 'atlas-theme'), value: 'x-large' },
                    { label: wp.i18n.__('Huge', 'atlas-theme'), value: 'huge' },
                    { label: wp.i18n.__('Gigantic', 'atlas-theme'), value: 'gigantic' }
                ];

                return wp.element.createElement(
                    Fragment,
                    {},
                    wp.element.createElement(BlockEdit, props),
                    wp.element.createElement(
                        InspectorControls,
                        {},
                        wp.element.createElement(
                            PanelBody,
                            { title: wp.i18n.__('Atlas Typography', 'atlas-theme') },
                            wp.element.createElement(SelectControl, {
                                label: wp.i18n.__('Font Size', 'atlas-theme'),
                                value: attributes.fontSize || 'medium',
                                options: fontSizes,
                                onChange: (value) => setAttributes({ fontSize: value })
                            })
                        )
                    )
                );
            };
        }, 'withFontSizes');

        addFilter('editor.BlockEdit', 'atlas-theme/font-sizes', withFontSizes);
    }

    /**
     * Initialize spacing controls
     */
    function initSpacingControls() {
        const { addFilter } = wp.hooks;
        const { createHigherOrderComponent } = wp.compose;
        const { Fragment } = wp.element;
        const { InspectorControls } = wp.blockEditor;
        const { PanelBody, SelectControl } = wp.components;

        const withSpacing = createHigherOrderComponent((BlockEdit) => {
            return (props) => {
                const { name, attributes, setAttributes } = props;
                
                // Add to all blocks
                const spacingOptions = [
                    { label: wp.i18n.__('None', 'atlas-theme'), value: '' },
                    { label: wp.i18n.__('Small', 'atlas-theme'), value: 'small' },
                    { label: wp.i18n.__('Medium', 'atlas-theme'), value: 'medium' },
                    { label: wp.i18n.__('Large', 'atlas-theme'), value: 'large' },
                    { label: wp.i18n.__('Extra Large', 'atlas-theme'), value: 'x-large' },
                    { label: wp.i18n.__('Huge', 'atlas-theme'), value: 'huge' },
                    { label: wp.i18n.__('Gigantic', 'atlas-theme'), value: 'gigantic' }
                ];

                return wp.element.createElement(
                    Fragment,
                    {},
                    wp.element.createElement(BlockEdit, props),
                    wp.element.createElement(
                        InspectorControls,
                        {},
                        wp.element.createElement(
                            PanelBody,
                            { title: wp.i18n.__('Atlas Spacing', 'atlas-theme') },
                            wp.element.createElement(SelectControl, {
                                label: wp.i18n.__('Bottom Spacing', 'atlas-theme'),
                                value: attributes.spacing || '',
                                options: spacingOptions,
                                onChange: (value) => setAttributes({ spacing: value })
                            })
                        )
                    )
                );
            };
        }, 'withSpacing');

        addFilter('editor.BlockEdit', 'atlas-theme/spacing', withSpacing);
    }

    /**
     * Add custom CSS classes to editor
     */
    function addEditorStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .editor-styles-wrapper .atlas-highlight {
                background-color: #FEB21A;
                color: #333;
                padding: 10px 15px;
                border-radius: 5px;
                font-weight: 600;
            }
            
            .editor-styles-wrapper .atlas-gradient {
                background: linear-gradient(135deg, #134686 0%, #FEB21A 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .editor-styles-wrapper .wp-block-button.atlas-primary .wp-block-button__link {
                background-color: #134686;
                border-color: #134686;
            }
            
            .editor-styles-wrapper .wp-block-button.atlas-secondary .wp-block-button__link {
                background-color: #FEB21A;
                border-color: #FEB21A;
                color: #333;
            }
        `;
        document.head.appendChild(style);
    }

    // Add styles when editor loads
    if (wp.domReady) {
        wp.domReady(addEditorStyles);
    } else {
        addEditorStyles();
    }

})();
