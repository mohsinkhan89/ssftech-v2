<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/blog', [FrontendController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');

// Admin Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AdminController::class, 'login']);
});

// Admin Panel Routes (Authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // Current User Profile
    Route::get('/admin/profile', [AdminController::class, 'profileShow'])->name('admin.profile.show');
    Route::put('/admin/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [AdminController::class, 'profileUpdatePassword'])->name('admin.profile.password');

    // Projects CRUD
    Route::get('/admin/projects', [AdminController::class, 'projectsIndex'])->name('admin.projects.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/projects/create', [AdminController::class, 'projectsCreate'])->name('admin.projects.create');
        Route::post('/admin/projects', [AdminController::class, 'projectsStore'])->name('admin.projects.store');
        Route::get('/admin/projects/{project}/edit', [AdminController::class, 'projectsEdit'])->name('admin.projects.edit');
        Route::put('/admin/projects/{project}', [AdminController::class, 'projectsUpdate'])->name('admin.projects.update');
        Route::patch('/admin/projects/{project}/toggle-status', [AdminController::class, 'projectsToggleStatus'])->name('admin.projects.toggle-status');
        Route::delete('/admin/projects/{project}', [AdminController::class, 'projectsDestroy'])->name('admin.projects.destroy');
    });

    // Messages Viewer
    Route::get('/admin/messages', [AdminController::class, 'messagesIndex'])->name('admin.messages.index');
    Route::get('/admin/messages/{message}', [AdminController::class, 'messagesShow'])->name('admin.messages.show');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::delete('/admin/messages/{message}', [AdminController::class, 'messagesDestroy'])->name('admin.messages.destroy');
    });

    // Clients CRUD
    Route::get('/admin/clients', [AdminController::class, 'clientsIndex'])->name('admin.clients.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/clients/create', [AdminController::class, 'clientsCreate'])->name('admin.clients.create');
        Route::post('/admin/clients', [AdminController::class, 'clientsStore'])->name('admin.clients.store');
        Route::get('/admin/clients/{client}/edit', [AdminController::class, 'clientsEdit'])->name('admin.clients.edit');
        Route::put('/admin/clients/{client}', [AdminController::class, 'clientsUpdate'])->name('admin.clients.update');
        Route::patch('/admin/clients/{client}/toggle-status', [AdminController::class, 'clientsToggleStatus'])->name('admin.clients.toggle-status');
        Route::delete('/admin/clients/{client}', [AdminController::class, 'clientsDestroy'])->name('admin.clients.destroy');
    });

    // Testimonials CRUD
    Route::get('/admin/testimonials', [AdminController::class, 'testimonialsIndex'])->name('admin.testimonials.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/testimonials/create', [AdminController::class, 'testimonialsCreate'])->name('admin.testimonials.create');
        Route::post('/admin/testimonials', [AdminController::class, 'testimonialsStore'])->name('admin.testimonials.store');
        Route::get('/admin/testimonials/{testimonial}/edit', [AdminController::class, 'testimonialsEdit'])->name('admin.testimonials.edit');
        Route::put('/admin/testimonials/{testimonial}', [AdminController::class, 'testimonialsUpdate'])->name('admin.testimonials.update');
        Route::patch('/admin/testimonials/{testimonial}/toggle-status', [AdminController::class, 'testimonialsToggleStatus'])->name('admin.testimonials.toggle-status');
        Route::delete('/admin/testimonials/{testimonial}', [AdminController::class, 'testimonialsDestroy'])->name('admin.testimonials.destroy');
    });

    // FAQs CRUD
    Route::get('/admin/faqs', [AdminController::class, 'faqsIndex'])->name('admin.faqs.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/faqs/create', [AdminController::class, 'faqsCreate'])->name('admin.faqs.create');
        Route::post('/admin/faqs', [AdminController::class, 'faqsStore'])->name('admin.faqs.store');
        Route::get('/admin/faqs/{faq}/edit', [AdminController::class, 'faqsEdit'])->name('admin.faqs.edit');
        Route::put('/admin/faqs/{faq}', [AdminController::class, 'faqsUpdate'])->name('admin.faqs.update');
        Route::patch('/admin/faqs/{faq}/toggle-status', [AdminController::class, 'faqsToggleStatus'])->name('admin.faqs.toggle-status');
        Route::delete('/admin/faqs/{faq}', [AdminController::class, 'faqsDestroy'])->name('admin.faqs.destroy');
    });

    // Services CRUD
    Route::get('/admin/services', [AdminController::class, 'servicesIndex'])->name('admin.services.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/services/create', [AdminController::class, 'servicesCreate'])->name('admin.services.create');
        Route::post('/admin/services', [AdminController::class, 'servicesStore'])->name('admin.services.store');
        Route::get('/admin/services/{service}/edit', [AdminController::class, 'servicesEdit'])->name('admin.services.edit');
        Route::put('/admin/services/{service}', [AdminController::class, 'servicesUpdate'])->name('admin.services.update');
        Route::patch('/admin/services/{service}/toggle-status', [AdminController::class, 'servicesToggleStatus'])->name('admin.services.toggle-status');
        Route::delete('/admin/services/{service}', [AdminController::class, 'servicesDestroy'])->name('admin.services.destroy');
    });

    // Social Links CRUD
    Route::get('/admin/social-links', [AdminController::class, 'socialLinksIndex'])->name('admin.social-links.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::get('/admin/social-links/create', [AdminController::class, 'socialLinksCreate'])->name('admin.social-links.create');
        Route::post('/admin/social-links', [AdminController::class, 'socialLinksStore'])->name('admin.social-links.store');
        Route::get('/admin/social-links/{socialLink}/edit', [AdminController::class, 'socialLinksEdit'])->name('admin.social-links.edit');
        Route::put('/admin/social-links/{socialLink}', [AdminController::class, 'socialLinksUpdate'])->name('admin.social-links.update');
        Route::patch('/admin/social-links/{socialLink}/toggle-status', [AdminController::class, 'socialLinksToggleStatus'])->name('admin.social-links.toggle-status');
        Route::delete('/admin/social-links/{socialLink}', [AdminController::class, 'socialLinksDestroy'])->name('admin.social-links.destroy');
    });

    // Site Settings
    Route::get('/admin/settings', [AdminController::class, 'settingsIndex'])->name('admin.settings.index');
    Route::middleware('role:administrator,admin')->group(function () {
        Route::post('/admin/settings/logo', [AdminController::class, 'settingsUpdateLogo'])->name('admin.settings.logo');
        Route::put('/admin/settings/asset-versions', [AdminController::class, 'settingsUpdateAssetVersions'])->name('admin.settings.asset-versions');
        Route::put('/admin/settings/contact-details', [AdminController::class, 'settingsUpdateContactDetails'])->name('admin.settings.contact-details');
    });

    // Users CRUD (Only Administrator)
    Route::middleware('role:administrator')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminController::class, 'usersCreate'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'usersStore'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
    });
});
