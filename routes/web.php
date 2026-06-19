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
    Route::get('/admin/projects/create', [AdminController::class, 'projectsCreate'])->name('admin.projects.create');
    Route::post('/admin/projects', [AdminController::class, 'projectsStore'])->name('admin.projects.store');
    Route::get('/admin/projects/{project}/edit', [AdminController::class, 'projectsEdit'])->name('admin.projects.edit');
    Route::put('/admin/projects/{project}', [AdminController::class, 'projectsUpdate'])->name('admin.projects.update');
    Route::delete('/admin/projects/{project}', [AdminController::class, 'projectsDestroy'])->name('admin.projects.destroy');

    // Messages Viewer
    Route::get('/admin/messages', [AdminController::class, 'messagesIndex'])->name('admin.messages.index');
    Route::get('/admin/messages/{message}', [AdminController::class, 'messagesShow'])->name('admin.messages.show');
    Route::delete('/admin/messages/{message}', [AdminController::class, 'messagesDestroy'])->name('admin.messages.destroy');
});
