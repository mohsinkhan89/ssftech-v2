<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('contact_address')->nullable()->after('js_version');
            $table->string('contact_phone', 50)->nullable()->after('contact_address');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });

        $settings = DB::table('site_settings')->first();
        $contactData = [
            'contact_address' => '71-75 Shelton Street, London, England, WC2H 9JQ',
            'contact_phone' => '07773 941324',
            'contact_email' => 'info@ssftech.co.uk',
            'updated_at' => now(),
        ];

        if ($settings) {
            DB::table('site_settings')->where('id', $settings->id)->update($contactData);
        } else {
            DB::table('site_settings')->insert(array_merge($contactData, [
                'css_version' => '1.0.0',
                'js_version' => '1.0.0',
                'created_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['contact_address', 'contact_phone', 'contact_email']);
        });
    }
};
