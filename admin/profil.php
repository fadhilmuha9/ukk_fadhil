<?php
    session_start();
	include '../config/koneksi.php';
	if($_SESSION['status'] != true){
		echo '<script>window.location="login.php"</script>';
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
</head>

<body>
    <!-- header -->
   <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">

  <div class="container">
    <a class="navbar-brand" href="index.php"> Website Galeri Foto </a>
    <a href="home.php" style="color: #ffffff;" class="nav-link">Home</a>
    <a href="album.php" style="color: #ffffff;" class="nav-link">Album</a>
    <a href="foto.php" style="color: #ffffff;" class="nav-link"> Foto </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>

    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
    <div class="navbar-nav me-auto">
         <a href="profil.php" class="nav-link"> Profil </a>
    </div>
    
    <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
    </svg> Keluar </a>
    </div>
  </div>
</nav>
    	

    	<!-- content -->
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bg-light">
                	<div class="text-center">
                        <h3>Profil</h3></div>
            <div class="card-body">
               <form action="" method="POST">
               	<div class="form-group">
               	<label><b>Nama Lengkap</b></label>
                   <input type="text" name="namalengkap" placeholder="Nama Lengkap" class="form-control" value="<?php echo $d->namalengkap ?>" required>
                </div>
                <div class="form-group">
                   <label><b>Username</b></label>
                   <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $d->username ?>" required>
                </div>
                <div class="form-group">
                   <label><b>Email</b></label>
                   <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $d->email ?>" required>
                </div>
                <div class="form-group">
                   <label><b>Alamat</b></label>
                   <input type="text" name="alamat" placeholder="alamat" class="form-control" value="<?php echo $d->alamat ?>" required>
                </div>
                
                   <input type="submit" name="submit" value="Ubah Profil" class="btn btn-primary mt-3">
                   <button href="profil.php" class="btn btn-danger mt-3">Reset</button>
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama   = $_POST['namalengkap'];
					   $user   = $_POST['username'];
					   $email  = $_POST['email'];
					   $alamat = $_POST['alamat'];
					   
					   $update = mysqli_query($koneksi, "UPDATE user SET 
					                 namalengkap = '".$nama."',
									  username = '".$user."',
									  email = '".$email."',
									  alamat = '".$alamat."'
									  WHERE userid = '".$d->userid."'");
					   if($update){
						   echo '<script>alert("Data Anda Telah Berhasil Di Ubah!")</script>';
						   echo '<script>window.location="profil.php"</script>';
					   }else{
						   echo 'gagal '.mysqli_error($koneksi);
					   }
					   
					}  
			   ?>
            </div>

<div>
	<p><a href="password.php">Ganti Kata Sandi</a></p>
</div>




    <!-- footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        
        	<p>&copy; Galery Foto BY: Muhammad Fadhil </p>
        
    </footer>
</body>
</html>