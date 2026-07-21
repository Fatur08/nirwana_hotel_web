@extends('layouts.PesanKamar')
@section('content')
    <style>
        #biaya_request {
            resize: none;
            overflow: hidden;
        }




        .select2-container--default .select2-selection--single {

            height: 58px;

            font-size: 16pt;

            border: 1px solid #ced4da;

        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {

            line-height: 56px;

            padding-left: 15px;

        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {

            height: 56px;

        }

        .select2-results__option {

            font-size: 16pt;

        }
    </style>



    <div class="row mt-3 mb-6">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Apakah Customer Baru?</h5>

            <select class="form-select" id="customer_baru" style="font-size:16pt;">
                <option value="">-- Pilih Ya / Tidak --</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
    </div>



    <form action="{{ url('PesanKamar/store_PesanKamar') }}" method="POST" id="frmPesanKamar" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="jenis_customer" name="jenis_customer">
        <!-- FORM CUSTOMER BARU -->
        <div id="formCustomerBaru" style="display:none;">
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
                        <input type="text" value="" id="nama_tamu" class="form-control" style="font-size:16pt;"
                            name="nama_tamu" placeholder="Masukkan Nama Tamu">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">Alamat Tamu</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-6">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <input type="text" value="" id="alamat_tamu" class="form-control" style="font-size:16pt;"
                            name="alamat_tamu" placeholder="Masukkan Alamat Tamu">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">No. WA Tamu</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-6">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icon-tabler-phone">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4
                                                                                                                                                                                                                                                                                                                                                                                                                                                         a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                            </svg>
                        </span>
                        <input type="text" id="no_wa_tamu" name="no_wa_tamu" class="form-control"
                            placeholder="Masukkan Nomor WA Tamu" inputmode="numeric" pattern="[0-9]+" minlength="10"
                            maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
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
                        <input type="file" id="foto_ktp" name="foto_ktp" accept="image/*" class="form-control"
                            style="font-size:16pt;">
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM CUSTOMER LAMA -->
        <div id="formCustomerLama" style="display:none;">
            <input type="hidden" id="id_customer_lama" name="id_customer_lama" value="">
            <div class="mb-3">

                <label class="form-label fw-bold text-start" style="font-size:16pt;">
                    Cari Customer
                </label>

                <input type="text" name="keyword_customer" id="keyword_customer" class="form-control"
                    placeholder="Ketik nama customer...">

            </div>

            <div id="hasilCustomer" class="list-group mb-3"
                style="display:none;
                                                                                                                                                                                                                                                                                    max-height:250px;
                                                                                                                                                                                                                                                                                    overflow-y:auto;">

            </div>

            <hr>

            <div id="dataCustomerLama" style="display:none;">

                <div class="mb-6">

                    <label class="form-label fw-bold text-start" style="font-size:16pt;">
                        Nama Customer
                    </label>

                    <input type="text" name="lama_nama_tamu" id="lama_nama_tamu" class="form-control" readonly>

                </div>

                <div class="mb-6">

                    <label class="form-label fw-bold text-start" style="font-size:16pt;">
                        Alamat
                    </label>

                    <div id="lama_alamat_tamu" class="form-control d-flex align-items-center"
                        style="
                                                                                                                                                                                                                    min-height:70px;
                                                                                                                                                                                                                    font-size:16pt;
                                                                                                                                                                                                                    white-space:pre-wrap;
                                                                                                                                                                                                                    word-break:break-word;">
                    </div>

                </div>

                <div class="mb-6">

                    <label class="form-label fw-bold text-start" style="font-size:16pt;">
                        No WA
                    </label>

                    <input type="text" name="lama_no_wa" id="lama_no_wa" class="form-control" readonly>

                </div>

                <div class="mb-6">

                    <label class="form-label fw-bold text-start" style="font-size:16pt;">
                        Foto KTP
                    </label>

                    <div id="lama_foto_ktp">

                        <div class="text-muted" style="font-size:16pt;">

                            Tidak ada Foto KTP

                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-warning" id="gantiCustomer" style="font-size:16pt;">

                    Ganti Customer

                </button>

            </div>

        </div>

        <!-- FORM BOOKING -->
        <div id="formBooking" style="display:none;">
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
                    <select id="jumlah_kamar_dipesan" name="jumlah_kamar_dipesan" class="form-control"
                        style="font-size:16pt;">
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
                    <h5 class="text-start" style="font-size:16pt;">Jumlah Extra Bed</h5>
                </div>
            </div>

            <div class="row mb-6">
                <div class="col-12">
                    <input type="number" id="jumlah_extra_bed" name="jumlah_extra_bed" class="form-control" min="0" value=""
                        style="font-size:16pt;" placeholder="Masukkan Jumlah Ekstra Bed">
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">Jumlah Breakfast</h5>
                </div>
            </div>

            <div class="row mb-6">
                <div class="col-12">
                    <input type="number" id="jumlah_breakfast" name="jumlah_breakfast" class="form-control" min="0" value=""
                        style="font-size:16pt;" placeholder="Masukkan Jumlah Breakfast">
                </div>
            </div>


            <div class="row" id="biaya_container" style="display:none;">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">Biaya Tambahan</h5>
                </div>
            </div>

            <div class="row mb-6" id="biaya_input_container" style="display:none;">
                <div class="col-12">
                    <textarea id="biaya_request" class="form-control" readonly
                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    font-size:16pt;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    min-height:120px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    resize:none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    overflow:hidden;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </textarea>

                    <input type="hidden" id="biaya_request_value" name="biaya_request">
                </div>
            </div>


            <!-- STATUS PEMBAYARAN -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">
                        Status Pembayaran
                    </h5>
                </div>
            </div>

            <div class="row mb-6">
                <div class="col-12">
                    <select id="status_pembayaran" name="status_pembayaran" class="form-control" style="font-size:16pt;">

                        <option value="">
                            -- Pilih Status Pembayaran --
                        </option>

                        <option value="0">
                            Belum Bayar
                        </option>

                        <option value="1">
                            DP
                        </option>

                        <option value="2">
                            Sudah Bayar
                        </option>

                    </select>
                </div>
            </div>



            <!-- METODE PEMBAYARAN -->
            <div class="row" id="metode_pembayaran_container" style="display:none;">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">
                        Metode Pembayaran
                    </h5>
                </div>
            </div>

            <div class="row mb-6" id="metode_pembayaran_input" style="display:none;">
                <div class="col-12">
                    <select id="metode_pembayaran" name="metode_pembayaran" class="form-control" style="font-size:16pt;">

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>

                        <option value="cash">
                            Cash
                        </option>

                        <option value="online">
                            Online
                        </option>

                    </select>
                </div>
            </div>



            <!-- INPUT JUMLAH DP -->
            <div class="row" id="total_dp_container" style="display:none;">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">
                        Masukkan Jumlah DP
                    </h5>
                </div>
            </div>

            <div class="row mb-6" id="total_dp_input" style="display:none;">
                <div class="col-12">
                    <div class="input-icon">

                        <span class="input-icon-addon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon">

                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 9v-2a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2" />
                                <path d="M12 11h.01" />
                                <path d="M12 14h.01" />

                            </svg>

                        </span>

                        <input type="text" id="total_dp" name="total_dp" class="form-control" style="font-size:16pt;"
                            placeholder="Contoh: 500000">
                    </div>
                </div>
            </div>



            <!-- SUMBER PEMBAYARAN -->
            <div class="row" id="sumber_pembayaran_container" style="display:none;">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">
                        Masukkan Sumber Pembayaran
                    </h5>
                </div>
            </div>

            <div class="row mb-6" id="sumber_pembayaran_input" style="display:none;">
                <div class="col-12">
                    <div class="input-icon">

                        <span class="input-icon-addon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon">

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



            <!-- BUKTI PEMBAYARAN -->
            <div class="row" id="bukti_pembayaran_container" style="display:none;">
                <div class="col-12">
                    <h5 class="text-start" style="font-size:16pt;">
                        Upload Bukti Pembayaran
                    </h5>
                </div>
            </div>

            <div class="row mb-6" id="bukti_pembayaran_input" style="display:none;">
                <div class="col-12">
                    <div class="input-icon">

                        <span class="input-icon-addon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon">

                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 8h.01" />
                                <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />

                            </svg>

                        </span>

                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control"
                            accept="image/*" style="font-size:16pt;">

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
            </div>

        </form>

@endsection
@push('myscript')
    <script>

        $(document).ready(function () {

            // Default saat modal dibuka
            $('#sumber_pembayaran_container').hide();
            $('#sumber_pembayaran_input').hide();

            $('#bukti_pembayaran_container').hide();
            $('#bukti_pembayaran_input').hide();


            $('#metode_pembayaran_container').hide();
            $('#metode_pembayaran_input').hide();

            $('#biaya_container').hide();
            $('#biaya_input_container').hide();

            $('#formCustomerBaru').hide();
            $('#formCustomerLama').hide();
            $('#formBooking').hide();


            $('#jumlah_kamar_dipesan').html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            -- Pilih Tanggal Check In Dulu --
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `);

            $('#kamar_tersedia_title').hide();
            $('#kamar_tersedia_list').hide();





            // ==========================
            // PILIH JENIS CUSTOMER
            // ==========================
            $('#customer_baru').change(function () {

                let jenis = $(this).val();

                // ==========================
                // RESET BOOKING
                // ==========================
                if (typeof resetFormBooking === "function") {
                    resetFormBooking();
                }

                // ==========================
                // RESET CUSTOMER
                // ==========================
                $('#formCustomerBaru').hide();
                $('#formCustomerLama').hide();

                $('#jenis_customer').val('');

                $('#id_customer_lama').val('');

                $('#hasilCustomer').hide();
                $('#dataCustomerLama').hide();

                $('#keyword_customer')
                    .val('')
                    .prop('readonly', false);

                $('#lama_nama_tamu').val('');
                $('#lama_alamat_tamu').text('');
                $('#lama_no_wa').val('');

                $('#lama_foto_ktp').html(`
                                                                                                                                    <div class="text-muted">
                                                                                                                                        Tidak ada Foto KTP
                                                                                                                                    </div>
                                                                                                                                `);

                // reset input customer baru
                $('#nama_tamu').val('');
                $('#alamat_tamu').val('');
                $('#no_wa_tamu').val('');
                $('#foto_ktp').val('');

                // ==========================
                // CUSTOMER BARU
                // ==========================
                if (jenis === "ya") {

                    $('#jenis_customer').val('baru');

                    $('#formCustomerBaru').show();
                    $('#formBooking').show();

                }

                // ==========================
                // CUSTOMER LAMA
                // ==========================
                else if (jenis === "tidak") {

                    $('#jenis_customer').val('lama');

                    $('#formCustomerLama').show();

                }

            });












            $(document).on('keyup', '#keyword_customer', function () {

                let keyword = $(this).val();

                if (keyword.length < 1) {

                    $('#hasilCustomer').hide();
                    $('#hasilCustomer').html('');

                    return;

                }

                $.ajax({

                    type: 'POST',

                    url: '/CariCustomer',

                    data: {

                        _token: $('meta[name="csrf-token"]').attr('content'),

                        keyword: keyword

                    },

                    success: function (response) {

                        let html = '';

                        if (response.length == 0) {

                            html = `
                                                                                                                                                                                                                                                                                                                                    <div class="list-group-item text-danger">
                                                                                                                                                                                                                                                                                                                                        Customer tidak ditemukan
                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                `;

                        } else {

                            response.forEach(function (item) {

                                html += `
                                                                                                                                                                                                                                                                                                                                        <a href="#"

                                                                                                                                                                                                                                                                                                                                           class="list-group-item list-group-item-action pilihCustomer"

                                                                                                                                                                                                                                                                                                                                           data-id="${item.id_rincian_pesanan}"

                                                                                                                                                                                                                                                                                                                                           data-nama="${item.nama_tamu}"

                                                                                                                                                                                                                                                                                                                                           data-alamat="${item.alamat_tamu ?? ''}"

                                                                                                                                                                                                                                                                                                                                           data-wa="${item.no_wa_tamu ?? ''}"

                                                                                                                                                                                                                                                                                                                                           data-foto="${item.foto_ktp ?? ''}">

                                                                                                                                                                                                                                                                                                                                            <b>${item.nama_tamu}</b>

                                                                                                                                                                                                                                                                                                                                            <br>

                                                                                                                                                                                                                                                                                                                                            <small>

                                                                                                                                                                                                                                                                                                                                                ${item.alamat_tamu ?? '-'}

                                                                                                                                                                                                                                                                                                                                            </small>

                                                                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                                                                    `;

                            });

                        }

                        $('#hasilCustomer').html(html).show();

                    }

                });

            });








            $(document).on('click', '.pilihCustomer', function (e) {

                e.preventDefault();

                // simpan id customer
                $('#id_customer_lama').val($(this).data('id'));

                // tampilkan data customer
                $('#lama_nama_tamu').val($(this).data('nama'));

                $("#lama_alamat_tamu").text($(this).data('alamat'));

                $('#lama_no_wa').val($(this).data('wa'));

                // Foto KTP
                let foto = $(this).data('foto');

                if (foto != '') {

                    $('#lama_foto_ktp').html(`
                                                                                                                                                                                                                                                                                                                        <img
                                                                                                                                                                                                                                                                                                                            src="/storage/uploads/foto_ktp/${foto}"
                                                                                                                                                                                                                                                                                                                            class="img-fluid rounded border"
                                                                                                                                                                                                                                                                                                                            style="max-height:250px;">
                                                                                                                                                                                                                                                                                                                    `);

                } else {

                    $('#lama_foto_ktp').html(`
                                                                                                                                                                                                                                                                                                                        <div class="text-muted">
                                                                                                                                                                                                                                                                                                                            Tidak ada Foto KTP
                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                    `);

                }

                // isi textbox dengan nama customer
                $('#keyword_customer').val($(this).data('nama'));

                // sembunyikan hasil pencarian
                $('#hasilCustomer').hide();

                // tampilkan data customer
                $('#dataCustomerLama').slideDown(200);

            });








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
                                let bed = '-';
                                if (kamar.jenis_bed == 1) {
                                    bed = 'Double';
                                } else if (kamar.jenis_bed == 2) {
                                    bed = 'Twin';
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
            // STATUS PEMBAYARAN
            // ==========================
            $(document).on('change', '#status_pembayaran', function () {

                let status = $(this).val();

                // Reset semua field
                $('#metode_pembayaran').val('');
                $('#total_dp').val('');
                $('#sumber_pembayaran').val('');
                $('#bukti_pembayaran').val('');

                // Sembunyikan semua
                $('#metode_pembayaran_container, #metode_pembayaran_input').hide();
                $('#total_dp_container, #total_dp_input').hide();
                $('#sumber_pembayaran_container, #sumber_pembayaran_input').hide();
                $('#bukti_pembayaran_container, #bukti_pembayaran_input').hide();

                // Jika DP atau Sudah Bayar
                if (status === '1' || status === '2') {

                    $('#metode_pembayaran_container').show();
                    $('#metode_pembayaran_input').show();

                }

            });





            // ==========================
            // METODE PEMBAYARAN
            // ==========================
            $(document).on('change', '#metode_pembayaran', function () {

                let metode = $(this).val();
                let status = $('#status_pembayaran').val();

                // Reset field online
                $('#sumber_pembayaran').val('');
                $('#bukti_pembayaran').val('');
                $('#total_dp').val('');

                // Sembunyikan semua tambahan
                $('#total_dp_container, #total_dp_input').hide();
                $('#sumber_pembayaran_container, #sumber_pembayaran_input').hide();
                $('#bukti_pembayaran_container, #bukti_pembayaran_input').hide();



                // =========================================
                // STATUS DP
                // =========================================
                if (status === '1') {

                    // Selalu tampilkan nominal DP
                    $('#total_dp_container').show();
                    $('#total_dp_input').show();

                    // Jika online
                    if (metode === 'online') {

                        $('#sumber_pembayaran_container').show();
                        $('#sumber_pembayaran_input').show();

                        $('#bukti_pembayaran_container').show();
                        $('#bukti_pembayaran_input').show();

                    }

                }



                // =========================================
                // STATUS SUDAH BAYAR
                // =========================================
                if (status === '2') {

                    // Jika online
                    if (metode === 'online') {

                        $('#sumber_pembayaran_container').show();
                        $('#sumber_pembayaran_input').show();

                        $('#bukti_pembayaran_container').show();
                        $('#bukti_pembayaran_input').show();

                    }

                }

            });





            // ==========================
            // FORMAT RUPIAH TOTAL DP
            // ==========================
            $('#total_dp').on('keyup', function () {
                let angka = $(this).val().replace(/[^0-9]/g, '');
                let rupiah = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $(this).val(rupiah);
            });








            // ==========================
            // SUBMIT FORM PESAN KAMAR
            // ==========================
            $(document).on('submit', '#frmPesanKamar', function (e) {

                e.preventDefault();

                let jenis_customer = $('#jenis_customer').val();

                let check_in = $('#check_in').val();
                let check_out = $('#check_out').val();
                let jumlah_kamar = $('#jumlah_kamar_dipesan').val();

                let status = $('#status_pembayaran').val();
                let metode = $('#metode_pembayaran').val();
                let sumber = $('#sumber_pembayaran').val();

                let bukti = $('#bukti_pembayaran').val();

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
                if (jenis_customer == "") {

                    showError("Silahkan pilih terlebih dahulu apakah Customer Baru");

                    return;

                }

                if (jenis_customer === "baru") {

                    if ($('#nama_tamu').val() == '') {
                        showError('Nama Tamu Harus Diisi', '#nama_tamu');
                        return;
                    }

                    if ($('#alamat_tamu').val() == '') {
                        showError('Alamat Tamu Harus Diisi', '#alamat_tamu');
                        return;
                    }

                    if ($('#no_wa_tamu').val() == '') {
                        showError('Nomor WA Harus Diisi', '#no_wa_tamu');
                        return;
                    }

                } else if (jenis_customer === "lama") {

                    if ($('#id_customer_lama').val() == '') {

                        showError('Silahkan pilih customer terlebih dahulu');

                        return;

                    }

                }

                if (check_in == '') {
                    showError('Tanggal Check In Harus Diisi');
                    return;
                }

                if (check_out == '') {
                    showError('Tanggal Check Out Harus Diisi');
                    return;
                }

                if (jumlah_kamar == '') {
                    showError(
                        'Jumlah Kamar Harus Dipilih',
                        '#jumlah_kamar_dipesan'
                    );
                    return;
                }

                // Validasi semua kamar dipilih
                let kamarKosong = false;

                $('.nomor-kamar').each(function () {

                    if ($(this).val() == '') {

                        kamarKosong = true;
                        $(this).focus();

                        return false;
                    }

                });

                if (kamarKosong) {

                    showError('Semua Kamar Harus Dipilih');
                    return;

                }

                // =========================================
                // VALIDASI STATUS PEMBAYARAN
                // =========================================

                // DP atau Sudah Bayar
                if (status == '1' || status == '2') {
                    if (metode == '') {
                        showError(
                            'Metode Pembayaran Harus Dipilih',
                            '#metode_pembayaran'
                        );
                        return;
                    }
                }



                // =========================================
                // VALIDASI DP
                // =========================================
                if (status == '1') {
                    if ($('#total_dp').val() == '') {
                        showError(
                            'Nominal DP Harus Diisi',
                            '#total_dp'
                        );
                        return;
                    }
                }



                // =========================================
                // VALIDASI PEMBAYARAN ONLINE
                // =========================================
                if ((status == '1' || status == '2') && metode == 'online') {
                    if (sumber == '') {
                        showError(
                            'Sumber Pembayaran Harus Diisi',
                            '#sumber_pembayaran'
                        );
                        return;
                    }

                    if (bukti == '') {
                        showError(
                            'Bukti Pembayaran Harus Diupload',
                            '#bukti_pembayaran'
                        );
                        return;
                    }
                }

                // ==========================
                // AJAX SIMPAN
                // ==========================

                let formData = buatFormData(this);


                // ==========================
                // UBAH FORMAT RUPIAH MENJADI ANGKA
                // ==========================
                let totalDP = formData.get('total_dp');
                if (totalDP) {
                    totalDP = totalDP.replace(/\./g, '');
                    formData.set(
                        'total_dp',
                        totalDP
                    );
                }

                console.log(formData.get('dibuat_oleh'));

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
                            text: 'Pemesanan kamar berhasil disimpan',
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

        });
    </script>
@endpush