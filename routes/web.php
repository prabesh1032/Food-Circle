<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/viewmenu/{id}', [PageController::class, 'viewmenu'])->name('viewmenu');
Route::get('/allmenus', [MenuController::class, 'menus'])->name('menu');

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/customers', [DashboardController::class, 'index'])->name('customers.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::get('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::get('/menucategory/create', [MenuCategoryController::class, 'create'])->name('menucategory.create');
    Route::post('/menucategory', [MenuCategoryController::class, 'store'])->name('menucategory.store');
    Route::get('/menucategory', [MenuCategoryController::class, 'index'])->name('menucategory.index');
    Route::get('/menucategory/{id}/edit', [MenuCategoryController::class, 'edit'])->name('menucategory.edit');
    Route::put('/menucategory/{id}', [MenuCategoryController::class, 'update'])->name('menucategory.update');
    Route::get('/menucategory/{id}', [MenuCategoryController::class, 'destroy'])->name('menucategory.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderController::class, 'userOrders'])->name('myorders');
    Route::post('/cancel-order/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');


    Route::post('/direct-checkout', [OrderController::class, 'directCheckout'])->name('direct.checkout');
    Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/{status}', [OrderController::class, 'status'])->name('orders.status');
    Route::POST('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/order/esewa/{cartid}', [OrderController::class, 'storeEsewa'])->name('order.storeEsewa');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
