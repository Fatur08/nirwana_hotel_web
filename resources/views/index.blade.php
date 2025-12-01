@extends('layouts.index')
@section('content')
<style>
  body {
    background: linear-gradient(to bottom, #eaf3ff, #ffffff);
    margin: 0;
    padding: 15px;
    min-height: 100vh;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .login-container {
    text-align: center;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 15px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .login-title {
    background-color: #007bff;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
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
    background-color: #ff3838ff;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .kotak-spr {
    background-color: #25a6fbff;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
  .kotak-std {
    background-color: #f7fc57ff;
    color: black;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
    font-size: 20px;
  }
</style>
<div class="body" style="margin-top: 10px;">
  <div class="login-container">
    <div class="login-title">
        <h1>Aplikasi Manajemen<br>Hotel Nirwana</h>
    </div>
    <img src="{{ asset('assets/img/nirwana_hotel.png') }}" 
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
      <h1>Cari Tanggal</h1>
      <form action="/" method="GET" id="frmCariTanggal" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-8">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </span>
                <!-- INPUT TAMPILAN (UNTUK USER) -->
                <input type="text" id="tgl_tampil" class="form-control flatpickr" placeholder="Masukkan Tanggal" autocomplete="off">
                 
                <!-- INPUT ASLI UNTUK DATABASE -->
                <input type="hidden" id="cari_tanggal" name="cari_tanggal">
            </div>
          </div>
          <div class="col-4">
            <button class="btn btn-success w-100" type="submit">
              Cari
            </button>
          </div>
        </div>
      </form>
    </div>
    
    <h1>
      @if(request('cari_tanggal'))
          {{ \Carbon\Carbon::parse(request('cari_tanggal'))->locale('id')->translatedFormat('l, d F Y') }}
      @else
          {{ now()->locale('id')->translatedFormat('l, d F Y') }}
      @endif
    </h1>
    
    <div class="kotak-dlx">
        <h1>Kamar Deluxe</h1>
        <a href="#" class="TambahModalDLX btn btn-success mb-2 w-100" tipe_kamar="1" data-tanggal="{{ $cari_tanggal }}">
          Tambah Pemesanan
        </a>
        <div class="role-grid">
          @foreach($kamarDLX as $dlx)
        
            <div class="role-card {{ $dlx->histori_aktif ? 'bg-success text-white' : '' }}">
        
              {{-- ✅ HEADER: JUDUL TENGAH + TOMBOL HAPUS KANAN --}}
              <div class="d-flex align-items-center justify-content-between mb-2">
        
                <h5 class="text-center flex-grow-1 mb-0">
                  <strong>{{ $dlx->kode_kamar }}{{ $dlx->nomor_kamar }}</strong>
                </h5>
        
                {{-- Tombol Hapus hanya muncul jika kamar sedang terisi --}}
                @if($dlx->histori_aktif)
                  <a href="#"
                    class="btn btn-danger btn-sm btn-hapus-kamar"
                    data-id="{{ $dlx->histori_aktif }}">
                    Hapus
                  </a>
                @endif
        
              </div>
        
              {{-- ✅ TOMBOL INFORMASI --}}
              <a href="#"
                 class="ModalDLX btn {{ $dlx->histori_aktif ? 'btn-light' : 'btn-primary' }} w-100"
                 data-tanggal="{{ $cari_tanggal }}"
                 nomor_kamar="{{ $dlx->id_nomor_kamar }}"
                 tipe_kamar="1">
                 Informasi Kamar
              </a>
        
            </div>
        
          @endforeach
        </div>
    </div>

























    <div class="kotak-spr">
        <h1>Kamar Superior</h1>
        <a href="#" class="TambahModalSPR btn btn-success mb-2 w-100" tipe_kamar="2" data-tanggal="{{ $cari_tanggal }}">
          Tambah Pemesanan
        </a>
        <div class="role-grid">
          @foreach($kamarSPR as $spr)
        
            <div class="role-card {{ $spr->histori_aktif ? 'bg-success text-white' : '' }}">
        
              {{-- ✅ HEADER: JUDUL TENGAH + TOMBOL HAPUS KANAN --}}
              <div class="d-flex align-items-center justify-content-between mb-2">
        
                <h5 class="text-center flex-grow-1 mb-0">
                  <strong>{{ $spr->kode_kamar }}{{ $spr->nomor_kamar }}</strong>
                </h5>
        
                {{-- Tombol Hapus hanya muncul jika kamar sedang terisi --}}
                @if($spr->histori_aktif)
                  <a href="#"
                    class="btn btn-danger btn-sm btn-hapus-kamar"
                    data-id="{{ $spr->histori_aktif }}">
                    Hapus
                  </a>
                @endif
        
              </div>
        
              {{-- ✅ TOMBOL INFORMASI --}}
              <a href="#"
                 class="ModalSPR btn {{ $spr->histori_aktif ? 'btn-light' : 'btn-primary' }} w-100"
                 data-tanggal="{{ $cari_tanggal }}"
                 nomor_kamar="{{ $spr->id_nomor_kamar }}"
                 tipe_kamar="2">
                 Informasi Kamar
              </a>
        
            </div>
        
          @endforeach
        </div>
    </div>






























    <div class="kotak-std">
        <h1>Kamar Standar</h1>
        <a href="#" class="TambahModalSTD btn btn-success mb-2 w-100" tipe_kamar="3" data-tanggal="{{ $cari_tanggal }}">
          Tambah Pemesanan
        </a>
        <div class="role-grid">
          @foreach($kamarSTD as $std)
        
            <div class="role-card {{ $std->histori_aktif ? 'bg-success text-white' : '' }}">
        
              {{-- ✅ HEADER: JUDUL TENGAH + TOMBOL HAPUS KANAN --}}
              <div class="d-flex align-items-center justify-content-between mb-2">
        
                <h5 class="text-center flex-grow-1 mb-0">
                  <strong>{{ $std->kode_kamar }}{{ $std->nomor_kamar }}</strong>
                </h5>
        
                {{-- Tombol Hapus hanya muncul jika kamar sedang terisi --}}
                @if($std->histori_aktif)
                  <a href="#"
                    class="btn btn-danger btn-sm btn-hapus-kamar"
                    data-id="{{ $std->histori_aktif }}">
                    Hapus
                  </a>
                @endif
        
              </div>
        
              {{-- ✅ TOMBOL INFORMASI --}}
              <a href="#"
                 class="ModalSTD btn {{ $std->histori_aktif ? 'btn-light' : 'btn-primary' }} w-100"
                 data-tanggal="{{ $cari_tanggal }}"
                 nomor_kamar="{{ $std->id_nomor_kamar }}"
                 tipe_kamar="3">
                 Informasi Kamar
              </a>
        
            </div>
        
          @endforeach
        </div>
    </div>
  </div>





  <!-- BAGIAN KAMAR DELUXE (DLX) -->
  <!-- Modal Tambah Kamar Deluxe (DLX) -->
  <div class="modal fade" id="modal-DLX" tabindex="-1" aria-labelledby="TambahModalDLXLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="TambahModalDLXLabel">Tambah Pemesanan Kamar - Tipe Deluxe</h5>
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
          <h5 class="modal-title" id="ModalDLXLabel">Informasi Kamar - Tipe Deluxe</h5>
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
          <h5 class="modal-title" id="TambahModalSPRLabel">Tambah Pemesanan Kamar - Tipe Superior</h5>
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
          <h5 class="modal-title" id="ModalSPRLabel">Informasi Kamar - Tipe Superior</h5>
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
          <h5 class="modal-title" id="TambahModalSTDLabel">Tambah Pemesanan Kamar - Tipe Standar</h5>
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
          <h5 class="modal-title" id="ModalSTDLabel">Informasi Kamar - Tipe Standar</h5>
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
        format: "dd MM yyyy",   // format tampilan untuk user
        autoclose: true,
        todayHighlight: true,
        language: "id"
    }).on('changeDate', function (e) {
        let tanggalDB = e.format('yyyy-mm-dd'); // format database

        // simpan ke hidden input yang sesuai
        if($(this).attr('id') === 'check_in_tampil') {
            $('#check_in').val(tanggalDB);
        } else if($(this).attr('id') === 'check_out_tampil') {
            $('#check_out').val(tanggalDB);
        } else if($(this).attr('id') === 'tgl_tampil') {
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
    let tanggal = $(this).data('tanggal');

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

            // 🟩 PANGGIL GET KAMAR TERSEDIA SETELAH MODAL DILOAD
            if(!tanggal){
                $('#jumlah_kamar_dipesan_dlx').html(`<option value="">Silakan cari tanggal dulu</option>`);
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
                        $('#jumlah_kamar_dipesan_dlx').html(`<option value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option value="${i}">${i}</option>`;
                    }

                    $('#jumlah_kamar_dipesan_dlx').html(opt);
                    window.kamar = res;
                }
            });
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

    let tipe = 1; // ✅ DLX
    let tanggal = $('#cari_tanggal').val(); // ✅ dari input hidden

    list.html('');

    if (!jumlah || jumlah < 1) return;

    for (let i = 1; i <= jumlah; i++) {
        let selectHTML = `
            <div class="mb-2">
                <label>Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar-dlx">
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

            $('.select-kamar-dlx').each(function () {
                let select = $(this);
                select.html('<option value="">-- Pilih Nomor Kamar --</option>');

                res.forEach(function (k) {
                    select.append(`
                        <option value="${k.id_nomor_kamar}">
                            DLX${k.nomor_kamar}
                        </option>
                    `);
                });
            });
        }
    });

});



$(document).on('change', '.select-kamar-dlx', function () {
    let selectedValues = [];

    $('.select-kamar-dlx').each(function () {
        let val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('.select-kamar-dlx').each(function () {
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
                $('#jumlah_kamar_dipesan_spr').html(`<option value="">Silakan cari tanggal dulu</option>`);
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
                        $('#jumlah_kamar_dipesan_spr').html(`<option value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option value="${i}">${i}</option>`;
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
                <label>Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar-spr">
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
                select.html('<option value="">-- Pilih Nomor Kamar --</option>');

                res.forEach(function (k) {
                    select.append(`
                        <option value="${k.id_nomor_kamar}">
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
                $('#jumlah_kamar_dipesan_std').html(`<option value="">Silakan cari tanggal dulu</option>`);
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
                        $('#jumlah_kamar_dipesan_std').html(`<option value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option value="${i}">${i}</option>`;
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

    let tipe = 1; // ✅ DLX
    let tanggal = $('#cari_tanggal').val(); // ✅ dari input hidden

    list.html('');

    if (!jumlah || jumlah < 1) return;

    for (let i = 1; i <= jumlah; i++) {
        let selectHTML = `
            <div class="mb-2">
                <label>Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar-std">
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
                select.html('<option value="">-- Pilih Nomor Kamar --</option>');

                res.forEach(function (k) {
                    select.append(`
                        <option value="${k.id_nomor_kamar}">
                            DLX${k.nomor_kamar}
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