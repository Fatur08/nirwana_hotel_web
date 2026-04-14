@extends('layouts.index')
@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #e8dbb9, #eaf3ff);
        font-family: 'Be Vietnam Pro', sans-serif;
        margin: 0;
        padding: 15px;
        min-height: 100vh;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .login-container {
        text-align: center;
        background: #e8dbb9;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .login-title {
        background: linear-gradient(135deg, #3a8dde, #1c6ed5);
        color: white;
        padding: 18px;
        border-radius: 10px;
        font-weight: bold;
        max-width: 100%;
        width: 100%;
        font-size: 20px;

        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .login-title h1 {
        margin: 0;
        font-size: 22px;
    }

    .role-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 10px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .role-card {
        background-color: #f8f9fa;
        color: black;
        border-radius: 10px;
        padding: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .role-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        max-width: 100%;
        width: 100%;
    }

    .role-card img {
        max-width: 100%;
        width: 100%;
        height: 93px;
        object-fit: contain;
    }

    .role-card button {
        max-width: 100%;
        width: 100%;
        border-radius: 10px;
        font-size: 20px;
    }

    .kotak-cari {
        background-color: #4fce05ff;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        margin-bottom: 10px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .kotak-dlx {
        background: linear-gradient(to right, #ea3438, #f39c12, #28a745);
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        margin-bottom: 10px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .kotak-spr {
        background: linear-gradient(to right, #99caeb, #5daee6, #f39c12);
        color: black;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        margin-bottom: 10px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }

    .kotak-std {
        background: linear-gradient(to right, #f6df07, #f4c20d, #ff7f50, #c0392b, #8e44ad);
        color: black;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        margin-bottom: 10px;
        max-width: 100%;
        width: 100%;
        font-size: 20px;
    }


    /* === Table Style === */
    .custom-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        background-color: #ffffff;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #007bff, #00bcd4);
        color: white;
        text-align: center;
        font-weight: 600;
        font-size: 15px;
        letter-spacing: 0.5px;
        padding: 12px;
        border: none;
    }

    .custom-table thead tr:first-child th {
        background: linear-gradient(135deg, #0069d9, #17a2b8);
        font-size: 17px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .custom-table tbody td,
    .custom-table tbody th {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #dee2e6;
        font-size: 16px;
        color: #333;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .custom-table tbody tr:hover {
        background-color: #e9f5ff;
        transition: 0.3s;
    }

    .table-container {
        max-width: 1600px;
    }




    .table-garis {
        border-collapse: collapse;
        width: 100%;
    }

    .table-garis th,
    .table-garis td {
        border: 1px solid black;
        padding: 8px;
    }




    .table-custom {
        width: 100%;
        border: 1px solid black;
        /* border luar saja */
        border-collapse: collapse;
    }

    .table-custom td,
    .table-custom th {
        border: none;
        /* hilangkan semua garis dalam */
        padding: 6px;
    }

    /* KHUSUS HEADER KAMAR DELUXE */
    .table-custom .header-kamar {
        border: 1px solid black;
        font-size: 24px;
        font-weight: bold;
    }



    /* KHUSUS SAAT PDF */
    .mode-pdf {
        width: 105mm !important;
        height: 148mm !important;
        overflow: hidden;
        padding: 10px;
        box-sizing: border-box;
        font-size: 12px;
    }

    /* kecilkan elemen hanya saat PDF */
    .mode-pdf h1 {
        font-size: 18px !important;
    }

    .mode-pdf h2 {
        font-size: 16px !important;
    }

    .mode-pdf img {
        max-height: 80px !important;
    }




    /* ================= PRINT RESI ================= */

    @media print {

        body {
            background: white !important;
            padding: 0;
            margin: 0;
            font-size: 12px;
            /* kecilkan biar muat A6 */
        }

        #area-print {
            width: 100%;
            max-width: 105mm;
            margin: auto;
        }

        table {
            page-break-inside: avoid;
        }

        tr,
        td,
        th {
            page-break-inside: avoid;
        }

    }
</style>
<div class="body" style="margin-top: 10px;">
    <div class="login-container">
        <div class="login-title">
            <h1>Aplikasi Manajemen<br>Hotel Nirwana</h1>
        </div>
        <img src="{{ asset('assets/img/Nirwana_Logo.png') }}"
            alt="Logo Hotel Nirwana"
            style="width:290px; height:220px; margin-bottom: 15px;">


        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif


        <div class="kotak-cari">
            <h1>Informasi Pemesanan</h1>
            <form action="/" method="GET" id="frmCariTanggal" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M16 3l0 4" />
                                    <path d="M8 3l0 4" />
                                    <path d="M4 11l16 0" />
                                    <path d="M8 15h2v2h-2z" />
                                </svg>
                            </span>
                            <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                            <input type="text"
                                id="check_in_tampil"
                                class="form-control flatpickr"
                                placeholder="Tanggal Check-In"
                                autocomplete="off"
                                style="font-size:16pt;">
                            <!-- INPUT ASLI UNTUK DATABASE -->
                            <input type="hidden" id="cari_check_in" name="cari_check_in">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M16 3l0 4" />
                                    <path d="M8 3l0 4" />
                                    <path d="M4 11l16 0" />
                                    <path d="M8 15h2v2h-2z" />
                                </svg>
                            </span>
                            <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                            <input type="text"
                                id="check_out_tampil"
                                class="form-control flatpickr"
                                placeholder="Tanggal Check-Out"
                                autocomplete="off"
                                style="font-size:16pt;">
                            <!-- INPUT ASLI UNTUK DATABASE -->
                            <input type="hidden" id="cari_check_out" name="cari_check_out">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <select id="status" name="status" class="form-control" style="font-size:16pt;">
                            <option value="">-- Pilih Status --</option>
                            <option value="booking">Booking</option>
                            <option value="check_in">Check-In</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success w-100"
                            type="submit"
                            style="font-size:16pt; padding:10px;">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tamu</th>
                            <th>Status</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Resi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histori as $no => $row)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $row->nama_tamu }}</td>
                            <td>
                                @if($row->status == 'booking')
                                <span class="badge bg-secondary">Booking</span>
                                @else
                                <span class="badge bg-success">Check-In</span>
                                @endif
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->check_in)->translatedFormat('d F Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->check_out)->translatedFormat('d F Y') }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#"
                                        class="ModalResi btn btn-success"
                                        id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="ModalInfo btn btn-secondary"
                                        id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </a>
                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center">
                                Tidak ada data pemesanan
                            </td>

                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



        <div class="kotak-dlx mt-3 p-3">
            <div class="row align-items-center">

                <!-- FOTO -->
                <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
                </div>

                <!-- KONTEN KAMAR -->
                <div class="col-md-6 col-12 text-start">
                    <h1 class="mb-1">Kamar Deluxe</h1>
                    <p class="mb-1">
                        Tersedia <br>
                        {{ $kamarSingleDLX }} Kamar Single Bed
                        <br>{{ $kamarDoubleDLX }} Kamar Double Bed
                    </p>
                    <p class="mb-0">
                        <span style="font-size:22px; font-weight:700; color:#00ff79;">Rp.300.000</span>
                        / malam
                    </p>
                </div>

                <!-- TOMBOL -->
                <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                    <a href="#"
                        class="TambahModalDLX btn btn-dark px-3 py-2"
                        style="font-size:14pt; white-space:nowrap;"
                        tipe_kamar="1">
                        Pesan Kamar
                    </a>
                </div>

            </div>
        </div>



        <div class="kotak-spr mt-3 p-3">
            <div class="row align-items-center">

                <!-- FOTO -->
                <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/img/kamar_superior.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
                </div>

                <!-- KONTEN KAMAR -->
                <div class="col-md-6 col-12 text-start">
                    <h1 class="mb-1">Kamar Superior</h1>
                    <p class="mb-1">
                        Tersedia <br>
                        {{ $kamarSingleSPR }} Kamar Single Bed
                        <br>{{ $kamarDoubleSPR }} Kamar Double Bed
                    </p>
                    <p class="mb-0">
                        <span style="font-size:22px; font-weight:700; color:#d68300;">Rp.280.000</span>
                        / malam
                    </p>
                </div>

                <!-- TOMBOL -->
                <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                    <a href="#"
                        class="TambahModalSPR btn btn-dark px-3 py-2"
                        style="font-size:14pt; white-space:nowrap;"
                        tipe_kamar="2">
                        Pesan Kamar
                    </a>
                </div>

            </div>
        </div>





        <div class="kotak-std mt-3 p-3">
            <div class="row align-items-center">

                <!-- FOTO -->
                <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/img/kamar_standar.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
                </div>

                <!-- KONTEN KAMAR -->
                <div class="col-md-6 col-12 text-start">
                    <h1 class="mb-1">Kamar Standar</h1>
                    <p class="mb-1">
                        Tersedia <br>
                        {{ $kamarSingleSTD }} Kamar Single Bed
                        <br>{{ $kamarDoubleSTD }} Kamar Double Bed
                    </p>
                    <p class="mb-0">
                        <span style="font-size:22px; font-weight:700; color:#8F00FF;">Rp.240.000</span>
                        / malam
                    </p>
                </div>

                <!-- TOMBOL -->
                <!-- TOMBOL -->
                <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                    <a href="#"
                        class="TambahModalSTD btn btn-dark px-3 py-2"
                        style="font-size:14pt; white-space:nowrap;"
                        tipe_kamar="3">
                        Pesan Kamar
                    </a>
                </div>

            </div>
        </div>





        <!-- BAGIAN KAMAR DELUXE (DLX) -->
        <!-- Modal Tambah Kamar Deluxe (DLX) -->
        <div class="modal fade" id="modal-DLX" tabindex="-1" aria-labelledby="TambahModalDLXLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="TambahModalDLXLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Deluxe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="loadTambahModalDLX">
                    </div>
                </div>
            </div>
        </div>











        <!-- BAGIAN KAMAR SUPERIOR (SPR) -->
        <!-- Modal Tambah Kamar Superior (SPR) -->
        <div class="modal fade" id="modal-SPR" tabindex="-1" aria-labelledby="TambahModalSPRLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="TambahModalSPRLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Superior</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="loadTambahModalSPR">
                    </div>
                </div>
            </div>
        </div>
















        <!-- BAGIAN KAMAR STANDAR (STD) -->
        <!-- Modal Tambah Kamar Standar (STD) -->
        <div class="modal fade" id="modal-STD" tabindex="-1" aria-labelledby="TambahModalSTDLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="TambahModalSTDLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Standar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="loadTambahModalSTD">
                    </div>
                </div>
            </div>
        </div>































        <!-- Modal Informasi Pemesanan -->
        <div class="modal fade" id="modal-info" tabindex="-1" aria-labelledby="ModalInfoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title" id="ModalInfoLabel" style="font-size:16pt;">Informasi Pemesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="loadModalInfo">
                    </div>
                </div>
            </div>
        </div>






        <!-- Modal Resi -->
        <div class="modal fade" id="modal-resi" tabindex="-1" aria-labelledby="ModalResiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="ModalResiLabel" style="font-size:16pt;">Resi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="loadModalResi">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('myscript')
    <script>
        // BAGIAN DARI FORM PENCARIAN TANGGAL
        $(document).on('focus', '.flatpickr', function() {

            $(this).datepicker({
                format: "dd MM yyyy",
                autoclose: true,
                todayHighlight: true,
                language: "id"
            }).on('changeDate', function(e) {

                let tanggalDB = e.format('yyyy-mm-dd');

                // FORM PENCARIAN
                if ($(this).attr('id') === 'check_in_tampil') {
                    $('#cari_check_in').val(tanggalDB);
                } else if ($(this).attr('id') === 'check_out_tampil') {
                    $('#cari_check_out').val(tanggalDB);
                }

                // FORM MODAL DLX
                else if ($(this).attr('id') === 'check_in_tampil_dlx') {
                    $('#check_in_dlx').val(tanggalDB).trigger('change');
                } else if ($(this).attr('id') === 'check_out_tampil_dlx') {
                    $('#check_out_dlx').val(tanggalDB);
                }


                // FORM MODAL SPR
                else if ($(this).attr('id') === 'check_in_tampil_spr') {
                    $('#check_in_spr').val(tanggalDB).trigger('change');
                } else if ($(this).attr('id') === 'check_out_tampil_spr') {
                    $('#check_out_spr').val(tanggalDB);
                }


                // FORM MODAL STD
                else if ($(this).attr('id') === 'check_in_tampil_std') {
                    $('#check_in_std').val(tanggalDB).trigger('change');
                } else if ($(this).attr('id') === 'check_out_tampil_std') {
                    $('#check_out_std').val(tanggalDB);
                }

            });

        });




        document.addEventListener("DOMContentLoaded", function() {

            let today = new Date();

            let yyyy = today.getFullYear();
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let dd = String(today.getDate()).padStart(2, '0');

            let formatDB = `${yyyy}-${mm}-${dd}`;

            let bulanIndo = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            let formatView = `${dd} ${bulanIndo[today.getMonth()]} ${yyyy}`;

            // INPUT TAMPILAN
            if (document.getElementById("check_in_tampil"))
                document.getElementById("check_in_tampil").value = formatView;

            if (document.getElementById("check_out_tampil"))
                document.getElementById("check_out_tampil").value = formatView;

            if (document.getElementById("check_in_tampil_dlx"))
                document.getElementById("check_in_tampil_dlx").value = formatView;

            if (document.getElementById("check_out_tampil_dlx"))
                document.getElementById("check_out_tampil_dlx").value = formatView;

            if (document.getElementById("check_in_tampil_spr"))
                document.getElementById("check_in_tampil_spr").value = formatView;

            if (document.getElementById("check_out_tampil_spr"))
                document.getElementById("check_out_tampil_spr").value = formatView;

            if (document.getElementById("check_in_tampil_std"))
                document.getElementById("check_in_tampil_std").value = formatView;

            if (document.getElementById("check_out_tampil_std"))
                document.getElementById("check_out_tampil_std").value = formatView;


            // INPUT DATABASE
            if (document.getElementById("cari_check_in"))
                document.getElementById("cari_check_in").value = formatDB;

            if (document.getElementById("cari_check_out"))
                document.getElementById("cari_check_out").value = formatDB;

            if (document.getElementById("check_in_dlx"))
                document.getElementById("check_in_dlx").value = formatDB;

            if (document.getElementById("check_out_dlx"))
                document.getElementById("check_out_dlx").value = formatDB;

            if (document.getElementById("check_in_spr"))
                document.getElementById("check_in_spr").value = formatDB;

            if (document.getElementById("check_out_spr"))
                document.getElementById("check_out_spr").value = formatDB;

            if (document.getElementById("check_in_std"))
                document.getElementById("check_in_std").value = formatDB;

            if (document.getElementById("check_out_std"))
                document.getElementById("check_out_std").value = formatDB;

        });


















        // BAGIAN DARI FORM TAMBAH MODAL DELUXE
        $(document).on('click', '.TambahModalDLX', function(e) {
            e.preventDefault();

            let tipe = $(this).attr('tipe_kamar');

            $.ajax({
                type: 'POST',
                url: '/TambahModalDLX',
                data: {
                    _token: "{{ csrf_token() }}",
                    tipe_kamar: tipe
                },
                success: function(respond) {
                    $("#loadTambahModalDLX").html(respond);
                    $("#modal-DLX").modal("show");

                    // default isi dropdown
                    $('#jumlah_kamar_dipesan_dlx').html(`
                <option style="font-size:16pt;" value="">
                    Silakan pilih tanggal check-in
                </option>
            `);
                }
            });
        });



        $(document).on('change', '#check_in_dlx', function() {

            let tanggal = $(this).val();
            let tipe = 1; // DLX

            if (!tanggal) {
                $('#jumlah_kamar_dipesan_dlx').html(`
            <option style="font-size:16pt;" value="">
                Silakan pilih tanggal check-in
            </option>
        `);
                return;
            }

            $.ajax({
                url: '/getKamarTersedia',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("RESPON FINAL:", res);

                    if (!res || res.length === 0) {
                        $('#jumlah_kamar_dipesan_dlx').html(`
                    <option style="font-size:16pt;" value="">
                        Kamar Penuh
                    </option>
                `);
                        return;
                    }

                    let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;

                    for (let i = 1; i <= res.length; i++) {
                        opt += `<option style="font-size:16pt;" value="${i}">${i} Kamar</option>`;
                    }

                    $('#jumlah_kamar_dipesan_dlx').html(opt);

                    // simpan data kamar
                    window.kamar = res;
                }
            });

        });


        // ✅ RESET SAAT MODAL DIBUKA
        $(document).on('shown.bs.modal', '#modal-DLX', function() {

            $('#list_nomor_kamar_dlx').html('');

            $('#kamar_tersedia_title_dlx').hide();
            $('#kamar_tersedia_list_dlx').hide();

            window.kamar = [];
        });


        // ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
        $(document).on('change', '#jumlah_kamar_dipesan_dlx', function() {

            let jumlah = parseInt($(this).val());
            let list = $('#list_nomor_kamar_dlx');

            if (jumlah && jumlah > 0) {
                $('#kamar_tersedia_title_dlx').show();
                $('#kamar_tersedia_list_dlx').show();
            } else {
                $('#kamar_tersedia_title_dlx').hide();
                $('#kamar_tersedia_list_dlx').hide();
            }

            let tipe = 1;
            let tanggal = $('#check_in_dlx').val();

            list.html('');

            if (!jumlah || jumlah < 1) return;

            for (let i = 1; i <= jumlah; i++) {

                let selectHTML = `
        <div class="mb-2">
            <label style="font-size:16pt;">Jenis Bed ${i}</label>
            <select name="jenis_bed[]" class="form-control select-bed-dlx" style="font-size:16pt;">
                <option value="">-- Pilih Jenis Bed --</option>
            </select>
        </div>
        `;

                list.append(selectHTML);
            }

            $.ajax({
                type: 'POST',
                url: "/getKamarTersedia",
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("DATA KAMAR:", res);

                    let single = res.filter(k => k.jenis_bed == 1).length;
                    let dbl = res.filter(k => k.jenis_bed == 2).length;

                    console.log("STOK SINGLE:", single);
                    console.log("STOK DOUBLE:", dbl);

                    window.stokBedDLX = {
                        single: single,
                        double: dbl
                    };

                    setTimeout(function() {
                        updateBedSelectDLX();
                    }, 100);
                }
            });

        });



        function updateBedSelectDLX() {

            let usedSingle = 0;
            let usedDouble = 0;

            $('.select-bed-dlx').each(function() {

                let val = $(this).val();

                if (val == 1) usedSingle++;
                if (val == 2) usedDouble++;

            });

            $('.select-bed-dlx').each(function() {

                let current = $(this).val();
                let select = $(this);

                select.empty();

                select.append(`<option value="">-- Pilih Jenis Bed --</option>`);

                // Single Bed
                if (window.stokBedDLX.single - usedSingle > 0 || current == 1) {
                    select.append(`<option value="1">Single Bed</option>`);
                }

                // Double Bed
                if (window.stokBedDLX.double - usedDouble > 0 || current == 2) {
                    select.append(`<option value="2">Double Bed</option>`);
                }

                if (current) {
                    select.val(current);
                }

            });

        }

        $(document).on('change', '.select-bed-dlx', function() {
            updateBedSelectDLX();
        });



        // ✅ REQUEST EXTRA BED / BREAKFAST
        $(document).on('change', '#request_dlx', function() {

            let value = $(this).val();
            let biaya = 0;

            if (value === 'extra_bed') {
                biaya = 150000;
            } else if (value === 'breakfast') {
                biaya = 50000;
            }

            if (value !== '') {
                $('#biaya_container_dlx').show();
                $('#biaya_input_container_dlx').show();

                $('#biaya_request_dlx').val('Rp ' + biaya.toLocaleString('id-ID'));
                $('#biaya_request_value_dlx').val(biaya);
            } else {
                $('#biaya_container_dlx').hide();
                $('#biaya_input_container_dlx').hide();
                $('#biaya_request_dlx').val('');
                $('#biaya_request_value_dlx').val('');
            }

        });




        $(document).on('change', '#metode_pembayaran_dlx', function() {

            let metode = $(this).val();

            if (metode === 'online') {
                $('#sumber_pembayaran_container_dlx').show();
                $('#sumber_pembayaran_input_dlx').show();
            } else {
                $('#sumber_pembayaran_container_dlx').hide();
                $('#sumber_pembayaran_input_dlx').hide();
                $('#sumber_pembayaran_dlx').val('');
            }

        });



        $(document).on('submit', '#frmTambahModalDLX', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {

                    alert('Data berhasil disimpan');

                    $('#modal-DLX').modal('hide');

                    location.reload();

                },

                error: function(xhr) {

                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan');

                }
            });

        });


































        // BAGIAN DARI FORM TAMBAH MODAL SUPERIOR
        $(document).on('click', '.TambahModalSPR', function(e) {
            e.preventDefault();

            let tipe = $(this).attr('tipe_kamar');

            $.ajax({
                type: 'POST',
                url: '/TambahModalSPR',
                data: {
                    _token: "{{ csrf_token() }}",
                    tipe_kamar: tipe
                },
                success: function(respond) {
                    $("#loadTambahModalSPR").html(respond);
                    $("#modal-SPR").modal("show");

                    // default isi dropdown
                    $('#jumlah_kamar_dipesan_spr').html(`
                <option style="font-size:16pt;" value="">
                    Silakan pilih tanggal check-in
                </option>
            `);
                }
            });
        });



        $(document).on('change', '#check_in_spr', function() {

            let tanggal = $(this).val();
            let tipe = 2; // SPR

            if (!tanggal) {
                $('#jumlah_kamar_dipesan_spr').html(`
            <option style="font-size:16pt;" value="">
                Silakan pilih tanggal check-in
            </option>
        `);
                return;
            }

            $.ajax({
                url: '/getKamarTersedia',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("RESPON FINAL:", res);

                    if (!res || res.length === 0) {
                        $('#jumlah_kamar_dipesan_spr').html(`
                    <option style="font-size:16pt;" value="">
                        Kamar Penuh
                    </option>
                `);
                        return;
                    }

                    let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;

                    for (let i = 1; i <= res.length; i++) {
                        opt += `<option style="font-size:16pt;" value="${i}">${i} Kamar</option>`;
                    }

                    $('#jumlah_kamar_dipesan_spr').html(opt);

                    // simpan data kamar
                    window.kamar = res;
                }
            });

        });


        // ✅ RESET SAAT MODAL DIBUKA
        $(document).on('shown.bs.modal', '#modal-SPR', function() {

            $('#list_nomor_kamar_spr').html('');

            $('#kamar_tersedia_title_spr').hide();
            $('#kamar_tersedia_list_spr').hide();

            window.kamar = [];
        });


        // ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
        $(document).on('change', '#jumlah_kamar_dipesan_spr', function() {

            let jumlah = parseInt($(this).val());
            let list = $('#list_nomor_kamar_spr');

            if (jumlah && jumlah > 0) {
                $('#kamar_tersedia_title_spr').show();
                $('#kamar_tersedia_list_spr').show();
            } else {
                $('#kamar_tersedia_title_spr').hide();
                $('#kamar_tersedia_list_spr').hide();
            }

            let tipe = 2;
            let tanggal = $('#check_in_spr').val();

            list.html('');

            if (!jumlah || jumlah < 1) return;

            for (let i = 1; i <= jumlah; i++) {

                let selectHTML = `
        <div class="mb-2">
            <label style="font-size:16pt;">Jenis Bed ${i}</label>
            <select name="jenis_bed[]" class="form-control select-bed-spr" style="font-size:16pt;">
                <option value="">-- Pilih Jenis Bed --</option>
            </select>
        </div>
        `;

                list.append(selectHTML);
            }

            $.ajax({
                type: 'POST',
                url: "/getKamarTersedia",
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("DATA KAMAR:", res);

                    let single = res.filter(k => k.jenis_bed == 1).length;
                    let dbl = res.filter(k => k.jenis_bed == 2).length;

                    console.log("STOK SINGLE:", single);
                    console.log("STOK DOUBLE:", dbl);

                    window.stokBedSPR = {
                        single: single,
                        double: dbl
                    };

                    setTimeout(function() {
                        updateBedSelectSPR();
                    }, 100);
                }
            });

        });



        function updateBedSelectSPR() {

            let usedSingle = 0;
            let usedDouble = 0;

            $('.select-bed-spr').each(function() {

                let val = $(this).val();

                if (val == 1) usedSingle++;
                if (val == 2) usedDouble++;

            });

            $('.select-bed-spr').each(function() {

                let current = $(this).val();
                let select = $(this);

                select.empty();

                select.append(`<option value="">-- Pilih Jenis Bed --</option>`);

                // Single Bed
                if (window.stokBedSPR.single - usedSingle > 0 || current == 1) {
                    select.append(`<option value="1">Single Bed</option>`);
                }

                // Double Bed
                if (window.stokBedSPR.double - usedDouble > 0 || current == 2) {
                    select.append(`<option value="2">Double Bed</option>`);
                }

                if (current) {
                    select.val(current);
                }

            });

        }

        $(document).on('change', '.select-bed-spr', function() {
            updateBedSelectSPR();
        });



        // ✅ REQUEST EXTRA BED / BREAKFAST
        $(document).on('change', '#request_spr', function() {

            let value = $(this).val();
            let biaya = 0;

            if (value === 'extra_bed') {
                biaya = 150000;
            } else if (value === 'breakfast') {
                biaya = 50000;
            }

            if (value !== '') {
                $('#biaya_container_spr').show();
                $('#biaya_input_container_spr').show();

                $('#biaya_request_spr').val('Rp ' + biaya.toLocaleString('id-ID'));
                $('#biaya_request_value_spr').val(biaya);
            } else {
                $('#biaya_container_spr').hide();
                $('#biaya_input_container_spr').hide();
                $('#biaya_request_spr').val('');
                $('#biaya_request_value_spr').val('');
            }

        });



        $(document).on('change', '#metode_pembayaran_spr', function() {

            let metode = $(this).val();

            if (metode === 'online') {
                $('#sumber_pembayaran_container_spr').show();
                $('#sumber_pembayaran_input_spr').show();
            } else {
                $('#sumber_pembayaran_container_spr').hide();
                $('#sumber_pembayaran_input_spr').hide();
                $('#sumber_pembayaran_spr').val('');
            }

        });




        $(document).on('submit', '#frmTambahModalSPR', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {

                    alert('Data berhasil disimpan');

                    $('#modal-SPR').modal('hide');

                    location.reload();

                },

                error: function(xhr) {

                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan');

                }
            });

        });




















        // BAGIAN DARI FORM TAMBAH MODAL STANDAR
        $(document).on('click', '.TambahModalSTD', function(e) {
            e.preventDefault();

            let tipe = $(this).attr('tipe_kamar');

            $.ajax({
                type: 'POST',
                url: '/TambahModalSTD',
                data: {
                    _token: "{{ csrf_token() }}",
                    tipe_kamar: tipe
                },
                success: function(respond) {
                    $("#loadTambahModalSTD").html(respond);
                    $("#modal-STD").modal("show");

                    // default isi dropdown
                    $('#jumlah_kamar_dipesan_std').html(`
                <option style="font-size:16pt;" value="">
                    Silakan pilih tanggal check-in
                </option>
            `);
                }
            });
        });



        $(document).on('change', '#check_in_std', function() {

            let tanggal = $(this).val();
            let tipe = 3; // STD

            if (!tanggal) {
                $('#jumlah_kamar_dipesan_std').html(`
            <option style="font-size:16pt;" value="">
                Silakan pilih tanggal check-in
            </option>
        `);
                return;
            }

            $.ajax({
                url: '/getKamarTersedia',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("RESPON FINAL:", res);

                    if (!res || res.length === 0) {
                        $('#jumlah_kamar_dipesan_std').html(`
                    <option style="font-size:16pt;" value="">
                        Kamar Penuh
                    </option>
                `);
                        return;
                    }

                    let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;

                    for (let i = 1; i <= res.length; i++) {
                        opt += `<option style="font-size:16pt;" value="${i}">${i} Kamar</option>`;
                    }

                    $('#jumlah_kamar_dipesan_std').html(opt);

                    // simpan data kamar
                    window.kamar = res;
                }
            });

        });


        // ✅ RESET SAAT MODAL DIBUKA
        $(document).on('shown.bs.modal', '#modal-STD', function() {

            $('#list_nomor_kamar_std').html('');

            $('#kamar_tersedia_title_std').hide();
            $('#kamar_tersedia_list_std').hide();

            window.kamar = [];
        });


        // ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
        $(document).on('change', '#jumlah_kamar_dipesan_std', function() {

            let jumlah = parseInt($(this).val());
            let list = $('#list_nomor_kamar_std');

            if (jumlah && jumlah > 0) {
                $('#kamar_tersedia_title_std').show();
                $('#kamar_tersedia_list_std').show();
            } else {
                $('#kamar_tersedia_title_std').hide();
                $('#kamar_tersedia_list_std').hide();
            }

            let tipe = 3;
            let tanggal = $('#check_in_std').val();

            list.html('');

            if (!jumlah || jumlah < 1) return;

            for (let i = 1; i <= jumlah; i++) {

                let selectHTML = `
        <div class="mb-2">
            <label style="font-size:16pt;">Jenis Bed ${i}</label>
            <select name="jenis_bed[]" class="form-control select-bed-std" style="font-size:16pt;">
                <option value="">-- Pilih Jenis Bed --</option>
            </select>
        </div>
        `;

                list.append(selectHTML);
            }

            $.ajax({
                type: 'POST',
                url: "/getKamarTersedia",
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res) {

                    console.log("DATA KAMAR:", res);

                    let single = res.filter(k => k.jenis_bed == 1).length;
                    let dbl = res.filter(k => k.jenis_bed == 2).length;

                    console.log("STOK SINGLE:", single);
                    console.log("STOK DOUBLE:", dbl);

                    window.stokBedSTD = {
                        single: single,
                        double: dbl
                    };

                    setTimeout(function() {
                        updateBedSelectSTD();
                    }, 100);
                }
            });

        });



        function updateBedSelectSTD() {

            let usedSingle = 0;
            let usedDouble = 0;

            $('.select-bed-std').each(function() {

                let val = $(this).val();

                if (val == 1) usedSingle++;
                if (val == 2) usedDouble++;

            });

            $('.select-bed-std').each(function() {

                let current = $(this).val();
                let select = $(this);

                select.empty();

                select.append(`<option value="">-- Pilih Jenis Bed --</option>`);

                // Single Bed
                if (window.stokBedSTD.single - usedSingle > 0 || current == 1) {
                    select.append(`<option value="1">Single Bed</option>`);
                }

                // Double Bed
                if (window.stokBedSTD.double - usedDouble > 0 || current == 2) {
                    select.append(`<option value="2">Double Bed</option>`);
                }

                if (current) {
                    select.val(current);
                }

            });

        }

        $(document).on('change', '.select-bed-std', function() {
            updateBedSelectSTD();
        });



        // ✅ REQUEST EXTRA BED / BREAKFAST
        $(document).on('change', '#request_std', function() {

            let value = $(this).val();
            let biaya = 0;

            if (value === 'extra_bed') {
                biaya = 150000;
            } else if (value === 'breakfast') {
                biaya = 50000;
            }

            if (value !== '') {
                $('#biaya_container_std').show();
                $('#biaya_input_container_std').show();

                $('#biaya_request_std').val('Rp ' + biaya.toLocaleString('id-ID'));
                $('#biaya_request_value_std').val(biaya);
            } else {
                $('#biaya_container_std').hide();
                $('#biaya_input_container_std').hide();
                $('#biaya_request_std').val('');
                $('#biaya_request_value_std').val('');
            }

        });



        $(document).on('change', '#metode_pembayaran_std', function() {

            let metode = $(this).val();

            if (metode === 'online') {
                $('#sumber_pembayaran_container_std').show();
                $('#sumber_pembayaran_input_std').show();
            } else {
                $('#sumber_pembayaran_container_std').hide();
                $('#sumber_pembayaran_input_std').hide();
                $('#sumber_pembayaran_std').val('');
            }

        });




        $(document).on('submit', '#frmTambahModalSTD', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {

                    alert('Data berhasil disimpan');

                    $('#modal-SPR').modal('hide');

                    location.reload();

                },

                error: function(xhr) {

                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan');

                }
            });

        });












        // BAGIAN DARI MODAL INFO
        $(document).on('click', '.ModalInfo', function(e) {
            e.preventDefault();

            let id = $(this).attr('id_laporan_keuangan');

            $.ajax({
                type: 'POST',
                url: '/ModalInfo',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_laporan_keuangan: id
                },
                success: function(respond) {
                    $("#loadModalInfo").html(respond);
                    $("#modal-info").modal("show");
                }
            });
        });














        // BAGIAN DARI MODAL RESI
        $(document).on('click', '.ModalResi', function(e) {
            e.preventDefault();

            let id = $(this).attr('id_laporan_keuangan');

            $.ajax({
                type: 'POST',
                url: '/ModalResi',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_laporan_keuangan: id
                },
                success: function(respond) {
                    $("#loadModalResi").html(respond);
                    $("#modal-resi").modal("show");
                }
            });
        });








        function printResi() {

            var isi = document.getElementById("area-print").innerHTML;

            var frame = document.createElement('iframe');
            frame.style.position = "absolute";
            frame.style.top = "-1000000px";

            document.body.appendChild(frame);

            var frameDoc = frame.contentWindow.document;

            frameDoc.open();
            frameDoc.write(`
        <html>
        <head>
            <title>Print Resi</title>
            <style>
                body{
                    font-family: Arial;
                    font-size:14px;
                    padding:20px;
                }
            </style>
        </head>
        <body>
            ${isi}
        </body>
        </html>
    `);
            frameDoc.close();

            frame.contentWindow.focus();
            frame.contentWindow.print();

            setTimeout(function() {
                document.body.removeChild(frame);
            }, 1000);
        }









        function cetakPDF() {

            let element = document.getElementById('area-print');

            // 👉 tambahkan class khusus
            element.classList.add('mode-pdf');

            let opt = {
                margin: 0,
                filename: 'resi.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 1.5
                },
                jsPDF: {
                    unit: 'mm',
                    format: [105, 148],
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                // 👉 hapus lagi biar modal normal
                element.classList.remove('mode-pdf');
            });
        }















        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @endpush