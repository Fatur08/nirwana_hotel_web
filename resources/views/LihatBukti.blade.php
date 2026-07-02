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

            @if($bukti && $bukti->status_pembayaran == 1 && $bukti->metode_pembayaran == 'Cash')

                <div class="alert alert-success text-center p-4">

                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3">

                        <path d="M5 12l5 5l10 -10" />

                    </svg>

                    <h3 class="mb-2">Sudah Dibayar Cash</h3>

                    <p class="mb-0">
                        Pembayaran dilakukan secara tunai sehingga tidak memiliki bukti transfer.
                    </p>

                </div>

            @elseif($bukti && $bukti->status_pembayaran == 1)

                <div class="alert alert-warning text-center">
                    Bukti pembayaran tidak tersedia.
                </div>

            @else

                <div class="alert alert-danger text-center">
                    Bukti pembayaran belum tersedia.
                </div>

            @endif

        @endif

    </div>

@endsection

@push('myscript')
@endpush