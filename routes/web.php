<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

/*
|--------------------------------------------------------------------------
| Breeze Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', Admin\ProjectController::class)->except(['show']);
    Route::resource('certificates', Admin\CertificateController::class)->except(['show']);
    Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('comments', [Admin\CommentController::class, 'index'])->name('comments.index');
    Route::patch('comments/{comment}/approve', [Admin\CommentController::class, 'approve'])->name('comments.approve');
    Route::patch('comments/{comment}/reject', [Admin\CommentController::class, 'reject'])->name('comments.reject');
    Route::delete('comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';