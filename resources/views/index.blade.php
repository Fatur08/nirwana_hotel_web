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
  }
  .login-container {
    text-align: center;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 15px;
    max-width: 100%;
    width: 100%;
  }
  .login-title {
    background-color: #007bff;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    max-width: 100%;
    width: 100%;
  }
  .role-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 10px;
    max-width: 100%;
    width: 100%;
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
  }
</style>
<div class="body" style="margin-top: 10px;">
  <div class="login-container">
    <div class="login-title">
        <h3>Aplikasi Manajemen<br>Hotel Nirwana</h3>
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
      <h3>Cari Tanggal</h3>
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
    
    <h3>
      @if(request('cari_tanggal'))
          {{ \Carbon\Carbon::parse(request('cari_tanggal'))->locale('id')->translatedFormat('l, d F Y') }}
      @else
          {{ now()->locale('id')->translatedFormat('l, d F Y') }}
      @endif
    </h3>
    
    <div class="kotak-dlx">
        <h3>Kamar Deluxe</h3>
        <a href="#" class="TambahModalDLX btn btn-success mb-2 w-100" tipe_kamar="1" data-tanggal="{{ $cari_tanggal }}">
          Tambah Pemesanan
        </a>
        <div class="role-grid">
          @foreach($kamarDLX as $dlx)

            <div class="role-card {{ $dlx->histori_aktif ? 'bg-success text-white' : '' }}">

              <h5>
                <strong>{{ $dlx->kode_kamar }}{{ $dlx->nomor_kamar }}</strong>
              </h5>

              <a href="#"
                 class="ModalDLX btn {{ $dlx->histori_aktif ? 'btn-light' : 'btn-primary' }} w-100"
                 nomor_kamar="{{ $dlx->id_nomor_kamar }}"
                 tipe_kamar="1">
                 Informasi Kamar
              </a>

            </div>

          @endforeach
        </div>
    </div>

    <div class="kotak-spr">
        Kamar Superior
    </div>

    <div class="kotak-std">
        Kamar Standar
    </div>
  </div>


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
</div>
@endsection
@push('myscript')
<script>
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
                $('#jumlah_kamar_dipesan').html(`<option value="">Silakan cari tanggal dulu</option>`);
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
                        $('#jumlah_kamar_dipesan').html(`<option value="">Kamar Penuh</option>`);
                        return;
                    }

                    let opt = `<option value="">-- Pilih --</option>`;
                    for(let i = 1; i <= res.length; i++){
                        opt += `<option value="${i}">${i}</option>`;
                    }

                    $('#jumlah_kamar_dipesan').html(opt);
                    window.kamar = res;
                }
            });
        }
    });
});


// ✅ RESET SAAT MODAL DIBUKA
$(document).on('shown.bs.modal', '#modal-DLX', function () {
    $('#list_nomor_kamar').html('');
    window.kamar = [];
});


// ✅ SAAT JUMLAH KAMAR DIPILIH → GENERATE SELECT NOMOR KAMAR
$(document).on('change', '#jumlah_kamar_dipesan', function () {
    let jumlah = parseInt($(this).val());
    let list = $('#list_nomor_kamar');

    list.html(''); // reset dulu

    if (!jumlah || jumlah < 1) return;

    // ✅ looping sesuai jumlah kamar yang dipilih
    for (let i = 1; i <= jumlah; i++) {
        let selectHTML = `
            <div class="mb-2">
                <label>Nomor Kamar ${i}</label>
                <select name="nomor_kamar[]" class="form-control select-kamar" required>
                    <option value="">-- Pilih Nomor Kamar --</option>
                </select>
            </div>
        `;
        list.append(selectHTML);
    }

    // ✅ ISI SEMUA SELECT DENGAN DATA KAMAR DARI window.kamar
    if (window.kamar && window.kamar.length > 0) {
        $('.select-kamar').each(function () {
            let select = $(this);
            select.html('<option value="">-- Pilih Nomor Kamar --</option>');
                
            window.kamar.forEach(function (k) {
                // ✅ value = id_nomor_kamar (ANGKA)
                // ✅ text = DLX + nomor kamar
                select.append(`
                    <option value="${k.id_nomor_kamar}">
                        DLX${k.nomor_kamar}
                    </option>
                `);
            });
        });
    }
});



$(document).on('change', '.select-kamar', function () {
    let selectedValues = [];

    $('.select-kamar').each(function () {
        let val = $(this).val();
        if (val) selectedValues.push(val);
    });

    $('.select-kamar').each(function () {
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



$(document).on('click', '.ModalDLX', function(e){
    e.preventDefault();

    let nomor_kamar = $(this).attr('nomor_kamar');
    let tipe = $(this).attr('tipe_kamar');

    $.ajax({
        type:'POST',
        url:'/ModalDLX',
        data:{
            _token : "{{ csrf_token() }}",
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
    $('#list_nomor_kamar').html('');
    window.kamar = [];
});



$.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
</script>
@endpush