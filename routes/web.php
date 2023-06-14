<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role === 'seller') {
        return redirect('/admin/dashboard');
    }

    return redirect('/shop/home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::prefix('admin')->middleware(['seller'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index']);

        //Products page
            // Products List page
        Route::get('products', [ProductController::class, 'index']);
            //Add Products page
        Route::get('products/add', [ProductController::class, 'create'])->name('product.create');
            // Create New Product POST request
        Route::post('products', [ProductController::class, 'store']);
            // Edit Product page
        Route::get('products/edit/{id}', [ProductController::class, 'edit']);//this one continue
        Route::patch('products/delete/{id}',[ProductController::class, 'delete']);//this one continue
            // update Product PATCH request
        Route::patch('products/{id}', [ProductController::class, 'update']);//this one continue

        // Categories page
            // Categories List page
        Route::get('categories', [CategoryController::class, 'index']);
            // Add Category Page
        Route::get('categories/add', [CategoryController::class, 'create']);
            // Create New Category POST request
        Route::post('categories', [CategoryController::class, 'store']);
            // Edit Category Page
        Route::get('categories/{id}', [CategoryController::class, 'edit']);
            // Delete Category
        Route::get('products/delete/{id}',[ProductController::class, 'delete']);//this one continue
            // Update Category PATCH request
        Route::patch('categories/{id}', [CategoryController::class, 'update']);//this can be remove add and delete fo categonly ory


        // Add new admin routes here:
            // Purchases page
                // Purchases list page
        Route::get('purchases', [PurchaseController::class, 'index']);
                // Add new purchases page
        Route::get('purchases/add', [PurchaseController::class, 'create']);
        Route::get('purchases/view/{id}', [PurchaseController::class, 'show']);
        Route::post('purchases', [PurchaseController::class, 'store']);

            // Sales page
        Route::get('sales', [SaleController::class, 'index']);
        Route::get('sales/view/{id}', [SaleController::class, 'show']);
        Route::patch('sales/update_status', [SaleController::class, 'updateStatus']);
        Route::patch('sales/update_payment_status', [SaleController::class, 'updatePaymentStatus']);
    });

    // Buyer
    Route::prefix('shop')->group(function() {
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('cart', [CartController::class, 'index']);
        Route::post('cart', [CartController::class, 'addToCart']);
        Route::patch('cart/{id}', [CartController::class, 'update']);
        Route::post('cart/{id}/checkout', [CartController::class, 'checkout']);
    });
});

Route::prefix('shop')->group(function() {
    Route::get('home', [ShopController::class, 'index'])->name('shop.home');
    Route::get('products', [ShopController::class, 'products']);
});


require __DIR__.'/auth.php';
