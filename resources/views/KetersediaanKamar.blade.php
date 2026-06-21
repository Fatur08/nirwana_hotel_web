@extends('layouts.index')
@section('content')
    <div class="mb-3">
        <a href="{{ url('/') }}" class="btn btn-dark">

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">

                <path d="M15 6l-6 6l6 6" />
            </svg>

            Kembali
        </a>
    </div>
@endsection
@push('myscript')
@endpush