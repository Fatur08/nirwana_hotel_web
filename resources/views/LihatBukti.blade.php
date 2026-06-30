@extends('layouts.ModalPembayaran')

@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
    @endphp

    <div class="container-fluid">

        @if($bukti && $bukti->bukti_pembayaran)

            @php
                $file = $bukti->bukti_pembayaran;

                // Prioritas ambil dari public/storage
                if (file_exists(public_path('storage/uploads/bukti_pembayaran/' . $file))) {

                    $url = asset('storage/uploads/bukti_pembayaran/' . $file);

                }

                // Kalau tidak ada, cek di storage/app/public
                elseif (Storage::exists('public/uploads/bukti_pembayaran/' . $file)) {

                    $url = asset('storage/uploads/bukti_pembayaran/' . $file);

                } else {

                    $url = null;

                }

                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            @endphp

            @if($url)

                @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))

                    <img src="{{ $url }}" class="img-fluid rounded border w-100">

                @elseif($ext == 'pdf')

                    <iframe src="{{ $url }}" width="100%" height="700px">
                    </iframe>

                @else

                    <div class="alert alert-warning">
                        Format file tidak didukung.
                    </div>

                @endif

            @else

                <div class="alert alert-danger">
                    File bukti pembayaran tidak ditemukan.
                </div>

            @endif

        @else

            <div class="alert alert-danger">
                Bukti pembayaran belum tersedia.
            </div>

        @endif

    </div>

@endsection

@push('myscript')
@endpush