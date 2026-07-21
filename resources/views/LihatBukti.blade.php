@extends('layouts.ModalPembayaran')
@section('content')
    @php
        use Illuminate\Support\Facades\Storage;

        function getFileUrl($folder, $file)
        {
            if (!$file) {
                return null;
            }

            if (file_exists(public_path("storage/uploads/$folder/" . $file))) {
                return asset("storage/uploads/$folder/" . $file);
            }

            if (Storage::exists("public/uploads/$folder/" . $file)) {
                return asset("storage/uploads/$folder/" . $file);
            }

            return null;
        }

        $urlDP = getFileUrl('bukti_dp', $bukti->bukti_dp ?? null);
        $urlPelunasan = getFileUrl('bukti_pembayaran', $bukti->bukti_pembayaran ?? null);
    @endphp

    <div class="container-fluid">
        @if($bukti->status_pembayaran == 1 || $bukti->bukti_dp || $bukti->total_dp > 0)
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">
                        Bukti Pembayaran DP
                    </h4>
                </div>

                <div class="card-body">
                    <h5>
                        Metode Pembayaran :
                        <b>
                            {{ $bukti->metode_dp ?? '-' }}
                        </b>
                    </h5>

                    <h5>
                        Nominal DP : Rp.{{ number_format($bukti->total_dp, 0, ',', '.') }}
                    </h5>

                    <hr>

                    @if($bukti->metode_dp == 'Cash')
                        <div class="alert alert-success text-center">
                            Pembayaran DP dilakukan secara Cash.
                        </div>
                    @elseif($urlDP)
                        @php
                            $ext = strtolower(pathinfo($bukti->bukti_dp, PATHINFO_EXTENSION));
                        @endphp
                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ $urlDP }}" class="img-fluid rounded border w-100">
                        @elseif($ext == 'pdf')
                            <iframe src="{{ $urlDP }}" width="100%" height="700px"></iframe>
                        @endif
                    @else
                        <div class="alert alert-warning text-center">
                            Bukti DP tidak tersedia.
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if($bukti->status_pembayaran == 2)
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        Bukti Pelunasan
                    </h4>
                </div>

                <div class="card-body">
                    <h5>
                        Metode Pembayaran :
                        <b>
                            {{ $bukti->metode_pembayaran ?? '-' }}
                        </b>
                    </h5>

                    <hr>

                    @if($bukti->metode_pembayaran == 'Cash')
                        <div class="alert alert-success text-center">
                            Pelunasan dilakukan secara Cash.
                        </div>
                    @elseif($urlPelunasan)
                        @php
                            $ext = strtolower(pathinfo($bukti->bukti_pembayaran, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ $urlPelunasan }}" class="img-fluid rounded border w-100">
                        @elseif($ext == 'pdf')
                            <iframe src="{{ $urlPelunasan }}" width="100%" height="700px"></iframe>
                        @endif
                    @else
                        <div class="alert alert-warning text-center">
                            Bukti Pelunasan tidak tersedia.
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection