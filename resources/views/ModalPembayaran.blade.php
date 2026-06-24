@extends('layouts.ModalPembayaran')
@section('content')
    <form action="{{ url('ModalPembayaran/store_ModalPembayaran') }}" method="POST" id="frmModalPembayaran"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_laporan_keuangan" value="{{ $id_laporan_keuangan }}">
        <!-- METODE PEMBAYARAN -->
        <div class="row" id="metode_pembayaran_container">
            <div class="col-12">
                <h5 class="text-start" style="font-size:16pt;">Metode Pembayaran</h5>
            </div>
        </div>
        <div class="row mb-6" id="metode_pembayaran_input">
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
            // METODE PEMBAYARAN
            // ==========================
            $(document).on('change', '#metode_pembayaran', function () {

                let metode = $(this).val();

                if (metode === 'online') {

                    $('#sumber_pembayaran_container').show();
                    $('#sumber_pembayaran_input').show();

                    $('#bukti_pembayaran_container').show();
                    $('#bukti_pembayaran_input').show();

                } else {

                    $('#sumber_pembayaran_container').hide();
                    $('#sumber_pembayaran_input').hide();

                    $('#bukti_pembayaran_container').hide();
                    $('#bukti_pembayaran_input').hide();

                    $('#sumber_pembayaran').val('');
                    $('#bukti_pembayaran').val('');
                }

            });




            // ==========================
            // SUBMIT FORM PESAN KAMAR
            // ==========================
            $(document).on('submit', '#frmModalPembayaran', function (e) {

                e.preventDefault();
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
                if (metode == '') {

                    showError(
                        'Metode Pembayaran Harus Dipilih',
                        '#metode_pembayaran'
                    );

                    return;
                }

                if (metode == 'online' && sumber == '') {

                    showError(
                        'Sumber Pembayaran Harus Diisi',
                        '#sumber_pembayaran'
                    );

                    return;
                }

                if (metode == 'online' && bukti == '') {

                    showError(
                        'Bukti Pembayaran Harus Diupload',
                        '#bukti_pembayaran'
                    );

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