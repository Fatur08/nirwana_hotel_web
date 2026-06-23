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
            background: #ffd7db !important;
            color: #000 !important;
        }

        .header-spr {
            background: #e2f3ff !important;
            color: #000 !important;
        }

        .header-std {
            background: #fff9e3 !important;
            color: #000 !important;
        }

        .header-hmsty {
            background: #e7fff1 !important;
            color: #000 !important;
        }
    </style>




    {{-- HEADER --}}
    <div class="kotak-header-ketersediaan text-center mb-3">
        <h1 class="mb-1 fw-bold" style="font-size:25pt;">
            Ketersediaan Kamar
        </h1>
    </div>



    {{-- TABEL --}}
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

                                <td class="{{ $warna }}"></td>

                            @endforeach

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
@endsection
@push('myscript')
@endpush