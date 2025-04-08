<?php 
	session_start();

	$host 	  = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'spk_bimbel_topsis';

	$koneksi = mysqli_connect($host, $username, $password, $database);


	if ($koneksi) {
		// echo "koneksi berhasil";
	}

	if (isset($_SESSION['id_user'])) {
		$id_user = $_SESSION['id_user'];
		$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
	}
 ?>