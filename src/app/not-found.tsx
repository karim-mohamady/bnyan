import Link from 'next/link';

export default function NotFound() {
  return (
    <div style={{
      minHeight: '70vh',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      flexDirection: 'column',
      textAlign: 'center',
      padding: '40px 20px',
      direction: 'rtl'
    }}>
      <div style={{
        width: '80px',
        height: '80px',
        borderRadius: '50%',
        background: 'rgba(201, 162, 39, 0.12)',
        color: '#c9a227',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        fontSize: '36px',
        marginBottom: '24px'
      }}>
        <i className="fa-solid fa-triangle-exclamation"></i>
      </div>
      <h1 style={{ fontSize: '32px', fontWeight: 800, color: '#12291a', marginBottom: '12px' }}>
        الصفحة غير موجودة (٤٠٤)
      </h1>
      <p style={{ fontSize: '15px', color: '#666', maxWidth: '440px', lineHeight: 1.8, marginBottom: '28px' }}>
        عذراً، الصفحة التي تبحث عنها قد تم نقلها أو لم تعد متوفرة. يمكنك العودة إلى الصفحة الرئيسية أو تصفح مشاريع الجمعية.
      </p>
      <div style={{ display: 'flex', gap: '12px', flexWrap: 'wrap', justifyContent: 'center' }}>
        <Link href="/" className="btn btn-primary" style={{ padding: '10px 24px', borderRadius: '10px' }}>
          الرئيسية
        </Link>
        <Link href="/projects" className="btn btn-secondary" style={{ padding: '10px 24px', borderRadius: '10px' }}>
          استعراض المشاريع
        </Link>
      </div>
    </div>
  );
}
