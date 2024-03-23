<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password' ");

$cek = mysqli_num_rows($sql);
/*Aksi Login */
if ($cek > 0){
    $data = mysqli_fetch_array($sql);

    $_SESSION['username'] = $data['username'];
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['status'] = 'login';
    echo "<script>
    alert('Anda Telah Berhasil Login');
    location.href='../admin/index.php';
    
    </script>";
}else{
    echo "<script>
    alert('Username Atau Kata Sandi Anda Salaha!');
    location.href='../login.php';
    
    </script>";
}

?>