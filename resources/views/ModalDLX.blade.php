<form action="#" method="POST" id="frmModalDLX" enctype="multipart/form-data">
    @csrf
    <input type="text" readonly value="{{ $nomor_kamar }}" id="nomor_kamar" class="form-control" name="nomor_kamar" placeholder="nomor_kamar" hidden>
    <input type="text" readonly value="{{ $tipe_kamar }}" id="tipe_kamar" class="form-control" name="tipe_kamar" placeholder="tipe_kamar" hidden>
    @php
        if ($tipe_kamar == 1) {
            $labelKamar = 'DLX ' . $histori_kamar->nomor_kamar;
        } elseif ($tipe_kamar == 2) {
            $labelKamar = 'SPR ' . $histori_kamar->nomor_kamar;
        } else {
            $labelKamar = 'STD ' . $histori_kamar->nomor_kamar;
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
                ? \Carbon\Carbon::parse($histori_kamar->check_in)->translatedFormat('d F Y')
                : '-' 
            }}
        </td>
    </tr>
        
    <tr>
        <td><b>Check Out</b></td>
        <td>
            {{ $histori_kamar->check_out
                ? \Carbon\Carbon::parse($histori_kamar->check_out)->translatedFormat('d F Y')
                : '-' 
            }}
        </td>
    </tr>
    </table>

    <button class="btn btn-danger w-100 mt-3" type="submit">
        Simpan
    </button>
</form>