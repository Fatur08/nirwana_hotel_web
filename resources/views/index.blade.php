@extends('layouts.index')
@section('content')
    <div class="body" style="margin-top: 10px;">
        <div class="login-container">
            <div class="login-title">
                <h1>Aplikasi Manajemen<br>Hotel Nirwana Tes</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center position-relative mb-3">

                {{-- Logo Hotel --}}
                <img src="{{ asset('assets/img/Nirwana_Logo.png') }}" alt="Logo Hotel Nirwana"
                    style="width:290px; height:220px;">

                {{-- Tombol Notifikasi --}}
                <div class="dropdown position-absolute" style="
                                        right:20px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        z-index:1000;
                                    ">

                    <button class="btn-notifikasi" id="btnNotifikasi" data-bs-toggle="dropdown" aria-expanded="false">

                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                            <path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5" />

                            <path d="M9 17a3 3 0 0 0 6 0" />

                        </svg>

                    </button>

                    <div class="dropdown-menu dropdown-menu-end shadow-lg p-0 mt-3" id="dropdownNotifikasi">

                        <div class="p-4 text-center">

                            <h5 class="fw-bold mb-2">

                                Activity Log

                            </h5>

                            <p class="text-muted mb-0">

                                Belum ada aktivitas.

                            </p>

                        </div>

                    </div>

                </div>

            </div>


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
        <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
        </body>

@endsection
    @push('myscript')
        <script src="{{ asset('assets/js/index.js') }}"></script>
    @endpush