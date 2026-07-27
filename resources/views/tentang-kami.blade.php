@extends('layouts.tentang-kami')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/tentang-kami.css') }}">

    <div class="container py-5">

        <div class="hero-section">

            <div class="hero-card">

                <div class="logo-area">

                    <img src="{{ asset('img/logo.png') }}" class="logo-hotel">

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






        <div class="text-center mt-5">

            <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-5">

                Kembali ke Login

            </a>

        </div>

    </div>

@endsection

@push('myscript')
@endpush