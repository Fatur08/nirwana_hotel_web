@extends('layouts.tentang-kami')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/tentang-kami.css') }}">

    <div class="container py-5">

        <div class="hero-section">

            <div class="hero-card">

                <div class="logo-area">

                    <img src="{{ asset('assets/img/nirwana_hotel.png') }}" class="logo-hotel" alt="Logo Nirwana Hotel">

                </div>

                <h1 class="judul-hotel">
                    NIRWANA GUEST HOUSE
                </h1>

                <p class="subjudul">
                    Sistem Manajemen Reservasi Hotel
                </p>

            </div>

        </div>





        <div class="row justify-content-center mt-5">

            <div class="col-lg-9">

                <div class="info-card">

                    <h2>
                        Tentang Usaha
                    </h2>

                    <hr>

                    <p class="deskripsi">

                        <strong>NIRWANA GUEST HOUSE</strong>
                        merupakan usaha penginapan yang berlokasi di
                        Kecamatan Kalianda, Kabupaten Lampung Selatan,
                        Provinsi Lampung.

                        Website ini digunakan sebagai sistem informasi
                        reservasi kamar, pengelolaan tamu,
                        serta administrasi operasional hotel.

                    </p>

                </div>

            </div>

        </div>






        {{-- ==========================================
        GALERI HOTEL
        ========================================== --}}
        <div class="gallery-card mt-5">
            <div class="gallery-header">
                <i class="fas fa-images"></i>
                Foto Hotel
            </div>
            <div class="gallery-body">
                <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                    {{-- Indicator --}}
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="0" class="active">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="1">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="2">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="3">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="4">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="5">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="6">
                        </button>

                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="7">
                        </button>
                    </div>

                    {{-- Isi Slide --}}
                    <div class="carousel-inner rounded-4">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/deluxe1.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/deluxe2.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/superior1.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/superior2.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/standart1.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/standart2.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/homestay1.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/homestay2.jpeg') }}"
                                class="d-block w-100 gallery-image">
                        </div>
                    </div>

                    {{-- Tombol Kiri --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    {{-- Tombol Kanan --}}
                    <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>







        <div class="legal-card mt-4">

            <div class="legal-header">
                <i class="fas fa-file-contract"></i>
                Legalitas Usaha
            </div>

            <div class="legal-body">

                <div class="legal-item">
                    <div class="legal-title">
                        Nomor Induk Berusaha (NIB)
                    </div>

                    <div class="legal-value">
                        9120100382352
                    </div>
                </div>

                <div class="legal-item">
                    <div class="legal-title">
                        Bidang Usaha
                    </div>

                    <div class="legal-value">
                        Penginapan dan Restoran
                    </div>
                </div>

                <div class="legal-item">
                    <div class="legal-title">
                        KBLI
                    </div>

                    <div class="legal-value">
                        55191, 56101, 47249
                    </div>
                </div>

                <div class="legal-item">
                    <div class="legal-title">
                        Status Penanaman Modal
                    </div>

                    <div class="legal-value">
                        PMDN
                    </div>
                </div>

            </div>

        </div>







        <div class="row mt-4 justify-content-center">

            <div class="col-lg-9">

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <div class="detail-card">

                            <div class="icon-box">

                                <i class="ti ti-building"></i>

                            </div>

                            <h5>
                                Nama Usaha
                            </h5>

                            <p>

                                NIRWANA GUEST HOUSE

                            </p>

                        </div>

                    </div>







                    <div class="col-md-4 mb-4">

                        <div class="detail-card">

                            <div class="icon-box">

                                <i class="ti ti-bed"></i>

                            </div>

                            <h5>
                                Bidang Usaha
                            </h5>

                            <p>

                                Penginapan dan Restoran

                            </p>

                        </div>

                    </div>








                    <div class="col-md-4 mb-4">

                        <div class="detail-card">

                            <div class="icon-box">

                                <i class="ti ti-map-pin"></i>

                            </div>

                            <h5>
                                Alamat
                            </h5>

                            <p>

                                Jl. Kesuma Bangsa Way Urang,
                                <br>

                                Kel. Way Urang,
                                Kec. Kalianda,

                                <br>

                                Kab. Lampung Selatan,
                                Lampung

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>






        {{-- BUTTON KEMBALI --}}
        <a href="{{ url('/') }}" class="btn btn-secondary w-100" style="font-size:20pt;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M15 6l-6 6l6 6" />
            </svg>
            Kembali ke Login
        </a>

    </div>

@endsection

@push('myscript')
@endpush