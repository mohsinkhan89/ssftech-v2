<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
        });

        $now = now();
        DB::table('faqs')->insert([
            ['question' => 'What services does SSF Tech offer?', 'answer' => 'We offer a full range of digital services including web development, mobile app development, digital marketing, UI and UX design, and IT support, all tailored to suit your business needs.', 'sort_order' => 1, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'How long does a typical project take?', 'answer' => 'Most projects take between two and six weeks, depending on the scope of work, the amount of content involved, any integrations required and how quickly feedback is provided during review.', 'sort_order' => 2, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Do you work with startups and small businesses?', 'answer' => 'Yes, we build practical and affordable digital solutions for startups, growing brands and established teams alike.', 'sort_order' => 3, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'What is your pricing model?', 'answer' => 'Pricing is based on your specific project requirements, timeline and the level of ongoing support you need, so every quote is tailored to you.', 'sort_order' => 4, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'How do you ensure data security?', 'answer' => 'We follow secure development practices, careful access control, protected deployments and regular backup recommendations to help keep your data safe.', 'sort_order' => 5, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Do you provide support after launch?', 'answer' => 'Yes, ongoing support is available after your website, app or campaign goes live, helping keep everything stable and continually improving.', 'sort_order' => 6, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
