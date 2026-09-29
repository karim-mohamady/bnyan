function mosqueIllustration(color) {
  const valid = ['moss', 'sand', 'sage', 'earth'];
  const c = valid.includes(color) ? color : 'moss';
  return '<img src="assets/icons/mosque-' + c + '.svg" alt="" width="100%" height="180" style="display:block;object-fit:cover" loading="lazy">';
}
