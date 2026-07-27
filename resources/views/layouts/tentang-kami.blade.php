<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=980">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
  <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet">
</head>

<body>
  <div class="page">
    <div class="page-wrapper">
      @yield('content')
    </div>
  </div>
  <!-- Tabler Core -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  @stack('myscript')
  <script src="{{ asset('tabler/dist/js/tabler.min.js') }}"></script>
</body>

</html>