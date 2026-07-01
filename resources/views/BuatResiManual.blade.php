@extends('layouts.PesanKamar')
@section('content')
    <style>
        .tanggal-wrapper {
            position: relative;
            width: 100%;
        }

        .tanggal-asli {

            position: absolute;
            inset: 0;

            width: 100%;
            height: 100%;

            opacity: 0;

            cursor: pointer;

            z-index: 10;

        }

        .tanggal-view {

            border: 1px solid #ced4da;

            border-radius: 8px;

            min-height: 58px;

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


        @media (min-width: 10000px) {

            input[type="date"] {
                font-size: 26px;
                padding: 18px 20px;
                height: 6500px;
                letter-spacing: 1px;
                font-weight: 600;
            }

        }
    </style>
    <div class="card-body">

        <form action="{{ url('BuatResiManual/store') }}" id="FormResiManual" method="POST">

            @csrf

            {{-- ========================= --}}
            {{-- DATA TAMU --}}
            {{-- ========================= --}}

            <div class="row mb-5">

                <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Nama Tamu
                    </label>

                    <input type="text" name="nama_tamu_resi_manual" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size:16pt;">
                        Alamat
                    </label>

                    <input type="text" name="alamat_tamu_resi_manual" class="form-control" required>
                </div>

            </div>


            {{-- ========================= --}}
            {{-- CHECK IN / OUT --}}
            {{-- ========================= --}}

            <div class="mb-3">

                <label class="form-label fw-bold" style="font-size:16pt;">
                    Check In
                </label>

                <div class="tanggal-wrapper">

                    <!-- Input date asli -->
                    <input type="date" id="check_in_resi_manual" name="check_in_resi_manual" class="tanggal-asli" required>

                    <!-- Tampilan -->
                    <div class="tanggal-view">

                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>

                        <span id="check_in_text">
                            Pilih Tanggal Check In
                        </span>

                    </div>

                </div>

            </div>




            <div class="mb-4">

                <label class="form-label fw-bold" style="font-size:16pt;">
                    Check Out
                </label>

                <div class="tanggal-wrapper">

                    <input type="date" id="check_out_resi_manual" name="check_out_resi_manual" class="tanggal-asli"
                        required>

                    <div class="tanggal-view">

                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>

                        <span id="check_out_text">
                            Pilih Tanggal Check Out
                        </span>

                    </div>

                </div>

            </div>


            <hr>

            <h4 class="mb-4" style="font-size:16pt;">
                Jumlah Kamar
            </h4>

            <div class="row mb-4">

                <div class="col-md-3 mb-3">
                    <label style="font-size:16pt;">Deluxe</label>

                    <input type="number" name="jumlah_kamar_deluxe" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label style="font-size:16pt;">Superior</label>

                    <input type="number" name="jumlah_kamar_superior" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label style="font-size:16pt;">Standart</label>

                    <input type="number" name="jumlah_kamar_standart" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label style="font-size:16pt;">Home Stay</label>

                    <input type="number" name="jumlah_homestay" class="form-control" min="0" value="0">
                </div>

            </div>


            <hr>

            <h4 class="mt-3 mb-4" style="font-size:16pt;">
                Request Tambahan
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label style="font-size:16pt;">Ekstra Bed</label>

                    <input type="number" name="jumlah_ekstrabed" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-6 mb-3">
                    <label style="font-size:16pt;">Breakfast</label>

                    <input type="number" name="jumlah_breakfast" class="form-control" min="0" value="0">
                </div>

            </div>


            <div class="text-end mt-4">

                <button class="btn btn-info btn-lg" style="font-size:16pt;">

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



        $('#check_in_resi_manual').change(function () {

            $('#check_in_text').text(
                formatIndonesia($(this).val())
            );

        });


        $('#check_out_resi_manual').change(function () {

            $('#check_out_text').text(
                formatIndonesia($(this).val())
            );

        });





        // ==========================
        // SUBMIT FORM PESAN KAMAR
        // ==========================
        $(document).on('submit', '#FormResiManual', function (e) {

            e.preventDefault();

            let nama_tamu_resi_manual = $('#nama_tamu_resi_manual').val();
            let alamat_tamu_resi_manual = $('#alamat_tamu_resi_manual').val();
            let check_in_resi_manual = $('#check_in_resi_manual').val();
            let check_out_resi_manual = $('#check_out_resi_manual').val();

            function showError(pesan, el = null) {

                Swal.fire({
                    title: 'Warning!',
                    text: pesan,
                    icon: 'warning'
                }).then(() => {

                    if (el) {
                        $(el).focus();
                    }

                });

            }

            // ==========================
            // VALIDASI
            // ==========================

            if (nama_tamu_resi_manual == '') {
                showError('Nama Tamu Harus Diisi', '#nama_tamu_resi_manual');
                return;
            }

            if (alamat_tamu_resi_manual == '') {
                showError('Nama Tamu Harus Diisi', '#alamat_tamu_resi_manual');
                return;
            }

            if (check_in_resi_manual == '') {
                showError('Tanggal Check In Harus Diisi');
                return;
            }

            if (check_out_resi_manual == '') {
                showError('Tanggal Check Out Harus Diisi');
                return;
            }

            // ==========================
            // AJAX SIMPAN
            // ==========================

            let formData = new FormData(this);

            $.ajax({

                type: 'POST',
                url: $(this).attr('action'),
                data: formData,

                processData: false,
                contentType: false,

                beforeSend: function () {

                    Swal.fire({
                        title: 'Menyimpan Data...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                },

                success: function (res) {

                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data resi manual berhasil disimpan',
                        icon: 'success'
                    }).then(() => {

                        window.location.reload();

                    });

                },

                error: function (xhr) {

                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON?.message ??
                            'Terjadi kesalahan saat menyimpan data',
                        icon: 'error'
                    });

                    console.log(xhr.responseText);

                }

            });

        });
    </script>
@endpush