<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingController;

use App\Models\Category;

Route::middleware(['track.visits'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('/category/{category:slug}', [PostController::class, 'byCategory'])->name('category.show');
    Route::get('/search', [PostController::class, 'search'])->name('search');

    Route::post('/post/{post:slug}/comments', [CommentController::class, 'store'])
        ->middleware('auth')
        ->name('comments.store');
});

require __DIR__.'/auth.php';
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::put('settings/logo', [SiteSettingController::class, 'updateLogo'])->name('admin.settings.logo');
    Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::patch('users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('menus', [AdminMenuController::class, 'index'])->name('admin.menus.index');
    Route::post('menus', [AdminMenuController::class, 'store'])->name('admin.menus.store');
    Route::patch('menus/{menuItem}', [AdminMenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('menus/{menuItem}', [AdminMenuController::class, 'destroy'])->name('admin.menus.destroy');
});

Route::prefix('author')->middleware(['auth','role:author,admin'])->group(function () {
    Route::resource('posts', AdminPostController::class)->except(['show']);
});

Route::get('/about', function () {
    $categories = Category::orderBy('name')->get();
    return view('about', compact('categories'));
})->name('about');

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->put('/profile', [ProfileController::class, 'update'])->name('profile.update');

