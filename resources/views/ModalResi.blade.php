<div id="area-print">

    <div id="area-inner" style="padding:30px;">

        {{-- HEADER HOTEL --}}
        <div style="font-size:20pt;font-weight:bold;">
            NIRWANA HOTEL ★
        </div>

        <div style="font-size:12pt;">
            Jl. Kolonel Makmun Rasyid No.18, Way Urang, Kec. Kalianda,
        </div>

        <div style="font-size:12pt;">
            Kab. Lampung Selatan, Lampung, 35551
        </div>

        <div style="font-size:12pt;">
            0851 5609 1313
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

        <table style="width:100%; font-size:14pt; border-collapse:collapse;">

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
                <td>Check - In</td>
                <td style="text-align:center;">:</td>
                <td>{{ $checkIn->translatedFormat('d F Y') }}</td>

                <td style="width:180px; text-align:center;">Check - Out</td>
                <td>: {{ $checkOut->translatedFormat('d F Y') }}</td>
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

                    <td>
                        {{ $item['jumlah'] }}
                        x Rp.{{ number_format($item['tarif'], 0, ',', '.') }}
                        x {{ $lama }} Hari
                    </td>

                    <td style="text-align:center;"></td>

                    <td style="text-align:left;">
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

                    <td>
                        {{ $req->jumlah_request }}
                        x Rp.{{ number_format($req->tarif_per_hari, 0, ',', '.') }}
                    </td>

                    <td style="text-align:center;"></td>

                    <td style="text-align:left;">
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
                <td colspan="3"></td>

                <td style="text-align:right;">

                </td>

                <td style="text-align:left;">
                    = Rp.{{ number_format($subTotal, 0, ',', '.') }}
                </td>
            </tr>

            {{-- PAJAK --}}
            <tr>
                <td colspan="3"></td>

                <td style="text-align:center;">
                    Pajak
                </td>

                <td style="text-align:left;">
                    = <!--Rp.{{ number_format($pajak, 0, ',', '.') }}-->
                </td>
            </tr>

            {{-- TOTAL --}}
            <tr style="font-weight:bold;">
                <td colspan="3"></td>

                <td style="text-align:center;">
                    Total
                </td>

                <td style="text-align:left;">
                    = Rp.{{ number_format($grandTotal, 0, ',', '.') }}
                </td>
            </tr>

        </table>


        {{-- TANDA TANGAN --}}
        <div style="width:40%;margin-left:auto;margin-top:30px;text-align:center;">

            Kalianda,
            {{ Carbon::now()->translatedFormat('d F Y') }}

            <br><br>

            <img src="{{ asset('assets/img/ttd_dan_cap.png') }}" style="width:250px;">

            <br><br>

            ( Ani Muslimah )

        </div>

    </div>

</div>

<button onclick="cetakJPG()" class="btn btn-success w-100 mt-3">Cetak</button>

<button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>