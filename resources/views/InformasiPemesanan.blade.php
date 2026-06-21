@extends('layouts.index')
@section('content')
    {{-- HEADER --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h1 class="mb-0 fw-bold" style="font-size:35pt; color:#2c3e50;">
                        Informasi Pemesanan
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- KOTAK CARI --}}
    <div class="kotak-cari">
        <form action="/" method="GET" id="frmCariTanggal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>
                        <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                        <input type="text" id="check_in_tampil" class="form-control flatpickr w-100"
                            placeholder="Tanggal Check-In" autocomplete="off" readonly style="font-size:16pt;">
                        <!-- INPUT ASLI UNTUK DATABASE -->
                        <input type="hidden" id="cari_check_in" name="cari_check_in">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>
                        <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                        <input type="text" id="check_out_tampil" class="form-control flatpickr w-100"
                            placeholder="Tanggal Check-Out" autocomplete="off" readonly style="font-size:16pt;">
                        <!-- INPUT ASLI UNTUK DATABASE -->
                        <input type="hidden" id="cari_check_out" name="cari_check_out">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <select id="status" name="status" class="form-control" style="font-size:16pt;">
                        <option value="">-- Pilih Status --</option>
                        <option value="booking">Booking</option>
                        <option value="check_in">Check-In</option>
                    </select>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100" type="submit" style="font-size:16pt; padding:10px;">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- TABEL --}}
    <div class="table-wrapper mt-3">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tamu</th>
                        <th>Status</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Resi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histori as $no => $row)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $row->nama_tamu }}</td>
                            <td>
                                @if($row->status == 'booking')
                                    <span class="badge bg-secondary">Booking</span>
                                @else
                                    <span class="badge bg-success">Check-In</span>
                                @endif
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->check_in)->translatedFormat('d F Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->check_out)->translatedFormat('d F Y') }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="ModalResi btn btn-success"
                                        id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                            <path
                                                d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="ModalInfo btn btn-secondary"
                                        id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </a>
                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">
                                Tidak ada data pemesanan
                            </td>

                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- BUTTON KEMBALI --}}
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ url('/') }}" class="btn btn-secondary w-100" style="font-size:25pt;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M15 6l-6 6l6 6" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
@endsection
@push('myscript')
@endpush