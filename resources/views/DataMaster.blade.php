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


        .kotak-pesan {
            background-color: rgb(209, 209, 209);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 20px;
        }

        .kotak-dlx {
            background: linear-gradient(to right, #ea3438, #f39c12, #28a745);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }


        .kotak-hmsty {
            background: linear-gradient(to right, #0d6efd, #0dcaf0, #20c997);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .kotak-spr {
            background: linear-gradient(to right, #99caeb, #5daee6, #f39c12);
            color: black;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .kotak-std {
            background: linear-gradient(to right, #f6df07, #f4c20d, #ff7f50, #c0392b, #8e44ad);
            color: black;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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

        <div class="kotak-cari mt-3">

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Deluxe</label>
                <input type="text" class="form-control rupiah" name="DLX"
                    value="Rp.{{ number_format($kamar['DLX'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Superior</label>
                <input type="text" class="form-control rupiah" name="SPR"
                    value="Rp.{{ number_format($kamar['SPR'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Standart</label>
                <input type="text" class="form-control rupiah" name="STD"
                    value="Rp.{{ number_format($kamar['STD'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Home Stay</label>
                <input type="text" class="form-control rupiah" name="HMSTY"
                    value="Rp.{{ number_format($kamar['HMSTY'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Ekstra Bed</label>
                <input type="text" class="form-control rupiah" name="BED"
                    value="Rp.{{ number_format($kamar['BED'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <div class="mb-7">
                <label class="form-label" style="font-size:20pt;">Breakfast</label>
                <input type="text" class="form-control rupiah" name="FAST"
                    value="Rp.{{ number_format($kamar['FAST'] ?? 0, 0, ',', '.') }}" style="font-size:20pt;">
            </div>

            <button type="submit" class="btn btn-success w-100" style="font-size:20pt;">
                Simpan
            </button>

        </div>
    </form>



    <div class="kotak-pesan">
        <div class="row mt-3">
            <!-- KAMAR DELUXE -->
            <div class="col-6 mb-3">
                <div class="kotak-dlx h-100 p-4 text-center">

                    <p class="mb-3">Kamar Deluxe</p>

                    <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded mb-3"
                        style="max-height:180px;">

                    <p class="mb-2">
                        Total Kamar :<br>
                        {{ $kamarSingleDLX }} Kamar Single Bed
                        <br>
                        {{ $kamarDoubleDLX }} Kamar Double Bed
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-success w-100 mb-2" style="font-size:20pt;">
                        Tambah Kamar
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-warning w-100 mb-2" style="font-size:20pt;">
                        Edit Kamar
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-danger w-100" style="font-size:20pt;">
                        Hapus Kamar
                    </a>
                </div>
            </div>

            <!-- HOME STAY -->
            <div class="col-6 mb-3">
                <div class="kotak-hmsty h-100 p-4 text-center">

                    <p class="mb-3">Home Stay</p>

                    <img src="{{ asset('assets/img/homestay.jpg') }}" class="img-fluid rounded mb-3"
                        style="max-height:180px;">

                    <p class="mb-2">
                        Total Kamar :<br>
                        {{ $SingleHMSTY }} Kamar Single Bed
                        <br>
                        {{ $DoubleHMSTY }} Kamar Double Bed
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
                        Total Kamar :<br>
                        {{ $kamarSingleSPR }} Kamar Single Bed
                        <br>
                        {{ $kamarDoubleSPR }} Kamar Double Bed
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
                        Total Kamar :<br>
                        {{ $kamarSingleSTD }} Kamar Single Bed
                        <br>
                        {{ $kamarDoubleSTD }} Kamar Double Bed
                    </p>
                </div>
            </div>
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

        function formatRupiah(angka) {

            angka = angka.replace(/[^,\d]/g, '');

            let split = angka.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {

                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');

            }

            return 'Rp.' + rupiah;
        }

        $('.rupiah').on('keyup', function () {

            let angka = $(this).val().replace(/[^0-9]/g, '');

            if (angka == '') {
                $(this).val('Rp.');
            } else {
                $(this).val(formatRupiah(angka));
            }

        });

    </script>
@endpush