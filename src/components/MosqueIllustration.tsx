import React from 'react';

interface MosqueIllustrationProps {
  color?: 'moss' | 'sand' | 'sage' | 'earth';
  className?: string;
  style?: React.CSSProperties;
}

export default function MosqueIllustration({ color = 'moss', className = '', style }: MosqueIllustrationProps) {
  const valid = ['moss', 'sand', 'sage', 'earth'];
  const c = valid.includes(color) ? color : 'moss';
  
  return (
    <img 
      src={`/assets/icons/mosque-${c}.svg`} 
      alt="" 
      width="100%" 
      height="180" 
      className={className}
      style={{ display: 'block', objectFit: 'cover', ...style }}
      loading="lazy"
    />
  );
}
