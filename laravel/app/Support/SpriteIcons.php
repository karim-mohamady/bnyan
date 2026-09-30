<?php

namespace App\Support;

class SpriteIcons
{
    protected static ?array $cachedIcons = null;

    /**
     * Parse public/admin/sprite.svg (or public/assets/icons/sprite.svg)
     * Extract <symbol id="icon-*" and return bare names without "icon-" prefix.
     */
    public static function all(): array
    {
        if (self::$cachedIcons !== null) {
            return self::$cachedIcons;
        }

        $paths = [
            public_path('admin/sprite.svg'),
            base_path('../public/assets/icons/sprite.svg'),
            public_path('assets/icons/sprite.svg'),
        ];

        $filePath = null;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $filePath = $path;
                break;
            }
        }

        if (!$filePath) {
            return [];
        }

        $svgContent = file_get_contents($filePath);
        preg_match_all('/id="icon-([^"]+)"/', $svgContent, $matches);

        self::$cachedIcons = !empty($matches[1]) ? array_values(array_unique($matches[1])) : [];
        sort(self::$cachedIcons);

        return self::$cachedIcons;
    }

    /**
     * Clear the cached icon list.
     */
    public static function clearCache(): void
    {
        self::$cachedIcons = null;
    }
}
