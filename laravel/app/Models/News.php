<?php

namespace App\Models;

use App\Models\Concerns\NormalizesNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use NormalizesNumbers;
    use SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'tag',
        'tag_style',
        'icon',
        'day',
        'hijri_date_text',
        'context_label',
        'excerpt',
        'body',
        'cover_image',
        'gallery',
        'showcase_image',
        'showcase_caption',
        'press_links',
        'placement',
        'show_on_home',
        'show_on_news_page',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'press_links' => 'array',
        'show_on_home' => 'boolean',
        'show_on_news_page' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Splits body into paragraph strings array
     */
    public function getBodyParagraphsAttribute(): array
    {
        if (empty($this->body)) {
            return [];
        }

        // Split by double newline or single newline
        $parts = preg_split('/(\r\n|\n|\r){2,}/', trim($this->body));
        return array_values(array_filter(array_map('trim', $parts)));
    }
}
