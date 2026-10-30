<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Web Development already covers both websites and custom web applications.
        DB::table('services')
            ->where('title', 'Web Application Development')
            ->delete();

        // Remove any exact duplicate titles while preserving the oldest record.
        DB::table('services')
            ->orderBy('id')
            ->get(['id', 'title'])
            ->groupBy(fn ($service) => mb_strtolower(trim($service->title)))
            ->each(function ($duplicates): void {
                $duplicateIds = $duplicates->pluck('id')->slice(1);

                if ($duplicateIds->isNotEmpty()) {
                    DB::table('services')->whereIn('id', $duplicateIds)->delete();
                }
            });
    }

    public function down(): void
    {
        // Removed duplicates cannot be restored reliably.
    }
};
