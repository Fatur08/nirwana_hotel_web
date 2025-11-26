@extends('layouts.tabler')
@section('content')
<form action="/modalDLX/update_modalDLX" method="POST" id="frmmodalDLX" enctype="multipart/form-data">
    @csrf
    <input type="text" readonly value="{{ $nomor_kamar }}" id="nomor_kamar" class="form-control" name="nomor_kamar" placeholder="nomor_kamar" hidden>
    <div class="row">
        <div class="col-12">
            <h5>Nama Tamu</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" value="" id="nama_tamu" class="form-control" name="nama_tamu" placeholder="Masukkan Nama Tamu">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Jumlah Kamar Dipesan</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select id="jumlah_kamar_dipesan" class="form-control">
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Kamar Yang Tersedia</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div id="list_nomor_kamar"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Check-In</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </span>
                <input type="text" value="" id="check_in" name="check_in" class="form-control flatpickr" placeholder="Masukkan Tanggal Check-In" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Check-Out</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </span>
                <input type="text" value="" id="check_out" name="check_out" class="form-control flatpickr" placeholder="Masukkan Tanggal Check-Out" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Biaya Tambahan (Opsional)</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-currency-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                </span>
                <input type="number" value="" id="biaya_tambahan" class="form-control" name="biaya_tambahan" placeholder="Masukkan Biaya Tambahan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-danger w-100">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
@push('myscript')
<script>
    $(function(){
        $(".flatpickr").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        })
    });



    const kamar = {
        DLX: @json($kamar_DLX),
        SPR: @json($kamar_SPR),
        STD: @json($kamar_STD)
    };

    // ✅ Ambil tipe dari hidden input/config kamu
    const tipe = "{{ $nomor_kamar == 1 ? 'DLX' : ($nomor_kamar == 2 ? 'SPR' : 'STD') }}";

    const kamarTersedia = kamar[tipe];

    // ✅ Isi select jumlah kamar otomatis
    let jumlahHTML = '';
    for(let i = 1; i <= kamarTersedia.length; i++){
        jumlahHTML += `<option value="${i}">${i} Kamar</option>`;
    }
    $("#jumlah_kamar_dipesan").html(jumlahHTML);

    // ✅ Render select kamar
    function renderSelect(jumlah){
        let html = "";

        for (let i = 1; i <= jumlah; i++) {
            html += `
                <div class="mt-2">
                    <label>Pilih Nomor Kamar ${i}</label>
                    <select name="nomor_kamar_dipilih[]" class="form-control kamar-select">
                        <option value="">-- Pilih Kamar --</option>
                        ${kamarTersedia.map(k => 
                            `<option value="${k.nomor_kamar}">
                                ${k.kode_kamar}-${k.nomor_kamar}
                            </option>`
                        ).join("")}
                    </select>
                </div>
            `;
        }

        $("#list_nomor_kamar").html(html);
    }

    // ✅ Saat jumlah kamar berubah
    $("#jumlah_kamar_dipesan").on("change", function () {
        renderSelect($(this).val());
    });

    // ✅ Agar tidak bisa pilih kamar yang sama
    $(document).on("change", ".kamar-select", function () {
        let selected = [];

        $(".kamar-select").each(function () {
            if ($(this).val()) {
                selected.push($(this).val());
            }
        });

        $(".kamar-select option").prop("disabled", false);

        selected.forEach(function (val) {
            $(".kamar-select").not(function () {
                return $(this).val() == val;
            }).find(`option[value="${val}"]`).prop("disabled", true);
        });
    });

    // ✅ Auto trigger saat pertama kali dibuka
    $("#jumlah_kamar_dipesan").trigger("change");
</script>
@endpush