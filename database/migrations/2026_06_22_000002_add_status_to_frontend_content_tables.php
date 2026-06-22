<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'status')) {
                $table->unsignedTinyInteger('status')->default(1)->after('project_url');
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'status')) {
                $table->unsignedTinyInteger('status')->default(1)->after('image');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'status')) {
                $table->unsignedTinyInteger('status')->default(1)->after('is_active');
            }
        });

        if (Schema::hasColumn('testimonials', 'is_active') && Schema::hasColumn('testimonials', 'status')) {
            DB::table('testimonials')->update([
                'status' => DB::raw('CASE WHEN is_active = 1 THEN 1 ELSE 0 END'),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
