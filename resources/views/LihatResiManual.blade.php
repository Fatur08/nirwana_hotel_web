@php
    use Carbon\Carbon;

    $checkIn = $data && $data->check_in
        ? Carbon::parse($data->check_in)
        : null;

    $checkOut = $data && $data->check_out
        ? Carbon::parse($data->check_out)
        : null;

    $lama = ($checkIn && $checkOut)
        ? $checkIn->diffInDays($checkOut)
        : 0;

    // Tarif
    $hargaDLX = 300000;
    $hargaSPR = 280000;
    $hargaSTD = 240000;
    $hargaHM = 800000;
    $hargaEB = 60000;
    $hargaBF = 30000;

    // Subtotal kamar
    $subtotalDLX = ($data->jumlah_kamar_deluxe ?? 0) * $hargaDLX * $lama;
    $subtotalSPR = ($data->jumlah_kamar_superior ?? 0) * $hargaSPR * $lama;
    $subtotalSTD = ($data->jumlah_kamar_standart ?? 0) * $hargaSTD * $lama;
    $subtotalHM = ($data->jumlah_homestay ?? 0) * $hargaHM * $lama;

    // Request
    $subtotalEB = ($data->jumlah_ekstrabed ?? 0) * $hargaEB;
    $subtotalBF = ($data->jumlah_breakfast ?? 0) * $hargaBF;

    // Grand Total
    $grandTotal =
        $subtotalDLX +
        $subtotalSPR +
        $subtotalSTD +
        $subtotalHM +
        $subtotalEB +
        $subtotalBF;
@endphp
@extends('layouts.PesanKamar')
@section('content')
    <div id="area-print">

        <div id="area-inner" style="padding:30px;">

            {{-- HEADER HOTEL --}}
            <div style="font-size:20pt;font-weight:bold;">
                NIRWANA HOTEL
            </div>

            <div style="font-size:12pt;">
                Jl. Kolonel Makmun Rasyid No.18, Way Urang, Kec. Kalianda,
            </div>

            <div style="font-size:12pt;">
                Kab. Lampung Selatan, Lampung, 35551
            </div>

            <div style="font-size:12pt;">
                0812 7281 0410 <br>
                (0727)321493
            </div>

            <hr style="border:3px solid black;">

            <div style="font-size:24pt;margin-top:20px;">
                Bukti Pembayaran ( Invoice )
            </div>

            <br>

            <table style="width:100%;font-size:16pt;">

                <tr>
                    <td style="width:180px;">Nama Tn/Ny</td>
                    <td style="width:20px;">:</td>
                    <td>{{ $data->nama_tamu_resi_manual ?? 0 }}</td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $data->alamat_tamu_resi_manual ?? 0 }}</td>
                </tr>

                <tr>
                    <td>Check In</td>
                    <td>:</td>
                    <td colspan="3">{{ $checkIn ? $checkIn->translatedFormat('d F Y') : '-' }}</td>
                </tr>

                <tr>
                    <td>Check Out</td>
                    <td>:</td>
                    <td colspan="3">{{ $checkOut ? $checkOut->translatedFormat('d F Y') : '-' }}</td>
                </tr>

                <tr>

                    <td>Hari</td>

                    <td>:</td>

                    <td colspan="3">

                        {{ $lama }} Hari

                    </td>

                </tr>

                <tr>

                    <td colspan="5" style="height:25px;"></td>

                </tr>


                @if(!$data)

                    <tr>
                        <td colspan="5" class="text-center" style="padding:30px;color:#999;">
                            Belum ada data Resi Manual.
                        </td>
                    </tr>

                @endif

                {{-- Deluxe --}}
                @if(($data->jumlah_kamar_deluxe ?? 0) > 0)

                    <tr>

                        <td>Deluxe</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_kamar_deluxe ?? 0 }}
                            x Rp.{{ number_format($hargaDLX, 0, ',', '.') }}
                            x {{ $lama }} Hari

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalDLX, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                {{-- Superior --}}
                @if(($data->jumlah_kamar_superior ?? 0) > 0)

                    <tr>

                        <td>Superior</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_kamar_superior ?? 0 }}
                            x Rp.{{ number_format($hargaSPR, 0, ',', '.') }}
                            x {{ $lama }} Hari

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalSPR, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                {{-- Standart --}}
                @if(($data->jumlah_kamar_standart ?? 0) > 0)

                    <tr>

                        <td>Standart</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_kamar_standart ?? 0 }}
                            x Rp.{{ number_format($hargaSTD, 0, ',', '.') }}
                            x {{ $lama }} Hari

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalSTD, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                {{-- Home Stay --}}
                @if(($data->jumlah_homestay ?? 0) > 0)

                    <tr>

                        <td>Home Stay</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_homestay ?? 0 }}
                            x Rp.{{ number_format($hargaHM, 0, ',', '.') }}
                            x {{ $lama }} Hari

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalHM, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                {{-- SPASI --}}
                <tr>
                    <td colspan="5" style="height:15px;"></td>
                </tr>

                {{-- Ekstra Bed --}}
                @if(($data->jumlah_ekstrabed ?? 0) > 0)

                    <tr>

                        <td>Ekstra Bed</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_ekstrabed ?? 0 }}
                            x Rp.{{ number_format($hargaEB, 0, ',', '.') }}

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalEB, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                {{-- Breakfast --}}
                @if(($data->jumlah_breakfast ?? 0) > 0)

                    <tr>

                        <td>Breakfast</td>

                        <td>:</td>

                        <td>

                            {{ $data->jumlah_breakfast ?? 0 }}
                            x Rp.{{ number_format($hargaBF, 0, ',', '.') }}

                        </td>

                        <td></td>

                        <td>

                            = Rp.{{ number_format($subtotalBF, 0, ',', '.') }}

                        </td>

                    </tr>

                @endif

                <tr>

                    <td colspan="3"></td>

                    <td>

                        <hr style="border:3px solid black;">

                    </td>

                    <td>

                        <hr style="border:3px solid black;">

                    </td>

                </tr>

                {{-- PAJAK --}}
                <tr>
                    <td colspan="3"></td>

                    <td style="text-align:center;">
                        Pajak
                    </td>

                    <td style="text-align:left;">
                        =
                    </td>
                </tr>

                <tr style="font-weight:bold;">

                    <td colspan="3"></td>

                    <td style="text-align:center;">Total</td>

                    <td>

                        = Rp.{{ number_format($grandTotal, 0, ',', '.') }}

                    </td>

                </tr>

            </table>

            <div style="width:40%;margin-left:auto;margin-top:30px;text-align:center;">
                Kalianda,
                {{ Carbon::now()->translatedFormat('d F Y') }}
                <br><br>
                <img src="{{ asset('assets/img/ttd_dan_cap.png') }}" style="width:250px; position:relative; left:-55px;">
                <br><br>
                ( Ani Muslimah )
            </div>
        </div>
    </div>

    <hr style="margin:50px 0;">


    @if($data)

        <button onclick="cetakJPG()" class="btn btn-info w-100 mt-3" style="font-size:20pt;">
            Cetak
        </button>

        <button type="button" id="btnKosongkanResi" class="btn btn-danger w-100 mt-3" style="font-size:20pt;">
            Kosongkan
        </button>

    @endif

    <button type="button" class="btn btn-info w-100 mt-3" data-bs-dismiss="modal" style="font-size:20pt;">
        Tutup
    </button>
@endsection
@push('myscript')
    <script>
        $(document).on('click', '#btnKosongkanResi', function () {

            Swal.fire({
                title: 'Yakin?',
                text: 'Seluruh data Resi Manual akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        type: 'POST',
                        url: '/KosongkanResiManual',

                        data: {
                            _token: "{{ csrf_token() }}"
                        },

                        beforeSend: function () {

                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
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
                                text: 'Resi Manual berhasil dikosongkan.'
                            }).then(() => {

                                $("#modal-lihat-resi-manual").modal("hide");

                            });

                        },

                        error: function (xhr) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON?.message ??
                                    'Terjadi kesalahan.'
                            });

                        }

                    });

                }

            });

        });
    </script>
@endpush