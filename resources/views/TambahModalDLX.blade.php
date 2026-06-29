@extends('layouts.TambahModalDLX')
@section('content')
    <form action="{{ url('TambahModalDLX/store_TambahModalDLX') }}" method="POST" id="frmTambahModalDLX"
        enctype="multipart/form-data">
        @csrf
        <input type="text" readonly value="{{ $kode_kamar }}" id="kode_kamar" class="form-control" name="kode_kamar"
            placeholder="kode_kamar" hidden>

        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:25pt;">Masukkan Jumlah Kamar</h5>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-12">
                <input type="number" id="jumlah_kamar" name="jumlah_kamar" class="form-control" min="0" value="0"
                    style="font-size:25pt;">
            </div>
        </div>




        <!-- JENIS BED -->
        <div class="row">
            <div class="col-12">
                <h5 class="text-start" style="font-size:25pt;">
                    Jenis Bed
                </h5>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-12">
                <select id="jenis_bed" name="jenis_bed" class="form-control" style="font-size:25pt;">

                    <option value="">
                        -- Pilih Jenis Bed --
                    </option>

                    <option value="1">
                        Single Bed
                    </option>

                    <option value="2">
                        Double Bed
                    </option>

                </select>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-success w-100" type="submit" style="font-size:25pt;">
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

        });</script>
@endpush