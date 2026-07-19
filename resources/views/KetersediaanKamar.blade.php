@extends('layouts.index')
@section('content')
    <style>
        .kotak-header-ketersediaan {
            background: linear-gradient(to right,
                    #2c3e50,
                    #3498db,
                    #5dade2);

            color: white;
            border-radius: 12px;
            padding: 20px;
        }

        /* === Table Style === */
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #007bff, #00bcd4);
            color: white;
            text-align: center;
            font-weight: 600;
            font-size: 20px;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            border: none;
            position: sticky;
            border-bottom: 0 !important;
        }

        .custom-table thead tr:first-child th {
            background: linear-gradient(135deg, #0069d9, #17a2b8);
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-table tbody td,
        .custom-table tbody th {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            font-size: 20px;
            color: #333;
        }





        .custom-table tbody th {
            position: sticky;
            left: 0;
            z-index: 90;
            background: #f8f9fa;
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



        /* Header nomor kamar */
        .header-dlx {
            background: #ffe6e9 !important;
            color: #000 !important;
        }

        .header-spr {
            background: #eaf6ff !important;
            color: #000 !important;
        }

        .header-std {
            background: #fffbed !important;
            color: #000 !important;
        }

        .header-hmsty {
            background: #effff6 !important;
            color: #000 !important;
        }






        /* ===========================================================
                                   STICKY TABLE
                                =========================================================== */

        .sticky-table-wrapper {
            max-height: 75vh;
            overflow: auto;
        }

        /* ================= HEADER BARIS PERTAMA ================= */

        .custom-table thead tr:first-child th {

            position: sticky;
            top: 0;
            z-index: 100;

            background: linear-gradient(135deg, #0069d9, #17a2b8);

        }

        /* ================= HEADER BARIS KEDUA ================= */

        .custom-table thead tr:nth-child(2) th {
            position: sticky;
            top: 60px;
            z-index: 99;
            background: linear-gradient(135deg, #007bff, #00bcd4);
        }

        /* ================= KOLOM TANGGAL ================= */

        .custom-table tbody th {

            position: sticky;

            left: 0;

            z-index: 98;

            background: #f8f9fa;

            min-width: 80px;

            box-shadow: 2px 0 8px rgba(0, 0, 0, .12);

        }

        /* ================= POJOK KIRI ATAS ================= */

        .custom-table thead tr:first-child th:first-child {

            left: 0;

            z-index: 120;

        }

        /* ================= KOLOM TOTAL ================= */

        .custom-table thead tr:first-child th:last-child {

            z-index: 120;

        }


        .custom-table thead tr:first-child th {
            height: 60px;
        }

        .custom-table thead tr:nth-child(2) th {
            height: 60px;
        }

        .custom-table thead tr:nth-child(2) th {
            border-top: 0 !important;
        }
    </style>




    {{-- HEADER --}}
    <div class="kotak-header-ketersediaan text-center mb-3">
        <h1 class="mb-1 fw-bold" style="font-size:25pt;">
            Ketersediaan Kamar
        </h1>
    </div>



    <form method="GET" action="{{ url('/KetersediaanKamar') }}">
        <div class="row mt-3">
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold text-center" style="font-size:20pt;">
                    Pilih Bulan
                </label>

                @php
                    $bulanList = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember'
                    ];
                @endphp
                <select name="bulan" class="form-control" style="font-size:20pt;">
                    @foreach($bulanList as $key => $nama)
                        <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold text-center" style="font-size:20pt;">
                    Pilih Tahun
                </label>

                <select name="tahun" class="form-control" style="font-size:20pt;">
                    @for($thn = 2026; $thn <= date('Y') + 20; $thn++)
                        <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>
                            {{ $thn }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">

                <button type="submit" class="btn btn-primary w-100" style="font-size:20pt;">

                    Tampilkan

                </button>

            </div>
        </div>

    </form>




    <div class="mt-4 mb-3">

        <table class="table-custom">

            <tr>
                <td width="120" style="font-size:20pt;">
                    <b>Bulan</b>
                </td>
                <td style="font-size:20pt;">
                    : {{ $namaBulan }}
                </td>
            </tr>

            <tr>
                <td style="font-size:20pt;">
                    <b>Tahun</b>
                </td>
                <td style="font-size:20pt;">
                    : {{ $tahun }}
                </td>
            </tr>

        </table>

    </div>



    {{-- TABEL --}}
    @php
        $tanggalDipilih = \Carbon\Carbon::create($tahun, $bulan, 1);
    @endphp
    <div class="table-wrapper mt-3">
        <div class="table-responsive sticky-table-wrapper">
            <table class="table custom-table">
                <thead class="table-primary">

                    <tr>
                        <th rowspan="2" class="align-middle" style="min-width:80px;">
                            Tanggal
                        </th>

                        <th colspan="{{ $nomorKamar->count() }}" class="text-center">
                            Nomor Kamar
                        </th>

                        <th rowspan="2" class="align-middle">
                            Total
                        </th>
                    </tr>

                    <tr>
                        @foreach ($nomorKamar as $kamar)
                            <th style="min-width:60px;">
                                {{ $kamar->id_nomor_kamar }}
                            </th>
                        @endforeach
                    </tr>

                </thead>
                <tbody>

                    @for ($tgl = 1; $tgl <= $jumlahHari; $tgl++)

                        @php
                            $totalTerisi = 0;
                            $tanggalCell = \Carbon\Carbon::create($tahun, $bulan, $tgl)->format('Y-m-d');
                        @endphp

                        <tr>

                            <th class="table-light">
                                {{ $tgl }}
                            </th>

                            @foreach ($nomorKamar as $kamar)

                                @php

                                    switch ($kamar->id_kamar) {
                                        case 1:
                                            $warna = 'header-dlx';
                                            break;
                                        case 2:
                                            $warna = 'header-spr';
                                            break;
                                        case 3:
                                            $warna = 'header-std';
                                            break;
                                        case 4:
                                            $warna = 'header-hmsty';
                                            break;
                                        default:
                                            $warna = '';
                                    }

                                    $booking = $bookingKamar->first(function ($item) use ($kamar, $tanggalCell) {
                                        return $item->id_nomor_kamar == $kamar->id_nomor_kamar
                                            && $tanggalCell >= $item->check_in
                                            && $tanggalCell < $item->check_out;
                                    });

                                @endphp

                                <td class="{{ $warna }}">

                                    @if($booking)

                                        @php

                                            $hariIni = \Carbon\Carbon::today();
                                            $checkIn = \Carbon\Carbon::parse($booking->check_in);

                                            if ($booking->status_pembayaran == 0) {

                                                $btn = 'btn-warning';

                                            } else {

                                                if ($checkIn->gt($hariIni)) {
                                                    $btn = 'btn-secondary';
                                                } else {
                                                    $btn = 'btn-success';
                                                }
                                                $totalTerisi++;
                                            }
                                        @endphp

                                        <a href="#" class="ModalInfo btn {{ $btn }}"
                                            id_rincian_pesanan="{{ $booking->id_rincian_pesanan }}"
                                            style="
                                                                                                                                                                                                                                                                                                                                                                                                    width:30px;
                                                                                                                                                                                                                                                                                                                                                                                                    height:30px;
                                                                                                                                                                                                                                                                                                                                                                                                    padding:0;
                                                                                                                                                                                                                                                                                                                                                                                                    border-radius:4px;
                                                                                                                                                                                                                                                                                                                                                                                                    display:inline-block;
                                                                                                                                                                                                                                                                                                                                                                                                ">
                                        </a>

                                    @endif

                                </td>

                            @endforeach

                            <td class="fw-bold bg-light">
                                {{ $totalTerisi }}
                            </td>

                        </tr>

                    @endfor

                </tbody>
            </table>
        </div>
    </div>

    {{-- KETERANGAN --}}
    <div class="card mt-3 shadow-sm">
        <div class="card-header fw-bold" style="font-size:18px;">
            Keterangan
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-2">
                    <span class="btn btn-success" style="width:30px;height:30px;padding:0;border-radius:4px;">
                    </span>

                    <span class="ms-2 fw-semibold">
                        Check In & Sudah Bayar
                    </span>
                </div>

                <div class="col-md-4 mb-2">
                    <span class="btn btn-secondary" style="width:30px;height:30px;padding:0;border-radius:4px;">
                    </span>

                    <span class="ms-2 fw-semibold">
                        Booking & Sudah Bayar
                    </span>
                </div>

                <div class="col-md-4 mb-2">
                    <span class="btn btn-warning" style="width:30px;height:30px;padding:0;border-radius:4px;">
                    </span>

                    <span class="ms-2 fw-semibold">
                        Belum Bayar
                    </span>
                </div>

            </div>

            <small class="text-muted">
                <b>Catatan:</b> Status <b>Belum Bayar</b> berlaku baik sebelum maupun sesudah tanggal Check In selama
                pembayaran belum dilakukan.
            </small>

        </div>
    </div>



    {{-- BUTTON KEMBALI --}}
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ url('/') }}" class="btn btn-secondary w-100" style="font-size:25pt;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M15 6l-6 6l6 6" />
                </svg>
                Kembali
            </a>
        </div>
    </div>




    <!-- Modal Informasi Pemesanan -->
    <div class="modal fade" id="modal-info" tabindex="-1" aria-labelledby="ModalInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="ModalInfoLabel" style="font-size:20pt;">Informasi Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="loadModalInfo">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        // BAGIAN DARI MODAL INFO
        $(document).on('click', '.ModalInfo', function (e) {
            e.preventDefault();

            let id = $(this).attr('id_rincian_pesanan');

            $.ajax({
                type: 'POST',
                url: '/ModalInfo',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_rincian_pesanan: id
                },
                success: function (respond) {
                    $("#loadModalInfo").html(respond);
                    $("#modal-info").modal("show");
                }
            });
        });
    </script>
@endpush