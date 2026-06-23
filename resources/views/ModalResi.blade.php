<div id="area-print">

    <div id="area-inner" style="padding:30px;">

        {{-- HEADER HOTEL --}}
        <div style="font-size:20pt;font-weight:bold;">
            NIRWANA HOTEL KALIANDA ★
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

        <hr style="border:1px solid black;">


        {{-- JUDUL --}}
        <div style="font-size:24pt;margin-top:20px;">
            Bukti Pembayaran ( Invoice )
        </div>

        @php
            use Carbon\Carbon;

            $checkIn = Carbon::parse($data->check_in);
            $checkOut = Carbon::parse($data->check_out);
        @endphp

        <table style="width:100%;font-size:14pt;">
            <tr>
                <td width="20%">Nama Tn/Ny</td>
                <td width="35%">: {{ $data->nama_tamu }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>: {{ $histori->alamat ?? '-' }}</td>
            </tr>

            <tr>
                <td>Check - In</td>
                <td>: {{ $checkIn->translatedFormat('d F Y') }}</td>

                <td width="20%">Check - Out</td>
                <td>: {{ $checkOut->translatedFormat('d F Y') }}</td>
            </tr>

            <tr>
                <td>Hari</td>
                <td>: {{ $lama }} Hari</td>
            </tr>
        </table>

        <br><br>

        <table style="width:100%; font-size:14pt; border-collapse:collapse;">

            {{-- KAMAR --}}
            @foreach($detailKamar as $item)
                <tr>
                    <td style="width:180px;">
                        {{ $item['nama'] }}
                    </td>

                    <td style="width:20px;">
                        :
                    </td>

                    <td>
                        {{ $item['jumlah'] }}
                        x Rp.{{ number_format($item['tarif'], 0, ',', '.') }}
                        x {{ $lama }} Hari
                    </td>

                    <td style="width:20px;">
                        =
                    </td>

                    <td style="width:180px; text-align:right;">
                        Rp.{{ number_format($item['subtotal'], 0, ',', '.') }}
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

                    <td style="width:180px;">
                        {{ $req->tipe_kamar }}
                    </td>

                    <td>
                        :
                    </td>

                    <td>
                        {{ $req->jumlah_request }}
                        x Rp.{{ number_format($req->tarif_per_hari, 0, ',', '.') }}
                    </td>

                    <td>
                        =
                    </td>

                    <td style="text-align:right;">
                        Rp.{{ number_format($req->total_harga, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </table>

        <br><br>


        {{-- TOTAL --}}
        <table style="
        width:380px;
        margin-left:auto;
        margin-top:20px;
        font-size:14pt;
        border-collapse:collapse;
    ">

            <tr>
                <td colspan="2">
                    <hr style="border:1px solid black; margin:0;">
                </td>
            </tr>

            <tr>
                <td style="text-align:right; width:150px;">
                    =
                </td>

                <td style="text-align:right;">
                    Rp.{{ number_format($subTotal, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td style="text-align:right;">
                    Pajak =
                </td>

                <td style="text-align:right;">
                    Rp.{{ number_format($pajak, 0, ',', '.') }}
                </td>
            </tr>

            <tr style="font-weight:bold;">
                <td style="text-align:right;">
                    Total =
                </td>

                <td style="text-align:right;">
                    Rp.{{ number_format($grandTotal, 0, ',', '.') }}
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

<button onclick="cetakPDF()" class="btn btn-success w-100 mt-3">Cetak</button>

<button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>