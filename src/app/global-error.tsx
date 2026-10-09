'use client';
export const dynamic = 'force-dynamic';
export default function GlobalError({
  reset,
}: {
  error: Error & { digest?: string };
  reset: () => void;
}) {
  return (
    <html lang="ar" dir="rtl">
      <body>
        <div style={{ minHeight: '100vh', display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', fontFamily: 'sans-serif', textAlign: 'center', padding: '20px' }}>
          <h2 style={{ fontSize: '24px', fontWeight: 800, color: '#1a6b3c', marginBottom: '16px' }}>حدث خطأ غير متوقع</h2>
          <p style={{ color: '#555', marginBottom: '24px' }}>نعتذر عن هذا الخطأ، يرجى المحاولة مرة أخرى.</p>
          <button
            onClick={() => reset()}
            style={{ padding: '10px 24px', backgroundColor: '#1a6b3c', color: '#fff', border: 'none', borderRadius: '8px', cursor: 'pointer', fontWeight: 700 }}
          >
            إعادة المحاولة
          </button>
        </div>
      </body>
    </html>
  );
}
