<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('icon')->default('fa-solid fa-newspaper');
            $table->text('excerpt');
            $table->longText('description');
            $table->string('image');
            $table->string('hero_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('content_banner')->nullable();
            $table->string('author_name')->default('Sarah Johnson');
            $table->string('author_role')->nullable();
            $table->text('author_bio')->nullable();
            $table->string('read_time')->default('5 min read');
            $table->text('tags')->nullable();
            $table->date('published_at')->nullable()->index();
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
        });

        $now = now();
        $description = '<p>In today’s competitive digital landscape, having a great product or service isn’t enough. You need a strategic digital approach that attracts attention and converts it into measurable business results.</p><h2>1. Understand Your Audience Deeply</h2><p>Successful growth starts with understanding. Create detailed buyer personas, analyse user behaviour, and identify pain points so your message truly resonates.</p><blockquote>Marketing is no longer about the stuff that you make, but about the stories you tell.<cite>— Seth Godin</cite></blockquote><h2>2. Build a Strong Digital Presence</h2><p>Your website is your digital storefront. Ensure it is fast, mobile-friendly, SEO-optimised, and delivers a seamless user experience.</p><h2>3. Create Valuable, Engaging Content</h2><p>Publish useful articles, videos, case studies, and guides that educate, inspire, and solve real customer problems.</p><h2>4. Leverage Data and Analytics</h2><p>Track KPIs, analyse user behaviour, and continuously optimise campaigns to maximise ROI and sustainable growth.</p>';
        DB::table('blogs')->insert([
            ['title'=>'Digital Marketing Strategies That Deliver Real Growth','slug'=>'digital-marketing-growth','category'=>'Marketing','icon'=>'fa-solid fa-bullseye','excerpt'=>'Explore proven tactics to boost visibility, generate leads, and create measurable business impact.','description'=>$description,'image'=>'frontend/assets/images/blog/marketing-growth.png','hero_image'=>'frontend/assets/images/blog/article-hero-marketing.png','featured_image'=>'frontend/assets/images/blog/article-featured-marketing.png','content_banner'=>'frontend/assets/images/blog/article-content-marketing.png','author_name'=>'Sarah Johnson','author_role'=>'Digital Marketing Strategist at SSF Tech','author_bio'=>'Sarah helps brands grow through data-driven marketing strategies and performance-focused campaigns.','read_time'=>'4 min read','tags'=>'Digital Marketing, Growth Strategy, Lead Generation, Business Growth, SEO','published_at'=>'2026-02-22','status'=>true,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'How Modern Web Design Builds Trust and Conversions','slug'=>'modern-web-design','category'=>'Web Design','icon'=>'fa-solid fa-globe','excerpt'=>'Discover how clean layouts, speed, and strong UX help businesses turn visitors into customers.','description'=>$description,'image'=>'frontend/assets/images/blog/web-design-insights.png','hero_image'=>null,'featured_image'=>null,'content_banner'=>'frontend/assets/images/blog/article-content-marketing.png','author_name'=>'Sarah Johnson','author_role'=>'Digital Experience Strategist at SSF Tech','author_bio'=>'Sarah creates useful digital experiences that connect brands with customers.','read_time'=>'5 min read','tags'=>'Web Design, UX, Conversion, Performance','published_at'=>'2026-02-14','status'=>true,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Building a Brand Identity That Stands Out Online','slug'=>'brand-identity-online','category'=>'Branding','icon'=>'fa-solid fa-id-badge','excerpt'=>'Learn how consistent visuals and messaging help position your business for long-term success.','description'=>$description,'image'=>'frontend/assets/images/blog/brand-identity.png','hero_image'=>null,'featured_image'=>null,'content_banner'=>'frontend/assets/images/blog/article-content-marketing.png','author_name'=>'Sarah Johnson','author_role'=>'Brand Strategist at SSF Tech','author_bio'=>'Sarah helps businesses build recognisable and consistent digital brands.','read_time'=>'6 min read','tags'=>'Branding, Identity, Design, Business Growth','published_at'=>'2026-03-01','status'=>true,'created_at'=>$now,'updated_at'=>$now],
        ]);
    }

    public function down(): void { Schema::dropIfExists('blogs'); }
};
