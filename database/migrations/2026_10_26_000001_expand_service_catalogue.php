<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->default('development')->index();
        });

        $now = now();
        $services = [
            ['title' => 'Custom CRM Development', 'description' => 'A CRM shaped around your sales process, customer relationships and everyday workflows.', 'icon' => 'fa-solid fa-address-book', 'category' => 'crm', 'sort_order' => 1],
            ['title' => 'CRM Setup & Implementation', 'description' => 'Configure your customer records, sales pipelines, permissions and reporting for a smooth start.', 'icon' => 'fa-solid fa-sliders', 'category' => 'crm', 'sort_order' => 2],
            ['title' => 'Sales & Lead Automation', 'description' => 'Connect lead capture, follow-ups, sales tasks and pipeline updates so opportunities keep moving.', 'icon' => 'fa-solid fa-filter-circle-dollar', 'category' => 'crm', 'sort_order' => 3],
            ['title' => 'CRM Integration & Data Migration', 'description' => 'Bring your customer data together and connect your CRM with websites, email and business tools.', 'icon' => 'fa-solid fa-arrows-rotate', 'category' => 'crm', 'sort_order' => 4],
            ['title' => 'Customer Service & Support CRM', 'description' => 'Manage support requests, service history and customer conversations in one connected workspace.', 'icon' => 'fa-solid fa-headset', 'category' => 'crm', 'sort_order' => 5],
            ['title' => 'CRM Reporting & Analytics', 'description' => 'Understand pipeline health, sales activity and customer trends with practical dashboards.', 'icon' => 'fa-solid fa-chart-line', 'category' => 'crm', 'sort_order' => 6],
            ['title' => 'CRM Training & Support', 'description' => 'Help your team adopt the system with onboarding, guidance, maintenance and ongoing improvements.', 'icon' => 'fa-solid fa-chalkboard-user', 'category' => 'crm', 'sort_order' => 7],
            ['title' => 'Custom ERP Development', 'description' => 'Connect your business functions with an ERP designed around the way your organisation works.', 'icon' => 'fa-solid fa-building-columns', 'category' => 'erp', 'sort_order' => 1],
            ['title' => 'ERP Implementation & Migration', 'description' => 'Plan, configure and roll out your ERP with structured data migration and team onboarding.', 'icon' => 'fa-solid fa-gears', 'category' => 'erp', 'sort_order' => 2],
            ['title' => 'Finance & Accounting Systems', 'description' => 'Connect invoicing, expenses, purchasing and financial reporting in your business workflows.', 'icon' => 'fa-solid fa-file-invoice-dollar', 'category' => 'erp', 'sort_order' => 3],
            ['title' => 'Inventory & Warehouse Management', 'description' => 'Track stock, goods movements and warehouse operations with clear, connected records.', 'icon' => 'fa-solid fa-boxes-stacked', 'category' => 'erp', 'sort_order' => 4],
            ['title' => 'HR & Payroll Systems', 'description' => 'Centralise employee records, attendance, leave and payroll workflows around your requirements.', 'icon' => 'fa-solid fa-users-gear', 'category' => 'erp', 'sort_order' => 5],
            ['title' => 'Procurement & Supply Chain', 'description' => 'Bring suppliers, purchase orders and fulfilment together for better operational visibility.', 'icon' => 'fa-solid fa-truck-fast', 'category' => 'erp', 'sort_order' => 6],
            ['title' => 'Manufacturing & Production Planning', 'description' => 'Coordinate materials, production schedules and work orders through connected planning tools.', 'icon' => 'fa-solid fa-industry', 'category' => 'erp', 'sort_order' => 7],
            ['title' => 'ERP Integration & Support', 'description' => 'Connect your ERP to other applications and keep it running with maintenance and technical support.', 'icon' => 'fa-solid fa-code-branch', 'category' => 'erp', 'sort_order' => 8],
            ['title' => 'Digital Marketing Strategy', 'description' => 'Build a practical channel plan around your audience, business goals and budget.', 'icon' => 'fa-solid fa-bullseye', 'category' => 'marketing', 'sort_order' => 1],
            ['title' => 'Search Engine Optimisation (SEO)', 'description' => 'Improve your technical foundations, on-page content and search visibility with ongoing SEO.', 'icon' => 'fa-solid fa-magnifying-glass-chart', 'category' => 'marketing', 'sort_order' => 2],
            ['title' => 'Local SEO & Business Profiles', 'description' => 'Improve location pages, business profiles and local search presence to help nearby customers find you.', 'icon' => 'fa-solid fa-location-dot', 'category' => 'marketing', 'sort_order' => 3],
            ['title' => 'PPC & Search Advertising', 'description' => 'Plan and manage paid search campaigns with focused targeting, landing pages and performance reviews.', 'icon' => 'fa-solid fa-arrow-pointer', 'category' => 'marketing', 'sort_order' => 4],
            ['title' => 'Paid Social Advertising', 'description' => 'Reach relevant audiences with paid campaigns across social platforms and creative testing.', 'icon' => 'fa-solid fa-rectangle-ad', 'category' => 'marketing', 'sort_order' => 5],
            ['title' => 'Social Media Management', 'description' => 'Keep your social presence active with content planning, publishing and community engagement.', 'icon' => 'fa-solid fa-comments', 'category' => 'marketing', 'sort_order' => 6],
            ['title' => 'Content Marketing & Copywriting', 'description' => 'Create useful website copy, articles and campaign content that speaks to your customers.', 'icon' => 'fa-solid fa-pen-nib', 'category' => 'marketing', 'sort_order' => 7],
            ['title' => 'Email Marketing & Automation', 'description' => 'Build email campaigns, welcome journeys and follow-ups around the customer lifecycle.', 'icon' => 'fa-solid fa-envelope-open-text', 'category' => 'marketing', 'sort_order' => 8],
            ['title' => 'Brand Identity & Creative Design', 'description' => 'Create a consistent visual identity with brand assets, graphics and campaign creative.', 'icon' => 'fa-solid fa-palette', 'category' => 'marketing', 'sort_order' => 9],
            ['title' => 'Video Marketing & Motion Content', 'description' => 'Develop video content and motion graphics for social channels, campaigns and product storytelling.', 'icon' => 'fa-solid fa-photo-film', 'category' => 'marketing', 'sort_order' => 10],
            ['title' => 'Conversion Rate Optimisation', 'description' => 'Improve key pages and user journeys with research, testing and thoughtful design changes.', 'icon' => 'fa-solid fa-arrow-trend-up', 'category' => 'marketing', 'sort_order' => 11],
            ['title' => 'Marketing Analytics & Reporting', 'description' => 'Set up measurement, campaign tracking and dashboards to understand what is working.', 'icon' => 'fa-solid fa-chart-pie', 'category' => 'marketing', 'sort_order' => 12],
        ];

        foreach ($services as $service) {
            if (! DB::table('services')->where('title', $service['title'])->exists()) {
                DB::table('services')->insert($service + [
                    'link' => '#contact', 'status' => true,
                    'created_at' => $now, 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropColumn('category');
        });
    }
};
