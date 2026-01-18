<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\ImageController as AdminImageController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Image Routes
Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/{image}', [ImageController::class, 'show'])->name('images.show');

// Public Video Routes
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/embed/video/{video}', [VideoController::class, 'embed'])->name('videos.embed');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('videos', AdminVideoController::class)->except(['edit', 'update']);
    Route::resource('images', AdminImageController::class)->except(['edit', 'update']);
    Route::resource('categories', CategoryController::class);
    Route::get('import', [ImportController::class, 'create'])->name('import.create');
    Route::post('import', [ImportController::class, 'store'])->name('import.store');
});

require __DIR__.'/auth.php';
