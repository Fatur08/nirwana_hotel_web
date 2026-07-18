@extends('layouts.index')
@section('content')
    <div class="body" style="margin-top: 10px;">
        <div class="login-container">
            <div class="login-title">
                <h1>Aplikasi Manajemen<br>Hotel Nirwana</h1>
            </div>
            <div class="logo-area">

                {{-- Logo Hotel --}}
                <img src="{{ asset('assets/img/Nirwana_Logo.png') }}" alt="Logo Hotel Nirwana" class="logo-hotel">

                {{-- Tombol Notifikasi --}}
                <div class="dropdown notification-wrapper">

                    <button id="btnNotifikasi" class="btn-notifikasi" data-bs-toggle="dropdown" aria-expanded="false">

                        🔔

                    </button>

                    {{-- Dropdown Activity Log --}}
                    <div class="dropdown-menu dropdown-menu-end shadow activity-dropdown p-0">
                        <div class="activity-header">
                            <div>
                                <div class="activity-title">
                                    Activity Log
                                </div>

                                <div class="activity-subtitle">
                                    10 aktivitas terbaru
                                </div>
                            </div>
                        </div>

                        <div class="activity-divider"></div>

                        <div class="activity-body" id="activityBody">
                            <div class="activity-empty">
                                <div class="activity-empty-icon">
                                    📭
                                </div>

                                <p class="mb-0">
                                    Memuat aktivitas...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <div class="kotak-pesan">

                <div class="row">
                    <div class="col-12">
                        <a href="#" class="PesanKamar btn btn-dark w-100" style="font-size:35pt; white-space:nowrap;">
                            Pesan Kamar
                        </a>
                    </div>
                </div>

                <div class="row mt-3">

                    <!-- KAMAR DELUXE -->
                    <div class="col-6 mb-3">
                        <div class="kotak-dlx h-100 p-4 text-center">

                            <p class="mb-3">Kamar Deluxe</p>

                            <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $kamarSingleDLX }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleDLX }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#00ff79;">
                                    Rp.{{ number_format($tarifKamar['DLX']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>

                    <!-- HOME STAY -->
                    <div class="col-6 mb-3">
                        <div class="kotak-hmsty h-100 p-4 text-center">

                            <p class="mb-3">Home Stay</p>

                            <img src="{{ asset('assets/img/homestay.jpg') }}" class="img-fluid rounded mb-3"
                                style="max-height:180px;">

                            <p class="mb-2">
                                Tersedia Hari ini<br>
                                {{ $SingleHMSTY }} Kamar Single Bed
                                <br>
                                {{ $DoubleHMSTY }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#8F00FF;">
                                    Rp.{{ number_format($tarifKamar['HMSTY']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
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
                                Tersedia Hari ini<br>
                                {{ $kamarSingleSPR }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleSPR }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#f8f9fa;">
                                    Rp.{{ number_format($tarifKamar['SPR']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
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
                                Tersedia Hari ini<br>
                                {{ $kamarSingleSTD }} Kamar Single Bed
                                <br>
                                {{ $kamarDoubleSTD }} Kamar Double Bed
                            </p>

                            <p class="mb-0">
                                <span style="font-size:24px;font-weight:700;color:#8F00FF;">
                                    Rp.{{ number_format($tarifKamar['STD']->tarif_per_hari ?? 0, 0, ',', '.') }}
                                </span>
                                / malam
                            </p>

                        </div>
                    </div>
                </div>
            </div>


            <!-- MENU KETERSEDIAAN KAMAR -->
            <a href="{{ url('KetersediaanKamar') }}" class="kotak-ketersediaan-kamar mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/ketersediaan_kamar.png') }}" class="img-fluid"
                            style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Ketersediaan Kamar
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





            <!-- MENU INFORMASI PEMESANAN -->
            <a href="{{ url('InformasiPemesanan') }}"
                class="kotak-informasi-pemesanan mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/informasi_pemesanan.png') }}" class="img-fluid"
                            style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Informasi Pemesanan
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>






            <!-- MENU DATA MASTER -->
            <a href="{{ url('DataMaster') }}" class="kotak-data-master mt-3 p-3 d-block text-decoration-none">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/data_master.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Data Master
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>









            <!-- MENU DATA PENGGUNA -->
            <a href="#" class="kotak-data-pengguna mt-3 p-3 d-block text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#ModalDataPengguna">
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/data_pengguna.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Data Pengguna
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





            <!-- MENU LOGOUT -->
            <a href="#" id="btnLogout" class="kotak-logout mt-3 p-3 d-block text-decoration-none">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">

                    @csrf

                </form>
                <div class="row align-items-center">
                    <!-- FOTO -->
                    <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('assets/img/logout.png') }}" class="img-fluid" style="max-height:120px;">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-7 col-9">
                        <p class="mb-0 text-white fw-bold" style="font-size:25pt; white-space:nowrap;">
                            Logout
                        </p>
                    </div>

                    <!-- ICON PANAH -->
                    <div class="col-md-2 col-3 text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M13 5l7 7l-7 7" />
                        </svg>
                    </div>
                </div>
            </a>





















            <!-- Modal Pesan Kamar -->
            <div class="modal fade" id="modal-pesan-kamar" tabindex="-1" aria-labelledby="ModalPesanKamar"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="ModalPesanKamar" style="font-size:20pt;">Tambah Pemesanan Kamar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="loadPesanKamar">
                        </div>
                    </div>
                </div>
            </div>





            <!-- Modal Data Pengguna -->
            <div class="modal fade" id="ModalDataPengguna" tabindex="-1" aria-labelledby="ModalDataPengguna"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="ModalPesanKamar" style="font-size:20pt;">Data Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-label fw-bold" style="font-size:20pt;">
                                Nama Pengguna
                            </label>
                            <input type="text" id="nama_pengguna_modal" class="form-control" style="font-size:20pt;"
                                readonly>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning text-white w-100" id="btnGantiPengguna" style="font-size:20pt;">
                                Ganti Pengguna
                            </button>

                            <button class="btn btn-secondary w-100" style="font-size:20pt;" data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
        </body>

@endsection
    @push('myscript')
        <script>
            // ======================================================
            // MODAL PESAN KAMAR
            // ======================================================
            $(document).on('click', '.PesanKamar', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/PesanKamar',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (respond) {

                        $("#loadPesanKamar").html(respond);

                        $("#modal-pesan-kamar").modal("show");

                        setTimeout(function () {
                            initPesanKamar();
                        }, 200);

                    }
                });
            });


            // ======================================================
            // INIT PESAN KAMAR
            // ======================================================
            function initPesanKamar() {

                const checkOutPicker = flatpickr("#check_out_pesan_kamar", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false
                });

                const checkInPicker = flatpickr("#check_in_pesan_kamar", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d F Y",
                    locale: flatpickr.l10ns.id,
                    disableMobile: true,
                    allowInput: false,

                    onChange: function (selectedDates) {

                        if (!selectedDates.length) return;

                        let checkInDate = selectedDates[0];

                        $('#check_in').val(
                            this.formatDate(checkInDate, "Y-m-d")
                        );

                        let minCheckout = new Date(checkInDate);
                        minCheckout.setDate(minCheckout.getDate() + 1);

                        checkOutPicker.set('minDate', minCheckout);

                        checkOutPicker.clear();
                        $('#check_out').val('');

                        $('#jumlah_kamar_dipesan').html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                -- Pilih Tanggal Check Out Dulu --
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `);

                        $('#kamar_tersedia_title').hide();
                        $('#kamar_tersedia_list').hide();
                        $('#list_nomor_kamar').html('');
                    }
                });

                checkOutPicker.config.onChange.push(function (selectedDates) {

                    if (!selectedDates.length) return;

                    $('#check_out').val(
                        checkOutPicker.formatDate(selectedDates[0], "Y-m-d")
                    );

                    $.ajax({
                        type: 'POST',
                        url: '/getKamarTersedia',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            check_in: $('#check_in').val(),
                            check_out: $('#check_out').val()
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

                });


                // ======================================================
                // RESET BOOKING
                // ======================================================
                function resetFormBooking() {

                    checkInPicker.clear();
                    checkOutPicker.clear();

                    $("#check_in_pesan_kamar").val("");
                    $("#check_out_pesan_kamar").val("");

                    $("#check_in").val("");
                    $("#check_out").val("");

                    $("#jumlah_kamar_dipesan").html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            -- Pilih Tanggal Check In Dulu --
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `);

                    $("#kamar_tersedia_title").hide();
                    $("#kamar_tersedia_list").hide();
                    $("#list_nomor_kamar").html("");

                    $("#jumlah_extra_bed").val("");
                    $("#jumlah_breakfast").val("");

                    $("#biaya_container").hide();
                    $("#biaya_input_container").hide();

                    $("#biaya_request").val("");
                    $("#biaya_request_value").val("");

                    $("#status_pembayaran").val("");
                    $("#metode_pembayaran").val("");
                    $("#sumber_pembayaran").val("");
                    $("#bukti_pembayaran").val("");

                    $("#metode_pembayaran_container").hide();
                    $("#metode_pembayaran_input").hide();

                    $("#sumber_pembayaran_container").hide();
                    $("#sumber_pembayaran_input").hide();

                    $("#bukti_pembayaran_container").hide();
                    $("#bukti_pembayaran_input").hide();

                    $("#formBooking").hide();

                }

                // supaya bisa dipanggil dari luar
                window.resetFormBooking = resetFormBooking;

                resetFormBooking();

            }


            // ======================================================
            // PILIH CUSTOMER
            // ======================================================
            $(document).off('click', '.pilihCustomer').on('click', '.pilihCustomer', function (e) {

                e.preventDefault();

                $("#id_customer_lama").val($(this).data('id'));

                $("#lama_nama_tamu").val($(this).data('nama'));
                $("#lama_alamat_tamu").text($(this).data('alamat'));
                $("#lama_no_wa").val($(this).data('wa'));

                if ($(this).data('foto')) {

                    $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <img src="/storage/uploads/foto_ktp/${$(this).data('foto')}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            class="img-fluid rounded"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="max-height:250px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `);

                } else {

                    $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="text-muted">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Tidak ada Foto KTP
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `);

                }

                $("#keyword_customer").val($(this).data('nama'));

                $("#hasilCustomer").hide();

                $("#dataCustomerLama").show();

                $("#formBooking").show();

                $("#gantiCustomer").show();

                $("#keyword_customer").prop("readonly", true);

            });


            // ======================================================
            // GANTI CUSTOMER
            // ======================================================
            $(document).off('click', '#gantiCustomer').on('click', '#gantiCustomer', function () {

                $("#keyword_customer").val("");
                $("#keyword_customer").prop("readonly", false);

                $("#id_customer_lama").val("");

                $("#lama_nama_tamu").val("");
                $("#lama_alamat_tamu").text("");
                $("#lama_no_wa").val("");

                $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="text-muted">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Tidak ada Foto KTP
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `);

                $("#hasilCustomer").hide();
                $("#dataCustomerLama").hide();
                $("#gantiCustomer").hide();

                resetFormBooking();

                $("#keyword_customer").focus();

            });


            // ======================================================
            // MODAL DITUTUP
            // ======================================================
            $('#modal-pesan-kamar').on('hidden.bs.modal', function () {

                $(this).find('form').trigger('reset');

                if (typeof resetFormBooking === "function") {
                    resetFormBooking();
                }

                $("#hasilCustomer").hide();
                $("#dataCustomerLama").hide();

            });





            $('#ModalDataPengguna').on('show.bs.modal', function () {
                $('#nama_pengguna_modal').val(
                    getNamaPengguna()
                );
            });



            $('#btnGantiPengguna').click(function () {
                localStorage.removeItem('nama_pengguna');
                location.reload();
            });






            /*
            |--------------------------------------------------------------------------
            | Logout
            |--------------------------------------------------------------------------
            */
            const btnLogout = document.getElementById('btnLogout');
            if (btnLogout) {
                btnLogout.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Logout',
                        text: 'Apakah Anda yakin ingin keluar dari sistem?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d32f2f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Logout',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logoutForm').submit();
                        }
                    });
                });
            }









            /*
            |--------------------------------------------------------------------------
            | Format Waktu Notifikasi
            |--------------------------------------------------------------------------
            */

            function formatWaktu(waktuDatabase) {
                const sekarang = new Date();
                const waktu = new Date(waktuDatabase.replace(" ", "T"));
                const selisih = Math.floor(
                    (sekarang - waktu) / 1000
                );

                if (selisih < 60) {
                    return "Baru saja";
                }

                if (selisih < 3600) {
                    const menit = Math.floor(
                        selisih / 60
                    );
                    return menit + " menit yang lalu";
                }

                if (selisih < 86400) {
                    const jam = Math.floor(
                        selisih / 3600
                    );
                    return jam + " jam yang lalu";
                }

                if (selisih < 172800) {
                    return "Kemarin";
                }

                if (selisih < 604800) {
                    const hari = Math.floor(
                        selisih / 86400
                    );
                    return hari + " hari yang lalu";
                }

                return waktu.toLocaleDateString("id-ID", {
                    day: "numeric",
                    month: "short",
                    year: "numeric"
                });
            }











            /*
            |--------------------------------------------------------------------------
            | Activity Log
            |--------------------------------------------------------------------------
            */

            async function loadActivityLog() {
                try {
                    const response = await fetch("/Notifikasi");
                    const data = await response.json();
                    renderActivity(data);
                } catch (error) {
                    console.error(error);
                }
            }







            /*
            |--------------------------------------------------------------------------
            | Icon Berdasarkan Jenis Notifikasi
            |--------------------------------------------------------------------------
            */

            function getActivityIcon(jenis) {
                switch (jenis) {
                    case "pemesanan":
                        return {
                            icon: "🛏️",
                            color: "bg-primary-lt"
                        };

                    case "edit_pemesanan":
                        return {
                            icon: "✏️",
                            color: "bg-warning-lt"
                        };

                    case "hapus_pesanan":
                        return {
                            icon: "🗑️",
                            color: "bg-danger-lt"
                        };

                    case "pembayaran":
                        return {
                            icon: "💰",
                            color: "bg-green-lt"
                        };

                    case "whatsapp":
                        return {
                            icon: "📱",
                            color: "bg-success-lt"
                        };

                    case "data_master":
                        return {
                            icon: "🏨",
                            color: "bg-indigo-lt"
                        };

                    default:
                        return {
                            icon: "🔔",
                            color: "bg-secondary-lt"
                        };
                }
            }






            function renderActivity(data) {
                const activityBody = document.getElementById("activityBody");
                activityBody.innerHTML = "";
                if (data.length === 0) {
                    activityBody.innerHTML = `
                    <div class="activity-empty">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="64"
                            height="64"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7h18M5 7v11a2 2 0 002 2h10a2 2 0 002-2V7M9 11h6"/>

                        </svg>
                        <h5>Belum ada aktivitas</h5>
                        <p>Semua aktivitas akan tampil di sini.</p>
                    </div>
                `;
                    return;
                }
                data.forEach(function (item) {
                    const activity = getActivityIcon(
                        item.jenis_notifikasi
                    );
                    activityBody.innerHTML += `
                    <div class="activity-item">
                        <div class="activity-icon ${activity.color}">
                            <span class="activity-emoji">
                                ${activity.icon}
                            </span>
                        </div>

                        <div class="activity-content">
                            <div class="activity-judul">
                                ${item.judul_notifikasi}
                            </div>

                            <div class="activity-isi">
                                ${item.isi_notifikasi.replace(
                        ".",
                        ` oleh <strong>${item.dibuat_oleh}</strong>.`
                    )}
                            </div>

                            <div class="activity-waktu">
                                ${formatWaktu(item.waktu_notifikasi)}
                            </div>
                        </div>
                    </div>
                `;
                });
            }






            document.addEventListener("DOMContentLoaded", function () {
                loadActivityLog();
            });
        </script>
    @endpush