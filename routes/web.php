<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HostingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{token}/preview', [ProjectController::class, 'preview'])->name('projects.preview');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Order routes
    Route::get('/projects/{project}/order', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/projects/{project}/order', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/check-domain', [OrderController::class, 'checkDomain'])->name('orders.check-domain');
});

// Preview routes (accessible without auth but need valid token)
Route::get('/preview/{token}/{path?}', [PreviewController::class, 'show'])->where('path', '.*');

// Hosting routes (publicly accessible)
Route::get('/hosting/{domain}/{path?}', [HostingController::class, 'serve'])->where('path', '.*')->name('hosting.serve');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders/{order}/download-project', [App\Http\Controllers\Admin\OrderController::class, 'downloadProject'])->name('orders.download-project');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names('users');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
});
