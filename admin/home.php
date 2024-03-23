<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
  echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
  </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title> Website Galeri Foto </title>
   <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
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

<div class="container mt-3">
  Album :
  <?php
  $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
  while($row = mysqli_fetch_array($album)){ ?>
  <a href="home.php?albumid=<?php echo $row['albumid']?>" class="btn btn-outline-primary"><?php echo $row['namaalbum']?></a>

  <?php } ?>

	<div class="row">
    <?php
    if (isset($_GET['albumid'])) { 
      $albumid = $_GET['albumid'];
      $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid ='$userid' AND albumid='$albumid'");
      while($data = mysqli_fetch_array($query)){ ?>
      <div class="col-md-3 mt-2">
			<div class="card">
            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="img-fluid w-102 rounded" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
			<div class="card-footer text-center">
				
      <?php
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    $cekbatalsuka = mysqli_query($koneksi, "SELECT * FROM unlikefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-thumbs-up m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-thumbs-up m-1"></i></a>

                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' ';
                    ?>
                    <?php
                    if (mysqli_num_rows($cekbatalsuka) == 1) { ?>
                      <a href="../config/proses_unlike.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-thumbs-down m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_unlike.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-thumbs-down m-1"></i></a>

                    <?php }
                    $unlike = mysqli_query($koneksi, "SELECT * FROM unlikefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($unlike). ' ';
                    ?><br>
				<a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i> </a>
        <?php  
        $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).' Komentar';
        ?>
				</div>
			</div>
		</div>
    <?php } }else{
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
while($data = mysqli_fetch_array($query)){
?>
<div class="col-md-3 mt-2">
			<div class="card">
            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
			<div class="card-footer text-center">
				
      <?php
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    $cekbatalsuka = mysqli_query($koneksi, "SELECT * FROM unlikefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-thumbs-up m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-thumbs-up m-1"></i></a>

                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' ';
                    ?>
                    <?php
                    if (mysqli_num_rows($cekbatalsuka) == 1) { ?>
                      <a href="../config/proses_unlike.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-thumbs-down m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_unlike.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-thumbs-down m-1"></i></a>

                    <?php }
                    $unlike = mysqli_query($koneksi, "SELECT * FROM unlikefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($unlike). ' ';
                    ?><br>
				<a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
</svg>
         </a>
        <?php  
        $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).' Komentar';
        ?>
				</div>
			</div>
		</div>
<?php } } ?>
</div>
 </div>
 <footer class="d-flex justify-content-center border-top mt-3 bg-dark text-white fixed-bottom">
<p>&copy; Galery Foto BY: Muhammad Fadhil  </p>
</footer>

<script type="text/javascript" src="../assets/js/boostrap.min.js"></script>
</body>
</html> 