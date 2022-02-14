<?php

include "koneksi.php";
//this is function to show Rp.
function rupiah($angka){
    $hasil_rupiah = "Rp." . number_format($angka,0,',','.');
    return $hasil_rupiah;    
}
//check payment status, if payment already made and complete, token will not be generate
$query_lun = "SELECT status_pembayaran FROM transaksi";
$sql_lun = mysqli_query($conn, $query_lun);
while ($data_lun = mysqli_fetch_array($sql_lun)){
$status_pembayaran = $data_lun['status_pembayaran'];
}
if($status_pembayaran == 'lunas'){
  $snapToken = 'snapToken Empty Because payment already done';
}
else{

require_once('vendor/autoload.php');
//if payment not complete yet we generate the snapToken

  Veritrans_Config::$serverKey = ""; //your mid server

  //change to true if accpet real transaction
  Veritrans_Config::$isProduction = false;

  Veritrans_Config::$isSanitized = true;

  Veritrans_Config::$is3ds = true;
  $order_id = rand();//random order id, you can take it from database
  $transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => 0, 
  );
  //you can take it from database
  $product_id = 'B-01';
  $total_bayar = '750000';
  $item1_details = array(
    'id' => $product_id,
    'price' => $total_bayar,
    'quantity' => 1,
    'name' => "Sepatu Keren Mantap Anti Terjatuh Dari Patah Hati"
  );

  $item_details = array ($item1_details);

  $billing_address = array(
    'first_name'    => "",
    'last_name'     => "",
    'address'       => "",
    'city'          => "",
    'postal_code'   => "",
    'phone'         => "",
    'country_code'  => 'IDN'
  );

  $shipping_address = array(
    'first_name'    => "",
    'last_name'     => "",
    'address'       => "",
    'city'          => "",
    'postal_code'   => "",
    'phone'         => "",
    'country_code'  => 'IDN'
  );

  $customer_details = array(
    'first_name'    => "Alex",
    'last_name'     => "Joni",
    'email'         => "alexjoni@bohongmail.com",
    'phone'         => "081234567890",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
  );

  $enable_payments = array(
  "credit_card",
  "gopay",
  "shopeepay",
  "permata_va",
  "bca_va",
  "bni_va",
  "bri_va",
  "echannel",
  "other_va",
  "danamon_online",
  "mandiri_clickpay",
  "cimb_clicks",
  "bca_klikbca",
  "bca_klikpay",
  "bri_epay",
  "xl_tunai",
  "indosat_dompetku",
  "kioson",
  "Indomaret",
  "alfamart",
  "akulaku");

  $transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
  );

  $snapToken = Veritrans_Snap::getSnapToken($transaction);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sepatu Keren</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel='stylesheet' type='text/css' href='dist/sweet/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'>
  <script type='text/javascript' src='dist/sweet/sweetalert2/sweetalert2.min.js'></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        
      </li>
      
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cog"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <span class="dropdown-item dropdown-header">Pengaturan</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <span class="text-muted text-sm" style="text-align: center;">LOGOUT</span>
          </a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
        </div>
        <div class="info">
          <a href="#" class="d-block">Halo</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="produk.php" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
            </ul>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Sepatu Keren Mantap Anti Terjatuh Dari Patah Hati</h3>
              <div class="col-12">
                <img src="dist/img/prod-1.jpg" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="dist/img/prod-1.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="dist/img/prod-2.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="dist/img/prod-3.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="dist/img/prod-4.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="dist/img/prod-5.jpg" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Sepatu Keren Mantap Anti Terjatuh Dari Patah Hati</h3>
              <p>Sepatu mantap, pokoknya beli aja, bukan scam kok, hehehehe</p>
              <p style="color:red;">SnapToken = <?= $snapToken; ?></p>
              <hr>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  <?php echo rupiah($total_bayar);?>
                </h2>
              </div>
              <input type="hidden" id="order_id" value="<?= $order_id; ?>"><!--Hiding ID so we can take it when using ajax-->
              <div class="mt-4">
              <?php
              // just validation for payment status, status will update using handle_transaction which is accessed by midtrans system, you can set up it at midtrans dashboard
              if($status_pembayaran === 'not_pay'){
              ?>
                  <div class="btn btn-primary btn-lg btn-flat" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Beli Dong
                </div>
              <?php
              }elseif($status_pembayaran === 'menunggu'){
              ?>
                  <div class="btn btn-primary btn-lg btn-flat disabled" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Menunggu Pembayaran
                  </div>
              <?php
              }elseif($status_pembayaran === 'lunas'){?>
                  <div class="btn btn-primary btn-lg btn-flat disabled" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Pembayaran Selesai
                  </div>
              <?php
              } elseif($status_pembayaran === 'deny'){?>
                  <p id="text_red" style="color:red;">Pembayaran Ditolak</p>
                  <div class="btn btn-primary btn-lg btn-flat disabled" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Bayar Ulang
                  </div>
              <?php
              }elseif($status_pembayaran === 'expired'){?>
                   <p id="text_red" style="color:red;">Pembayaran Sudah Tidak Berlaku</p>
                   <div class="btn btn-primary btn-lg btn-flat disabled" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Bayar Ulang
                  </div>
              <?php }elseif($status_pembayaran === 'cancel'){?>
                    <p id="text_red" style="color:red;">Pembayaran Dibatalkan</p>
                    <div class="btn btn-primary btn-lg btn-flat disabled" id="pay-button">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Bayar Ulang
                  </div>
              <?php }else{?>
                <div class="btn btn-primary btn-lg btn-flat disabled">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  System Error
                  </div>
              <?php } ?>
                <div class="btn btn-primary btn-lg btn-flat disabled" onClick="window.location.reload();" <?php if($status_pembayaran == 'menunggu'){}else{echo "style='display: none;'";}?>>
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Cek Status Pembayaran
                  </div>
              </div>

              

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Midtrans Script, data client key using your client key-->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        var order_id = $("#order_id").val();
        $.ajax({
            type: "POST", 
            url: "update_order.php",
            data:  "order_id="+order_id,
            dataType: "JSON",
            success: function(data){
              snap.pay('<?=$snapToken?>', {
                // Optional
                onSuccess: function(result){
                  Swal.fire({
                    title: 'Pembayaran Berhasil',
                    text: "Sepatu Dikirim Gan",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.reload();
                    }
                  })
                  
                },
                // Optional
                onPending: function(result){
                  Swal.fire(
                    'Pembayaran Sedang Di Proses',
                    'Refresh halaman jika status belum berubah',
                    'success'
                  )
                  
                    document.getElementById("pay-button").disabled = true;
                    document.querySelector('#pay-button').innerText = 'Menunggu Pembayaran';
                    document.getElementById("status").style.display = "block";
                    document.getElementById("text_red").style.display = "none";
                  
                },
                // Optional
                onError: function(result){
                  Swal.fire(
                    'Terjadi Error',
                    'Harap Tunggu Beberapa Saat Lagi',
                    'warning'
                  )
                }
              });
            },
            error: function(data){
              Swal.fire(
              'Terjadi Error',
              'Harap Tunggu Beberapa Saat Lagi',
              'warning'
            )}           
        });
        
      };

      
    </script>
</body>
</html>
