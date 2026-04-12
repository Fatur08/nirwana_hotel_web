<div id="area-print">
    <div class="container-fluid">

        <!-- Judul + Logo -->
        <div class="row">
            <div class="col-8 text-start">
                <div style="font-size:28px; font-weight:bold;" class="mt-4 mb-5">
                    Bukti Pembayaran
                </div>
                <div style="font-size:20px; font-weight:bold;">
                    Nirwana Hotel Kalianda ★
                </div>
            </div>

            <div class="col-4 text-end">
                <img src="{{ asset('assets/img/nirwana_hotel.png') }}" style="height:150px; width:200">
            </div>
        </div>

        <!-- Alamat + Tanggal -->
        <div class="row mt-2">
            <div class="col-8 text-start" style="font-size:16px;">
                Jl. Kolonel Makmun Rasyid No.18, Way Urang, Kec. Kalianda,
            </div>

            <div class="col-4 text-end" style="font-size:16px; font-weight:bold;">
                Dipesan Pada 09 April 2026
            </div>
        </div>

        <!-- Alamat lanjut -->
        <div class="row">
            <div class="col-12 text-start" style="font-size:16px;">
                Kabupaten Lampung Selatan, Lampung 35551
            </div>
        </div>

        <!-- Telepon -->
        <div class="row">
            <div class="col-12 text-start" style="font-size:16px;">
                0851 5609 1313
            </div>
        </div>

        <!-- Spacer -->
        <div class="row mt-3"></div>
        <div class="row mt-3"></div>

        <!-- Judul Detail -->
        <div class="row">
            <div class="col-12 text-start" style="font-size:26px; font-weight:bold;">
                Detail Pemesanan
            </div>
        </div>


        <div class="row">
            <div class="col-12 text-start">
                <table class="table-garis">
                    <tbody>
                        <tr>
                            <th>
                                Kamar Deluxe
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Check In dan Check Out
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>




    <br><br>
    <b>{{ $id }}</b>

</div>



<button onclick="printResi()" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Cetak
</button>

<button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>