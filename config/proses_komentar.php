<?php  
session_start();
include 'koneksi.php';

$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isikomentar','$tanggalkomentar')");

echo "<script>
alert('Komentar anda sudah di tambahkan!');
location.href='../admin/index.php';
</script>";

?>