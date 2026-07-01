<div class="card-body">

    <form action="{{ url('BuatResiManual/store') }}" method="POST">

        @csrf

        {{-- ========================= --}}
        {{-- DATA TAMU --}}
        {{-- ========================= --}}

        <div class="row mb-3">

            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Nama Tamu
                </label>

                <input type="text" name="nama_tamu" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Alamat
                </label>

                <input type="text" name="alamat" class="form-control" required>
            </div>

        </div>


        {{-- ========================= --}}
        {{-- CHECK IN / OUT --}}
        {{-- ========================= --}}

        <div class="row mb-4">

            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Check In
                </label>

                <input type="date" name="check_in" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Check Out
                </label>

                <input type="date" name="check_out" class="form-control" required>
            </div>

        </div>


        <hr>

        <h4 class="mb-3">
            Jumlah Kamar
        </h4>

        <div class="row">

            <div class="col-md-3 mb-3">
                <label>Deluxe</label>

                <input type="number" name="deluxe" class="form-control" min="0" value="0">
            </div>

            <div class="col-md-3 mb-3">
                <label>Superior</label>

                <input type="number" name="superior" class="form-control" min="0" value="0">
            </div>

            <div class="col-md-3 mb-3">
                <label>Standart</label>

                <input type="number" name="standart" class="form-control" min="0" value="0">
            </div>

            <div class="col-md-3 mb-3">
                <label>Home Stay</label>

                <input type="number" name="homestay" class="form-control" min="0" value="0">
            </div>

        </div>


        <hr>

        <h4 class="mb-3">
            Request Tambahan
        </h4>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Ekstra Bed</label>

                <input type="number" name="ekstra_bed" class="form-control" min="0" value="0">
            </div>

            <div class="col-md-6 mb-3">
                <label>Breakfast</label>

                <input type="number" name="breakfast" class="form-control" min="0" value="0">
            </div>

        </div>


        <div class="text-end mt-4">

            <button class="btn btn-success btn-lg">

                Simpan

            </button>

        </div>

    </form>

</div>