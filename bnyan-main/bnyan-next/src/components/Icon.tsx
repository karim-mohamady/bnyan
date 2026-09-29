import React from 'react';

interface IconProps {
  name: string;
  width?: number | string;
  height?: number | string;
  className?: string;
  style?: React.CSSProperties;
}

export default function Icon({ name, width = 24, height = 24, className = '', style }: IconProps) {
  return (
    <svg 
      className={`icon ${className}`} 
      width={width} 
      height={height} 
      aria-hidden="true"
      style={style}
    >
      <use href={`/assets/icons/sprite.svg#icon-${name}`} />
    </svg>
  );
}
