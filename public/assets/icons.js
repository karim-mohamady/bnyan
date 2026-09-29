function icon(name, w, h, extra) {
  w = w || 24; h = h || 24; extra = extra || '';
  return '<svg class="icon" width="' + w + '" height="' + h + '" aria-hidden="true"' + extra + '><use href="assets/icons/sprite.svg#icon-' + name + '"/></svg>';
}
