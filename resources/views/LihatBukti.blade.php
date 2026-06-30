@extends('layouts.ModalPembayaran')

@section('content')

    <div class="container-fluid">

        @if($bukti && $bukti->bukti_pembayaran)

            @php
                $ext = strtolower(pathinfo($bukti->bukti_pembayaran, PATHINFO_EXTENSION));
            @endphp

            @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))

                <img src="{{ asset('uploads/bukti_pembayaran/' . $bukti->bukti_pembayaran) }}" class="img-fluid rounded border w-100">

            @elseif($ext == 'pdf')

                <iframe src="{{ asset('uploads/bukti_pembayaran/' . $bukti->bukti_pembayaran) }}" width="100%" height="700px">
                </iframe>

            @else

                <div class="alert alert-warning">
                    Format file tidak didukung.
                </div>

            @endif

        @else

            <div class="alert alert-danger text-center">
                Bukti pembayaran belum tersedia.
            </div>

        @endif

    </div>

@endsection

@push('myscript')
@endpush