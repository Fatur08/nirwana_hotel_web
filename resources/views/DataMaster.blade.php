@extends('layouts.index')
@section('content')
    <style>
        .kotak-header-data-master {
            background: linear-gradient(to right,
                    #2c3e50,
                    #3498db,
                    #5dade2);

            color: white;
            border-radius: 12px;
            padding: 20px;
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
    </style>




    {{-- HEADER --}}
    <div class="kotak-header-data-master text-center mb-3">
        <h1 class="mb-1 fw-bold" style="font-size:25pt;">
            Data Master
        </h1>
    </div>




    <form action="{{ url('/UpdateDataMaster') }}" method="POST" id="frmDataMaster">
        @csrf

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                {{-- DELUXE --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Deluxe
                    </label>

                    <input type="number" class="form-control" name="DLX" style="font-size:16pt;"
                        value="{{ $kamar['DLX'] ?? 0 }}">
                </div>

                {{-- SUPERIOR --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Superior
                    </label>

                    <input type="number" class="form-control" name="SPR" style="font-size:16pt;"
                        value="{{ $kamar['SPR'] ?? 0 }}">
                </div>

                {{-- STANDART --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Standart
                    </label>

                    <input type="number" class="form-control" name="STD" style="font-size:16pt;"
                        value="{{ $kamar['STD'] ?? 0 }}">
                </div>

                {{-- HOME STAY --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Home Stay
                    </label>

                    <input type="number" class="form-control" name="HMSTY" style="font-size:16pt;"
                        value="{{ $kamar['HMSTY'] ?? 0 }}">
                </div>

                {{-- EXTRA BED --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Ekstra Bed
                    </label>

                    <input type="number" class="form-control" name="BED" style="font-size:16pt;"
                        value="{{ $kamar['BED'] ?? 0 }}">
                </div>

                {{-- BREAKFAST --}}
                <div class="mb-4">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Breakfast
                    </label>

                    <input type="number" class="form-control" name="FAST" style="font-size:16pt;"
                        value="{{ $kamar['FAST'] ?? 0 }}">
                </div>

                <button type="submit" class="btn btn-success w-100" style="font-size:20pt;">

                    Simpan

                </button>

            </div>
        </div>
    </form>



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
    <script>
        $(document).on('submit', '#frmDataMaster', function (e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,

                success: function (res) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Master berhasil diperbarui'
                    });

                },

                error: function (xhr) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan'
                    });

                    console.log(xhr.responseText);

                }

            });

        });
    </script>
@endpush