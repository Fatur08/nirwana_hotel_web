<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/', [HotelController::class,'index']);
Route::post('/TambahModalDLX', [HotelController::class,'TambahModalDLX']);
Route::post('/getKamarTersedia', [HotelController::class, 'getKamarTersedia']);
Route::post('/TambahModalDLX/store_TambahModalDLX', [HotelController::class, 'store_TambahModalDLX']);
Route::post('/ModalDLX', [HotelController::class,'ModalDLX']);