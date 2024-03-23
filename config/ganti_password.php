<?php

//Koneksi Database
include "koneksi.php";

//enkripsi inputan password lama
$password_lama = md5($_POST['pass_lama']);

//panggil username
$username = $_POST['username'];

//uji jika password lama sesuai
$tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE 
													username = '$username' and password = 
													'$password_lama'");
$data = mysqli_fetch_array($tampil);
//jika data ditemukan,maka password sesuai
if($data){
	//uji jika password baru dan konfirmasi password sama
	$password_baru = $_POST['pass_baru'];
	$konfirmasi_password = $_POST['konfirmasi_pass'];

	if($password_baru == $konfirmasi_password){
		//proses ganti password
		//enkripsi password baru
		$pass_ok =md5($konfirmasi_password);
		$ubah = mysqli_query($koneksi, "UPDATE user set password = '$pass_ok'	
										WHERE userid = '$data[userid]'");
		if($ubah){
			echo "<script>
    		alert('Password anda berhasil diubah, Silahkan login ulang untuk menguji password baru anda');
    		document.location.href='../index.php'; </script>";
		}
	} else {
		echo "<script>alert('maaf, password baru & konfirmasi password yang anda masukkan tidak sama');
    	document.location.href='../admin/profil.php'; </script>";
	}
} else {
	echo "<script>alert('Maaf, Password lama anda tidak sesuai!');
    document.location.href='../admin/profil.php'; </script>";
}

