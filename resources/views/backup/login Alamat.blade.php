<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Login | Nirwana Hotel Kalianda
    </title>

    <!-- Tabler CSS -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Logo -->

            <div class="logo">

                <img src="{{ asset('assets/img/nirwana_hotel.png') }}" alt="Logo Nirwana Hotel">

            </div>

            <!-- Judul -->

            <h2 class="login-title">

                NIRWANA HOTEL

            </h2>

            <p class="login-subtitle">

                Sistem Manajemen Hotel Kalianda

            </p>

            <!-- Alert Error -->

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    <strong>

                        Login Gagal

                    </strong>

                    <br>

                    {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            <!-- Form Login -->

            <form id="loginForm" method="POST" action="{{ url('/login') }}">

                @csrf

                <!-- Username -->

                <div class="mb-3">

                    <label class="form-label">

                        Username

                    </label>

                    <div class="input-icon">

                        <i class="bi bi-person"></i>

                        <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                            placeholder="Masukkan Username" required autofocus>

                    </div>

                </div>

                <!-- Password -->

                <div class="mb-4">

                    <label class="form-label">

                        Password

                    </label>

                    <div class="input-icon">

                        <i class="bi bi-lock"></i>

                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Masukkan Password" required>

                        <span id="togglePassword" class="password-toggle">

                            <i id="eyeIcon" class="bi bi-eye">
                            </i>

                        </span>

                    </div>

                </div>

                <!-- Button -->

                <button id="btnLogin" type="submit" class="btn btn-primary w-100 btn-lg">

                    <span id="btnText">

                        Masuk

                    </span>

                </button>

            </form>

            <!-- Footer -->

            <div class="login-footer">

                <p>

                    © {{ date('Y') }} Nirwana Hotel Kalianda

                </p>

                <div class="version">

                    Version 1.0

                </div>

            </div>

        </div>

    </div>
    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>