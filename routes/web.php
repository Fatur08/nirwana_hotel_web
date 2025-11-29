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


Route::post('/hapus-histori-kamar', [HotelController::class, 'hapusHistoriKamar']);




Route::post('/TambahModalSPR', [HotelController::class,'TambahModalSPR']);


Route::post('/TambahModalSPR/store_TambahModalSPR', [HotelController::class, 'store_TambahModalSPR']);