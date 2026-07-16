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
            ['title' => 'Digital Marketing', 'description' => 'Results focused marketing strategies that grow your brand, reach the right audience and turn clicks into paying customers.', 'icon' => 'fa-solid fa-bullhorn', 'link' => '#contact', 'sort_order' => 2, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Graphic Designing', 'description' => 'Creative, memorable designs that tell your brand\'s story and leave a lasting impression on every visitor.', 'icon' => 'fa-solid fa-pen-nib', 'link' => '#contact', 'sort_order' => 3, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'IT Support', 'description' => 'Reliable, responsive support and maintenance that keeps your systems running smoothly, day in and day out.', 'icon' => 'fa-solid fa-headset', 'link' => '#contact', 'sort_order' => 4, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
