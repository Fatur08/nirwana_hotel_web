<div id="area-print">
    <table class="table-garis">
        <tbody>

            <tr>
                <td style="font-size:22px; font-weight:bold; text-align:left;">
                    Bukti Pembayaran
                </td>

                <td rowspan="2" style="text-align:right;">
                    <img src="{{ asset('assets/img/nirwana_hotel.png') }}" style="height:150px;">
                </td>
            </tr>

            <tr>
                <td style="font-size:20px; font-weight:bold; text-align:left;">
                    Nirwana Hotel Kalianda ★
                </td>

            </tr>

            <tr>
                <td style="font-size:16px; text-align:left;">
                    Jl. Kolonel Makmun Rasyid No.18, Way Urang, Kec. Kalianda,
                </td>
                <td style="font-size:16px; text-align:right; font-weight:bold;">
                    Dipesan Pada 09 April 2026
                </td>
            </tr>

            <tr>
                <td style="font-size:16px; text-align:left;">
                    Kabupaten Lampung Selatan, Lampung 35551
                </td>
            </tr>

            <tr>
                <td style="font-size:16px; text-align:left;">
                    0851 5609 1313
                </td>
            </tr>

            <tr>
                <td>Detail Pemesanan</td>
            </tr>

        </tbody>
    </table>




    <br><br>
    <b>{{ $id }}</b>

</div>



<button onclick="printResi()" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Cetak
</button>

<button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>