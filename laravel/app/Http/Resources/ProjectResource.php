<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $images = $this->images->pluck('url')->map(fn($url) => str_starts_with($url, 'http') ? $url : url('storage/' . ltrim($url, '/')))->values()->toArray();
        $videos = $this->videos->pluck('url')->map(fn($url) => str_starts_with($url, 'http') ? $url : url('storage/' . ltrim($url, '/')))->values()->toArray();

        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'desc' => (string) $this->desc,
            'longDesc' => (string) ($this->long_desc ?? $this->desc),
            'cat' => (string) $this->category,
            'done' => (bool) $this->is_done,
            'req' => (int) $this->req,
            'rem' => (int) $this->rem,
            'pct' => (int) $this->pct,
            'color' => (string) $this->color,
            'tag' => (string) $this->tag,
            'tagClass' => (string) $this->tag_class,
            'target' => $this->target,
            'isFeatured' => (bool) $this->is_featured,
            'images' => $images,
            'videos' => $videos,
        ];
    }
}
