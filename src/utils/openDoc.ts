/** Opens an uploaded document (from the dashboard) or tells the visitor it is not available yet. */
export function openDoc(url: string | null | undefined, fallbackMessage: string): void {
  if (url) {
    window.open(url, '_blank', 'noopener,noreferrer');
  } else {
    alert(fallbackMessage);
  }
}
