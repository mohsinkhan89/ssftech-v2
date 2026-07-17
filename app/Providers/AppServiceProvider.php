<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Message;
use App\Models\Service;
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

        View::composer('frontend.inc.footer', function ($view) {
            $view->with(
                'footerServices',
                Service::where('status', true)->orderBy('sort_order')->orderBy('created_at')->get()
            );
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
