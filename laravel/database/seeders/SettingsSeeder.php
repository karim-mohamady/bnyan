<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContent;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/truth/contact.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        $contact = $data['CONTACT'] ?? [];
        $socials = $data['SOCIAL_PLATFORMS'] ?? [];

        $settings = [
            'associationName' => 'جمعية بنيان للعناية بالمساجد بالخبراء',
            'phone' => $contact['phone'] ?? '0536502143',
            'phoneDisplay' => $contact['phoneDisplay'] ?? '+966 53 650 2143',
            'phoneTel' => $contact['phoneTel'] ?? '+966536502143',
            'email' => $contact['email'] ?? 'bunyan355@gmail.com',
            'addressShort' => $contact['addressShort'] ?? 'القصيم · الخبراء · طريق الملك فهد',
            'addressFull' => $contact['addressFull'] ?? 'حي المرقب، الخبراء، منطقة القصيم، المملكة العربية السعودية',
            'addressLine' => $contact['addressLine'] ?? 'القصيم - الخبراء - طريق الملك فهد',
            'workingHours' => $contact['workingHours'] ?? 'من الأحد إلى الخميس: 8 ص - 4 م',
            'licenseNo' => $contact['licenseNo'] ?? '1000806000',
            'unifiedNo' => $contact['unifiedNo'] ?? '7051934854',
            'mapsUrl' => $contact['mapsUrl'] ?? 'https://maps.app.goo.gl/tB3aC7VvD9nF6WbA9',
            'whatsappUrl' => $contact['whatsappUrl'] ?? 'https://wa.me/966536502143',
            'bankName' => $contact['bank']['name'] ?? 'مصرف الراجحي',
            'bankNameEn' => $contact['bank']['nameEn'] ?? 'Al Rajhi Bank',
            'accountName' => $contact['bank']['accountName'] ?? 'جمعية بنيان للعناية بالمساجد بالخبراء',
            'iban' => $contact['bank']['iban'] ?? 'SA8680000265608010979797',
            'ibanDisplay' => $contact['bank']['ibanDisplay'] ?? 'SA86 8000 0265 6080 1097 9797',
            'instagramHandle' => $contact['instagram']['handle'] ?? '@Bunyan355',
            'instagramUrl' => $contact['instagram']['url'] ?? 'https://instagram.com/Bunyan355',
            'xHandle' => $contact['x']['handle'] ?? '@Bunyan355Bunyan',
            'xUrl' => $contact['x']['url'] ?? 'https://x.com/Bunyan355Bunyan',
            'youtubeHandle' => $contact['youtube']['handle'] ?? 'جمعية بنيان',
            'youtubeUrl' => $contact['youtube']['url'] ?? 'https://www.youtube.com/@Bunyan355',
            'socialPlatforms' => $socials,
        ];

        foreach ($settings as $key => $val) {
            SiteContent::setField('settings', $key, $val);
        }
    }
}
