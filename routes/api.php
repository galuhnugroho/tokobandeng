<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function(){
    Route::post('admin', [AuthContoller::class, 'login']);
    Route::post('register', [AuthContoller::class, 'register']);
    Route::post('logout', [AuthContoller::class, 'logout']);
});

Route::group([
    'middleware' => 'api',
], function(){
    Route::resources([
        'sliders' => SliderController::class,
        'products' => ProductController::class,
        'members' => MemberController::class,
        'orders' => OrderController::class,
        'payments' => PaymentController::class,
    ]);

    Route::get('pesanan/baru', [OrderController::class, 'baru']);
    Route::get('pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi']);
    Route::get('pesanan/dikemas', [OrderController::class, 'dikemas']);
    Route::get('pesanan/dikirim', [OrderController::class, 'dikirim']);
    Route::get('pesanan/diterima', [OrderController::class, 'diterima']);
    Route::get('pesanan/selesai', [OrderController::class, 'selesai']);

    Route::post('pesanan/ubah_status/{order}', [OrderController::class, 'ubah_status']);
    
    Route::get('reports', [ReportController::class, 'get_reports']);
});