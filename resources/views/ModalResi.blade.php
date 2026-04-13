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
                Dipesan Pada
                {{ \Carbon\Carbon::parse($data->tanggal_dipesan)->translatedFormat('d F Y') }}
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

        <!-- Detail Pemesanan -->
        <div class="row">
            <div class="col-12 text-start mb-4" style="font-size:26px; font-weight:bold;">
                Detail Pemesanan
            </div>
        </div>


        <div class="row">
            <div class="col-12 text-start">
                <table class="table-custom">
                    <tbody>

                        <!-- KHUSUS INI ADA BORDER SENDIRI -->
                        <tr>
                            <td class="header-kamar">
                                Kamar Deluxe
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Tanggal Check In dan Check Out
                            </th>
                        </tr>
                        @php
                        $checkIn = \Carbon\Carbon::parse($data->check_in);
                        $checkOut = \Carbon\Carbon::parse($data->check_out);
                        $lama = $checkOut->diffInDays($checkIn);
                        @endphp

                        <tr>
                            <td>
                                {{ $checkIn->translatedFormat('l, d F Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                {{ $checkOut->translatedFormat('l, d F Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                ( {{ $lama }} Malam )
                            </td>
                        </tr>

                        <tr>
                            <th><br>Jumlah Kamar</th>
                        </tr>
                        <tr>
                            <td>{{ $data->jumlah_kamar_dipesan }} Kamar</td>
                        </tr>

                        <tr>
                            <th><br>Nomor Kamar</th>
                        </tr>
                        <tr>
                            <td class="text-start">
                                @foreach($kamar as $k)

                                @php
                                switch($k->id_kamar){
                                case 1:
                                $tipe = "Deluxe ";
                                break;
                                case 2:
                                $tipe = "Superior ";
                                break;
                                case 3:
                                $tipe = "Standar ";
                                break;
                                default:
                                $tipe = "-";
                                }

                                switch($k->jenis_bed){
                                case 1:
                                $bed = "Single Bed";
                                break;
                                case 2:
                                $bed = "Double Bed";
                                break;
                                default:
                                $bed = "-";
                                }
                                @endphp

                                {{ $loop->iteration }}. {{ $tipe }}{{ $k->nomor_kamar }} - {{ $bed }} <br>

                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <th><br>Permintaan ( Request )</th>
                        </tr>
                        <tr>
                            <th>{{ $requestTambahan }}</th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>




        <!-- Detail Pembayaran -->
        <div class="row">
            <div class="col-12 text-start mt-5 mb-4" style="font-size:26px; font-weight:bold;">
                Detail Pembayaran
            </div>
        </div>


        <div class="row">
            <div class="col-12 text-start">
                <table class="table-garis">
                    <tbody>
                        <tr>
                            <td>Nama Tamu</td>
                            <td>Waktu Pembayaran</td>
                            <td>Metode Pembayaran</td>
                        </tr>
                        <tr>
                            <th>{{ $data->nama_tamu }}</th>
                            <th>{{ \Carbon\Carbon::parse($data->tanggal_dipesan)->translatedFormat('l, d F Y H:i') }}</th>
                            <th>{{ $data->metode_pembayaran }}</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Total Harga<br>
                                <b>{{ $lama }} Malam X {{ $data->jumlah_kamar_dipesan }} Kamar</b>
                            </td>
                            <th>Rp.{{ number_format($data->biaya, 0, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<button onclick="printResi()" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Cetak
</button>

<button type="button" class="btn btn-success w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>