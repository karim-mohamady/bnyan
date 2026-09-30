# جمعية بنيان للعناية بالمساجد بالخبراء 🕌

موقع إلكتروني رسمي متكامل مبني باستخدام **Next.js 16 (App Router)** و **React 19** و **TypeScript** ومصمم بأحدث معايير الويب لدعم جمعية بنيان للعناية بالمساجد بمحافظة الخبراء.

---

## 📑 فهرس المحتويات
1. [نظرة عامة على المشروع](#-نظرة-عامة-على-المشروع)
2. [دليل مسارات الواجهة البرمجية (API Endpoints)](#-دليل-مسارات-الواجهة-البرمجية-api-endpoints)
3. [أين توجد البيانات وكيف تعدلها؟](#-أين-توجد-البيانات-وكيف-تعدلها)
4. [كيفية إنشاء مسار API جديد خطوة بخطوة](#-كيفية-إنشاء-مسار-api-جديد-خطوة-بخطوة)
5. [تشغيل المشروع والتطوير](#-تشغيل-المشروع-والتطوير)

---

## 🌟 نظرة عامة على المشروع
المشروع أصبح ذاتي التشغيل بالكامل بدون الحاجة لخادم PHP أو Laravel خارجي؛ حيث تم تضمين جميع واجهات الـ API ونقاط النهاية (Endpoints) داخل Next.js مباشرة في مجلد `src/app/api/v1/`.

---

## 📡 دليل مسارات الواجهة البرمجية (API Endpoints)

جميع واجهات الـ API تبدأ بالمسار `/api/v1/` وتعمل بصيغة JSON:

| المسار (Endpoint) | الطريقة (Method) | الوظيفة والهدف | مصدر البيانات في الكود |
| :--- | :--- | :--- | :--- |
| `/api/v1/projects` | `GET` | إرجاع قائمة كافة مشاريع الجمعية (صيانة، ترميم، سقيا، نظافة...) | `src/data/projects.ts` |
| `/api/v1/projects/[id]` | `GET` | إرجاع تفاصيل مشروع معين عبر معرّفه الرقمي (مثال: `/api/v1/projects/1`) | `src/data/projects.ts` |
| `/api/v1/news` | `GET` | إرجاع قائمة كافة الأخبار والفعاليات والبيانات الصحفية للجمعية | `src/data/news.ts` |
| `/api/v1/news/[id]` | `GET` | إرجاع خبر محدد برقم المعرف (مثال: `/api/v1/news/1`) | `src/data/news.ts` |
| `/api/v1/board-members` | `GET` | إرجاع أعضاء مجلس الإدارة ومناصبهم المعتمدة | `src/data/board.ts` |
| `/api/v1/governance` | `GET` | إرجاع ملفات الحوكمة، القوائم المالية، المحاضر، التقارير والسياسات | `src/data/governance.ts` |
| `/api/v1/settings` | `GET` | إرجاع معلومات الجمعية العامة، أرقام التواصل، الآيبان وحسابات التواصل الاجتماعي | `src/data/contact.ts` |
| `/api/v1/contact` | `POST` | استقبال رسائل ونماذج التواصل من الزوار والتحقق من صحتها | مسار التحقق `src/app/api/v1/contact/route.ts` |

---

### تفاصيل كل مسار وأمثلة الاستخدام:

#### 1. قائمة المشاريع: `GET /api/v1/projects`
- **الهدف**: عرض المشاريع في صفحة المشاريع والصفحة الرئيسية وبوابة التبرع.
- **مثال الاستجابة**:
```json
{
  "data": [
    {
      "id": 1,
      "name": "مشروع صيانة المساجد الشاملة",
      "cat": "maintenance",
      "pct": 74,
      "req": 150000,
      "rem": 39000,
      "tag": "صيانة دورية",
      "images": ["https://..."]
    }
  ]
}
```

#### 2. تفاصيل مشروع محدد: `GET /api/v1/projects/:id`
- **الهدف**: جلب بيانات مشروع واحد (الصور، الفيديوهات، نسبة الإنجاز، الميزانية).
- **مثال الاستدعاء**: `/api/v1/projects/2`

#### 3. قائمة الأخبار: `GET /api/v1/news`
- **الهدف**: تزويد صفحة الأخبار بأحدث المستجدات والبيانات الصحفية وألبومات الصور.

#### 4. أعضاء مجلس الإدارة: `GET /api/v1/board-members`
- **الهدف**: عرض رئيس وأعضاء مجلس الإدارة ومسمياتهم الرسمية.

#### 5. الحوكمة واللوائح: `GET /api/v1/governance`
- **الهدف**: إرجاع مصفوفات منظمة تشمل: التقارير السنوية (`annualReports`)، القوائم المالية (`financialStatements`)، محاضر الجمعية العمومية (`assemblyMinutes`)، والسياسات المعتمدة (`policies`).

#### 6. الإعدادات والتواصل: `GET /api/v1/settings`
- **الهدف**: يرجع الهاتف، الواتساب، البريد، العنوان، رقم الآيبان والبنك، وروابط شبكات التواصل.

#### 7. إرسال رسالة تواصل: `POST /api/v1/contact`
- **الهدف**: إرسال نموذج "اتصل بنا" مع التحقق من صحة المدخلات وحماية ضد السبام (Honeypot).
- **بيانات الطلب المطلوبة (JSON)**:
```json
{
  "name": "عبدالله محمد",
  "email": "user@example.com",
  "phone": "0501234567",
  "subject": "استفسار بخصوص مشروع",
  "message": "السلام عليكم، أود الاستفسار عن..."
}
```

---

## 🛠 أين توجد البيانات وكيف تعدلها؟

جميع البيانات مكتوبة بلغة TypeScript منظمة وسهلة التعديل داخل مجلد `src/data/`:

1. **المشاريع**: عدّل ملف `src/data/projects.ts` لإضافة مشروع جديد أو تغيير نسب الإنجاز والمبالغ والصور.
2. **الأخبار**: عدّل ملف `src/data/news.ts` لإضافة مقال أو صور جديدة.
3. **مجلس الإدارة**: عدّل ملف `src/data/board.ts` لتغيير أسماء الأعضاء ومناصبهم.
4. **أرقام التواصل والبنك**: عدّل ملف `src/data/contact.ts` لتغيير رقم الجوال، الآيبان، البريد، أو الحسابات.
5. **لوائح الحوكمة**: عدّل ملف `src/data/governance.ts` لإضافة تقارير أو محاضر اجتماعات جديدة.

---

## 💡 كيفية إنشاء مسار API جديد خطوة بخطوة

إذا أردت إنشاء نقطة نهاية جديدة (مثلاً: `/api/v1/testimonials` لآراء المستفيدين أو الداعمين):

### الخطوة 1: تجهيز ملف البيانات (اختياري لكن مفضل للترتيب)
أنشئ ملفاً باسم `src/data/testimonials.ts`:
```typescript
export interface Testimonial {
  id: number;
  name: string;
  comment: string;
  role: string;
}

export const testimonials: Testimonial[] = [
  {
    id: 1,
    name: "سعد بن إبراهيم",
    role: "إمام جامع",
    comment: "جهود مباركة في صيانة وتكييف بيوت الله في الخبراء."
  }
];
```

### الخطوة 2: إنشاء مسار الـ API داخل Next.js
أنشئ مجلداً جديداً داخل المسار:
`src/app/api/v1/testimonials/` وبداخله ملف باسم `route.ts`.

### الخطوة 3: كتابة دالة التعامل مع الطلب (GET أو POST)
ضع الكود التالي داخل `src/app/api/v1/testimonials/route.ts`:
```typescript
import { NextResponse } from 'next/server';
import { testimonials } from '@/data/testimonials';

// دالة لجلب البيانات GET
export async function GET() {
  return NextResponse.json(
    { data: testimonials },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}

// دالة لإضافة تعليق جديد POST (اختياري)
export async function POST(request: Request) {
  const body = await request.json();
  
  // تحقق من البيانات وحفظها أو معالجتها هنا
  return NextResponse.json(
    { message: "تمت إضافة التقييم بنجاح!", item: body },
    { status: 201 }
  );
}
```

### الخطوة 4: تجربة المسار الجديد
الآن يمكنك فتح المتصفح أو أي أداة تجربة (مثل Postman أو curl) على الرابط:
`http://localhost:3000/api/v1/testimonials` وستحصل فوراً على البيانات بصيغة JSON.

---

## 🚀 تشغيل المشروع والتطوير

### تثبيت الحزم:
```bash
npm install
```

### تشغيل خادم التطوير (Local Dev Server):
```bash
npm run dev
```
افتح المتصفح على [http://localhost:3000](http://localhost:3000).

### بناء نسخة الإنتاج (Production Build):
```bash
npm run build
npm start
```

---

## 🔒 الأمان وتحديث الكاش (On-Demand Revalidation)
المشروع مزود بمسار `/api/revalidate` لإعادة بناء الكاش عند الطلب عبر إرسال الرمز السري `REVALIDATE_SECRET` المحدد في ملف البيئة `.env.example`.

---

## 🏛️ معمارية الربط الكامل مع خادم Laravel (Full-Stack Deployment Guide)

عند تشغيل أو نشر خادم Laravel خارجي مخصص مع قاعدة بيانات MySQL:

### 1. تجهيز بيئة Laravel:
```bash
# تثبيت الاعتماديات
composer install --no-dev --optimize-autoloader

# إعداد ملف البيئة
cp .env.example .env
php artisan key:generate

# تشغيل قواعد البيانات وتعبئة البيانات الأولية
php artisan migrate --seed

# ربط وسائط التخزين
php artisan storage:link
```

### 2. ربط الواجهة الأمامية Next.js بـ Laravel:
في بيئة استضافة Next.js، أضف المتغيرات التالية:
```env
NEXT_PUBLIC_API_URL=https://<your-laravel-domain>/api/v1
REVALIDATE_SECRET=your_production_revalidate_secret_here
```

### 3. تدفق البيانات والتشغيل الاحتياطي (Fallback Mode):
- في حال كان خادم Laravel يعمل: تقوم دالة `src/lib/api.ts` بجلب البيانات الحية والتحديثات من خادم Laravel مباشرة وتخزينها بكاش ذكي (Revalidation).
- عند حدوث أي تعديل في لوحة التحكم الإدارية، يقوم خادم Laravel بإرسال طلب `POST /api/revalidate` لتحديث كاش Next.js فوراً.
- في حال انقطاع الاتصال أو عدم إدخال رابط خارجي: يستمر موقع Next.js بالعمل بنسبة 100% وبدون أي توقف أو أخطاء معتمداً على واجهات Next.js المدمجة (`/api/v1/*`) والبيانات المعتمدة.

