<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/', [HotelController::class, 'index']);


Route::post('/ModalInfo', [HotelController::class, 'ModalInfo']);


Route::post('/ModalResi', [HotelController::class, 'ModalResi']);


Route::post('/PesanKamar', [HotelController::class, 'PesanKamar']);


Route::post('/TambahModalDLX', [HotelController::class, 'TambahModalDLX']);


Route::post('/getKamarTersedia', [HotelController::class, 'getKamarTersedia']);


Route::post('/getRequestHotel', [HotelController::class, 'getRequestHotel']);


Route::post('/getBiayaRequest', [HotelController::class, 'getBiayaRequest']);


Route::post('/hapus-histori-kamar', [HotelController::class, 'hapusHistoriKamar']);


Route::post('/PesanKamar/store_PesanKamar', [HotelController::class, 'store_PesanKamar']);


Route::post('/KetersediaanKamar', [HotelController::class, 'KetersediaanKamar']);


Route::post('/ModalDLX', [HotelController::class, 'ModalDLX']);










Route::post('/TambahModalSPR', [HotelController::class, 'TambahModalSPR']);


Route::post('/TambahModalSPR/store_TambahModalSPR', [HotelController::class, 'store_TambahModalSPR']);


Route::post('/ModalSPR', [HotelController::class, 'ModalSPR']);







Route::post('/TambahModalSTD', [HotelController::class, 'TambahModalSTD']);


Route::post('/TambahModalSTD/store_TambahModalSTD', [HotelController::class, 'store_TambahModalSTD']);


Route::post('/ModalSTD', [HotelController::class, 'ModalSTD']);