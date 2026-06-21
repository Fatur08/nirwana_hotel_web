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
                                    Rp.300.000
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
                                {{ $kamarSingleSTD }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleSTD }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#8F00FF;">
                                    Rp.800.000
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
                                    Rp.280.000
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
                                    Rp.240.000
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









            <div class="kotak-cari mt-3">
                <h1>Informasi Pemesanan</h1>
                <form action="/" method="GET" id="frmCariTanggal" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M16 3l0 4" />
                                        <path d="M8 3l0 4" />
                                        <path d="M4 11l16 0" />
                                        <path d="M8 15h2v2h-2z" />
                                    </svg>
                                </span>
                                <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                                <input type="text" id="check_in_tampil" class="form-control flatpickr w-100"
                                    placeholder="Tanggal Check-In" autocomplete="off" readonly style="font-size:16pt;">
                                <!-- INPUT ASLI UNTUK DATABASE -->
                                <input type="hidden" id="cari_check_in" name="cari_check_in">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M16 3l0 4" />
                                        <path d="M8 3l0 4" />
                                        <path d="M4 11l16 0" />
                                        <path d="M8 15h2v2h-2z" />
                                    </svg>
                                </span>
                                <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                                <input type="text" id="check_out_tampil" class="form-control flatpickr w-100"
                                    placeholder="Tanggal Check-Out" autocomplete="off" readonly style="font-size:16pt;">
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
                            <button class="btn btn-success w-100" type="submit" style="font-size:16pt; padding:10px;">
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
                                            <a href="#" class="ModalResi btn btn-success"
                                                id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                    <path
                                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                </svg>
                                            </a>
                                            <a href="#" class="ModalInfo btn btn-secondary"
                                                id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
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
                        <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded"
                            style="max-height:120px;">
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
                        <a href="#" class="TambahModalDLX btn btn-dark px-3 py-2"
                            style="font-size:14pt; white-space:nowrap;" tipe_kamar="1">
                            Pesan Kamar
                        </a>
                    </div>

                </div>
            </div>



            <div class="kotak-spr mt-3 p-3">
                <div class="row align-items-center">

                    <!-- FOTO -->
                    <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/kamar_superior.jpg') }}" class="img-fluid rounded"
                            style="max-height:120px;">
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
                        <a href="#" class="TambahModalSPR btn btn-dark px-3 py-2"
                            style="font-size:14pt; white-space:nowrap;" tipe_kamar="2">
                            Pesan Kamar
                        </a>
                    </div>

                </div>
            </div>





            <div class="kotak-std mt-3 p-3">
                <div class="row align-items-center">

                    <!-- FOTO -->
                    <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/kamar_standar.jpg') }}" class="img-fluid rounded"
                            style="max-height:120px;">
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
                        <a href="#" class="TambahModalSTD btn btn-dark px-3 py-2"
                            style="font-size:14pt; white-space:nowrap;" tipe_kamar="3">
                            Pesan Kamar
                        </a>
                    </div>

                </div>
            </div>





















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
















            <!-- BAGIAN KAMAR DELUXE (DLX) -->
            <!-- Modal Tambah Kamar Deluxe (DLX) -->
            <div class="modal fade" id="modal-DLX" tabindex="-1" aria-labelledby="TambahModalDLXLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="TambahModalDLXLabel" style="font-size:16pt;">Tambah Pemesanan Kamar
                                - Tipe Deluxe</h5>
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
                            <h5 class="modal-title" id="TambahModalSPRLabel" style="font-size:16pt;">Tambah Pemesanan Kamar
                                - Tipe Superior</h5>
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
                            <h5 class="modal-title" id="TambahModalSTDLabel" style="font-size:16pt;">Tambah Pemesanan Kamar
                                - Tipe Standar</h5>
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
            document.addEventListener("DOMContentLoaded", function () {

                const checkOutPicker = flatpickr("#check_out_tampil", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false
                });

                const checkInPicker = flatpickr("#check_in_tampil", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false,

                    onChange: function (selectedDates) {

                        if (!selectedDates.length) return;

                        let checkInDate = selectedDates[0];

                        // Simpan ke hidden input pencarian
                        $('#cari_check_in').val(
                            this.formatDate(checkInDate, "Y-m-d")
                        );

                        // Check-Out minimal H+1
                        let minCheckout = new Date(checkInDate);
                        minCheckout.setDate(minCheckout.getDate() + 1);

                        checkOutPicker.set('minDate', minCheckout);

                        // Reset pilihan check-out lama
                        checkOutPicker.clear();
                        $('#cari_check_out').val('');
                    }
                });

                checkOutPicker.config.onChange.push(function (selectedDates) {

                    if (!selectedDates.length) return;

                    $('#cari_check_out').val(
                        checkOutPicker.formatDate(selectedDates[0], "Y-m-d")
                    );

                });

                // =========================
                // DEFAULT TANGGAL HARI INI
                // =========================

                let today = new Date();

                let yyyy = today.getFullYear();
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let dd = String(today.getDate()).padStart(2, '0');

                let formatDB = `${yyyy}-${mm}-${dd}`;

                // Hidden input untuk pencarian
                $('#cari_check_in').val(formatDB);
                $('#cari_check_out').val(formatDB);

            });














            // MODAL PESAN KAMAR
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
                // Default kosong saat modal dibuka
                checkInPicker.clear();
                checkOutPicker.clear();

                $('#check_in').val('');
                $('#check_out').val('');

                $('#jumlah_kamar_dipesan').html(`
                                                                                                                                                        <option value="">
                                                                                                                                                            -- Pilih Tanggal Check In Dulu --
                                                                                                                                                        </option>
                                                                                                                                                    `);

                $('#kamar_tersedia_title').hide();
                $('#kamar_tersedia_list').hide();
                $('#list_nomor_kamar').html('');
            }

















            // BAGIAN DARI MODAL INFO
            $(document).on('click', '.ModalInfo', function (e) {
                e.preventDefault();

                let id = $(this).attr('id_laporan_keuangan');

                $.ajax({
                    type: 'POST',
                    url: '/ModalInfo',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_laporan_keuangan: id
                    },
                    success: function (respond) {
                        $("#loadModalInfo").html(respond);
                        $("#modal-info").modal("show");
                    }
                });
            });














            // BAGIAN DARI MODAL RESI
            $(document).on('click', '.ModalResi', function (e) {
                e.preventDefault();

                let id = $(this).attr('id_laporan_keuangan');

                $.ajax({
                    type: 'POST',
                    url: '/ModalResi',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_laporan_keuangan: id
                    },
                    success: function (respond) {
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

                setTimeout(function () {
                    document.body.removeChild(frame);
                }, 1000);
            }









            function cetakPDF() {

                let element = document.querySelector("#area-print");

                html2canvas(element, {
                    scale: 2,
                    useCORS: true
                }).then(canvas => {

                    let imgData = canvas.toDataURL('image/jpeg', 1.0);

                    // 🔥 ini yang benar
                    const {
                        jsPDF
                    } = window.jspdf;

                    let pdf = new jsPDF('p', 'mm', [105, 148]);

                    pdf.addImage(imgData, 'JPEG', 0, 0, 105, 148);

                    pdf.save("resi.pdf");
                });
            }















            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    @endpush