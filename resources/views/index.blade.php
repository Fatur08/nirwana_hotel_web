<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Hotel Nirwana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom, #eaf3ff, #ffffff);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }

        .login-container {
            text-align: center;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 15px;
            max-width: 500px;
            width: 90%;
        }

        .login-title {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .role-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .role-card img {
            width: 80%;
            height: 93px;
            object-fit: contain;
        }

        .role-card button {
            width: 80%;
            border-radius: 10px;
        }



        .kotak-dlx {
            background-color: #ff3838ff;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-title">
            Aplikasi Manajemen<br>Hotel Nirwana
        </div>

        <img src="{{ asset('assets/img/nirwana_hotel.png') }}" 
             alt="Logo Hotel Nirwana" 
             style="width:290px; height:220px; margin-bottom: 15px;">
        
        
        <div class="kotak-dlx">
            Kamar Deluxe
        </div>

        <div class="role-grid">

            <!-- Owner -->
            <div class="role-card">
                <img src="{{ asset('assets/img/owner/login/loginowner.png') }}" alt="Login Owner">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOwner">
                    Informasi Kamar
                </button>
            </div>

            <!-- Admin -->
            <div class="role-card">
                <img src="{{ asset('assets/img/owner/login/loginadmin.png') }}" alt="Login Admin">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdmin">
                    Informasi Kamar
                </button>
            </div>

            <!-- Kepala Dapur -->
            <div class="role-card">
                <img src="{{ asset('assets/img/login/login_chef.png') }}" alt="Login Kepala Dapur">
                <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalKepalaDapur">
                    Informasi Kamar
                </button>
            </div>

            <!-- Distributor -->
            <div class="role-card">
                <img src="{{ asset('assets/img/login/login_distributor.png') }}" alt="Login Distributor">
                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalDistributor">
                    Informasi Kamar
                </button>
            </div>

        </div>
    </div>

    <!-- Modal Owner -->
    <div class="modal fade" id="modalOwner" tabindex="-1" aria-labelledby="modalOwnerLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalOwnerLabel">Informasi Kamar - Tipe Owner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Tipe Kamar:</strong> Deluxe Room</p>
            <p><strong>Fasilitas:</strong> AC, TV, WiFi, Kamar Mandi Dalam, Sarapan Gratis</p>
            <p><strong>Harga:</strong> Rp 500.000 / malam</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Admin -->
    <div class="modal fade" id="modalAdmin" tabindex="-1" aria-labelledby="modalAdminLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalAdminLabel">Informasi Kamar - Tipe Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Tipe Kamar:</strong> Superior Room</p>
            <p><strong>Fasilitas:</strong> AC, TV, WiFi</p>
            <p><strong>Harga:</strong> Rp 350.000 / malam</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Kepala Dapur -->
    <div class="modal fade" id="modalKepalaDapur" tabindex="-1" aria-labelledby="modalKepalaDapurLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-warning text-white">
            <h5 class="modal-title" id="modalKepalaDapurLabel">Informasi Kamar - Tipe Chef</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Tipe Kamar:</strong> Standard Room</p>
            <p><strong>Fasilitas:</strong> Kipas Angin, TV</p>
            <p><strong>Harga:</strong> Rp 250.000 / malam</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Distributor -->
    <div class="modal fade" id="modalDistributor" tabindex="-1" aria-labelledby="modalDistributorLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="modalDistributorLabel">Informasi Kamar - Tipe Distributor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Tipe Kamar:</strong> Family Room</p>
            <p><strong>Fasilitas:</strong> 2 Tempat Tidur, AC, TV, Kulkas Mini</p>
            <p><strong>Harga:</strong> Rp 600.000 / malam</p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>