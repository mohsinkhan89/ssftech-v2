<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $paths = [
            'frontend/assets/images/blog/marketing-growth.png' => 'frontend/assets/images/blog/marketing-growth.webp',
            'frontend/assets/images/blog/web-design-insights.png' => 'frontend/assets/images/blog/web-design-insights.webp',
            'frontend/assets/images/blog/brand-identity.png' => 'frontend/assets/images/blog/brand-identity.webp',
        ];

        foreach ($paths as $oldPath => $newPath) {
            DB::table('blogs')->where('image', $oldPath)->update(['image' => $newPath]);
        }

        DB::table('blogs')
            ->where('content_banner', 'frontend/assets/images/blog/article-content-marketing.png')
            ->update(['content_banner' => 'frontend/assets/images/blog/article-content-marketing.webp']);
    }

    public function down(): void
    {
        // The original PNG files remain available, but optimized paths are intentionally retained.
    }
};
