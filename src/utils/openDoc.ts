/** Opens an uploaded document (from the dashboard) if a URL is provided. */
export function openDoc(url: string | null | undefined): void {
  if (url && typeof window !== 'undefined') {
    window.open(url, '_blank', 'noopener,noreferrer');
  }
}
