<form action="{{ url('TambahModalDLX/store_TambahModalDLX') }}" method="POST" id="frmTambahModalDLX" enctype="multipart/form-data">
    @csrf
    <input type="text" readonly value="{{ $tipe_kamar }}" id="tipe_kamar" class="form-control" name="tipe_kamar" placeholder="tipe_kamar" hidden>

    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Nama Tamu</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="" id="nama_tamu_dlx" class="form-control" style="font-size:16pt;" name="nama_tamu_dlx" placeholder="Masukkan Nama Tamu">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Check-In</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M16 3l0 4" />
                        <path d="M8 3l0 4" />
                        <path d="M4 11l16 0" />
                        <path d="M8 15h2v2h-2z" />
                    </svg>
                </span>
                <input type="text" id="check_in_tampil_dlx" class="form-control flatpickr" style="font-size:16pt;" placeholder="Masukkan Tanggal Check-In" autocomplete="off">
                <input type="hidden" id="check_in_dlx" name="check_in_dlx">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Check-Out</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M16 3l0 4" />
                        <path d="M8 3l0 4" />
                        <path d="M4 11l16 0" />
                        <path d="M8 15h2v2h-2z" />
                    </svg>
                </span>
                <input type="text" id="check_out_tampil_dlx" class="form-control flatpickr" style="font-size:16pt;" placeholder="Masukkan Tanggal Check-Out" autocomplete="off">
                <input type="hidden" id="check_out_dlx" name="check_out_dlx">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Jumlah Kamar Dipesan</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select id="jumlah_kamar_dipesan_dlx" name="jumlah_kamar_dipesan_dlx" class="form-control" style="font-size:16pt;">
            </select>
        </div>
    </div>
    <div class="row" id="kamar_tersedia_title_dlx" style="display:none;">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Kamar Yang Tersedia</h5>
        </div>
    </div>
    <div class="row mb-3" id="kamar_tersedia_list_dlx" style="display:none;">
        <div class="col-12">
            <div id="list_nomor_kamar_dlx"></div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Upload Foto KTP</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Icon kamera -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-camera">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 7h2l1 -2h8l1 2h2a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2" />
                        <path d="M12 13m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    </svg>
                </span>
                <input type="file"
                    id="foto_ktp_dlx"
                    name="foto_ktp_dlx"
                    class="form-control"
                    style="font-size:16pt;">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Request</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select id="request_dlx" name="request_dlx" class="request_dlx form-control" style="font-size:16pt;">
                <option value="">-- Pilih Request --</option>
                <option value="extra_bed">Ekstra Bed</option>
                <option value="breakfast">Breakfast</option>
            </select>
        </div>
    </div>
    <div class="row" id="biaya_container_dlx" style="display: none;">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Biaya Tambahan</h5>
        </div>
    </div>
    <div class="row" id="biaya_input_container_dlx" style="display: none;">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-currency-dollar">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                        <path d="M12 3v3m0 12v3" />
                    </svg>
                </span>
                <input type="text" id="biaya_request_dlx" class="form-control"
                    style="font-size:16pt;" readonly>
                <input type="hidden" id="biaya_request_value_dlx" name="biaya_request_dlx">
            </div>
        </div>
    </div>


    <!-- METODE PEMBAYARAN -->
    <div class="row">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Metode Pembayaran</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <select id="metode_pembayaran_dlx" name="metode_pembayaran_dlx" class="form-control" style="font-size:16pt;">
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="cash">Cash</option>
                <option value="online">Online</option>
            </select>
        </div>
    </div>

    <!-- INPUT TAMBAHAN JIKA ONLINE -->
    <div class="row" id="sumber_pembayaran_container_dlx" style="display:none;">
        <div class="col-12">
            <h5 class="text-start" style="font-size:16pt;">Masukkan Sumber Pembayaran Online</h5>
        </div>
    </div>
    <div class="row mb-3" id="sumber_pembayaran_input_dlx" style="display:none;">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="3" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </span>
                <input type="text"
                    id="sumber_pembayaran_dlx"
                    name="sumber_pembayaran_dlx"
                    class="form-control"
                    style="font-size:16pt;"
                    placeholder="Contoh: BCA, Dana, OVO, dll">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-danger w-100" type="submit" style="font-size:16pt;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>