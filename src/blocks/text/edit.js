import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { 
    PanelBody, 
    TextareaControl,
    RangeControl,
	FontSizePicker,
	GradientPicker,
    __experimentalToggleGroupControl as ToggleGroupControl,
    __experimentalToggleGroupControlOption as ToggleGroupControlOption,
} from '@wordpress/components';
import { ColorPalette } from '@wordpress/block-editor';

import './editor.scss';
export default function Edit( { attributes, setAttributes}) {
    const { title, fontSize, textType, textColor, shadowSize, textGradient } = attributes;
	const fontSizes = [
        { name: 'S', slug: 'small', size: 12 },
        { name: 'M', slug: 'medium', size: 16 },
        { name: 'L', slug: 'large', size: 20 },
        { name: 'XL', slug: 'x-large', size: 24 },
        { name: 'XXL', slug: 'xx-large', size: 32 },
    ];
    const blockProps = useBlockProps({
        className: 'wp-block-jo-shu-block-text',
        style: {
            fontSize: fontSize ? `${fontSize}px` : undefined,
            color: textType === 'single' ? textColor : undefined,
            backgroundImage: textType === 'gradient' ? textGradient : undefined,
            backgroundClip: textType === 'gradient' ? 'text' : undefined,
            WebkitBackgroundClip: textType === 'gradient' ? 'text' : undefined,
            WebkitTextFillColor: textType === 'gradient' ? 'transparent' : undefined,
            textShadow: shadowSize ? `${shadowSize}px ${shadowSize}px ${shadowSize}px rgba(0,0,0,0.3)` : undefined,
        }
    });

    return (
        <>
            <InspectorControls>
                <PanelBody
                    title={__('Typography', 'jo-shu-block')}
                    initialOpen={true}
                >
                    <TextareaControl
                        label={__('Content', 'jo-shu-block')}
                        value={title}
                        onChange={(newTitle) => setAttributes({ title: newTitle })}
                    />
					 <FontSizePicker
						fontSizes={fontSizes}
						value={fontSize}
						onChange={(value) => setAttributes({ fontSize: value })}
						disableCustomFontSizes={false} // Set to true to disable custom sizes
					/>
                    {/* <RangeControl
                        label={__('Size', 'jo-shu-block')}
                        value={fontSize}
                        onChange={(value) => setAttributes({ fontSize: value })}
                        min={0}
                        max={100}
                    /> */}
                    <ToggleGroupControl
						label={__('Text Type', 'jo-shu-block')}
						value={textType}
						onChange={(value) => setAttributes({ textType: value })}>
						<ToggleGroupControlOption value="single" label={__('Single', 'jo-shu-block')} />
						<ToggleGroupControlOption value="gradient" label={__('Gradient', 'jo-shu-block')} />
					</ToggleGroupControl>

					{ textType === 'single' && (
						<div className="components-base-control">
							<label className="components-base-control__label">
								{__('Text Color', 'jo-shu-block')}
							</label>
							<ColorPalette
								value={textColor}
								onChange={(color) => setAttributes({ textColor: color })}
							/>
						</div>
					)}

					{ textType === 'gradient' && (
						<div className="components-base-control">
							<label className="components-base-control__label">
								{__('Text Gradient', 'jo-shu-block')}
							</label>
							<GradientPicker
								value={textGradient}
								onChange={(gradient) => setAttributes({ textGradient: gradient })}
							/>
						</div>
					)}
                    <RangeControl
                        label={__('Shadow / Outline', 'jo-shu-block')}
                        value={shadowSize}
                        onChange={(value) => setAttributes({ shadowSize: value })}
                        min={0}
                        max={20}
                    />
                </PanelBody>
            </InspectorControls>
            <div { ...blockProps }>
                <p>{title}</p>
            </div>
        </>
    );
}
