@extends('layouts.ModalPembayaran')
@section('content')
    <input type="hidden" id="id_rincian_pesanan" value="{{ $data->id_rincian_pesanan }}">
    <table class="table table-bordered" style="font-size:20pt;">

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Nama Tamu</b></td>
        </tr>
        <tr>
            <td class="text-start">{{ $data->nama_tamu }}</td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Alamat Tamu</b></td>
        </tr>
        <tr>
            <td class="text-start">{{ $histori->alamat_tamu }}</td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>No. WA Tamu</b></td>
        </tr>
        <tr>
            <td class="text-start">{{ $data->no_wa_tamu }}</td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Check In</b></td>
        </tr>
        <tr>
            <td class="text-start">
                {{ \Carbon\Carbon::parse($histori->check_in)->locale('id')->translatedFormat('l, d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Check Out</b></td>
        </tr>
        <tr>
            <td class="text-start">
                {{ \Carbon\Carbon::parse($histori->check_out)->locale('id')->translatedFormat('l, d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Jumlah Kamar Dipesan :
                    {{ $data->total_kamar_dipesan }} Kamar</b></td>
        </tr>
        <tr>
            <td class="text-start">
                @foreach($kamar as $k)

                    @php

                        switch ($k->jenis_bed) {

                            case 1:
                                $bed = 'Double';
                                break;

                            case 2:
                                $bed = 'Twin';
                                break;

                            default:
                                $bed = '-';

                        }

                    @endphp

                    {{ $loop->iteration }}. {{ $k->tipe_kamar }} {{ $k->nomor_kamar }} - {{ $bed }} <br>

                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Foto KTP</b></td>
        </tr>
        <tr>
            <td>
                @if($foto && $foto->foto_ktp)

                    <img src="{{ asset('storage/uploads/foto_ktp/' . $foto->foto_ktp) }}" width="200">

                @else

                    <div class="text-center">

                        <p>Tidak ada foto KTP</p>

                        <button class="btn btn-primary" id="btnTambahKTP">

                            Tambah Foto KTP

                        </button>

                        <input type="file" id="uploadKTP" accept="image/*" style="display:none;">

                    </div>

                @endif
            </td>
        </tr>

        <tr>
            <td class="text-start" style="background:#f5f5f5;font-weight:bold;">
                <b>Request</b>
            </td>
        </tr>

        <tr>
            <td class="text-start">

                @if($requestTambahan->count() > 0)

                    @foreach($requestTambahan as $req)

                        {{ $loop->iteration }}.
                        {{ $req->tipe_kamar }}
                        ({{ $req->jumlah_request }})

                        <br>

                    @endforeach

                @else

                    -

                @endif

            </td>
        </tr>

    </table>

    <button type="button" class="btn btn-secondary w-100 mt-3" data-bs-dismiss="modal" style="font-size:20pt;">
        Tutup
    </button>
@endsection
@push('myscript')
    <script>

        $(document).on('click', '#btnTambahKTP', function () {

            $('#uploadKTP').click();

        });


        $(document).on('change', '#uploadKTP', function () {

            let file = this.files[0];

            if (!file) {
                return;
            }

            let formData = new FormData();

            formData.append('_token', "{{ csrf_token() }}");
            formData.append(
                'id_rincian_pesanan',
                $('#id_rincian_pesanan').val()
            );
            formData.append('foto_ktp', file);
            formData.append(
                'nama_pengguna',
                localStorage.getItem('nama_pengguna')
            );

            $.ajax({

                url: '/UploadFotoKTP',
                type: 'POST',
                data: formData,

                processData: false,
                contentType: false,

                beforeSend: function () {

                    Swal.fire({
                        title: 'Mengupload...',
                        text: 'Mohon tunggu',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                },

                success: function (res) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Foto KTP berhasil diupload'
                    });

                    // Reload isi modal tanpa refresh halaman
                    $.ajax({

                        type: 'POST',

                        url: '/ModalInfo',

                        data: {
                            _token: "{{ csrf_token() }}",
                            id_rincian_pesanan: $('#id_rincian_pesanan').val()
                        },

                        success: function (html) {

                            $('#loadModalInfo').html(html);

                        }

                    });

                },

                error: function (xhr) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message ??
                            'Upload gagal'
                    });

                }

            });

        });

    </script>
@endpush