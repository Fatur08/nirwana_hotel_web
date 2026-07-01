@extends('layouts.PesanKamar')
@section('content')
    <style>
        .tanggal-wrapper {
            position: relative;
            width: 200%;
        }

        .tanggal-asli {

            position: absolute;
            inset: 0;

            width: 200%;
            height: 200%;

            opacity: 0;

            cursor: pointer;

            z-index: 10;

        }

        .tanggal-view {

            border: 1px solid #ced4da;

            border-radius: 8px;

            min-height: 580px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 18px;

            font-size: 20px;

            background: #fff;

        }

        .icon {

            margin-right: 10px;

        }

        #check_in_text,
        #check_out_text {

            flex: 1;

            margin-left: 10px;

            color: #444;

        }
    </style>
    <div class="card-body">

        <form action="{{ url('BuatResiManual/store') }}" method="POST">

            @csrf

            {{-- ========================= --}}
            {{-- DATA TAMU --}}
            {{-- ========================= --}}

            <div class="row mb-3">

                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        Nama Tamu
                    </label>

                    <input type="text" name="nama_tamu" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        Alamat
                    </label>

                    <input type="text" name="alamat" class="form-control" required>
                </div>

            </div>


            {{-- ========================= --}}
            {{-- CHECK IN / OUT --}}
            {{-- ========================= --}}

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Check In
                </label>

                <div class="tanggal-wrapper">

                    <!-- Input date asli -->
                    <input type="date" id="check_in" name="check_in" class="tanggal-asli" required>

                    <!-- Tampilan -->
                    <div class="tanggal-view">

                        <span class="icon">
                            📅
                        </span>

                        <span id="check_in_text">
                            Pilih Tanggal Check In
                        </span>

                    </div>

                </div>

            </div>




            <div class="mb-4">

                <label class="form-label fw-bold">
                    Check Out
                </label>

                <div class="tanggal-wrapper">

                    <input type="date" id="check_out" name="check_out" class="tanggal-asli" required>

                    <div class="tanggal-view">

                        <span class="icon">
                            📅
                        </span>

                        <span id="check_out_text">
                            Pilih Tanggal Check Out
                        </span>

                    </div>

                </div>

            </div>


            <hr>

            <h4 class="mb-3">
                Jumlah Kamar
            </h4>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Deluxe</label>

                    <input type="number" name="deluxe" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Superior</label>

                    <input type="number" name="superior" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Standart</label>

                    <input type="number" name="standart" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Home Stay</label>

                    <input type="number" name="homestay" class="form-control" min="0" value="0">
                </div>

            </div>


            <hr>

            <h4 class="mb-3">
                Request Tambahan
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Ekstra Bed</label>

                    <input type="number" name="ekstra_bed" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Breakfast</label>

                    <input type="number" name="breakfast" class="form-control" min="0" value="0">
                </div>

            </div>


            <div class="text-end mt-4">

                <button class="btn btn-success btn-lg">

                    Simpan

                </button>

            </div>

        </form>

    </div>
@endsection
@push('myscript')
    <script>
        function formatIndonesia(tanggal) {

            if (!tanggal) return '';

            const bulan = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            let t = new Date(tanggal);

            return String(t.getDate()).padStart(2, '0')
                + ' '
                + bulan[t.getMonth()]
                + ' '
                + t.getFullYear();

        }



        $('#check_in').change(function () {

            $('#check_in_text').text(
                formatIndonesia($(this).val())
            );

        });


        $('#check_out').change(function () {

            $('#check_out_text').text(
                formatIndonesia($(this).val())
            );

        });
    </script>
@endpush