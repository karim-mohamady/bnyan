<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\ProjectCategory;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['key' => 'all', 'name' => 'الكل', 'sort_order' => 1],
            ['key' => 'maintenance', 'name' => 'صيانة المساجد', 'sort_order' => 2],
            ['key' => 'renovation', 'name' => 'الترميم والتأهيل', 'sort_order' => 3],
            ['key' => 'cleaning', 'name' => 'نظافة المساجد', 'sort_order' => 4],
            ['key' => 'lighting', 'name' => 'تعطير المساجد', 'sort_order' => 5],
            ['key' => 'water', 'name' => 'سُقيا الماء', 'sort_order' => 6],
            ['key' => 'building', 'name' => 'بناء المساجد', 'sort_order' => 7],
        ];

        foreach ($categories as $cat) {
            ProjectCategory::updateOrCreate(['key' => $cat['key']], $cat);
        }

        $jsonPath = database_path('seeders/truth/projects.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $projects = json_decode(file_get_contents($jsonPath), true);
        if (!is_array($projects)) {
            return;
        }

        foreach ($projects as $item) {
            $id = $item['id'];
            $req = $item['req'] ?? 0;
            $rem = $item['rem'] ?? 0;
            $collected = $req - $rem;
            $pct = $item['pct'] ?? 0;

            $isFeatured = in_array($id, [1, 2, 3], true);
            $featuredOrder = $isFeatured ? $id : 0;

            $project = Project::updateOrCreate(
                ['id' => $id],
                [
                    'name' => $item['name'] ?? '',
                    'desc' => $item['desc'] ?? '',
                    'long_desc' => $item['longDesc'] ?? '',
                    'category' => $item['cat'] ?? 'maintenance',
                    'tag' => $item['tag'] ?? '',
                    'tag_class' => $item['tagClass'] ?? 'green',
                    'color' => $item['color'] ?? 'moss',
                    'target' => $item['target'] ?? '',
                    'required_amount' => $req,
                    'collected_amount' => $collected,
                    'progress_percent' => $pct,
                    'is_done' => !empty($item['done']),
                    'is_published' => true,
                    'is_featured' => $isFeatured,
                    'featured_order' => $featuredOrder,
                    'sort_order' => $id,
                ]
            );

            ProjectMedia::where('project_id', $project->id)->delete();

            if (!empty($item['images']) && is_array($item['images'])) {
                foreach ($item['images'] as $imgIdx => $imgUrl) {
                    ProjectMedia::create([
                        'project_id' => $project->id,
                        'type' => 'image',
                        'url' => $imgUrl,
                        'sort_order' => $imgIdx + 1,
                    ]);
                }
            }

            if (!empty($item['videos']) && is_array($item['videos'])) {
                foreach ($item['videos'] as $vidIdx => $vidUrl) {
                    ProjectMedia::create([
                        'project_id' => $project->id,
                        'type' => 'video',
                        'url' => $vidUrl,
                        'sort_order' => $vidIdx + 1,
                    ]);
                }
            }
        }
    }
}
