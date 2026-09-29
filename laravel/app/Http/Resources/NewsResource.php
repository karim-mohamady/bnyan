<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $gallery = array_map(function ($item) {
            $src = is_array($item) ? ($item['src'] ?? '') : (string) $item;
            return str_starts_with($src, 'http') ? $src : url('storage/' . ltrim($src, '/'));
        }, $this->gallery ?? []);

        $cover = $this->cover_image ? (str_starts_with($this->cover_image, 'http') ? $this->cover_image : url('storage/' . ltrim($this->cover_image, '/'))) : null;
        $showcase = $this->showcase_image ? [
            'src' => str_starts_with($this->showcase_image, 'http') ? $this->showcase_image : url('storage/' . ltrim($this->showcase_image, '/')),
            'caption' => $this->showcase_caption,
        ] : null;

        return [
            'id' => (int) $this->id,
            'tag' => (string) ($this->tag ?? ''),
            'tagStyle' => (string) ($this->tag_style ?? 'primary'),
            'icon' => (string) ($this->icon ?? 'file'),
            'day' => (string) ($this->day ?? ''),
            'my' => (string) ($this->hijri_date_text ?? ''),
            'hijriDateText' => (string) ($this->hijri_date_text ?? ''),
            'contextLabel' => $this->context_label,
            'title' => (string) $this->title,
            'excerpt' => (string) ($this->excerpt ?? ''),
            'body' => $this->body_paragraphs,
            'cover' => $cover,
            'gallery' => $gallery,
            'showcase' => $showcase,
            'pressLinks' => array_map(function ($link) {
                return [
                    'label' => $link['label'] ?? '',
                    'url' => $link['url'] ?? '',
                    'widgetTitle' => $link['widget_title'] ?? $link['widgetTitle'] ?? '',
                    'widgetSubtitle' => $link['widget_subtitle'] ?? $link['widgetSubtitle'] ?? '',
                ];
            }, $this->press_links ?? []),
            'placement' => (string) ($this->placement ?? 'report'),
            'showOnHome' => (bool) $this->show_on_home,
            'showOnNewsPage' => (bool) $this->show_on_news_page,
        ];
    }
}
