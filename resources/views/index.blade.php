@extends('layouts.index')
@section('content')
<style>
  body {
    background: linear-gradient(to bottom, #e8dbb9, #eaf3ff);
    font-family: 'Be Vietnam Pro', sans-serif;
    margin: 0;
    padding: 15px;
    min-height: 100vh;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .login-container {
    text-align: center;
    background: #e8dbb9;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 15px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .login-title {
      background: linear-gradient(135deg, #3a8dde, #1c6ed5);
      color: white;
      padding: 18px;
      border-radius: 10px;
      font-weight: bold;
      max-width: 100%;
      width: 100%;
      font-size: 20px;
  
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
  
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  }
  
  .login-title h1{
      margin:0;
      font-size:22px;
  }
  .role-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .role-card {
    background-color: #f8f9fa;
    color: black;
    border-radius: 10px;
    padding: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .role-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    max-width: 100%;
    width: 100%;
  }
  .role-card img {
    max-width: 100%;
    width: 100%;
    height: 93px;
    object-fit: contain;
  }
  .role-card button {
    max-width: 100%;
    width: 100%;
    border-radius: 10px;
    font-size: 20px;
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
  .kotak-dlx {
    background: linear-gradient(to right, #ea3438, #f39c12, #28a745);
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  }
  .kotak-spr {
    background: linear-gradient(to right, #99caeb, #5daee6, #f39c12);
    color: black;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .kotak-std {
    background: linear-gradient(to right, #f6df07, #f4c20d, #ff7f50, #c0392b, #8e44ad);
    color: black;
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
    font-size: 15px;
    letter-spacing: 0.5px;
    padding: 12px;
    border: none;
}

.custom-table thead tr:first-child th {
    background: linear-gradient(135deg, #0069d9, #17a2b8);
    font-size: 17px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.custom-table tbody td, 
.custom-table tbody th {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #dee2e6;
    font-size: 16px;
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

/* === Buttons === */
.btn-status {
    font-size: 13px;
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 600;
    border: none;
    color: #fff;
}
.btn-menunggu {
    background-color: #facc15;
    color: #111827;
}
.btn-validasi {
    background-color: #38bdf8;
}
.btn-menunggu:hover {
    background-color: #eab308;
}
.btn-validasi:hover {
    background-color: #0ea5e9;
}
</style>
<div class="body" style="margin-top: 10px;">
  <div class="login-container">
    <div class="login-title">
        <h1>Aplikasi Manajemen<br>Hotel Nirwana</h1>
    </div>
    <img src="{{ asset('assets/img/Nirwana_Logo.png') }}" 
         alt="Logo Hotel Nirwana" 
         style="width:290px; height:220px; margin-bottom: 15px;">
    
         
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

      
    <div class="kotak-cari">
        <h1>Informasi Pemesanan</h1>
        <form action="/" method="GET" id="frmCariTanggal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span> 
                        <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                        <input type="text" 
                            id="tgl_tampil" 
                            class="form-control flatpickr"
                            placeholder="Tanggal Check-In"
                            autocomplete="off"
                            style="font-size:16pt;"> 
                        <!-- INPUT ASLI UNTUK DATABASE -->
                        <input type="hidden" id="cari_tanggal" name="cari_tanggal">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span> 
                        <!-- ✅ INPUT TAMPILAN (FONT 16pt) -->
                        <input type="text" 
                            id="tgl_tampil" 
                            class="form-control flatpickr"
                            placeholder="Tanggal Check-Out"
                            autocomplete="off"
                            style="font-size:16pt;"> 
                        <!-- INPUT ASLI UNTUK DATABASE -->
                        <input type="hidden" id="cari_tanggal" name="cari_tanggal">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <select id="status" name="status" class="form-control" style="font-size:16pt;">
                        <option value="">-- Pilih Status --</option>
                        <option value="booking">Booking</option>
                        <option value="check-in">Check-In</option>
                    </select>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100" 
                        type="submit"
                        style="font-size:16pt; padding:10px;">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>


    <div class="table-wrapper mt-3">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No.Kamar</th>
                        <th>Status</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Resi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>DLX1</td>
                        <td>Booking</td>
                        <td>06 April 2026</td>
                        <td>07 April 2026</td>
                        <td>
                            <a href="#"
                               class="TambahModalDLX btn btn-success"
                               tipe_kamar="1"
                               data-tanggal="{{ $cari_tanggal }}">
                               <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                            </a>
                            <a href="#"
                               class="TambahModalDLX btn btn-info"
                               tipe_kamar="1"
                               data-tanggal="{{ $cari_tanggal }}">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <div class="kotak-dlx mt-3 p-3">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                <img src="{{ asset('assets/img/kamar_deluxe.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
            </div>

            <!-- KONTEN KAMAR -->
            <div class="col-md-6 col-12 text-start">
                <h1 class="mb-1">Kamar Deluxe</h1>
                <p class="mb-1">
                    Tersedia <br> 
                    {{ $kamarSingleDLX }} Kamar Single Bed 
                    <br>{{ $kamarDoubleDLX }} Kamar Double Bed
                </p>
                <p class="mb-0">
                    <span style="font-size:22px; font-weight:700; color:#00ff79;">Rp.300.000</span> 
                    / malam
                </p>
            </div>

            <!-- TOMBOL -->
            <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                <a href="#"
                   class="TambahModalDLX btn btn-dark px-3 py-2"
                   style="font-size:14pt; white-space:nowrap;"
                   tipe_kamar="1"
                   data-tanggal="{{ $cari_tanggal }}">
                   Pesan Kamar
                </a>
            </div>

        </div>
    </div>



    <div class="kotak-spr mt-3 p-3">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                <img src="{{ asset('assets/img/kamar_superior.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
            </div>

            <!-- KONTEN KAMAR -->
            <div class="col-md-6 col-12 text-start">
                <h1 class="mb-1">Kamar Superior</h1>
                <p class="mb-1">Tersedia 7 Kamar</p>
                <p class="mb-0">
                    <span style="font-size:22px; font-weight:700; color:#d68300;">Rp.280.000</span> 
                    / malam
                </p>
            </div>

            <!-- TOMBOL -->
            <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                <a href="#"
                   class="TambahModalDLX btn btn-dark px-3 py-2"
                   style="font-size:14pt; white-space:nowrap;"
                   tipe_kamar="1"
                   data-tanggal="{{ $cari_tanggal }}">
                   Pesan Kamar
                </a>
            </div>

        </div>
    </div>





    <div class="kotak-std mt-3 p-3">
        <div class="row align-items-center">

            <!-- FOTO -->
            <div class="col-md-3 col-12 d-flex justify-content-center text-center mb-3 mb-md-0">
                <img src="{{ asset('assets/img/kamar_standar.jpg') }}" class="img-fluid rounded" style="max-height:120px;">
            </div>

            <!-- KONTEN KAMAR -->
            <div class="col-md-6 col-12 text-start">
                <h1 class="mb-1">Kamar Standar</h1>
                <p class="mb-1">Tersedia 5 Kamar</p>
                <p class="mb-0">
                    <span style="font-size:22px; font-weight:700; color:#8F00FF;">Rp.240.000</span> 
                    / malam
                </p>
            </div>

            <!-- TOMBOL -->
            <!-- TOMBOL -->
            <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                <a href="#"
                   class="TambahModalDLX btn btn-dark px-3 py-2"
                   style="font-size:14pt; white-space:nowrap;"
                   tipe_kamar="1"
                   data-tanggal="{{ $cari_tanggal }}">
                   Pesan Kamar
                </a>
            </div>

        </div>
    </div>





  <!-- BAGIAN KAMAR DELUXE (DLX) -->
  <!-- Modal Tambah Kamar Deluxe (DLX) -->
  <div class="modal fade" id="modal-DLX" tabindex="-1" aria-labelledby="TambahModalDLXLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="TambahModalDLXLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Deluxe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadTambahModalDLX">
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Informasi Kamar Deluxe (DLX) -->
  <div class="modal fade" id="modalinfo-DLX" tabindex="-1" aria-labelledby="ModalDLXLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="ModalDLXLabel" style="font-size:16pt;">Informasi Kamar - Tipe Deluxe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadModalDLX">
        </div>
      </div>
    </div>
  </div>











  <!-- BAGIAN KAMAR SUPERIOR (SPR) -->
  <!-- Modal Tambah Kamar Superior (SPR) -->
  <div class="modal fade" id="modal-SPR" tabindex="-1" aria-labelledby="TambahModalSPRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="TambahModalSPRLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Superior</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadTambahModalSPR">
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Informasi Kamar Superior (SPR) -->
  <div class="modal fade" id="modalinfo-SPR" tabindex="-1" aria-labelledby="ModalSPRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="ModalSPRLabel" style="font-size:16pt;">Informasi Kamar - Tipe Superior</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadModalSPR">
        </div>
      </div>
    </div>
  </div>
















  <!-- BAGIAN KAMAR STANDAR (STD) -->
  <!-- Modal Tambah Kamar Standar (STD) -->
  <div class="modal fade" id="modal-STD" tabindex="-1" aria-labelledby="TambahModalSTDLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="TambahModalSTDLabel" style="font-size:16pt;">Tambah Pemesanan Kamar - Tipe Standar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadTambahModalSTD">
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Informasi Kamar Standar (STD) -->
  <div class="modal fade" id="modalinfo-STD" tabindex="-1" aria-labelledby="ModalSTDLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="ModalSTDLabel" style="font-size:16pt;">Informasi Kamar - Tipe Standar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadModalSTD">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('myscript')
<script>
// BAGIAN DARI FORM PENCARIAN TANGGAL
$(document).on('change', '#tgl_tampil', function () {
    let tanggal = $(this).val(); // contoh: "01 Desember 2025" atau "01 December 2025"
    if (!tanggal) return;

    // map bahasa indonesia + english ke angka
    const bulanMap = {
        "Januari":"01","Jan":"01","January":"01",
        "Februari":"02","Feb":"02","February":"02",
        "Maret":"03","Mar":"03","March":"03",
        "April":"04","Apr":"04","April":"04",
        "Mei":"05","May":"05",
        "Juni":"06","Jun":"06","June":"06",
        "Juli":"07","Jul":"07","July":"07",
        "Agustus":"08","Aug":"08","August":"08",
        "September":"09","Sep":"09","September":"09",
        "Oktober":"10","Oct":"10","October":"10",
        "November":"11","Nov":"11","November":"11",
        "Desember":"12","Dec":"12","December":"12"
    };

    // split aman (hilangkan spasi berlebih)
    let parts = tanggal.trim().split(/\s+/);
    if (parts.length < 3) {
        // fallback: kalau format beda, coba parse dengan Date
        let parsed = new Date(tanggal);
        if (!isNaN(parsed)) {
            let yyyy = parsed.getFullYear();
            let mm = String(parsed.getMonth() + 1).padStart(2,'0');
            let dd = String(parsed.getDate()).padStart(2,'0');
            $('#cari_tanggal').val(`${yyyy}-${mm}-${dd}`);
        } else {
            console.warn('Format tanggal tidak dikenali:', tanggal);
        }
        return;
    }

    let hari = parts[0].padStart(2,'0'); // "1" -> "01"
    let bulanText = parts[1];
    let tahun = parts[2];

    let bulanNum = bulanMap[bulanText];
    if (!bulanNum) {
        // coba lowercase & capitalize
        let keyLower = bulanText.charAt(0).toUpperCase() + bulanText.slice(1).toLowerCase();
        bulanNum = bulanMap[keyLower];
    }

    if (!bulanNum) {
        alert('Format bulan tidak dikenali: ' + bulanText);
        return;
    }

    let formatDB = `${tahun}-${bulanNum}-${hari}`;
    $('#cari_tanggal').val(formatDB);
    console.log("Tanggal DB:", formatDB);
});


$(document).on('focus', '.flatpickr', function () {
    $(this).datepicker({
        format: "dd MM yyyy",
        autoclose: true,
        todayHighlight: true,
        language: "id"
    }).on('changeDate', function (e) {

        let tanggalDB = e.format('yyyy-mm-dd');

        if($(this).attr('id') === 'check_in_tampil') {
            $('#check_in').val(tanggalDB).trigger('change');
        } 
        else if($(this).attr('id') === 'check_out_tampil') {
            $('#check_out').val(tanggalDB);
        } 
        else if($(this).attr('id') === 'tgl_tampil') {
            $('#cari_tanggal').val(tanggalDB);
        }

    });
});


document.addEventListener("DOMContentLoaded", function () {
    let today = new Date();

    // ✅ FORMAT UNTUK DATABASE (YYYY-MM-DD)
    let yyyy = today.getFullYear();
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let dd = String(today.getDate()).padStart(2, '0');
    let formatDB = `${yyyy}-${mm}-${dd}`;

    // ✅ FORMAT UNTUK TAMPILAN (27 November 2025)
    let bulanIndo = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    let formatView = `${dd} ${bulanIndo[today.getMonth()]} ${yyyy}`;

    // ✅ SET OTOMATIS KE INPUT
    document.getElementById("tgl_tampil").value = formatView;
    document.getElementById("cari_tanggal").value = formatDB;

    console.log("AUTO TANGGAL AKTIF:", formatDB);
});


















// BAGIAN DARI FORM TAMBAH MODAL DELUXE
$(document).on('click', '.TambahModalDLX', function(e){
    e.preventDefault();

    let tipe = $(this).attr('tipe_kamar');

    $.ajax({
        type:'POST',
        url:'/TambahModalDLX',
        data:{
            _token : "{{ csrf_token() }}",
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadTambahModalDLX").html(respond);
            $("#modal-DLX").modal("show");

            // default isi dropdown
            $('#jumlah_kamar_dipesan_dlx').html(`
                <option style="font-size:16pt;" value="">
                    Silakan pilih tanggal check-in
                </option>
            `);
        }
    });
});



$(document).on('change', '#check_in', function(){

    let tanggal = $(this).val();
    let tipe = 1; // DLX

    if(!tanggal){
        $('#jumlah_kamar_dipesan_dlx').html(`
            <option style="font-size:16pt;" value="">
                Silakan pilih tanggal check-in
            </option>
        `);
        return;
    }

    $.ajax({
        url: '/getKamarTersedia',
        type: 'POST',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tanggal: tanggal,
            tipe_kamar: tipe
        },
        success: function(res){

            console.log("RESPON FINAL:", res);

            if (!res || res.length === 0) {
                $('#jumlah_kamar_dipesan_dlx').html(`
                    <option style="font-size:16pt;" value="">
                        Kamar Penuh
                    </option>
                `);
                return;
            }

            let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;

            for(let i = 1; i <= res.length; i++){
                opt += `<option style="font-size:16pt;" value="${i}">${i} Kamar</option>`;
            }

            $('#jumlah_kamar_dipesan_dlx').html(opt);

            // simpan data kamar
            window.kamar = res;
        }
    });

});


// ✅ RESET SAAT MODAL DIBUKA
$(document).on('shown.bs.modal', '#modal-DLX', function () {
    $('#list_nomor_kamar_dlx').html('');
    window.kamar = [];
});


// ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
$('body').on('change', '#jumlah_kamar_dipesan_dlx', function () {

    let jumlah = parseInt($(this).val());
    let list = $('#list_nomor_kamar_dlx');

    if(jumlah && jumlah > 0){
        $('#kamar_tersedia_title').show();
        $('#kamar_tersedia_list').show();
    }else{
        $('#kamar_tersedia_title').hide();
        $('#kamar_tersedia_list').hide();
    }

    let tipe = 1;
    let tanggal = $('#check_in').val();

    list.html('');

    if (!jumlah || jumlah < 1) return;

    for (let i = 1; i <= jumlah; i++) {

        let selectHTML = `
        <div class="mb-2">
            <label style="font-size:16pt;">Jenis Bed ${i}</label>
            <select name="jenis_bed[]" class="form-control select-bed-dlx" style="font-size:16pt;">
                <option value="">-- Pilih Jenis Bed --</option>
            </select>
        </div>
        `;

        list.append(selectHTML);
    }

    $.ajax({
        type: 'POST',
        url: "/getKamarTersedia",
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tanggal: tanggal,
            tipe_kamar: tipe
        },
        success: function (res) {

            console.log("DATA KAMAR:", res);

            // hitung stok bed
            let single = res.filter(k => k.jenis_bed == 1).length;
            let dbl = res.filter(k => k.jenis_bed == 2).length;

            window.stokBed = {
                single: single,
                double: dbl
            };

            updateBedSelect();

        }
    });

});



function updateBedSelect(){

    let usedSingle = 0;
    let usedDouble = 0;

    $('.select-bed-dlx').each(function(){

        let val = $(this).val();

        if(val == 1) usedSingle++;
        if(val == 2) usedDouble++;

    });

    $('.select-bed-dlx').each(function(){

        let current = $(this).val();
        let select = $(this);

        select.html(`<option value="">-- Pilih Jenis Bed --</option>`);

        // Single Bed
        if(window.stokBed.single - usedSingle > 0 || current == 1){
            select.append(`<option value="1" ${current==1?'selected':''}>Single Bed</option>`);
        }

        // Double Bed
        if(window.stokBed.double - usedDouble > 0 || current == 2){
            select.append(`<option value="2" ${current==2?'selected':''}>Double Bed</option>`);
        }

    });

}


$(document).on('change', '.select-bed-dlx', function(){

    updateBedSelect();

});



// ✅ REQUEST EXTRA BED / BREAKFAST
$(document).on('change', '#request', function(){

    let value = $(this).val();
    let biaya = 0;

    if(value === 'extra_bed'){
        biaya = 150000;
    } 
    else if(value === 'breakfast'){
        biaya = 50000;
    }

    if(value !== ''){
        $('#biaya_container').show();
        $('#biaya_input_container').show();

        $('#biaya_request').val('Rp ' + biaya.toLocaleString('id-ID'));
        $('#biaya_request_value').val(biaya);
    } 
    else{
        $('#biaya_container').hide();
        $('#biaya_input_container').hide();
        $('#biaya_request').val('');
        $('#biaya_request_value').val('');
    }

});



$(document).on('submit', '#frmTambahModalDLX', function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        processData: false,
        contentType: false,

        success: function(res){

            alert('Data berhasil disimpan');

            $('#modal-DLX').modal('hide');

            location.reload();

        },

        error: function(xhr){

            console.log(xhr.responseText);
            alert('Terjadi kesalahan');

        }
    });

});

















// BAGIAN DARI TABEL MODAL DELUXE
$(document).on('click', '.ModalDLX', function(e){
    e.preventDefault();

    let tanggal = $(this).data('tanggal');
    let nomor_kamar = $(this).attr('nomor_kamar');
    let tipe = $(this).attr('tipe_kamar');

    $.ajax({
        type:'POST',
        url:'/ModalDLX',
        data:{
            _token : "{{ csrf_token() }}",
            tanggal : tanggal,
            nomor_kamar : nomor_kamar,
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadModalDLX").html(respond);
            $("#modalinfo-DLX").modal("show");
        }
    });
});


$(document).on('shown.bs.modal', '#modalinfo-DLX', function () {
    $('#list_nomor_kamar_dlx').html('');
    window.kamar = [];
});




























// BAGIAN DARI FORM TAMBAH MODAL SUPERIOR
$(document).on('click', '.TambahModalSPR', function(e){
    e.preventDefault();

    let tipe = $(this).attr('tipe_kamar');
    let tanggal = $(this).data('tanggal');

    $.ajax({
        type:'POST',
        url:'/TambahModalSPR',
        data:{
            _token : "{{ csrf_token() }}",
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadTambahModalSPR").html(respond);
            $("#modal-SPR").modal("show");

            // 🟩 PANGGIL GET KAMAR TERSEDIA SETELAH MODAL DILOAD
            if(!tanggal){
                $('#jumlah_kamar_dipesan_spr').html(`<option style="font-size:16pt;" value="">Silakan cari tanggal dulu</option>`);
                return;
            }

            $.ajax({
                url: '/getKamarTersedia',
                type: 'POST',
                dataType: 'json',
                data: {
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res){
                    console.log("RESPON FINAL:", res);

                    if (!res || res.length === 0) {
                        $('#jumlah_kamar_dipesan_spr').html(`<option style="font-size:16pt;" value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option style="font-size:16pt;" value="${i}">${i}</option>`;
                    }

                    $('#jumlah_kamar_dipesan_spr').html(opt);
                    window.kamar = res;
                }
            });
        }
    });
});


// ✅ RESET SAAT MODAL DIBUKA
$(document).on('shown.bs.modal', '#modal-SPR', function () {
    $('#list_nomor_kamar_spr').html('');
    window.kamar = [];
});


// ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
$('body').on('change', '#jumlah_kamar_dipesan_spr', function () {

    let jumlah = parseInt($(this).val());
    let list = $('#list_nomor_kamar_spr');

    let tipe = 2; // ✅ SPR
    let tanggal = $('#cari_tanggal').val(); // ✅ dari input hidden

    list.html('');

    if (!jumlah || jumlah < 1) return;

    for (let i = 1; i <= jumlah; i++) {
        let selectHTML = `
            <div class="mb-2">
                <label style="font-size:16pt;">Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar-spr" style="font-size:16pt;">
                    <option value="">-- Pilih Nomor Kamar --</option>
                </select>
            </div>
        `;
        list.append(selectHTML);
    }

    $.ajax({
        type: 'POST',
        url: "/getKamarTersedia",
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tanggal: tanggal,
            tipe_kamar: tipe
        },
        success: function (res) {

            console.log('DATA KAMAR:', res); // ✅ untuk debug

            $('.select-kamar-spr').each(function () {
                let select = $(this);
                select.html('<option style="font-size:16pt;" value="">-- Pilih Nomor Kamar --</option>');

                res.forEach(function (k) {
                    select.append(`
                        <option style="font-size:16pt;" value="${k.id_nomor_kamar}">
                            SPR${k.nomor_kamar}
                        </option>
                    `);
                });
            });
        }
    });

});



$(document).on('change', '.select-kamar-spr', function () {
    let selectedValues = [];

    $('.select-kamar-spr').each(function () {
        let val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('.select-kamar-spr').each(function () {
        let currentSelect = $(this);
        let currentValue = currentSelect.val();

        currentSelect.find('option').each(function () {
            let optionVal = $(this).val();

            if (selectedValues.includes(optionVal) && optionVal !== currentValue) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
    });
});

























// BAGIAN DARI TABEL MODAL SUPERIOR
$(document).on('click', '.ModalSPR', function(e){
    e.preventDefault();

    let tanggal = $(this).data('tanggal');
    let nomor_kamar = $(this).attr('nomor_kamar');
    let tipe = $(this).attr('tipe_kamar');

    $.ajax({
        type:'POST',
        url:'/ModalSPR',
        data:{
            _token : "{{ csrf_token() }}",
            tanggal : tanggal,
            nomor_kamar : nomor_kamar,
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadModalSPR").html(respond);
            $("#modalinfo-SPR").modal("show");
        }
    });
});


$(document).on('shown.bs.modal', '#modalinfo-SPR', function () {
    $('#list_nomor_kamar_dlx').html('');
    window.kamar = [];
});




















// BAGIAN DARI FORM TAMBAH MODAL STANDAR
$(document).on('click', '.TambahModalSTD', function(e){
    e.preventDefault();

    let tipe = $(this).attr('tipe_kamar');
    let tanggal = $(this).data('tanggal');

    $.ajax({
        type:'POST',
        url:'/TambahModalSTD',
        data:{
            _token : "{{ csrf_token() }}",
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadTambahModalSTD").html(respond);
            $("#modal-STD").modal("show");

            // 🟩 PANGGIL GET KAMAR TERSEDIA SETELAH MODAL DILOAD
            if(!tanggal){
                $('#jumlah_kamar_dipesan_std').html(`<option style="font-size:16pt;" value="">Silakan cari tanggal dulu</option>`);
                return;
            }

            $.ajax({
                url: '/getKamarTersedia',
                type: 'POST',
                dataType: 'json',
                data: {
                    tanggal: tanggal,
                    tipe_kamar: tipe
                },
                success: function(res){
                    console.log("RESPON FINAL:", res);

                    if (!res || res.length === 0) {
                        $('#jumlah_kamar_dipesan_std').html(`<option style="font-size:16pt;" value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option style="font-size:16pt;" value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option style="font-size:16pt;" value="${i}">${i}</option>`;
                    }

                    $('#jumlah_kamar_dipesan_std').html(opt);
                    window.kamar = res;
                }
            });
        }
    });
});


// ✅ RESET SAAT MODAL DIBUKA
$(document).on('shown.bs.modal', '#modal-STD', function () {
    $('#list_nomor_kamar_std').html('');
    window.kamar = [];
});


// ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
$('body').on('change', '#jumlah_kamar_dipesan_std', function () {

    let jumlah = parseInt($(this).val());
    let list = $('#list_nomor_kamar_std');

    let tipe = 3; // ✅ STD
    let tanggal = $('#cari_tanggal').val(); // ✅ dari input hidden

    list.html('');

    if (!jumlah || jumlah < 1) return;

    for (let i = 1; i <= jumlah; i++) {
        let selectHTML = `
            <div class="mb-2">
                <label style="font-size:16pt;">Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar-std" style="font-size:16pt;">
                    <option value="">-- Pilih Nomor Kamar --</option>
                </select>
            </div>
        `;
        list.append(selectHTML);
    }

    $.ajax({
        type: 'POST',
        url: "/getKamarTersedia",
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tanggal: tanggal,
            tipe_kamar: tipe
        },
        success: function (res) {

            console.log('DATA KAMAR:', res); // ✅ untuk debug

            $('.select-kamar-std').each(function () {
                let select = $(this);
                select.html('<option style="font-size:16pt;" value="">-- Pilih Nomor Kamar --</option>');

                res.forEach(function (k) {
                    select.append(`
                        <option style="font-size:16pt;" value="${k.id_nomor_kamar}">
                            STD${k.nomor_kamar}
                        </option>
                    `);
                });
            });
        }
    });

});



$(document).on('change', '.select-kamar-std', function () {
    let selectedValues = [];

    $('.select-kamar-std').each(function () {
        let val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('.select-kamar-std').each(function () {
        let currentSelect = $(this);
        let currentValue = currentSelect.val();

        currentSelect.find('option').each(function () {
            let optionVal = $(this).val();

            if (selectedValues.includes(optionVal) && optionVal !== currentValue) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
    });
});

















// BAGIAN DARI TABEL MODAL STANDAR
$(document).on('click', '.ModalSTD', function(e){
    e.preventDefault();

    let tanggal = $(this).data('tanggal');
    let nomor_kamar = $(this).attr('nomor_kamar');
    let tipe = $(this).attr('tipe_kamar');

    $.ajax({
        type:'POST',
        url:'/ModalSTD',
        data:{
            _token : "{{ csrf_token() }}",
            tanggal : tanggal,
            nomor_kamar : nomor_kamar,
            tipe_kamar : tipe
        },
        success:function(respond){
            $("#loadModalSTD").html(respond);
            $("#modalinfo-STD").modal("show");
        }
    });
});


$(document).on('shown.bs.modal', '#modalinfo-STD', function () {
    $('#list_nomor_kamar_std').html('');
    window.kamar = [];
});






























// BAGIAN DARI HAPUS DATA HISTORI KAMAR DELUXE / SUPERIOR / STANDAR
$(document).on('click', '.btn-hapus-kamar', function() {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data pesanan kamar ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: '/hapus-histori-kamar',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_histori_kamar: id
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    setTimeout(function () {
                        location.reload(); // refresh role-grid
                    }, 2000);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Data gagal dihapus.'
                    });
                }
            });

        }
    });
});





















$.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
</script>
@endpush