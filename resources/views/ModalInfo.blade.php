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
    <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Jumlah Kamar Dipesan</b></td>
</tr>
<tr>
    <td>
        @foreach($kamar as $k)
            {{ $k->nomor_kamar }} ({{ $k->jenis_bed }}) <br>
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