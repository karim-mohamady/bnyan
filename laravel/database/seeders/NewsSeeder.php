<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $homePath = database_path('seeders/truth/news_home.json');
        if (file_exists($homePath)) {
            $homeItems = json_decode(file_get_contents($homePath), true);
            if (is_array($homeItems)) {
                foreach ($homeItems as $idx => $item) {
                    News::updateOrCreate(
                        ['title' => $item['title']],
                        [
                            'tag' => $item['tag'] ?? '',
                            'tag_style' => 'primary',
                            'icon' => $item['icon'] ?? 'home',
                            'day' => $item['day'] ?? '',
                            'hijri_date_text' => $item['my'] ?? '',
                            'context_label' => null,
                            'excerpt' => $item['excerpt'] ?? '',
                            'body' => $item['excerpt'] ?? '',
                            'cover_image' => null,
                            'gallery' => [],
                            'showcase_image' => null,
                            'showcase_caption' => null,
                            'press_links' => [],
                            'placement' => 'report',
                            'show_on_home' => true,
                            'show_on_news_page' => false,
                            'is_published' => true,
                            'sort_order' => $idx,
                        ]
                    );
                }
            }
        }

        $articlesPath = database_path('seeders/truth/news_articles.json');
        if (file_exists($articlesPath)) {
            $articles = json_decode(file_get_contents($articlesPath), true);
            if (is_array($articles)) {
                foreach ($articles as $art) {
                    News::updateOrCreate(
                        ['title' => $art['title']],
                        [
                            'tag' => $art['tag'],
                            'tag_style' => $art['tag_style'],
                            'icon' => $art['icon'],
                            'day' => $art['day'],
                            'hijri_date_text' => $art['hijri_date_text'],
                            'context_label' => $art['context_label'],
                            'excerpt' => $art['excerpt'],
                            'body' => $art['body'],
                            'cover_image' => $art['cover_image'],
                            'gallery' => $art['gallery'] ?? [],
                            'showcase_image' => $art['showcase_image'] ?? null,
                            'showcase_caption' => $art['showcase_caption'] ?? null,
                            'press_links' => $art['press_links'] ?? [],
                            'placement' => $art['placement'],
                            'show_on_home' => $art['show_on_home'],
                            'show_on_news_page' => $art['show_on_news_page'],
                            'is_published' => true,
                            'sort_order' => $art['sort_order'],
                        ]
                    );
                }
            }
        }
    }
}
