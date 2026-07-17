<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('fa-solid fa-gear');
            $table->string('link')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
        });

        $now = now();
        DB::table('services')->insert([
            ['title' => 'Web Development', 'description' => 'Custom websites built with modern technology, designed for strong performance, easy management and long term scalability.', 'icon' => 'fa-solid fa-laptop-code', 'link' => '#contact', 'sort_order' => 1, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'E-Commerce Development', 'description' => 'Secure, conversion-focused online stores with smooth checkout experiences, product management and scalable integrations.', 'icon' => 'fa-solid fa-cart-shopping', 'link' => '#contact', 'sort_order' => 2, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Web Application Development', 'description' => 'Custom web applications built around your workflows with responsive interfaces, reliable architecture and room to scale.', 'icon' => 'fa-solid fa-window-restore', 'link' => '#contact', 'sort_order' => 3, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'API Development & Integration', 'description' => 'Reliable APIs and third-party integrations that connect your website, applications, payments and business systems.', 'icon' => 'fa-solid fa-code-branch', 'link' => '#contact', 'sort_order' => 4, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Website Maintenance & Support', 'description' => 'Ongoing development support, security updates, performance improvements and technical maintenance for your website.', 'icon' => 'fa-solid fa-screwdriver-wrench', 'link' => '#contact', 'sort_order' => 5, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
