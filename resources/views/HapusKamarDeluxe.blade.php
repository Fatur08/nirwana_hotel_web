@extends('layouts.TambahModalDLX')
@section('content')
    <form action="{{ url('HapusKamarDeluxe/store_HapusKamarDeluxe') }}" method="POST" id="frmHapusKamarDeluxe"
        enctype="multipart/form-data">
        @csrf
        <input type="text" readonly value="{{ $kode_kamar }}" id="kode_kamar" class="form-control" name="kode_kamar"
            placeholder="kode_kamar" hidden>

        <div class="row mt-2">
            <div class="col-12">
                <h5 class="text-start" style="font-size:25pt;">
                    Pilih Jumlah Kamar yang Akan Dihapus :
                </h5>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-12">
                <select name="jumlah_kamar" id="jumlah_kamar" class="form-control" style="font-size:25pt;">

                    <option value="">
                        -- Pilih Jumlah Kamar --
                    </option>

                    @for($i = 1; $i <= $jumlahKamar; $i++)
                        <option value="{{ $i }}">
                            {{ $i }} Kamar
                        </option>
                    @endfor

                </select>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-warning w-100" type="submit" style="font-size:25pt;">
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
        // SUBMIT FORM PESAN KAMAR
        // ==========================
        $(document).on('submit', '#frmHapusKamarDeluxe', function (e) {

            e.preventDefault();

            let jumlah_kamar = $('#jumlah_kamar').val();

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

            if (jumlah_kamar == '') {

                showError(
                    'Pilih jumlah kamar yang akan dihapus!',
                    '#jumlah_kamar'
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
                        text: 'Data Kamar Deluxe Berhasil dihapus',
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