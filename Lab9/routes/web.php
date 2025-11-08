<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Xem danh sách: công khai
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Các thao tác còn lại: yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Articles routes - đặt TRƯỚC route {article} để tránh conflict
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit')
        ->middleware('can:update,article');

    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update')
        ->middleware('can:update,article');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy')
        ->middleware('can:delete,article');
});

// Xem chi tiết: công khai - đặt SAU các route cụ thể để tránh conflict
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Khu vực quản trị (yêu cầu admin)
Route::prefix('admin')
    ->middleware(['web', 'auth', 'admin'])
    ->group(function () {
        Route::resource('articles', ArticleController::class);
    });

// Throttle cho API demo
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/public-info', fn() => ['status' => 'ok']);
});

require __DIR__.'/auth.php';
