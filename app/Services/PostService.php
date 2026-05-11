<?php

namespace App\Services;

use Illuminate\Support\Str;

class PostService
{
    /**
     * Generate a unique slug for a given title.
     *
     * @param string $title
     * @param string $model
     * @return string
     */
    public function generateSlug(string $title, string $model): string
    {
        $slug = Str::slug($title);
        $count = $model::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Calculate reading time in minutes.
     * (200 words = 1 min)
     *
     * @param string $content
     * @return int
     */
    public function calculateReadingTime(string $content): int
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200);

        return (int) max(1, $readingTime);
    }
}
