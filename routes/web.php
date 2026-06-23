<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('index');
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
