<table class="table table-bordered" style="font-size:20pt;">

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
            {{ \Carbon\Carbon::parse($histori->check_in)->locale('id')->translatedFormat('l, d F Y') }}
        </td>
    </tr>

    <tr>
        <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Check Out</b></td>
    </tr>
    <tr>
        <td class="text-start">
            {{ \Carbon\Carbon::parse($histori->check_out)->locale('id')->translatedFormat('l, d F Y') }}
        </td>
    </tr>

    <tr>
        <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Jumlah Kamar Dipesan :
                {{ $data->total_kamar_dipesan }} Kamar</b></td>
    </tr>
    <tr>
        <td class="text-start">
            @foreach($kamar as $k)

                @php

                    switch ($k->jenis_bed) {

                        case 1:
                            $bed = 'Single Bed';
                            break;

                        case 2:
                            $bed = 'Double Bed';
                            break;

                        default:
                            $bed = '-';

                    }

                @endphp

                {{ $loop->iteration }}. {{ $k->tipe_kamar }}{{ $k->nomor_kamar }} - {{ $bed }} <br>

            @endforeach
        </td>
    </tr>

    <tr>
        <td class="text-start" style="background:#f5f5f5;font-weight:bold;"><b>Foto KTP</b></td>
    </tr>
    <tr>
        <td>
            @if($foto && $foto->foto_ktp)

                <img src="{{ asset('storage/uploads/foto_ktp/' . $foto->foto_ktp) }}" width="200">

            @else

                Tidak ada foto KTP

            @endif
        </td>
    </tr>

    <tr>
        <td class="text-start" style="background:#f5f5f5;font-weight:bold;">
            <b>Request</b>
        </td>
    </tr>

    <tr>
        <td class="text-start">

            @if($requestTambahan->count() > 0)

                @foreach($requestTambahan as $req)

                    {{ $loop->iteration }}.
                    {{ $req->tipe_kamar }}
                    ({{ $req->jumlah_request }})

                    <br>

                @endforeach

            @else

                -

            @endif

        </td>
    </tr>

</table>

<button type="button" class="btn btn-secondary w-100 mt-3" data-bs-dismiss="modal" style="font-size:20pt;">
    Tutup
</button>