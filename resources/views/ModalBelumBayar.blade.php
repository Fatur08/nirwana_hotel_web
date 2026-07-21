@extends('layouts.ModalBelumBayar')
@section('content')
    <form action="{{ url('ModalBelumBayar/store_ModalBelumBayar') }}" method="POST" id="frmModalBelumBayar"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_rincian_pesanan" value="{{ $id_rincian_pesanan }}">


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
                <select name="status_pembayaran" id="status_pembayaran" class="form-control" style="font-size:16pt;">
                    <option value="">
                        -- Pilih Status Pembayaran --
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

        <div class="row mb-4" id="metode_pembayaran_input" style="display:none;">
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









        <!-- NOMINAL DP -->
        <div class="row" id="total_dp_container" style="display:none;">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">
                    Masukkan Jumlah DP
                </h5>
            </div>
        </div>

        <div class="row mb-4" id="total_dp_input" style="display:none;">
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
                        placeholder="Contoh : 500.000">
                </div>
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
                <div class="input-icon mb-6">
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


        <!-- UPLOAD BUKTI PEMBAYARAN -->
        <div class="row" id="bukti_pembayaran_container" style="display:none;">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">
                    Upload Bukti Pembayaran
                </h5>
            </div>
        </div>

        <div class="row" id="bukti_pembayaran_input" style="display:none;">
            <div class="col-12">
                <div class="input-icon mb-6">

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

                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control" accept="image/*"
                        style="font-size:16pt;">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-info w-100" type="submit" style="font-size:16pt;">
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
            // ==========================
            // STATUS PEMBAYARAN
            // ==========================
            $(document).on('change', '#status_pembayaran', function () {
                let status = $(this).val();

                $('#metode_pembayaran').val('');
                $('#total_dp').val('');
                $('#sumber_pembayaran').val('');
                $('#bukti_pembayaran').val('');

                $('#metode_pembayaran_container').hide();
                $('#metode_pembayaran_input').hide();

                $('#total_dp_container').hide();
                $('#total_dp_input').hide();

                $('#sumber_pembayaran_container').hide();
                $('#sumber_pembayaran_input').hide();

                $('#bukti_pembayaran_container').hide();
                $('#bukti_pembayaran_input').hide();

                if (status == '1' || status == '2') {
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

                $('#total_dp_container').hide();
                $('#total_dp_input').hide();

                $('#sumber_pembayaran_container').hide();
                $('#sumber_pembayaran_input').hide();

                $('#bukti_pembayaran_container').hide();
                $('#bukti_pembayaran_input').hide();

                // ====================================
                // STATUS DP
                // ====================================
                if (status == '1') {
                    $('#total_dp_container').show();
                    $('#total_dp_input').show();

                    if (metode == 'online') {
                        $('#sumber_pembayaran_container').show();
                        $('#sumber_pembayaran_input').show();

                        $('#bukti_pembayaran_container').show();
                        $('#bukti_pembayaran_input').show();
                    }
                }

                // ====================================
                // STATUS SUDAH BAYAR
                // ====================================
                if (status == '2') {
                    if (metode == 'online') {
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
            // SUBMIT FORM
            // ==========================
            $(document).on('submit', '#frmModalBelumBayar', function (e) {

                e.preventDefault();

                let status = $('#status_pembayaran').val();
                let metode = $('#metode_pembayaran').val();

                let total_dp = $('#total_dp').val();
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

                // =========================================
                // STATUS PEMBAYARAN WAJIB
                // =========================================

                if (status == '') {

                    showError(
                        'Silahkan pilih Status Pembayaran',
                        '#status_pembayaran'
                    );

                    return;

                }

                // =========================================
                // METODE PEMBAYARAN WAJIB
                // =========================================

                if (metode == '') {

                    showError(
                        'Silahkan pilih Metode Pembayaran',
                        '#metode_pembayaran'
                    );

                    return;

                }

                // =========================================
                // JIKA STATUS = DP
                // =========================================

                if (status == '1') {

                    if (total_dp == '') {

                        showError(
                            'Nominal DP harus diisi',
                            '#total_dp'
                        );

                        return;

                    }

                    if (metode == 'online') {

                        if (sumber == '') {

                            showError(
                                'Sumber pembayaran harus diisi',
                                '#sumber_pembayaran'
                            );

                            return;

                        }

                        if (bukti == '') {

                            showError(
                                'Upload bukti pembayaran DP',
                                '#bukti_pembayaran'
                            );

                            return;

                        }

                    }

                }

                // =========================================
                // JIKA STATUS = SUDAH BAYAR
                // =========================================

                if (status == '2') {

                    if (metode == 'online') {

                        if (sumber == '') {

                            showError(
                                'Sumber pembayaran harus diisi',
                                '#sumber_pembayaran'
                            );

                            return;

                        }

                        if (bukti == '') {

                            showError(
                                'Upload bukti pembayaran',
                                '#bukti_pembayaran'
                            );

                            return;

                        }

                    }

                }

                // =========================================
                // AJAX
                // =========================================

                let formData = buatFormData(this);

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

                    success: function () {

                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Status pembayaran berhasil diperbarui',
                            icon: 'success'
                        }).then(() => {

                            window.location.reload();

                        });

                    },

                    error: function (xhr) {

                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON?.message ??
                                'Terjadi kesalahan',
                            icon: 'error'
                        });

                    }

                });

            });

        });
    </script>
@endpush