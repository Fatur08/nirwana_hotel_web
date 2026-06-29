<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/', [HotelController::class, 'index']);


Route::post('/PesanKamar', [HotelController::class, 'PesanKamar']);


Route::post('/getKamarTersedia', [HotelController::class, 'getKamarTersedia']);


Route::post('/getRequestHotel', [HotelController::class, 'getRequestHotel']);


Route::post('/getBiayaRequest', [HotelController::class, 'getBiayaRequest']);


Route::post('/hapus-histori-kamar', [HotelController::class, 'hapusHistoriKamar']);


Route::post('/PesanKamar/store_PesanKamar', [HotelController::class, 'store_PesanKamar']);





Route::get('/KetersediaanKamar', [HotelController::class, 'KetersediaanKamar']);





Route::get('/InformasiPemesanan', [HotelController::class, 'InformasiPemesanan']);


Route::post('/ModalInfo', [HotelController::class, 'ModalInfo']);


Route::post('/ModalResi', [HotelController::class, 'ModalResi']);


Route::post('/ModalPembayaran', [HotelController::class, 'ModalPembayaran']);


Route::post('/ModalPembayaran/store_ModalPembayaran', [HotelController::class, 'store_ModalPembayaran']);


Route::post('/ModalPembayaran/{id}/BatalkanPembayaran', [HotelController::class, 'BatalkanPembayaran']);


Route::post('/ModalEdit', [HotelController::class, 'ModalEdit']);


Route::post('ModalEdit/store_ModalEdit', [HotelController::class, 'store_ModalEdit']);


Route::post('/HapusPesanan/{id}', [HotelController::class, 'HapusPesanan']);





Route::get('/DataMaster', [HotelController::class, 'DataMaster']);


Route::post('/TambahKamarDeluxe', [HotelController::class, 'TambahKamarDeluxe']);


Route::post('/TambahHomeStay', [HotelController::class, 'TambahHomeStay']);


Route::post('/TambahKamarSuperior', [HotelController::class, 'TambahKamarSuperior']);


Route::post('/TambahKamarStandart', [HotelController::class, 'TambahKamarStandart']);


Route::post('/UpdateDataMaster', [HotelController::class, 'UpdateDataMaster']);