<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function show(): JsonResponse
    {
        $settings = Cache::remember('api_settings', 60, function () {
            $raw = SiteContent::getPageContent('settings');

            return [
                // Identical to existing CONTACT object
                'phone' => $raw['phone'] ?? '0536502143',
                'phoneDisplay' => $raw['phoneDisplay'] ?? '+966 53 650 2143',
                'phoneTel' => $raw['phoneTel'] ?? '+966536502143',
                'email' => $raw['email'] ?? 'bunyan355@gmail.com',
                'addressShort' => $raw['addressShort'] ?? 'القصيم · الخبراء · طريق الملك فهد',
                'addressFull' => $raw['addressFull'] ?? 'حي المرقب، الخبراء، منطقة القصيم، المملكة العربية السعودية',
                'addressLine' => $raw['addressLine'] ?? 'القصيم - الخبراء - طريق الملك فهد',
                'workingHours' => $raw['workingHours'] ?? 'من الأحد إلى الخميس: 8 ص - 4 م',
                'licenseNo' => $raw['licenseNo'] ?? '1000806000',
                'unifiedNo' => $raw['unifiedNo'] ?? '7051934854',
                'mapsUrl' => $raw['mapsUrl'] ?? 'https://maps.app.goo.gl/tB3aC7VvD9nF6WbA9',
                'whatsappUrl' => $raw['whatsappUrl'] ?? 'https://wa.me/966536502143',
                'bank' => [
                    'name' => $raw['bankName'] ?? 'مصرف الراجحي',
                    'nameEn' => $raw['bankNameEn'] ?? 'Al Rajhi Bank',
                    'accountName' => $raw['accountName'] ?? 'جمعية بنيان للعناية بالمساجد بالخبراء',
                    'iban' => $raw['iban'] ?? 'SA8680000265608010979797',
                    'ibanDisplay' => $raw['ibanDisplay'] ?? 'SA86 8000 0265 6080 1097 9797',
                ],
                'instagram' => [
                    'handle' => $raw['instagramHandle'] ?? '@Bunyan355',
                    'url' => $raw['instagramUrl'] ?? 'https://instagram.com/Bunyan355',
                ],
                'x' => [
                    'handle' => $raw['xHandle'] ?? '@Bunyan355Bunyan',
                    'url' => $raw['xUrl'] ?? 'https://x.com/Bunyan355Bunyan',
                ],
                'youtube' => [
                    'handle' => $raw['youtubeHandle'] ?? 'جمعية بنيان',
                    'url' => $raw['youtubeUrl'] ?? 'https://www.youtube.com/@Bunyan355',
                ],

                // Additional settings
                'logo' => $raw['logo'] ?? 'https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png',
                'siteTitle' => $raw['siteTitle'] ?? 'جمعية بنيان للعناية بالمساجد بالخبراء',
                'siteDescription' => $raw['siteDescription'] ?? 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.',
                'associationName' => $raw['associationName'] ?? 'جمعية بنيان للعناية بالمساجد بالخبراء',
                'associationSub' => $raw['associationSub'] ?? 'بالخبراء — منطقة القصيم',
                'footerDescription' => $raw['footerDescription'] ?? 'جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.',
                'volunteerPlatformUrl' => $raw['volunteerPlatformUrl'] ?? 'https://nvg.gov.sa',
                'mapEmbedUrl' => $raw['mapEmbedUrl'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115437.4589255768!2d43.486665799999995!3d26.0717281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x157ff9841804b46b%3A0x6b8bc00e12d4d989!2z2KfZhNiu2KjYsdin2KEg2KfZhNmC2LXZitmF!5e0!3m2!1sar!2ssa!4v1700000000000!5m2!1sar!2ssa',
                'copyrightText' => $raw['copyrightText'] ?? 'جميع الحقوق محفوظة لجمعية بنيان للعناية بالمساجد بالخبراء © 2026',
                'social' => [
                    [
                        'name' => 'إكس (تويتر)',
                        'platform' => 'x',
                        'handle' => $raw['xHandle'] ?? '@Bunyan355Bunyan',
                        'url' => $raw['xUrl'] ?? 'https://x.com/Bunyan355Bunyan',
                        'icon' => 'brand-x',
                    ],
                    [
                        'name' => 'انستغرام',
                        'platform' => 'instagram',
                        'handle' => $raw['instagramHandle'] ?? '@Bunyan355',
                        'url' => $raw['instagramUrl'] ?? 'https://instagram.com/Bunyan355',
                        'icon' => 'instagram',
                    ],
                    [
                        'name' => 'يوتيوب',
                        'platform' => 'youtube',
                        'handle' => $raw['youtubeHandle'] ?? 'جمعية بنيان',
                        'url' => $raw['youtubeUrl'] ?? 'https://www.youtube.com/@Bunyan355',
                        'icon' => 'youtube',
                    ],
                ],
            ];
        });

        return response()->json($settings)
            ->header('Cache-Control', 'public, max-age=60');
    }
}
