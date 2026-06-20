@extends('layouts.PesanKamar')
@section('content')
    <style>
        #biaya_request {
            resize: none;
            overflow: hidden;
        }
    </style>

    <form action="{{ url('PesanKamar/store_PesanKamar') }}" method="POST" id="frmPesanKamar" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Nama Tamu</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-icon mb-6">
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </span>
                    <input type="text" value="" id="nama_tamu" class="form-control" style="font-size:16pt;" name="nama_tamu"
                        placeholder="Masukkan Nama Tamu">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Check-In</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-icon mb-6">
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
                    <input type="text" id="check_in_pesan_kamar" class="form-control flatpickr w-100"
                        style="font-size:16pt;" placeholder="Masukkan Tanggal Check-In" autocomplete="off">
                    <input type="hidden" id="check_in" name="check_in">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Check-Out</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-icon mb-6">
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
                    <input type="text" id="check_out_pesan_kamar" class="form-control flatpickr" style="font-size:16pt;"
                        placeholder="Masukkan Tanggal Check-Out" autocomplete="off">
                    <input type="hidden" id="check_out" name="check_out">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Jumlah Kamar Dipesan</h5>
            </div>
        </div>
        <div class="row mb-6">
            <div class="col-12">
                <select id="jumlah_kamar_dipesan" name="jumlah_kamar_dipesan" class="form-control" style="font-size:16pt;">
                </select>
            </div>
        </div>
        <div class="row" id="kamar_tersedia_title" style="display:none;">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Kamar Yang Tersedia</h5>
            </div>
        </div>
        <div class="row mb-6" id="kamar_tersedia_list" style="display:none;">
            <div class="col-12">
                <div id="list_nomor_kamar"></div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Upload Foto KTP</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-icon mb-6">
                    <span class="input-icon-addon">
                        <!-- Icon kamera -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-camera">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M5 7h2l1 -2h8l1 2h2a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2" />
                            <path d="M12 13m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                    </span>
                    <input type="file" id="foto_ktp" name="foto_ktp" class="form-control" style="font-size:16pt;">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Jumlah Extra Bed</h5>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-12">
                <input type="number" id="jumlah_extra_bed" name="jumlah_extra_bed" class="form-control" min="0" value="0"
                    style="font-size:16pt;">
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Jumlah Breakfast</h5>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-12">
                <input type="number" id="jumlah_breakfast" name="jumlah_breakfast" class="form-control" min="0" value="0"
                    style="font-size:16pt;">
            </div>
        </div>


        <div class="row" id="biaya_container" style="display:none;">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Biaya Tambahan</h5>
            </div>
        </div>

        <div class="row mb-6" id="biaya_input_container" style="display:none;">
            <div class="col-12">
                <textarea id="biaya_request" class="form-control" readonly style="
                                                        font-size:16pt;
                                                        min-height:120px;
                                                        resize:none;
                                                        overflow:hidden;
                                                    ">
                                                </textarea>

                <input type="hidden" id="biaya_request_value" name="biaya_request">
            </div>
        </div>


        <!-- METODE PEMBAYARAN -->
        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Metode Pembayaran</h5>
            </div>
        </div>
        <div class="row mb-6">
            <div class="col-12">
                <select id="metode_pembayaran" name="metode_pembayaran" class="form-control" style="font-size:16pt;">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="cash">Cash</option>
                    <option value="online">Online</option>
                </select>
            </div>
        </div>

        <!-- INPUT TAMBAHAN JIKA ONLINE -->
        <div class="row" id="sumber_pembayaran_container" style="display:none;">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Masukkan Sumber Pembayaran Online</h5>
            </div>
        </div>
        <div class="row" id="sumber_pembayaran_input" style="display:none;">
            <div class="col-12">
                <div class="input-icon mb-7">
                    <span class="input-icon-addon">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <rect x="3" y="5" width="18" height="14" rx="3" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </span>
                    <input type="text" id="sumber_pembayaran" name="sumber_pembayaran" class="form-control"
                        style="font-size:16pt;" placeholder="Contoh: BCA, Dana, OVO, dll">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-secondary w-100" type="submit" style="font-size:16pt;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 14l11 -11" />
                            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('myscript')
    <script>

        $(document).ready(function () {

            // Default saat modal dibuka
            $('#sumber_pembayaran_container').hide();
            $('#sumber_pembayaran_input').hide();

            $('#jumlah_kamar_dipesan').html(`
                <option value="">
                    -- Pilih Tanggal Check In Dulu --
                </option>
            `);

            $('#kamar_tersedia_title').hide();
            $('#kamar_tersedia_list').hide();



            // ==========================
            // AMBIL JUMLAH KAMAR TERSEDIA
            // ==========================
            function refreshJumlahKamar() {

                let checkIn = $('#check_in').val();
                let checkOut = $('#check_out').val();

                console.log($('#check_in').val());
                console.log($('#check_out').val());

                if (!checkIn || !checkOut) {

                    $('#jumlah_kamar_dipesan').html(`
                                                                                                <option value="">
                                                                                                    -- Pilih Tanggal Check In Dulu --
                                                                                                </option>
                                                                                            `);

                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '/getKamarTersedia',
                    data: {
                        _token: "{{ csrf_token() }}",
                        check_in: checkIn,
                        check_out: checkOut
                    },

                    success: function (response) {

                        let totalKamar = response.length;

                        let opsiJumlah =
                            '<option value="">-- Pilih Jumlah Kamar --</option>';

                        for (let i = 1; i <= totalKamar; i++) {

                            opsiJumlah += `
                                                                                                                                    <option value="${i}">
                                                                                                                                        ${i} Kamar
                                                                                                                                    </option>
                                                                                                                                `;
                        }

                        $('#jumlah_kamar_dipesan').html(opsiJumlah);

                    }
                });
            }



            // Jika tanggal berubah, refresh jumlah kamar
            $('#check_in, #check_out').change(function () {

                $('#jumlah_kamar_dipesan').val('');

                $('#kamar_tersedia_title').hide();
                $('#kamar_tersedia_list').hide();
                $('#list_nomor_kamar').html('');

                refreshJumlahKamar();

            });


            // ==========================
            // SAAT JUMLAH KAMAR DIPILIH
            // ==========================
            $('#jumlah_kamar_dipesan').change(function () {

                let jumlah = $(this).val();

                let checkIn = $('#check_in').val();
                let checkOut = $('#check_out').val();

                if (!checkIn || !checkOut) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih tanggal Check-In dan Check-Out terlebih dahulu'
                    });

                    $(this).val('');

                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '/getKamarTersedia',
                    data: {
                        _token: "{{ csrf_token() }}",
                        check_in: checkIn,
                        check_out: checkOut
                    },

                    success: function (response) {

                        $('#kamar_tersedia_title').show();
                        $('#kamar_tersedia_list').show();

                        let html = '';

                        for (let i = 1; i <= jumlah; i++) {

                            html += `
                                                                                                                                                <div class="mb-4">

                                                                                                                                                    <label class="form-label fw-bold"
                                                                                                                                                           style="font-size:16pt;">
                                                                                                                                                        Pilih Kamar ${i}
                                                                                                                                                    </label>

                                                                                                                                                    <select
                                                                                                                                                        name="id_nomor_kamar[]"
                                                                                                                                                        class="form-control nomor-kamar"
                                                                                                                                                        style="font-size:16pt;"
                                                                                                                                                        required>

                                                                                                                                                        <option value="">
                                                                                                                                                            -- Pilih Kamar --
                                                                                                                                                        </option>
                                                                                                                                            `;

                            response.forEach(function (kamar) {

                                let bed = '';

                                if (kamar.jenis_bed == 1) {
                                    bed = 'Single Bed';
                                } else if (kamar.jenis_bed == 2) {
                                    bed = 'Double Bed';
                                } else {
                                    bed = '-';
                                }

                                html += `
                                                                                                                                                    <option value="${kamar.id_nomor_kamar}">
                                                                                                                                                        ${kamar.tipe_kamar}
                                                                                                                                                        ${kamar.nomor_kamar}
                                                                                                                                                        (${bed})
                                                                                                                                                    </option>
                                                                                                                                                `;
                            });

                            html += `
                                                                                                                                                    </select>
                                                                                                                                                </div>
                                                                                                                                            `;
                        }

                        $('#list_nomor_kamar').html(html);
                    }
                });

            });


            // ==========================
            // CEGAH KAMAR GANDA
            // ==========================
            $(document).on('change', '.nomor-kamar', function () {

                let selectedRooms = [];

                $('.nomor-kamar').each(function () {

                    let val = $(this).val();

                    if (val) {
                        selectedRooms.push(val);
                    }

                });

                $('.nomor-kamar option').prop('disabled', false);

                selectedRooms.forEach(function (id) {

                    $('.nomor-kamar').each(function () {

                        if ($(this).val() != id) {

                            $(this)
                                .find(`option[value="${id}"]`)
                                .prop('disabled', true);

                        }

                    });

                });

            });




            // ==========================
            // HITUNG BIAYA REQUEST
            // ==========================
            function hitungBiayaRequest() {

                let jumlahExtraBed =
                    parseInt($('#jumlah_extra_bed').val()) || 0;

                let jumlahBreakfast =
                    parseInt($('#jumlah_breakfast').val()) || 0;

                $.ajax({

                    type: 'POST',
                    url: '/getBiayaRequest',

                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function (response) {

                        let hargaExtraBed =
                            parseInt(response.extra_bed);

                        let hargaBreakfast =
                            parseInt(response.breakfast);

                        let total = 0;
                        let keterangan = [];

                        // EXTRA BED
                        if (jumlahExtraBed > 0) {

                            let subtotal =
                                jumlahExtraBed * hargaExtraBed;

                            total += subtotal;

                            if (jumlahExtraBed == 1) {

                                keterangan.push(
                                    'Rp ' +
                                    subtotal.toLocaleString('id-ID')
                                );

                            } else {

                                keterangan.push(
                                    jumlahExtraBed +
                                    ' Extra Bed x Rp ' +
                                    hargaExtraBed.toLocaleString('id-ID') +
                                    ' = Rp ' +
                                    subtotal.toLocaleString('id-ID')
                                );

                            }
                        }

                        // BREAKFAST
                        if (jumlahBreakfast > 0) {

                            let subtotal =
                                jumlahBreakfast * hargaBreakfast;

                            total += subtotal;

                            if (jumlahBreakfast == 1) {

                                keterangan.push(
                                    'Rp ' +
                                    subtotal.toLocaleString('id-ID')
                                );

                            } else {

                                keterangan.push(
                                    jumlahBreakfast +
                                    ' Breakfast x Rp ' +
                                    hargaBreakfast.toLocaleString('id-ID') +
                                    ' = Rp ' +
                                    subtotal.toLocaleString('id-ID')
                                );

                            }
                        }

                        if (total > 0) {

                            $('#biaya_container').show();
                            $('#biaya_input_container').show();

                            if (keterangan.length > 1) {

                                keterangan.push(
                                    '\nTotal = Rp ' +
                                    total.toLocaleString('id-ID')
                                );

                            }

                            $('#biaya_request').val(
                                keterangan.join('\n')
                            );

                            // paksa resize textarea
                            setTimeout(function () {

                                $('#biaya_request').css('height', 'auto');

                                $('#biaya_request').css(
                                    'height',
                                    $('#biaya_request')[0].scrollHeight + 'px'
                                );

                            }, 10);

                            $('#biaya_request_value').val(total);

                        } else {

                            $('#biaya_container').hide();
                            $('#biaya_input_container').hide();

                            $('#biaya_request').val('');
                            $('#biaya_request_value').val('');
                        }

                    }

                });

            }

            // Saat jumlah berubah
            $(document).on(
                'input',
                '#jumlah_extra_bed, #jumlah_breakfast',
                function () {

                    hitungBiayaRequest();

                }
            );



            // ==========================
            // METODE PEMBAYARAN
            // ==========================
            $(document).on('change', '#metode_pembayaran', function () {

                let metode = $(this).val();

                if (metode === 'online') {

                    $('#sumber_pembayaran_container').show();
                    $('#sumber_pembayaran_input').show();

                } else {

                    $('#sumber_pembayaran_container').hide();
                    $('#sumber_pembayaran_input').hide();

                    $('#sumber_pembayaran').val('');
                }

            });

        });
    </script>
@endpush