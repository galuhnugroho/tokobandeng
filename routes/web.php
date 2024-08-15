<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

//auth
Route::get('login', [AuthContoller::class, 'index'])->name('login');
Route::post('login', [AuthContoller::class, 'login']);
Route::get('logout', [AuthContoller::class, 'logout']);

Route::get('login_member', [AuthContoller::class, 'login_member']);
Route::post('login_member', [AuthContoller::class, 'login_member_action']);
Route::get('logout_member', [AuthContoller::class, 'logout_member']);

Route::get('register_member', [AuthContoller::class, 'register_member']);
Route::post('register_member', [AuthContoller::class, 'register_member_action']);

//kategori
Route::get('/slider', [SliderController::class, 'list']);
Route::get('/barang', [ProductController::class, 'list']);
Route::get('/payment', [PaymentController::class, 'list']);

Route::get('/pesanan/baru', [OrderController::class, 'list']);
Route::get('/pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dikemas', [OrderController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim', [OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima', [OrderController::class, 'diterima_list']);
Route::get('/pesanan/selesai', [OrderController::class, 'selesai_list']);

Route::get('/laporan', [ReportController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']);

// home routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/product/{id}', [HomeController::class, 'product']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/checkout/{id}', [HomeController::class, 'checkout2']);
Route::get('/orders', [HomeController::class, 'orders']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/profile', [HomeController::class, 'profile']);

Route::post('/add_to_cart', [HomeController::class, 'add_to_cart']);
Route::get('/delete_from_cart/{cart}', [HomeController::class, 'delete_from_cart']);
Route::get('/get_kota/{id}', [HomeController::class, 'get_kota']);
Route::get('/get_ongkir/{destination}/{weight}', [HomeController::class, 'get_ongkir']);
Route::post('/checkout_orders', [HomeController::class, 'checkout_orders']);
Route::post('/payments', [HomeController::class, 'payments']);
Route::post('/pesanan_selesai/{order}', [HomeController::class, 'pesanan_selesai']);