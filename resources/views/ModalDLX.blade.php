@php
    if ($tipe_kamar == 1) {
        $labelKamar = 'DLX' . $histori_kamar->nomor_kamar;
    } elseif ($tipe_kamar == 2) {
        $labelKamar = 'SPR' . $histori_kamar->nomor_kamar;
    } else {
        $labelKamar = 'STD' . $histori_kamar->nomor_kamar;
    }
@endphp

<table class="table table-bordered">
    <tr>
        <td width="40%"><b>Nomor Kamar</b></td>
        <td width="60%">{{ $labelKamar }}</td>
    </tr>
    <tr>
        <td><b>Nama Tamu</b></td>
        <td>{{ $histori_kamar->nama_tamu ?? '-' }}</td>
    </tr>
    <tr>
        <td><b>Nomor KTP Tamu</b></td>
        <td>{{ $histori_kamar->nomor_ktp_tamu ?? '-' }}</td>
    </tr>
    <tr>
        <td><b>Check In</b></td>
        <td>
            {{ $histori_kamar->check_in
                ? \Carbon\Carbon::parse($histori_kamar->check_in)->translatedFormat('l, d F Y')
                : '-' 
            }}
        </td>
    </tr>
        
    <tr>
        <td><b>Check Out</b></td>
        <td>
            {{ $histori_kamar->check_out
                ? \Carbon\Carbon::parse($histori_kamar->check_out)->translatedFormat('l, d F Y')
                : '-' 
            }}
        </td>
    </tr>
</table>
<a href="/" class="btn btn-danger btn-close w-100 mt-3">
    Kembali
</a>