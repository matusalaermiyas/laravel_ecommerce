<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\CustomerController;

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('site-admin/login', 'admin.login');
Route::post('site-admin/login', [AdminController::class, 'loginPOST'])->name('site.admin.login');


Route::controller(AdminController::class)->prefix('root')->middleware('root')->group(function () {
    Route::get('paid-customers', 'paidCustomers')->name('root.paid-customers');
    Route::get('unpaid-customers', 'unpaidCustomers')->name('root.unpaid-customers');
    Route::get('customer-orders/{id}', 'getOrders')->name('customer.orders');
    Route::get('logout', 'logout')->name('admin.logout');
    Route::get('add-product', 'addProduct')->name('root.add-product');
    Route::post('add-product', 'addProductPOST')->name('admin.add-product');
});

Route::controller(CustomerController::class)->prefix('customer')->group(function () {
    Route::get('stripe', 'stripe')->name('customer.stripe');
    Route::get('login', 'login')->name('customer.login');
    Route::get('register', 'register')->name('customer.register');
    Route::get('dashboard', 'dashboard')->name('customer.dashboard')->middleware('user.auth');
    Route::post('submit', 'submit')->name('customer.submit');
    Route::post('stripe', 'stripePost')->name('customer.stripe.post');
    Route::post('login', 'loginPOST')->name('customer.login.post');
    Route::post('register', 'registerPOST')->name('customer.register.post');
    Route::get('logout', 'logout')->name('customer.logout')->middleware('user.auth');
});

Route::controller(ClothesController::class)->prefix('clothes')->group(function () {
    Route::get('tshirts', 'tshirts')->name('clothes.tshirts');
    Route::get('trousers', 'trousers')->name('clothes.trousers');
    Route::get('shorts', 'shorts')->name('clothes.shorts');
    Route::get('underwears', 'underwears')->name('clothes.underwears');
    Route::get('add-to-cart/{id}', 'addToCart')->name('clothes.add-to-cart');
    Route::get('checkout', 'checkout')->name('clothes.checkout');
    Route::post('add-to-cart', 'addItemToCart')->name('clothes.add');
    Route::post('buy', 'buy')->name('clothes.buy');
    Route::delete('remove', 'removeFromCart')->name('clothes.remove');
});
