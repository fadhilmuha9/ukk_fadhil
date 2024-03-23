<?php
    session_start();
  include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
  echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php'; 
  </script>";
}
  
  $query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid ='".$_SESSION['userid']."'");
  $d = mysqli_fetch_object($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
 <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
 <style>
     body{
        background: url('assets/img/bg.jpg');
     }
 </style>
</head>

<body>
    <!-- header -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="../admin/index.php"> Website Galeri Foto </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
    <div class="navbar-nav me-auto">
      <a href="../admin/home.php" class="nav-link">Home</a>
        <a href="../admin/album.php" class="nav-link"> Album </a>
         <a href="../admin/foto.php" class="nav-link"> Foto </a>
         <a href="../admin/profil.php" class="nav-link"> Profil </a>
    </div>
    
    <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg> Keluar </a>

    </div>
  </div>
</nav>



<!-- UBAH PASSWORD -->


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body bg-light">
                  
            <div class="text-center">
            <h3>Ubah Kata Sandi</h3> </div>
            <label class="small">*Kata sandi anda harus paling tidak 6 karakter dan harus menyertakan kombinasi angka, huruf, dan karakter khusus (!$@%)</label>
            <div class="card-body">
               <form action="../config/ganti_password.php" method="POST">
               	<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
               		<div class="form-group">
               			<label><b>*Masukkan Kata Sandi Lama</b></label>
               			<input type="password" class="form-control" name="pass_lama" required>	
               		</div>
               		<div class="form-group">
               			<label><b>*Masukkan Kata Sandi Baru</b></label>
               			<input type="password" class="form-control" name="pass_baru" required>	
               		</div>
               		<div class="form-group">
               			<label><b>*Konfirmasi Kata Sandi Anda</b></label>
               			<input type="password" class="form-control" name="konfirmasi_pass" required>	
               		</div>
                  <div class="text-center">
               		<button type="submit" class="btn btn-primary mt-3">Proses</button>
               		<button type="reset" class="btn btn-danger mt-3">Reset</button>
                  </div>
               </form>
         
            </div>
        </div>
        </div>
    </div>
    </div>

    
    <!-- footer -->
    <footer class="d-flex justify-content-center border-top bg-light fixed-bottom">
        
            <p>&copy; Galery Foto BY: Muhammad Fadhil </p>
        
    </footer>
</body>
</html>