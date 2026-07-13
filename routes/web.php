<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
use App\Services\WhatsApp\MetaService;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [LoginController::class, 'index']
);

Route::post(
    '/login',
    [LoginController::class, 'login']
);

Route::get(
    '/logout',
    [LoginController::class, 'logout']
);

/*
|--------------------------------------------------------------------------
| Hotel
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [HotelController::class, 'index']
)->name('index');


Route::post('/PesanKamar', [HotelController::class, 'PesanKamar']);


Route::post('/CariCustomer', [HotelController::class, 'CariCustomer']);


Route::post('/getKamarTersedia', [HotelController::class, 'getKamarTersedia']);


Route::post('/getKamarTersediaEdit', [HotelController::class, 'getKamarTersediaEdit']);


Route::post('/getRequestHotel', [HotelController::class, 'getRequestHotel']);


Route::post('/getBiayaRequest', [HotelController::class, 'getBiayaRequest']);


Route::post('/hapus-histori-kamar', [HotelController::class, 'hapusHistoriKamar']);


Route::post('/PesanKamar/store_PesanKamar', [HotelController::class, 'store_PesanKamar']);





Route::get('/KetersediaanKamar', [HotelController::class, 'KetersediaanKamar']);





Route::get('/InformasiPemesanan', [HotelController::class, 'InformasiPemesanan']);


Route::post('/BuatResiManual', [HotelController::class, 'BuatResiManual']);


Route::post('/store_BuatResiManual', [HotelController::class, 'store_BuatResiManual']);


Route::post('/LihatResiManual', [HotelController::class, 'LihatResiManual']);


Route::post('/KosongkanResiManual', [HotelController::class, 'KosongkanResiManual']);


Route::post('/ModalInfo', [HotelController::class, 'ModalInfo']);


Route::post('/ModalResi', [HotelController::class, 'ModalResi']);


Route::post('/kirim-resi-wa/{id}', [HotelController::class, 'kirimResiWA']);


Route::post('/upload-resi-wa/{id}', [HotelController::class, 'uploadResiWA']);


Route::post('/ModalPembayaran', [HotelController::class, 'ModalPembayaran']);


Route::post('/ModalPembayaran/store_ModalPembayaran', [HotelController::class, 'store_ModalPembayaran']);


Route::post('/ModalPembayaran/{id}/BatalkanPembayaran', [HotelController::class, 'BatalkanPembayaran']);


Route::post('/LihatBukti', [HotelController::class, 'LihatBukti']);


Route::post('/UploadFotoKTP', [HotelController::class, 'UploadFotoKTP']);


Route::post('/ModalEdit', [HotelController::class, 'ModalEdit']);


Route::post('ModalEdit/store_ModalEdit', [HotelController::class, 'store_ModalEdit']);


Route::post('/HapusPesanan/{id}', [HotelController::class, 'HapusPesanan']);





Route::get('/DataMaster', [HotelController::class, 'DataMaster']);


Route::post('/TambahKamarDeluxe', [HotelController::class, 'TambahKamarDeluxe']);


Route::post('/TambahModalDLX/store_TambahModalDLX', [HotelController::class, 'store_TambahModalDLX']);


Route::post('/EditHargaDeluxe', [HotelController::class, 'EditHargaDeluxe']);


Route::post('/EditHargaDeluxe/store_EditHargaDeluxe', [HotelController::class, 'store_EditHargaDeluxe']);


Route::post('/HapusKamarDeluxe', [HotelController::class, 'HapusKamarDeluxe']);


Route::post('/HapusKamarDeluxe/store_HapusKamarDeluxe', [HotelController::class, 'store_HapusKamarDeluxe']);


Route::post('/TambahHomeStay', [HotelController::class, 'TambahHomeStay']);


Route::post('/TambahHomeStay/store_TambahHomeStay', [HotelController::class, 'store_TambahHomeStay']);


Route::post('/TambahKamarSuperior', [HotelController::class, 'TambahKamarSuperior']);


Route::post('/TambahModalSPR/store_TambahModalSPR', [HotelController::class, 'store_TambahModalSPR']);


Route::post('/TambahKamarStandart', [HotelController::class, 'TambahKamarStandart']);


Route::post('/TambahModalSTD/store_TambahModalSTD', [HotelController::class, 'store_TambahModalSTD']);


Route::post('/UpdateDataMaster', [HotelController::class, 'UpdateDataMaster']);


Route::get('/test-meta', function () {

    $meta = new MetaService();

    return $meta->sendText(
        '6288975660188',
        'Halo, ini percobaan dari Laravel menggunakan Meta Cloud API. Awas lo ya Anjmig'
    );

});





Route::get('/test-image', function () {

    $wa = new \App\Services\WhatsApp\MetaService();

    return $wa->sendImage(

        '6288975660188',

        'Percobaan kirim gambar dari server Hotel Nirwana',

        asset('storage/uploads/foto_ktp/Foto_KTP_Google_2026-07-09_12-24-31.jpg')

    );

});






Route::get('/generate-password', function () {

    return Hash::make('kalianda');

});