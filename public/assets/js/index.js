// ======================================================
// MODAL PESAN KAMAR
// ======================================================
$(document).on('click', '.PesanKamar', function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/PesanKamar',
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function (respond) {

            $("#loadPesanKamar").html(respond);

            $("#modal-pesan-kamar").modal("show");

            setTimeout(function () {
                initPesanKamar();
            }, 200);

        }
    });
});


// ======================================================
// INIT PESAN KAMAR
// ======================================================
function initPesanKamar() {

    const checkOutPicker = flatpickr("#check_out_pesan_kamar", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: flatpickr.l10ns.id,
        disableMobile: true,
        allowInput: false
    });

    const checkInPicker = flatpickr("#check_in_pesan_kamar", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: flatpickr.l10ns.id,
        disableMobile: true,
        allowInput: false,

        onChange: function (selectedDates) {

            if (!selectedDates.length) return;

            let checkInDate = selectedDates[0];

            $('#check_in').val(
                this.formatDate(checkInDate, "Y-m-d")
            );

            let minCheckout = new Date(checkInDate);
            minCheckout.setDate(minCheckout.getDate() + 1);

            checkOutPicker.set('minDate', minCheckout);

            checkOutPicker.clear();
            $('#check_out').val('');

            $('#jumlah_kamar_dipesan').html(`
                                                                                                                                                                                                                                                                                                                                <option value="">
                                                                                                                                                                                                                                                                                                                                    -- Pilih Tanggal Check Out Dulu --
                                                                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                                                                            `);

            $('#kamar_tersedia_title').hide();
            $('#kamar_tersedia_list').hide();
            $('#list_nomor_kamar').html('');
        }
    });

    checkOutPicker.config.onChange.push(function (selectedDates) {

        if (!selectedDates.length) return;

        $('#check_out').val(
            checkOutPicker.formatDate(selectedDates[0], "Y-m-d")
        );

        $.ajax({
            type: 'POST',
            url: '/getKamarTersedia',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                check_in: $('#check_in').val(),
                check_out: $('#check_out').val()
            },

            success: function (response) {

                let totalKamar = response.length;

                let opsiJumlah =
                    '<option value="">-- Pilih Jumlah Kamar --</option>';

                for (let i = 1; i <= totalKamar; i++) {

                    opsiJumlah += `
                                                                                                                                                                                                                                                                                                                                        <option value="${i}">
                                                                                                                                                                                                                                                                                                                                            ${i} Kamar
                                                                                                                                                                                                                                                                                                                                        </option>
                                                                                                                                                                                                                                                                                                                                    `;

                }

                $('#jumlah_kamar_dipesan').html(opsiJumlah);

            }

        });

    });


    // ======================================================
    // RESET BOOKING
    // ======================================================
    function resetFormBooking() {

        checkInPicker.clear();
        checkOutPicker.clear();

        $("#check_in_pesan_kamar").val("");
        $("#check_out_pesan_kamar").val("");

        $("#check_in").val("");
        $("#check_out").val("");

        $("#jumlah_kamar_dipesan").html(`
                                                                                                                                                                                                                                                                                                                            <option value="">
                                                                                                                                                                                                                                                                                                                                -- Pilih Tanggal Check In Dulu --
                                                                                                                                                                                                                                                                                                                            </option>
                                                                                                                                                                                                                                                                                                                        `);

        $("#kamar_tersedia_title").hide();
        $("#kamar_tersedia_list").hide();
        $("#list_nomor_kamar").html("");

        $("#jumlah_extra_bed").val("");
        $("#jumlah_breakfast").val("");

        $("#biaya_container").hide();
        $("#biaya_input_container").hide();

        $("#biaya_request").val("");
        $("#biaya_request_value").val("");

        $("#status_pembayaran").val("");
        $("#metode_pembayaran").val("");
        $("#sumber_pembayaran").val("");
        $("#bukti_pembayaran").val("");

        $("#metode_pembayaran_container").hide();
        $("#metode_pembayaran_input").hide();

        $("#sumber_pembayaran_container").hide();
        $("#sumber_pembayaran_input").hide();

        $("#bukti_pembayaran_container").hide();
        $("#bukti_pembayaran_input").hide();

        $("#formBooking").hide();

    }

    // supaya bisa dipanggil dari luar
    window.resetFormBooking = resetFormBooking;

    resetFormBooking();

}


// ======================================================
// PILIH CUSTOMER
// ======================================================
$(document).off('click', '.pilihCustomer').on('click', '.pilihCustomer', function (e) {

    e.preventDefault();

    $("#id_customer_lama").val($(this).data('id'));

    $("#lama_nama_tamu").val($(this).data('nama'));
    $("#lama_alamat_tamu").text($(this).data('alamat'));
    $("#lama_no_wa").val($(this).data('wa'));

    if ($(this).data('foto')) {

        $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                            <img src="/storage/uploads/foto_ktp/${$(this).data('foto')}"
                                                                                                                                                                                                                                                                                                                                class="img-fluid rounded"
                                                                                                                                                                                                                                                                                                                                style="max-height:250px;">
                                                                                                                                                                                                                                                                                                                        `);

    } else {

        $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                            <div class="text-muted">
                                                                                                                                                                                                                                                                                                                                Tidak ada Foto KTP
                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                        `);

    }

    $("#keyword_customer").val($(this).data('nama'));

    $("#hasilCustomer").hide();

    $("#dataCustomerLama").show();

    $("#formBooking").show();

    $("#gantiCustomer").show();

    $("#keyword_customer").prop("readonly", true);

});


// ======================================================
// GANTI CUSTOMER
// ======================================================
$(document).off('click', '#gantiCustomer').on('click', '#gantiCustomer', function () {

    $("#keyword_customer").val("");
    $("#keyword_customer").prop("readonly", false);

    $("#id_customer_lama").val("");

    $("#lama_nama_tamu").val("");
    $("#lama_alamat_tamu").text("");
    $("#lama_no_wa").val("");

    $("#lama_foto_ktp").html(`
                                                                                                                                                                                                                                                                                                                        <div class="text-muted">
                                                                                                                                                                                                                                                                                                                            Tidak ada Foto KTP
                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                    `);

    $("#hasilCustomer").hide();
    $("#dataCustomerLama").hide();
    $("#gantiCustomer").hide();

    resetFormBooking();

    $("#keyword_customer").focus();

});


// ======================================================
// MODAL DITUTUP
// ======================================================
$('#modal-pesan-kamar').on('hidden.bs.modal', function () {

    $(this).find('form').trigger('reset');

    if (typeof resetFormBooking === "function") {
        resetFormBooking();
    }

    $("#hasilCustomer").hide();
    $("#dataCustomerLama").hide();

});





$('#ModalDataPengguna').on('show.bs.modal', function () {
    $('#nama_pengguna_modal').val(
        getNamaPengguna()
    );
});



$('#btnGantiPengguna').click(function () {
    localStorage.removeItem('nama_pengguna');
    location.reload();
});






/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
const btnLogout = document.getElementById('btnLogout');
if (btnLogout) {
    btnLogout.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Logout',
            text: 'Apakah Anda yakin ingin keluar dari sistem?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d32f2f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
}






document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("btnNotifikasi");

    btn.addEventListener("mouseenter", function () {

        const icon = this.querySelector("svg");

        icon.classList.add("bell-shake");

    });

    btn.addEventListener("animationend", function () {

        const icon = this.querySelector("svg");

        icon.classList.remove("bell-shake");

    });

});