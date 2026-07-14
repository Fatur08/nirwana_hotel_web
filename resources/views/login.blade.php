<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nirwana Hotel Kalianda</title>
    {{-- Tabler CSS --}}
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)),
                url("{{ asset('assets/img/hotel_background.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }


        .login-card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
            animation: fadeInUp .8s ease;
            animation-delay: .2s;
            animation-fill-mode: both;
        }



        .logo-login {
            animation: zoomLogo 1s ease;
        }





        .form-control {
            height: 48px;
            border-radius: 12px;
            border: 1px solid #dce1e7;
            transition: all .3s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .20);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 18px;
        }

        .input-icon .form-control {
            padding-left: 45px;
            padding-right: 45px;
        }


        .btn-login {
            height: 48px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            transition: .3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, .35);
        }





        .login-footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .login-footer p {
            margin-bottom: 3px;
            color: #6c757d;
            font-size: 14px;
        }

        .version {
            font-size: 13px;
            color: #9ca3af;
        }






        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            font-size: 18px;
            transition: .2s;
        }

        .password-toggle:hover {
            color: #2563eb;
        }







        .alert {
            border-radius: 12px;
            animation: fadeAlert .5s ease;
        }





        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }





        @keyframes zoomLogo {
            from {
                opacity: 0;
                transform: scale(.85);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }




        @keyframes fadeAlert {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="d-flex flex-column bg-light">
    <div class="page page-center">
        <div class="container container-tight py-5" style="max-width:470px;">
            <div class="text-center mb-4">
                {{-- Logo Hotel --}}
                <img src="{{ asset('assets/img/nirwana_hotel.png') }}" width="140" class="mb-3 logo-login"
                    alt="Logo Hotel">
            </div>

            <div class="card card-md login-card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1">
                            NIRWANA HOTEL
                        </h2>
                        <p class="text-secondary mb-0">
                            Sistem Manajemen Hotel Kalianda
                        </p>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 9v4" />
                                        <path d="M12 16h.01" />
                                        <path
                                            d="M5.07 19h13.86a2 2 0 0 0 1.74-3l-6.93-12a2 2 0 0 0-3.48 0l-6.93 12a2 2 0 0 0 1.74 3z" />
                                    </svg>
                                </div>

                                <div>
                                    <strong>Login Gagal</strong>
                                    <br>
                                    {{ session('error') }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close">
                            </a>
                        </div>
                    @endif
                    <form id="loginForm" method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Username
                            </label>

                            <div class="input-icon">
                                <i class="ti ti-user"></i>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan Username"
                                    value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-icon">
                                <i class="ti ti-lock"></i>
                                <input id="password" type="password" name="password" class="form-control"
                                    placeholder="Masukkan Password" required>
                                <i id="togglePassword" class="ti ti-eye password-toggle"></i>
                            </div>
                        </div>

                        <button id="btnLogin" type="submit" class="btn btn-login w-100">
                            <span id="btnText">
                                Masuk
                            </span>
                        </button>
                    </form>
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
        </div>
    </div>



    <script>
        const password = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        togglePassword.addEventListener("click", function () {
            if (password.type === "password") {
                password.type = "text";
                this.classList.remove("ti-eye");
                this.classList.add("ti-eye-off");
            } else {
                password.type = "password";
                this.classList.remove("ti-eye-off");
                this.classList.add("ti-eye");
            }
        });



        /*
        |--------------------------------------------------------------------------
        | Loading Button Login
        |--------------------------------------------------------------------------
        */
        const loginForm = document.getElementById("loginForm");
        const btnLogin = document.getElementById("btnLogin");
        const btnText = document.getElementById("btnText");
        loginForm.addEventListener("submit", function () {
            btnLogin.disabled = true;
            btnText.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2"></span>
        Sedang Masuk...
    `;
        });





        /*
        |--------------------------------------------------------------------------
        | Auto Close Alert
        |--------------------------------------------------------------------------
        */
        const alertBox = document.querySelector(".alert");
        if (alertBox) {
            setTimeout(function () {
                alertBox.classList.remove("show");
                alertBox.classList.add("fade");
                setTimeout(function () {
                    alertBox.remove();
                }, 300);
            }, 4000);
        }
    </script>
    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}"></script>
</body>

</html>