<?php 
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'tiket_masuk';

	$conn = mysqli_connect($host, $user, $pass, $database);

	// if ($conn) {
	// 	echo "berhasil terkoneksi";
	// }

    if (isset($_SESSION['id_user'])) {
    	$id_user = $_SESSION['id_user'];
		$dataUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user"));
	}
?>
