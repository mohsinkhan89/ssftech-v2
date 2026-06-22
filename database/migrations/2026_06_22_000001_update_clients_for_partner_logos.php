<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }

            $table->string('icon')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'image')) {
                $table->dropColumn('image');
            }

            $table->string('icon')->nullable(false)->change();
        });
    }
};
