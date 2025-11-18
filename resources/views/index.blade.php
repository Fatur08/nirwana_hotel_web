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
      color: black;
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
    .kotak-spr {
      background-color: #25a6fbff;
      color: white;
      padding: 12px;
      border-radius: 10px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .kotak-std {
      background-color: #f7fc57ff;
      color: black;
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
        <h3>Aplikasi Manajemen<br>Hotel Nirwana</h3>
    </div>
    <img src="{{ asset('assets/img/nirwana_hotel.png') }}" 
         alt="Logo Hotel Nirwana" 
         style="width:290px; height:220px; margin-bottom: 15px;">
      
      
    <div class="kotak-dlx">
        <h3>Kamar Deluxe</h3>
        <div class="role-grid">
          <!-- Owner -->
          <div class="role-card">
            <h5><strong>DLX1</strong></h5>
            <a href="#" class="modalDLX btn btn-primary" nomor_kamar="1">
              Informasi Kamar
            </a>
          </div>
        </div>
    </div>

    <div class="kotak-spr">
        Kamar Superior
    </div>

    <div class="kotak-std">
        Kamar Standar
    </div>
  </div>


  <!-- Modal Kamar Deluxe (DLX) -->
  <div class="modal fade" id="modal-DLX" tabindex="-1" aria-labelledby="modalDLXLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalDLXLabel">Informasi Kamar - Tipe Deluxe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="loadmodalDLX">
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(function(){
      $(".modalDLX").click(function(){
        var nomor_kamar = $(this).attr('nomor_kamar');
        $.ajax({
          type:'POST',
          url:'/murid/edit',
          cache:false,
          data:{
            _token : "{{ csrf_token() }}",
            nomor_kamar : nomor_kamar
          },
          success:function(respond){
            $("#loadmodalDLX").html(respond);
          }
        });
        $("#modal-DLX").modal("show");
      });
    });
  </script>
</body>
</html>