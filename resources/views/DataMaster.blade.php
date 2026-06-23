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

            <div class="mb-3">
                <label class="form-label">Deluxe</label>
                <input type="text" class="form-control rupiah" name="DLX"
                    value="{{ !empty($kamar['DLX']) ? 'Rp.' . number_format($kamar['DLX'], 0, ',', '.') : '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Superior</label>
                <input type="text" class="form-control rupiah" name="SPR"
                    value="{{ !empty($kamar['SPR']) ? 'Rp.' . number_format($kamar['SPR'], 0, ',', '.') : '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Standart</label>
                <input type="text" class="form-control rupiah" name="STD"
                    value="{{ !empty($kamar['STD']) ? 'Rp.' . number_format($kamar['STD'], 0, ',', '.') : '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Home Stay</label>
                <input type="text" class="form-control rupiah" name="HMSTY"
                    value="{{ !empty($kamar['HMSTY']) ? 'Rp.' . number_format($kamar['HMSTY'], 0, ',', '.') : '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Ekstra Bed</label>
                <input type="text" class="form-control rupiah" name="BED"
                    value="{{ !empty($kamar['BED']) ? 'Rp.' . number_format($kamar['BED'], 0, ',', '.') : '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Breakfast</label>
                <input type="text" class="form-control rupiah" name="FAST"
                    value="{{ !empty($kamar['FAST']) ? 'Rp.' . number_format($kamar['FAST'], 0, ',', '.') : '' }}">
            </div>

            <button type="submit" class="btn btn-success w-100" style="font-size:16pt;">
                Simpan
            </button>

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

        function formatRupiah(angka) {

            angka = angka.replace(/\D/g, '');

            if (angka === '') {
                return '';
            }

            return 'Rp.' + new Intl.NumberFormat('id-ID').format(angka);
        }

        $('.rupiah').on('input', function () {

            $(this).val(
                formatRupiah($(this).val())
            );

        });
    </script>
@endpush