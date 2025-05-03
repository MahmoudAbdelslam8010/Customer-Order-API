<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;


Route::prefix('orders')->group(function () {
    Route::post('/addorder', [OrderController::class, 'addOrder']);
    Route::get('/getorder', [OrderController::class, 'getOrder']);
    Route::put('{id}', [OrderController::class, 'update']);
    Route::get('/stats', [OrderController::class, 'stats']);
    Route::get('/orderstatus', [OrderController::class, 'orderStatus']);
});
Route::prefix('customers')->group(function () {
    Route::post('/add', [CustomerController::class, 'addCustomer']);
    Route::get('/getall', [CustomerController::class, 'getCustomers']);
    Route::delete('/deleteall', [CustomerController::class, 'deleteAll']);
});


