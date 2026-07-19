<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->


<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=980">
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Home Page - Hotel Nirwana</title>
  <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
  <meta name="msapplication-TileColor" content="" />
  <meta name="theme-color" content="" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="mobile-web-app-capable" content="yes" />
  <meta name="HandheldFriendly" content="True" />
  <meta name="MobileOptimized" content="320" />
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
  <meta name="description"
    content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
  <meta name="canonical" content="https://preview.tabler.io/layout-vertical.html">
  <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
  <meta name="twitter:site" content="@tabler_ui">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title"
    content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
  <meta name="twitter:description"
    content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
  <meta property="og:image" content="https://preview.tabler.io/static/og.png">
  <meta property="og:image:width" content="1280">
  <meta property="og:image:height" content="640">
  <meta property="og:site_name" content="Tabler">
  <meta property="og:type" content="object">
  <meta property="og:title"
    content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
  <meta property="og:url" content="https://preview.tabler.io/static/og.png">
  <meta property="og:description"
    content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- CSS files -->
  <link href="{{ asset('tabler/dist/css/tabler.min.css?1685973381') }}" rel="stylesheet" />
  <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1685973381') }}" rel="stylesheet" />
  <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1685973381') }}" rel="stylesheet" />
  <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1685973381') }}" rel="stylesheet" />
  <link href="{{ asset('tabler/dist/css/demo.min.css?1685973381') }}" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" />

  <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
  <script src="{{ asset('assets/js/main.js') }}" defer></script>
  <script src="{{ asset('assets/js/sweetalert.js') }}" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }

    .colored-toast.swal2-icon-success {
      background-color: #a5dc86 !important;
    }

    .colored-toast.swal2-icon-success {
      background-color: #a5dc86 !important;
    }

    .colored-toast.swal2-icon-error {
      background-color: #f27474 !important;
    }

    .colored-toast.swal2-icon-warning {
      background-color: #f8bb86 !important;
    }

    .colored-toast.swal2-icon-info {
      background-color: #3fc3ee !important;
    }

    .colored-toast.swal2-icon-question {
      background-color: #87adbd !important;
    }

    .colored-toast .swal2-title {
      color: white;
    }

    .colored-toast .swal2-close {
      color: white;
    }

    .colored-toast .swal2-html-container {
      color: white;
    }
  </style>
  @stack('mycss')
</head>

<body>
  <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1685973381') }}"></script>
  <div class="page">
    <div class="page-wrapper">
      @yield('content')
    </div>
  </div>
  <!-- Libs JS -->
  <script src="{{ asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1685973381') }}" defer></script>
  <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1685973381') }}" defer></script>
  <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1685973381') }}" defer></script>
  <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1685973381') }}" defer></script>
  <!-- Tabler Core -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('tabler/dist/js/tabler.min.js?1685973381') }}" defer></script>
  <script src="{{ asset('tabler/dist/js/demo.min.js?1685973381') }}" defer></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  @stack('myscript')

  <!-- Modal Identitas Pengguna -->
  <div class="modal fade" id="modalIdentitasPengguna" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" style="font-size:16pt;">
            Identitas Pengguna
          </h5>
        </div>
        <div class="modal-body">
          <label class="form-label" style="font-size:16pt;">
            Nama Pengguna
          </label>
          <input type="text" class="form-control" id="nama_pengguna" style="font-size:16pt;"
            placeholder="Contoh : Resepsionis 1">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary w-100" id="btnSimpanPengguna" style="font-size:16pt;">
            Simpan
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      let namaPengguna = localStorage.getItem('nama_pengguna');
      if (!namaPengguna) {
        $('#modalIdentitasPengguna').modal('show');
      }
    });

    $('#btnSimpanPengguna').click(function () {
      let nama = $('#nama_pengguna').val().trim();
      if (nama == '') {
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Nama Pengguna wajib diisi.'
        });
        return;
      }

      localStorage.setItem(
        'nama_pengguna',
        nama
      );

      $('#modalIdentitasPengguna').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Identitas berhasil disimpan.',
        timer: 1200,
        showConfirmButton: false
      });
    });

    function getNamaPengguna() {
      return localStorage.getItem('nama_pengguna');
    }

    function buatFormData(form) {

      let formData = new FormData(form);

      formData.append(
        'dibuat_oleh',
        getNamaPengguna()
      );

      return formData;

    }
  </script>
</body>

</html>