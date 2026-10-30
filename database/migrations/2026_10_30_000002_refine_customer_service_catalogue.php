<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $developmentServices = [
            ['title' => 'UI/UX Design', 'description' => 'User-focused website and application interfaces designed for clarity, accessibility and smooth customer journeys.', 'icon' => 'fa-solid fa-pen-ruler', 'sort_order' => 2],
            ['title' => 'E-Commerce Development', 'description' => 'Secure, conversion-focused online stores with smooth checkout experiences, product management and scalable integrations.', 'icon' => 'fa-solid fa-cart-shopping', 'sort_order' => 3],
            ['title' => 'Mobile App Development', 'description' => 'Reliable mobile applications designed and developed around your customers, workflows and business goals.', 'icon' => 'fa-solid fa-mobile-screen-button', 'sort_order' => 4],
            ['title' => 'Custom Software Development', 'description' => 'Purpose-built software that simplifies business processes and grows with your organisation.', 'icon' => 'fa-solid fa-code', 'sort_order' => 5],
            ['title' => 'API Development & Integration', 'description' => 'Reliable APIs and third-party integrations that connect your website, applications, payments and business systems.', 'icon' => 'fa-solid fa-code-branch', 'sort_order' => 6],
            ['title' => 'Website Maintenance & Support', 'description' => 'Ongoing development support, security updates, performance improvements and technical maintenance for your website.', 'icon' => 'fa-solid fa-screwdriver-wrench', 'sort_order' => 7],
        ];

        DB::table('services')->where('title', 'Web Development')->update(['sort_order' => 1]);

        foreach ($developmentServices as $service) {
            DB::table('services')->updateOrInsert(
                ['title' => $service['title']],
                $service + [
                    'category' => 'development',
                    'link' => '#contact',
                    'status' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $clearerServiceNames = [
            'Customer Service & Support CRM' => 'Customer Support CRM Implementation',
            'Finance & Accounting Systems' => 'Finance & Accounting System Development',
            'Inventory & Warehouse Management' => 'Inventory & Warehouse System Development',
            'HR & Payroll Systems' => 'HR & Payroll System Development',
            'Procurement & Supply Chain' => 'Procurement & Supply Chain System Development',
            'Manufacturing & Production Planning' => 'Manufacturing & Production Planning Systems',
        ];

        foreach ($clearerServiceNames as $oldTitle => $newTitle) {
            DB::table('services')->where('title', $oldTitle)->update([
                'title' => $newTitle,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('services')->whereIn('title', [
            'UI/UX Design',
            'Mobile App Development',
            'Custom Software Development',
        ])->delete();
    }
};
