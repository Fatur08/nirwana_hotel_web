@extends('layouts.ModalPembayaran')
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


            {{-- JUDUL --}}
            <div style="font-size:24pt;margin-top:20px;">
                Bukti Pembayaran ( Invoice )
            </div>
            <br>

            @php
                use Carbon\Carbon;

                $checkIn = Carbon::parse($histori->check_in);
                $checkOut = Carbon::parse($histori->check_out);
            @endphp

            <table style="width:100%; font-size:14pt;">

                {{-- IDENTITAS --}}
                <tr>
                    <td style="width:180px;">Nama Tn/Ny</td>
                    <td style="width:25px;text-align:center;">:</td>
                    <td colspan="3">{{ $data->nama_tamu }}</td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td style="text-align:center;">:</td>
                    <td colspan="3">{{ $histori->alamat_tamu ?? '-' }}</td>
                </tr>

                <tr>
                    <td>Check In</td>
                    <td style="text-align:center;">:</td>
                    <td colspan="3">{{ $checkIn->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Check Out</td>
                    <td style="text-align:center;">:</td>
                    <td colspan="3">{{ $checkOut->translatedFormat('d F Y') }}</td>
                </tr>

                <tr>
                    <td>Hari</td>
                    <td style="text-align:center;">:</td>
                    <td colspan="3">{{ $lama }} Hari</td>
                </tr>

                {{-- SPASI --}}
                <tr>
                    <td colspan="7" style="height:25px;"></td>
                </tr>

                {{-- DETAIL KAMAR --}}
                @foreach($detailKamar as $item)
                    <tr>

                        <td>{{ $item['nama'] }}</td>

                        <td style="text-align:center;">:</td>

                        <td colspan="2">
                            {{ $item['jumlah'] }}
                            x Rp.{{ number_format($item['tarif'], 0, ',', '.') }}
                            x {{ $lama }} Hari
                        </td>

                        <td style="width:180px; text-align:left;">
                            = Rp.{{ number_format($item['subtotal'], 0, ',', '.') }}
                        </td>

                    </tr>
                @endforeach

                {{-- SPASI --}}
                <tr>
                    <td colspan="5" style="height:15px;"></td>
                </tr>

                {{-- REQUEST --}}
                @foreach($requestTambahan as $req)
                    <tr>

                        <td>{{ $req->tipe_kamar }}</td>

                        <td style="text-align:center;">:</td>

                        <td colspan="2">
                            {{ $req->jumlah_request }}
                            x Rp.{{ number_format($req->tarif_per_hari, 0, ',', '.') }}
                        </td>

                        <td style="width:180px; text-align:left;">
                            = Rp.{{ number_format($req->total_harga, 0, ',', '.') }}
                        </td>

                    </tr>
                @endforeach

                {{-- GARIS --}}
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        <hr style="margin:5px 0;border:3px solid #000000;">
                    </td>
                </tr>

                {{-- SUBTOTAL --}}
                <tr>
                    <td colspan="4"></td>

                    <td style="width:180px; text-align:left;">
                        = Rp.{{ number_format($subTotal, 0, ',', '.') }}
                    </td>
                </tr>

                {{-- PAJAK --}}
                <tr>
                    <td colspan="4" style="text-align:right;">
                        Pajak
                    </td>

                    <td style="width:180px; text-align:left;">
                        = <!--Rp.{{ number_format($pajak, 0, ',', '.') }}-->
                    </td>
                </tr>

                {{-- TOTAL --}}
                <tr style="font-weight:bold;">
                    <td colspan="4" style="text-align:right;">
                        Total
                    </td>

                    <td style="width:180px; text-align:left;">
                        = Rp.{{ number_format($grandTotal, 0, ',', '.') }}
                    </td>
                </tr>

            </table>


            {{-- TANDA TANGAN --}}
            <div style="width:40%; margin-left:auto; margin-top:30px; text-align:center;">
                Kalianda, {{ Carbon::now()->translatedFormat('d F Y') }}
                <br><br>
                <img src="{{ asset('assets/img/ttd_dan_cap.png') }}" style="width:250px; position:relative; left:-55px;">
                <br><br>
                ( Ani Muslimah )
            </div>
        </div>
    </div>

    <button onclick="cetakJPG()" class="btn btn-success w-100 mt-3" style="font-size:16pt;">Cetak</button>

    <button type="button" class="btn btn-success w-100 mt-3" id="btnKirimWA" data-id="{{ $data->id_rincian_pesanan }}"
        style="font-size:16pt;">
        <i class="bi bi-whatsapp"></i> Kirim ke WhatsApp
    </button>

    <button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal" style="font-size:16pt;">
        Tutup
    </button>
@endsection
@push('myscript')
    <script>
        document.getElementById('btnKirimWA').addEventListener('click', function () {

            let id = this.dataset.id;

            fetch("/kirim-resi-wa/" + id, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
                .then(res => res.json())
                .then(res => {

                    alert(res.message);

                })
                .catch(err => {

                    console.log(err);

                    alert("Terjadi kesalahan.");

                });

        });
    </script>
@endpush