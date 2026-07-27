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






        {{-- FOTO HOTEL --}}
        <div class="card hotel-photo-card mt-4 shadow-sm">
            <div class="card-header hotel-photo-header">
                <h3 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Foto Hotel
                </h3>
            </div>


            <div class="card-body">
                <div id="carouselHotel" class="carousel slide carousel-fade hotel-carousel" data-bs-ride="carousel"
                    data-bs-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/deluxe1.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/deluxe2.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/superior1.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/superior2.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/standart1.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/standart2.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/homestay1.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/foto_kamar_hotel/homestay2.jpeg') }}"
                                class="d-block w-100 hotel-image">
                        </div>
                    </div>

                    {{-- BUTTON NEXT PREV --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHotel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselHotel"
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






        {{-- =========================================================
        LOKASI HOTEL
        ========================================================= --}}
        <div class="card hotel-map-card mt-4 shadow-lg">
            <div class="card-header hotel-map-header">
                <h3 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M20 10c0 6-8 11-8 11S4 16 4 10a8 8 0 1 1 16 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Lokasi Hotel
                </h3>
            </div>

            <div class="card-body">
                <div class="row align-items-stretch">
                    {{-- ==========================================
                    INFORMASI HOTEL
                    =========================================== --}}
                    <div class="col-lg-5 mb-4">
                        <div class="hotel-info-box">
                            <h3 class="mb-4 text-primary">
                                NIRWANA GUEST HOUSE
                            </h3>

                            <div class="info-item">
                                <h5>Bidang Usaha</h5>
                                <p>
                                    Penginapan dan Restoran
                                </p>
                            </div>

                            <div class="info-item">
                                <h5>Alamat</h5>
                                <p>
                                    Jl. Kesuma Bangsa Way Urang<br>
                                    Kelurahan Way Urang<br>
                                    Kecamatan Kalianda<br>
                                    Kabupaten Lampung Selatan<br>
                                    Provinsi Lampung
                                </p>
                            </div>

                            <div class="info-item">
                                <h5>Koordinat</h5>
                                <p>
                                    -5.728685151672566<br>
                                    105.58855853311444
                                </p>
                            </div>

                            <a href="https://www.google.com/maps?q=-5.728685151672566,105.58855853311444" target="_blank"
                                class="btn btn-primary btn-lg mt-3">
                                Buka Google Maps
                            </a>
                        </div>
                    </div>


                    {{-- ==========================================
                    GOOGLE MAPS
                    =========================================== --}}
                    <div class="col-lg-7">
                        <div class="map-wrapper">
                            <iframe
                                src="https://www.google.com/maps?q=-5.728685151672566,105.58855853311444&hl=id&z=17&output=embed"
                                width="100%" height="100%" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">

                            </iframe>
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