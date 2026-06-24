@extends('layouts.index')
@section('content')
    <style>
        .kotak-header-pemesanan {
            background: linear-gradient(to right,
                    #2c3e50,
                    #3498db,
                    #5dade2);

            color: white;
            border-radius: 12px;
            padding: 20px;
        }

        .kotak-cari {
            background-color: #4fce05ff;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%;
            font-size: 20px;
        }



        /* === Table Style === */
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #007bff, #00bcd4);
            color: white;
            text-align: center;
            font-weight: 600;
            font-size: 20px;
            letter-spacing: 0.5px;
            padding: 12px;
            border: none;
        }

        .custom-table thead tr:first-child th {
            background: linear-gradient(135deg, #0069d9, #17a2b8);
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-table tbody td,
        .custom-table tbody th {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            font-size: 20px;
            color: #333;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .custom-table tbody tr:hover {
            background-color: #e9f5ff;
            transition: 0.3s;
        }

        .table-container {
            max-width: 1600px;
        }




        .table-garis {
            border-collapse: collapse;
            width: 100%;
        }

        .table-garis th,
        .table-garis td {
            border: 1px solid black;
            padding: 8px;
        }




        .table-custom {
            width: 100%;
            border: 1px solid black;
            /* border luar saja */
            border-collapse: collapse;
        }

        .table-custom td,
        .table-custom th {
            border: none;
            /* hilangkan semua garis dalam */
            padding: 6px;
        }
    </style>




    {{-- HEADER --}}
    <div class="kotak-header-pemesanan text-center mb-3">
        <h1 class="mb-1 fw-bold" style="font-size:25pt;">
            Informasi Pemesanan
        </h1>
    </div>

    {{-- KOTAK CARI --}}
    <div class="kotak-cari">
        <form action="/InformasiPemesanan" method="GET" id="FormInformasiPemesanan" enctype="multipart/form-data">
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
                        <!-- ✅ INPUT TAMPILAN (FONT 20pt) -->
                        <input type="text" id="check_in_tampil" class="form-control flatpickr w-100"
                            placeholder="Tanggal Check-In" autocomplete="off" readonly style="font-size:20pt;">
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
                        <!-- ✅ INPUT TAMPILAN (FONT 20pt) -->
                        <input type="text" id="check_out_tampil" class="form-control flatpickr w-100"
                            placeholder="Tanggal Check-Out" autocomplete="off" readonly style="font-size:20pt;">
                        <!-- INPUT ASLI UNTUK DATABASE -->
                        <input type="hidden" id="cari_check_out" name="cari_check_out">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <select id="status" name="status" class="form-control" style="font-size:20pt;">
                        <option value="">-- Pilih Status --</option>
                        <option value="booking">Booking</option>
                        <option value="check_in">Check-In</option>
                    </select>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100" type="submit" style="font-size:20pt; padding:10px;">
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
                        <th>Pembayaran</th>
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

                            <td class="text-center">
                                @if($row->status_pembayaran == 0)
                                    <button class="btn btn-warning btn-sm">Belum Bayar</button>
                                @else
                                    <button class="btn btn-success btn-sm">Sudah Bayar</button>
                                @endif
                                <div class="btn-group">
                                    @if($row->status_pembayaran == 0)
                                        <a href="#" class="ModalPembayaran btn btn-info"
                                            id_laporan_keuangan="{{ $row->id_laporan_keuangan }}">
                                            Validasi
                                        </a>
                                    @else
                                        <form
                                            action="/owner/data_staff/ahli_gizi/{{ $d->id_ahli_gizi }}/batalkan_validasi_ahli_gizi"
                                            style="margin-left: 5px;" method="POST">
                                            @csrf
                                            <a class="btn btn-sm bg-danger batalkan_validasi_ahli_gizi">
                                                Batalkan
                                            </a>
                                        </form>
                                    @endif
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




    <!-- Modal Informasi Pemesanan -->
    <div class="modal fade" id="modal-info" tabindex="-1" aria-labelledby="ModalInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="ModalInfoLabel" style="font-size:16pt;">Informasi Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="loadModalInfo">
                </div>
            </div>
        </div>
    </div>






    <!-- Modal Resi -->
    <div class="modal fade" id="modal-resi" tabindex="-1" aria-labelledby="ModalResiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="ModalResiLabel" style="font-size:16pt;">Resi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="loadModalResi">
                </div>
            </div>
        </div>
    </div>






    <!-- Modal Validasi Pembayaran -->
    <div class="modal fade" id="modal-pembayaran" tabindex="-1" aria-labelledby="ModalPembayaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="ModalPembayaranLabel" style="font-size:16pt;">Status Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="loadModalPembayaran">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const checkOutPicker = flatpickr("#check_out_tampil", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                locale: flatpickr.l10ns.id,
                disableMobile: true,
                allowInput: false
            });

            const checkInPicker = flatpickr("#check_in_tampil", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                locale: flatpickr.l10ns.id,
                disableMobile: true,
                allowInput: false,

                onChange: function (selectedDates) {

                    if (!selectedDates.length) return;

                    let checkInDate = selectedDates[0];

                    // Simpan ke hidden input pencarian
                    $('#cari_check_in').val(
                        this.formatDate(checkInDate, "Y-m-d")
                    );

                    // Check-Out minimal H+1
                    let minCheckout = new Date(checkInDate);
                    minCheckout.setDate(minCheckout.getDate() + 1);

                    checkOutPicker.set('minDate', minCheckout);

                    // Reset pilihan check-out lama
                    checkOutPicker.clear();
                    $('#cari_check_out').val('');
                }
            });

            checkOutPicker.config.onChange.push(function (selectedDates) {

                if (!selectedDates.length) return;

                $('#cari_check_out').val(
                    checkOutPicker.formatDate(selectedDates[0], "Y-m-d")
                );

            });

            // =========================
            // DEFAULT TANGGAL HARI INI
            // =========================

            let today = new Date();

            let yyyy = today.getFullYear();
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let dd = String(today.getDate()).padStart(2, '0');

            let formatDB = `${yyyy}-${mm}-${dd}`;

            // Hidden input untuk pencarian
            $('#cari_check_in').val(formatDB);
            $('#cari_check_out').val(formatDB);

        });




        // BAGIAN DARI MODAL INFO
        $(document).on('click', '.ModalInfo', function (e) {
            e.preventDefault();

            let id = $(this).attr('id_laporan_keuangan');

            $.ajax({
                type: 'POST',
                url: '/ModalInfo',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_laporan_keuangan: id
                },
                success: function (respond) {
                    $("#loadModalInfo").html(respond);
                    $("#modal-info").modal("show");
                }
            });
        });














        // BAGIAN DARI MODAL RESI
        $(document).on('click', '.ModalResi', function (e) {
            e.preventDefault();

            let id = $(this).attr('id_laporan_keuangan');

            $.ajax({
                type: 'POST',
                url: '/ModalResi',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_laporan_keuangan: id
                },
                success: function (respond) {
                    $("#loadModalResi").html(respond);
                    $("#modal-resi").modal("show");
                }
            });
        });












        // BAGIAN DARI MODAL PEMBAYARAN
        $(document).on('click', '.ModalPembayaran', function (e) {
            e.preventDefault();

            let id = $(this).attr('id_laporan_keuangan');

            $.ajax({
                type: 'POST',
                url: '/ModalPembayaran',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_laporan_keuangan: id
                },
                success: function (respond) {
                    $("#loadModalPembayaran").html(respond);
                    $("#modal-pembayaran").modal("show");
                }
            });
        });













        function printResi() {

            var isi = document.getElementById("area-print").innerHTML;

            var frame = document.createElement('iframe');
            frame.style.position = "absolute";
            frame.style.top = "-1000000px";

            document.body.appendChild(frame);

            var frameDoc = frame.contentWindow.document;

            frameDoc.open();
            frameDoc.write(`
                                                                                                    <html>
                                                                                                    <head>
                                                                                                        <title>Print Resi</title>
                                                                                                        <style>
                                                                                                            body{
                                                                                                                font-family: Arial;
                                                                                                                font-size:14px;
                                                                                                                padding:20px;
                                                                                                            }
                                                                                                        </style>
                                                                                                    </head>
                                                                                                    <body>
                                                                                                        ${isi}
                                                                                                    </body>
                                                                                                    </html>
                                                                                                `);
            frameDoc.close();

            frame.contentWindow.focus();
            frame.contentWindow.print();

            setTimeout(function () {
                document.body.removeChild(frame);
            }, 1000);
        }









        function cetakJPG() {

            let element = document.querySelector("#area-print");

            html2canvas(element, {
                scale: 4,
                useCORS: true,
                backgroundColor: "#ffffff"
            }).then(canvas => {

                let link = document.createElement('a');

                link.download = 'Resi-' + Date.now() + '.jpg';

                link.href = canvas.toDataURL('image/jpeg', 1.0);

                link.click();

            });

        }









        function cetakPDF() {

            let element = document.querySelector("#area-print");

            html2canvas(element, {
                scale: 2,
                useCORS: true
            }).then(canvas => {

                let imgData = canvas.toDataURL('image/jpeg', 1.0);

                // 🔥 ini yang benar
                const {
                    jsPDF
                } = window.jspdf;

                let pdf = new jsPDF('p', 'mm', [105, 148]);

                pdf.addImage(imgData, 'JPEG', 0, 0, 105, 148);

                pdf.save("resi.pdf");
            });
        }















        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush