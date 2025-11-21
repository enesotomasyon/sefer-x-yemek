<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurant;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\SliderController as AdminSlider;
use App\Http\Controllers\Admin\BranchController as AdminBranch;
use App\Http\Controllers\Admin\OwnerController as AdminOwner;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\RestaurantController as OwnerRestaurant;
use App\Http\Controllers\Owner\ProductController as OwnerProduct;
use App\Http\Controllers\Owner\BranchController as OwnerBranch;
use App\Http\Controllers\Owner\CategoryImageController as OwnerCategoryImage;
use App\Http\Controllers\Owner\QRController;

// Auth routes (must be before catch-all routes)
require __DIR__.'/auth.php';

// Dashboard - redirect based on role
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('owner')) {
        return redirect()->route('owner.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Catch-all route for restaurant slugs (must be last)
Route::get('/{restaurant:slug}', [RestaurantController::class, 'menu'])->name('restaurants.menu');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('owners', AdminOwner::class);
    Route::resource('restaurants', AdminRestaurant::class);
    Route::resource('categories', AdminCategory::class);
    Route::resource('sliders', AdminSlider::class);
    Route::resource('branches', AdminBranch::class)->only(['index', 'update']);
    Route::post('/branches/{branch}/approve', [AdminBranch::class, 'approve'])->name('branches.approve');
    Route::post('/branches/{branch}/reject', [AdminBranch::class, 'reject'])->name('branches.reject');
});

// Owner routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('dashboard');
    Route::post('/select-restaurant', [OwnerDashboard::class, 'selectRestaurant'])->name('select-restaurant');
    Route::resource('restaurants', OwnerRestaurant::class);
    Route::resource('products', OwnerProduct::class);
    Route::post('/products/bulk-update', [OwnerProduct::class, 'bulkUpdatePrices'])->name('products.bulk-update');
    Route::post('/products/increase-percentage', [OwnerProduct::class, 'increaseByPercentage'])->name('products.increase-percentage');
    Route::resource('branches', OwnerBranch::class);
    Route::get('/category-images', [OwnerCategoryImage::class, 'index'])->name('category-images.index');
    Route::post('/category-images', [OwnerCategoryImage::class, 'store'])->name('category-images.store');
    Route::delete('/category-images/{category}', [OwnerCategoryImage::class, 'destroy'])->name('category-images.destroy');
    Route::get('/qr/{restaurant}', [QRController::class, 'generate'])->name('qr.generate');
});
