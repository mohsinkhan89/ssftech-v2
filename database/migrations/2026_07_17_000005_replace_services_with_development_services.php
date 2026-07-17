<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('services')->whereIn('title', [
            'Digital Marketing',
            'Graphic Designing',
            'IT Support',
        ])->delete();

        $now = now();
        $services = [
            ['title' => 'E-Commerce Development', 'description' => 'Secure, conversion-focused online stores with smooth checkout experiences, product management and scalable integrations.', 'icon' => 'fa-solid fa-cart-shopping', 'sort_order' => 2],
            ['title' => 'Web Application Development', 'description' => 'Custom web applications built around your workflows with responsive interfaces, reliable architecture and room to scale.', 'icon' => 'fa-solid fa-window-restore', 'sort_order' => 3],
            ['title' => 'API Development & Integration', 'description' => 'Reliable APIs and third-party integrations that connect your website, applications, payments and business systems.', 'icon' => 'fa-solid fa-code-branch', 'sort_order' => 4],
            ['title' => 'Website Maintenance & Support', 'description' => 'Ongoing development support, security updates, performance improvements and technical maintenance for your website.', 'icon' => 'fa-solid fa-screwdriver-wrench', 'sort_order' => 5],
        ];

        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['title' => $service['title']],
                $service + ['link' => '#contact', 'status' => true, 'created_at' => $now, 'updated_at' => $now]
            );
        }
    }

    public function down(): void
    {
        DB::table('services')->whereIn('title', [
            'E-Commerce Development',
            'Web Application Development',
            'API Development & Integration',
            'Website Maintenance & Support',
        ])->delete();
    }
};
