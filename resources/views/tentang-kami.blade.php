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

                <h2 class="text-primary fw-bold mb-4">
                    NIRWANA GUEST HOUSE
                </h2>

                {{-- Bidang Usaha --}}
                <div class="info-item d-flex mb-4">

                    <div class="info-icon me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <path d="M3 21h18" />
                            <path d="M5 21V7l8-4v18" />
                            <path d="M19 21V11l-6-4" />
                        </svg>
                    </div>

                    <div>
                        <h5>Bidang Usaha</h5>

                        <p class="mb-0">
                            Penginapan dan Restoran
                        </p>
                    </div>

                </div>

                {{-- Alamat --}}
                <div class="info-item d-flex mb-4">

                    <div class="info-icon me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11z" />
                            <circle cx="12" cy="10" r="2" />
                        </svg>
                    </div>

                    <div>

                        <h5>Alamat</h5>

                        <p class="mb-0">
                            Jl. Kesuma Bangsa Way Urang<br>
                            Kelurahan Way Urang<br>
                            Kecamatan Kalianda<br>
                            Kabupaten Lampung Selatan<br>
                            Provinsi Lampung
                        </p>

                    </div>

                </div>

                {{-- Website --}}
                <div class="info-item d-flex mb-4">

                    <div class="info-icon me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <circle cx="12" cy="12" r="9" />
                            <path d="M3.6 9h16.8" />
                            <path d="M3.6 15h16.8" />
                            <path d="M12 3a15 15 0 0 1 0 18" />
                            <path d="M12 3a15 15 0 0 0 0 18" />
                        </svg>
                    </div>

                    <div>

                        <h5>Website Resmi</h5>

                        <p class="mb-0">
                            <a href="https://nirwanahotelkalianda.com" target="_blank"
                                class="text-decoration-none fw-semibold">

                                https://nirwanahotelkalianda.com

                            </a>
                        </p>

                    </div>

                </div>

                {{-- Email --}}
                <div class="info-item d-flex mb-4">

                    <div class="info-icon me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path d="M3 7l9 6l9-6" />
                        </svg>
                    </div>

                    <div>

                        <h5>Email</h5>

                        <p class="mb-0">
                            <a href="mailto:nirwanahotelkalianda@gmail.com" class="text-decoration-none fw-semibold">

                                nirwanahotelkalianda@gmail.com

                            </a>
                        </p>

                    </div>

                </div>

                {{-- Telepon --}}
                <div class="info-item d-flex mb-4">

                    <div class="info-icon me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <path
                                d="M5 4h4l2 5l-2.5 1.5a15 15 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2C10.8 21 3 13.2 3 6a2 2 0 0 1 2-2z" />
                        </svg>
                    </div>

                    <div>

                        <h5>Telepon</h5>

                        <p class="mb-0">
                            <a href="tel:081272810410" class="text-decoration-none fw-semibold">

                                0812 7281 0410

                            </a>
                        </p>

                    </div>

                </div>

                <a href="https://maps.app.goo.gl/LHWq4wN3ozwMKVCn8" target="_blank"
                    class="btn btn-primary btn-lg rounded-pill px-5 mt-3">

                    Buka Google Maps

                </a>

            </div>
        </div>






        {{-- BUTTON KEMBALI --}}
        <a href="{{ url('/') }}" class="btn btn-secondary w-100 mt-4" style="font-size:20pt;">
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