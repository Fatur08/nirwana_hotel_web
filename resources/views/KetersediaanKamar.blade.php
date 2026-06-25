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
            font-size: 20px;
            letter-spacing: 0.5px;
            padding: 12px;
            border: none;
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
                <label class="form-label fw-bold" style="font-size:20pt;">
                    Bulan
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
                <select name="bulan" class="form-control">
                    @foreach($bulanList as $key => $nama)
                        <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold" style="font-size:20pt;">
                    Tahun
                </label>

                <select name="tahun" class="form-control">
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

                <button type="submit" class="btn btn-primary w-100" style="font-size:18px;">

                    Tampilkan

                </button>

            </div>
        </div>

    </form>




    <div class="mt-4 mb-3">

        <table class="table-custom">

            <tr>
                <td width="120">
                    <b>Bulan</b>
                </td>
                <td>
                    : {{ $namaBulan }}
                </td>
            </tr>

            <tr>
                <td>
                    <b>Tahun</b>
                </td>
                <td>
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
        <div class="table-responsive">
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
                        @endphp
                        <tr>

                            <th class="table-light">
                                {{ $tgl }}
                            </th>

                            @foreach ($nomorKamar as $kamar)

                                @php
                                    $warna = match ($kamar->id_kamar) {
                                        1 => 'header-dlx',
                                        2 => 'header-spr',
                                        3 => 'header-std',
                                        4 => 'header-hmsty',
                                        default => ''
                                    };
                                @endphp
                                <td class="{{ $warna }}">

                                    @php

                                        $tanggalCell = \Carbon\Carbon::create(
                                            $tahun,
                                            $bulan,
                                            $tgl
                                        )->format('Y-m-d');

                                        $booking = $bookingKamar->first(function ($item) use ($kamar, $tanggalCell) {

                                            return $item->id_nomor_kamar == $kamar->id_nomor_kamar
                                                && $tanggalCell >= $item->check_in
                                                && $tanggalCell < $item->check_out;
                                        });

                                    @endphp

                                    @if($booking)

                                        @php

                                            $hariIni = date('Y-m-d');

                                            if (
                                                $booking->check_in > $hariIni
                                                && $booking->status_pembayaran == 0
                                            ) {

                                                $btn = 'btn-warning';

                                            } elseif (
                                                $booking->check_in > $hariIni
                                            ) {

                                                $btn = 'btn-secondary';

                                                $totalTerisi++;

                                            } else {

                                                $btn = 'btn-success';

                                                $totalTerisi++;
                                            }

                                        @endphp

                                        <a href="#" class="ModalInfo btn {{ $btn }}"
                                            id_laporan_keuangan="{{ $booking->id_laporan_keuangan }}"
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
                    <h5 class="modal-title" id="ModalInfoLabel" style="font-size:16pt;">Informasi Pemesanan</h5>
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
    </script>
@endpush