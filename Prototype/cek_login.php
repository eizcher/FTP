<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
date_default_timezone_set('Asia/Jakarta');
$waktu = date('m/d/Y h:i:s a', time());

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from tb_user where username='$username' and password='$password'");

// Menyimpan data nama user kedalam session
$nama_akun = mysqli_query($koneksi,"select nama_akun from tb_user where username='$username' and password='$password'");
$nama_ = mysqli_fetch_assoc($nama_akun);
$nama = $nama_["nama_akun"];

// Menyimpan data cabang kedalam session
$nama_cabang = mysqli_query($koneksi,"select cabang from tb_user where username='$username' and password='$password'");
$nama_cbg = mysqli_fetch_assoc($nama_cabang);
$nama_c = $nama_cbg["nama_cabang"];

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
  
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);

	// write log login
	$sqllog = mysqli_query($koneksi, "INSERT INTO tb_log_login(username,waktu) VALUES('$username','$waktu')");

	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $nama;
		$_SESSION['level'] = "admin";
		$_SESSION['cabang'] = $nama_c;
		// alihkan ke halaman dashboard admin
		header("location:admin_dashboard.php");
 
	// cek jika user login sebagai user
	}else if($data['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $nama;
		$_SESSION['level'] = "USER";
		$_SESSION['cabang'] = $nama_c;
		// alihkan ke halaman dashboard user
		header("location:user_dashboard.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>