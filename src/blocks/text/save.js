import { useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { title, fontSize, textType, textColor, shadowSize, textGradient } = attributes;
    
    const blockProps = useBlockProps.save({
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
        <div { ...blockProps }>
            <p>{title}</p>
        </div>
    );
}