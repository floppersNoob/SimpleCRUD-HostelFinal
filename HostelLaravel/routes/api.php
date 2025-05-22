<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get-rooms', [HostelController::class, 'index']);   
Route::post('/add-rooms', [HostelController::class, 'store']);     
Route::put( '/update-rooms/{id}', [HostelController::class, 'update']); 
Route::put('/rooms/{id}/archive', [HostelController::class, 'archive']);
Route::get('/rooms/archived/list', [HostelController::class, 'archived']);
Route::put('/rooms/recover/{id}', [HostelController::class, 'recover']);

Route::get('/get-customers', [CustomerController::class, 'index']);
Route::post('/add-customers', [CustomerController::class, 'store']);
Route::put('/put-customers/{id}', [CustomerController::class, 'update']);

Route::get('/get-payments', [PaymentController::class, 'index']);
Route::post('/add-payments', [PaymentController::class, 'store']);


