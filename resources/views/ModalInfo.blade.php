<table class="table table-bordered">

<tr>
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Nama Tamu</b></td>
</tr>
<tr>
    <td class="text-start">{{ $data->nama_tamu }}</td>
</tr>

<tr>
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Check In</b></td>
</tr>
<tr>
    <td class="text-start">
        {{ \Carbon\Carbon::parse($data->check_in)->locale('id')->translatedFormat('l, d F Y') }}
    </td>
</tr>

<tr>
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Check Out</b></td>
</tr>
<tr>
    <td class="text-start">
        {{ \Carbon\Carbon::parse($data->check_out)->locale('id')->translatedFormat('l, d F Y') }}
    </td>
</tr>

<tr>
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Jumlah Kamar Dipesan : {{ $data->jumlah_kamar_dipesan }} Kamar</b></td>
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
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Foto KTP</b></td>
</tr>
<tr>
    <td>
        <img src="{{ asset('storage/uploads/foto_ktp/'.$data->foto_ktp) }}" width="200">
    </td>
</tr>

<tr>
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Request</b></td>
</tr>
<tr>
    <td class="text-start">{{ $requestTambahan }}</td>
</tr>

</table>

<button type="button" class="btn btn-secondary w-100 mt-3" data-bs-dismiss="modal">
    Tutup
</button>