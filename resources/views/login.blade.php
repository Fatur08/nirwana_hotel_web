<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Nirwana Hotel Kalianda</title>

    {{-- Tabler CSS --}}
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet">

</head>

<body class="d-flex flex-column bg-light">

    <div class="page page-center">

        <div class="container container-tight py-4">

            <div class="text-center mb-4">

                {{-- Logo Hotel --}}
                <img src="{{ asset('assets/img/nirwana_hotel.png') }}" width="100" alt="Logo Hotel">

            </div>

            <div class="card card-md shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">

                        NIRWANA HOTEL KALIANDA

                    </h2>

                    @if(session('error'))

                        <div class="alert alert-danger">

                            {{ session('error') }}

                        </div>

                    @endif

                    <form method="POST" action="{{ url('/login') }}">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Username

                            </label>

                            <input type="text" name="username" class="form-control" required autofocus>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input type="password" name="password" class="form-control" required>

                        </div>

                        <div class="form-footer">

                            <button type="submit" class="btn btn-primary w-100">

                                Masuk

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>