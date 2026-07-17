<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.inc.header', function ($view) {
            $view->with('hasActiveBlogs', Blog::where('status', true)->exists());
        });

        View::composer('admin.layouts.admin', function ($view) {
            if (! Auth::check()) {
                return;
            }

            $view->with([
                'headerNotifications' => Message::latest()->limit(10)->get(),
                'unreadNotificationsCount' => Message::whereNull('read_at')->count(),
            ]);
        });
    }
}
