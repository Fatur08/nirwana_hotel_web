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
            overflow-x: auto;
        }








        /* Parent wajib */
        .input-icon {
            position: relative;
        }

        /* Calendar */
        .flatpickr-calendar {
            width: auto !important;
            max-width: none !important;
        }

        /* Hari */
        .flatpickr-day {
            height: 50px;
            line-height: 50px;
        }











        /* Semua input & select */
        .form-control,
        .form-select {
            height: 55px !important;
            font-size: 16px !important;
            line-height: normal !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            display: flex;
            align-items: center;
        }

        /* Khusus text di select biar benar-benar tengah */
        .form-select {
            display: block !important;
            line-height: 55px !important;
        }

        /* Flatpickr (input hasil clone) */
        .flatpickr-input {
            height: 55px !important;
            font-size: 16px !important;
            line-height: 55px !important;
        }

        /* Biar icon tidak ganggu alignment */
        .input-icon .form-control {
            padding-left: 40px;
        }

        /* Optional biar lebih halus */
        .form-control,
        .form-select,
        .flatpickr-input {
            border-radius: 8px;
        }












        /* BAGIAN STYLE INPUT KTP */
        /* Input file biar sejajar */
        input[type="file"].form-control {
            height: 55px !important;
            font-size: 16px !important;
            line-height: 55px !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            display: flex;
            align-items: center;
        }

        /* Tombol "Choose file" */
        input[type="file"]::file-selector-button {
            height: 55px;
            margin-right: 10px;
            border: none;
            background: #e9ecef;
            padding: 0 15px;
            cursor: pointer;
        }


        input[type="file"] {
            display: flex;
            align-items: center;
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
            font-size: 35px;
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

        .kotak-pesan {
            background-color: rgb(209, 209, 209);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
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



        .kotak-ketersediaan-kamar {
            background: linear-gradient(to right, #4facfe, #00c6ff, #43e97b);
            border-radius: 15px;
            cursor: pointer;
            transition: all .3s ease;
        }

        .kotak-ketersediaan-kamar:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .kotak-ketersediaan-kamar h1 {
            color: white;
            font-weight: bold;
        }






        .kotak-informasi-pemesanan {
            background: linear-gradient(to right, #43e97b, #38ef7d, #11998e);
            border-radius: 15px;
            cursor: pointer;
            transition: all .3s ease;
        }

        .kotak-informasi-pemesanan:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .kotak-informasi-pemesanan h1 {
            color: white;
            font-weight: bold;
        }







        .kotak-data-master {
            background: linear-gradient(to right, #667eea, #764ba2, #6a11cb);
            border-radius: 15px;
            cursor: pointer;
            transition: all .3s ease;
        }

        .kotak-data-master:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .kotak-data-master h1 {
            color: white;
            font-weight: bold;
        }






        .kotak-data-pengguna {
            background: linear-gradient(to right, #ffb347, #ff9800, #ff6f00);
            border-radius: 15px;
            cursor: pointer;
            transition: all .3s ease;
        }

        .kotak-data-pengguna:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .kotak-data-pengguna h1 {
            color: white;
            font-weight: bold;
        }







        /*
                                                        |--------------------------------------------------------------------------
                                                        | MENU LOGOUT
                                                        |--------------------------------------------------------------------------
                                                        */

        .kotak-logout {
            background: linear-gradient(to right,
                    #ff416c,
                    #ff4b2b,
                    #d32f2f);
            border-radius: 15px;
            cursor: pointer;
            transition: all .3s ease;
        }

        .kotak-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .kotak-logout h1 {
            color: white;
            font-weight: bold;
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
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }


        .kotak-hmsty {
            background: linear-gradient(to right, #0d6efd, #0dcaf0, #20c997);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 25px;
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
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
            padding: 10px;
            box-sizing: border-box;
            font-size: 12px;
            transform: scale(0.85);
            transform-origin: top left;
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

        #area-inner {
            transform: scale(0.88);
            /* 🔥 ini bisa kamu adjust */
            transform-origin: top center;
            width: 100%;
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
            <h1 style="color:red">
                DEVELOPMENT SERVER
            </h1>
            <div class="login-title">
                <h1>Aplikasi Manajemen<br>Hotel Nirwana</h1>
            </div>
            <img src="{{ asset('assets/img/Nirwana_Logo.png') }}" alt="Logo Hotel Nirwana"
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


            <div class="kotak-pesan">

                <div class="row">
                    <div class="col-12">
                        <a href="#" class="PesanKamar btn btn-dark w-100" style="font-size:35pt; white-space:nowrap;">
                            Pesan Kamar
                        </a>
                    </div>
                </div>

                <div class="row mt-3">

                    <!-- KAMAR DELUXE -->
                    <div class="col-6 mb-3">
                        <div class="kotak-dlx h-100 p-4 text-center">

                            <p class="mb-3">Kamar Deluxe</p>

                            <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $kamarSingleDLX }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleDLX }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#00ff79;">
                                    Rp.{{ number_format($tarifKamar['DLX']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>

                    <!-- HOME STAY -->
                    <div class="col-6 mb-3">
                        <div class="kotak-hmsty h-100 p-4 text-center">

                            <p class="mb-3">Home Stay</p>

                            <img src="{{ asset('assets/img/homestay.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $SingleHMSTY }} Kamar Single Bed
                                <br>
                                {{ $DoubleHMSTY }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#8F00FF;">
                                    Rp.{{ number_format($tarifKamar['HMSTY']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>
                </div>


                <div class="row mt-3">

                    <!-- KAMAR SUPERIOR -->
                    <div class="col-6 mb-3">
                        <div class="kotak-spr h-100 p-4 text-center">

                            <p class="mb-3">Kamar Superior</p>

                            <img src="{{ asset('assets/img/kamar_superior.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $kamarSingleSPR }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleSPR }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#f8f9fa;">
                                    Rp.{{ number_format($tarifKamar['SPR']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>

                    <!-- KAMAR STANDAR -->
                    <div class="col-6 mb-3">
                        <div class="kotak-std h-100 p-4 text-center">

                            <p class="mb-3">Kamar Standar</p>

                            <img src="{{ asset('assets/img/kamar_standar.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $kamarSingleSTD }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleSTD }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#8F00FF;">
                                    Rp.{{ number_format($tarifKamar['STD']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>
                </div>
            </div>


            <!-- MENU KETERSEDIAAN KAMAR -->
            <a href="{{ url('KetersediaanKamar') }}" class="kotak-ketersediaan-kamar mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/ketersediaan_kamar.png') }}" class="img-fluid"
                            style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Ketersediaan Kamar
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





            <!-- MENU INFORMASI PEMESANAN -->
            <a href="{{ url('InformasiPemesanan') }}"
                class="kotak-informasi-pemesanan mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/informasi_pemesanan.png') }}" class="img-fluid"
                            style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Informasi Pemesanan
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>






            <!-- MENU DATA MASTER -->
            <a href="{{ url('DataMaster') }}" class="kotak-data-master mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/data_master.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Data Master
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>









            <!-- MENU DATA PENGGUNA -->
            <a href="#" class="kotak-data-pengguna mt-3 p-3 d-block text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#ModalDataPengguna">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/data_pengguna.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Data Pengguna
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





            <!-- MENU LOGOUT -->
            <a href="#" id="btnLogout" class="kotak-logout mt-3 p-3 d-block text-decoration-none">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">

                    @csrf

                </form>
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/logout.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Logout
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





















            <!-- Modal Pesan Kamar -->
            <div class="modal fade" id="modal-pesan-kamar" tabindex="-1" aria-labelledby="ModalPesanKamar"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="ModalPesanKamar" style="font-size:20pt;">Tambah Pemesanan Kamar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="loadPesanKamar">
                        </div>
                    </div>
                </div>
            </div>





            <!-- Modal Data Pengguna -->
            <div class="modal fade" id="ModalDataPengguna" tabindex="-1" aria-labelledby="ModalDataPengguna"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="ModalPesanKamar" style="font-size:20pt;">Data Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-label fw-bold" style="font-size:20pt;">
                                Nama Pengguna
                            </label>
                            <input type="text" id="nama_pengguna_modal" class="form-control" style="font-size:20pt;"
                                readonly>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning text-white w-100" id="btnGantiPengguna" style="font-size:20pt;">
                                Ganti Pengguna
                            </button>

                            <button class="btn btn-secondary w-100" style="font-size:20pt;" data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </body>

@endsection
    @push('myscript')
        <script>
            // ======================================================
            // MODAL PESAN KAMAR
            // ======================================================
            $(document).on('click', '.PesanKamar', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/PesanKamar',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (respond) {

                        $("#loadPesanKamar").html(respond);

                        $("#modal-pesan-kamar").modal("show");

                        setTimeout(function () {
                            initPesanKamar();
                        }, 200);

                    }
                });
            });


            // ======================================================
            // INIT PESAN KAMAR
            // ======================================================
            function initPesanKamar() {

                const checkOutPicker = flatpickr("#check_out_pesan_kamar", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false
                });

                const checkInPicker = flatpickr("#check_in_pesan_kamar", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false,

                    onChange: function (selectedDates) {

                        if (!selectedDates.length) return;

                        let checkInDate = selectedDates[0];

                        $('#check_in').val(
                            this.formatDate(checkInDate, "Y-m-d")
                        );

                        let minCheckout = new Date(checkInDate);
                        minCheckout.setDate(minCheckout.getDate() + 1);

                        checkOutPicker.set('minDate', minCheckout);

                        checkOutPicker.clear();
                        $('#check_out').val('');

                        $('#jumlah_kamar_dipesan').html(`
                                                                                                                                                                                                                                                            <option value="">
                                                                                                                                                                                                                                                                -- Pilih Tanggal Check Out Dulu --
                                                                                                                                                                                                                                                            </option>
                                                                                                                                                                                                                                                        `);

                        $('#kamar_tersedia_title').hide();
                        $('#kamar_tersedia_list').hide();
                        $('#list_nomor_kamar').html('');
                    }
                });

                checkOutPicker.config.onChange.push(function (selectedDates) {

                    if (!selectedDates.length) return;

                    $('#check_out').val(
                        checkOutPicker.formatDate(selectedDates[0], "Y-m-d")
                    );

                    $.ajax({
                        type: 'POST',
                        url: '/getKamarTersedia',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            check_in: $('#check_in').val(),
                            check_out: $('#check_out').val()
                        },

                        success: function (response) {

                            let totalKamar = response.length;

                            let opsiJumlah =
                                '<option value="">-- Pilih Jumlah Kamar --</option>';

                            for (let i = 1; i <= totalKamar; i++) {

                                opsiJumlah += `
                                                                                                                                                                                                                                                                    <option value="${i}">
                                                                                                                                                                                                                                                                        ${i} Kamar
                                                                                                                                                                                                                                                                    </option>
                                                                                                                                                                                                                                                                `;

                            }

                            $('#jumlah_kamar_dipesan').html(opsiJumlah);

                        }

                    });

                });


                // ======================================================
                // RESET BOOKING
                // ======================================================
                function resetFormBooking() {

                    checkInPicker.clear();
                    checkOutPicker.clear();

                    $("#check_in_pesan_kamar").val("");
                    $("#check_out_pesan_kamar").val("");

                    $("#check_in").val("");
                    $("#check_out").val("");

                    $("#jumlah_kamar_dipesan").html(`
                                                                                                                                                                                                                                                        <option value="">
                                                                                                                                                                                                                                                            -- Pilih Tanggal Check In Dulu --
                                                                                                                                                                                                                                                        </option>
                                                                                                                                                                                                                                                    `);

                    $("#kamar_tersedia_title").hide();
                    $("#kamar_tersedia_list").hide();
                    $("#list_nomor_kamar").html("");

                    $("#jumlah_extra_bed").val("");
                    $("#jumlah_breakfast").val("");

                    $("#biaya_container").hide();
                    $("#biaya_input_container").hide();

                    $("#biaya_request").val("");
                    $("#biaya_request_value").val("");

                    $("#status_pembayaran").val("");
                    $("#metode_pembayaran").val("");
                    $("#sumber_pembayaran").val("");
                    $("#bukti_pembayaran").val("");

                    $("#metode_pembayaran_container").hide();
                    $("#metode_pembayaran_input").hide();

                    $("#sumber_pembayaran_container").hide();
                    $("#sumber_pembayaran_input").hide();

                    $("#bukti_pembayaran_container").hide();
                    $("#bukti_pembayaran_input").hide();

                    $("#formBooking").hide();

                }

                // supaya bisa dipanggil dari luar
                window.resetFormBooking = resetFormBooking;

                resetFormBooking();

            }


            // ======================================================
            // PILIH CUSTOMER
            // ======================================================
            $(document).off('click', '.pilihCustomer').on('click', '.pilihCustomer', function (e) {

                e.preventDefault();

                $("#id_customer_lama").val($(this).data('id'));

                $("#lama_nama_tamu").val($(this).data('nama'));
                $("#lama_alamat_tamu").text($(this).data('alamat'));
                $("#lama_no_wa").val($(this).data('wa'));

                if ($(this).data('foto')) {

                    $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                        <img src="/storage/uploads/foto_ktp/${$(this).data('foto')}"
                                                                                                                                                                                                                                                            class="img-fluid rounded"
                                                                                                                                                                                                                                                            style="max-height:250px;">
                                                                                                                                                                                                                                                    `);

                } else {

                    $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                        <div class="text-muted">
                                                                                                                                                                                                                                                            Tidak ada Foto KTP
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                    `);

                }

                $("#keyword_customer").val($(this).data('nama'));

                $("#hasilCustomer").hide();

                $("#dataCustomerLama").show();

                $("#formBooking").show();

                $("#gantiCustomer").show();

                $("#keyword_customer").prop("readonly", true);

            });


            // ======================================================
            // GANTI CUSTOMER
            // ======================================================
            $(document).off('click', '#gantiCustomer').on('click', '#gantiCustomer', function () {

                $("#keyword_customer").val("");
                $("#keyword_customer").prop("readonly", false);

                $("#id_customer_lama").val("");

                $("#lama_nama_tamu").val("");
                $("#lama_alamat_tamu").text("");
                $("#lama_no_wa").val("");

                $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                    <div class="text-muted">
                                                                                                                                                                                                                                                        Tidak ada Foto KTP
                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                `);

                $("#hasilCustomer").hide();
                $("#dataCustomerLama").hide();
                $("#gantiCustomer").hide();

                resetFormBooking();

                $("#keyword_customer").focus();

            });


            // ======================================================
            // MODAL DITUTUP
            // ======================================================
            $('#modal-pesan-kamar').on('hidden.bs.modal', function () {

                $(this).find('form').trigger('reset');

                if (typeof resetFormBooking === "function") {
                    resetFormBooking();
                }

                $("#hasilCustomer").hide();
                $("#dataCustomerLama").hide();

            });





            $('#ModalDataPengguna').on('show.bs.modal', function () {
                $('#nama_pengguna_modal').val(
                    getNamaPengguna()
                );
            });



            $('#btnGantiPengguna').click(function () {
                localStorage.removeItem('nama_pengguna');
                location.reload();
            });






            /*
            |--------------------------------------------------------------------------
            | Logout
            |--------------------------------------------------------------------------
            */
            const btnLogout = document.getElementById('btnLogout');
            if (btnLogout) {
                btnLogout.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Logout',
                        text: 'Apakah Anda yakin ingin keluar dari sistem?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d32f2f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Logout',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logoutForm').submit();
                        }
                    });
                });
            }
        </script>
    @endpush