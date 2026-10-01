# جمعية بنيان للعناية بالمساجد بالخبراء

مشروع من جزأين:

| المجلد | الوظيفة |
| :--- | :--- |
| `/` (جذر المشروع) | الموقع العام — Next.js 16 + React 19 |
| `laravel/` | **لوحة التحكم** + واجهة الـ API — Laravel 11 |
| `tools/` | أدوات التحقق من تطابق نصوص قاعدة البيانات مع نصوص الموقع |
| `docs/API-STANDALONE.md` | شرح مسارات `/api/v1/*` المدمجة داخل Next (وضع التشغيل المستقل) |

## كيف يعمل الربط

```
لوحة التحكم (Laravel)  ──حفظ──▶  قاعدة البيانات
        │                              │
        │ ping /api/revalidate         │ /api/v1/*
        ▼                              ▼
   موقع Next.js  ◀── يقرأ المحتوى ──────┘   (وإن تعذّر الاتصال يعرض البيانات الثابتة من src/data)
```

- عند حفظ أي تعديل في اللوحة، تُرسل Laravel طلباً إلى `/api/revalidate` فيتحدّث الموقع فوراً.
- إن لم يُضبط `LARAVEL_API_URL` يعمل الموقع بالبيانات الثابتة فقط (وضع مستقل).
- **المربوط بالموقع بالكامل:**
  - المشاريع وتفاصيل المشروع (`/projects`, `/projects/[id]`)
  - المركز الإعلامي وتفاصيل الأخبار (`/news`, `/news/[id]`) وأخبار الصفحة الرئيسية
  - الحوكمة والشفافية وصفحاتها الفرعية الست (`/governance`, `/governance/*`)
  - أعضاء مجلس الإدارة والجمعية العمومية (`/board`, `/governance/board-members`, `/governance/assembly-members`)
  - القوائم المالية والتقارير السنوية واللوائح ومحاضر الاجتماعات مع روابط التحميل المعتمدة
  - نموذج الاتصال والتحقق باللغة العربية (`/contact` مع دعم الأرقام العربية والمشرقية)
  - إعدادات الموقع وروابط التواصل الموحدة (`/settings`, `CONTACT`)
- **وضع التشغيل المزدوج (Dual-Mode Architecture):**
  - **وضع الإنتاج المتكامل (CMS-Driven):** عند ضبط `LARAVEL_API_URL` تقرأ جميع الصفحات من قاعدة بيانات Laravel وتتحدث تلقائياً وفورياً عند الحفظ عبر مسار `/api/revalidate`.
  - **الوضع المستقل (Standalone Fallback):** عند غياب أو تعذر الاتصال بـ Laravel، يواصل موقع Next.js عمله دون انقطاع عبر واجهات `/api/v1/*` وبيانات الطوارئ المعتمدة في `src/data/`.

## تشغيل لوحة التحكم (Laravel)

المتطلبات: PHP 8.2+ (mbstring, openssl, fileinfo, xml, ctype, json, pdo_sqlite أو pdo_mysql) و Composer.

```bash
cd laravel
./setup.sh            # على ويندوز: setup.bat
php artisan serve     # http://127.0.0.1:8000
```

السكريبت يثبّت الحزم، وينشئ `.env` والمفتاح وقاعدة SQLite، ويشغّل الـ migrations والـ seeders.
بعدها شغّل `php artisan admin:show-url` لعرض **رابط اللوحة السري**.

### إعدادات `laravel/.env` المهمة
| المتغير | الوصف |
| :--- | :--- |
| `ADMIN_PATH` | مسار اللوحة السري — غيّره إلى قيمة طويلة عشوائية |
| `ADMIN_PASSWORD` / `ADMIN_USER` | **فعّلهما في الإنتاج**: يطلب المتصفح اسم مستخدم وكلمة مرور قبل فتح اللوحة |
| `ADMIN_ALLOWED_IPS` | (اختياري) قائمة عناوين IP مسموحة مفصولة بفاصلة |
| `FRONTEND_URL` | عنوان الموقع العام |
| `NEXT_REVALIDATE_URL` | `https://موقعك/api/revalidate` |
| `REVALIDATE_SECRET` | سر مشترك — **نفس القيمة** في Next |
| `CONTACT_NOTIFY_EMAIL` | بريد استلام إشعارات رسائل التواصل |
| `APP_ENV=production`, `APP_DEBUG=false` | في الإنتاج |

بدون `ADMIN_PASSWORD` تكون الحماية رابطاً سرياً فقط — أي شخص يعرف الرابط يستطيع التعديل.

## تشغيل الموقع (Next.js)

```bash
cp .env.example .env.local     # ثم عدّل القيم
npm install                    # أو bun install
npm run dev                    # http://localhost:3000
npm run build && npm start     # للإنتاج
```

| المتغير | الوصف |
| :--- | :--- |
| `LARAVEL_API_URL` | مثال `http://127.0.0.1:8000/api/v1` — اتركه فارغاً للوضع المستقل |
| `REVALIDATE_SECRET` | نفس قيمة Laravel. **إن لم يُضبط يرفض `/api/revalidate` كل الطلبات** |
| `NEXT_PUBLIC_SITE_URL` | عنوان الموقع (sitemap / SEO) |

## أدوات التحقق

```bash
# من جذر المشروع
node --experimental-strip-types tools/extract-truth.mjs src/data laravel/database/seeders/truth
node tools/verify-strings.mjs src laravel/config/content_schema.php laravel/database/seeders
# داخل laravel/
php artisan content:verify
php artisan test
```

## ملاحظات
- رسائل التواصل تُحفظ في صندوق الوارد داخل اللوحة **فقط عند ضبط `LARAVEL_API_URL`**؛ بدونه يُتحقق منها ولا تُخزَّن.
- النسخ الاحتياطي: `php artisan backup:db`.
