<form action="/TambahModalSPR/store_TambahModalSPR" method="POST" id="frmTambahModalSPR" enctype="multipart/form-data">
    @csrf
    <input type="text" readonly value="{{ $tipe_kamar }}" id="tipe_kamar" class="form-control" name="tipe_kamar" placeholder="tipe_kamar" hidden>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Nama Tamu</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" value="" id="nama_tamu" class="form-control" name="nama_tamu" style="font-size:16pt;" placeholder="Masukkan Nama Tamu">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Nomor KTP Tamu</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-id"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>
                </span>
                <input type="number" value="" id="nomor_ktp_tamu" class="form-control" style="font-size:16pt;" name="nomor_ktp_tamu" placeholder="Masukkan Nomor KTP Tamu">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Jumlah Kamar Dipesan</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select id="jumlah_kamar_dipesan_spr" name="jumlah_kamar_dipesan_spr" class="form-control" style="font-size:16pt;">
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Kamar Yang Tersedia</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div id="list_nomor_kamar_spr"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Check-In</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </span>
                <input type="text" id="check_in_tampil" class="form-control flatpickr" style="font-size:16pt;" placeholder="Masukkan Tanggal Check-In" autocomplete="off">
                <input type="hidden" id="check_in" name="check_in">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Check-Out</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </span>
                <input type="text" id="check_out_tampil" class="form-control flatpickr" style="font-size:16pt;" placeholder="Masukkan Tanggal Check-Out" autocomplete="off">
                <input type="hidden" id="check_out" name="check_out">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 style="font-size:16pt;">Biaya Tambahan (Opsional)</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-currency-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                </span>
                <input type="number" value="" id="biaya_tambahan" class="form-control" style="font-size:16pt;" name="biaya_tambahan" placeholder="Masukkan Biaya Tambahan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100" type="submit" style="font-size:16pt;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>