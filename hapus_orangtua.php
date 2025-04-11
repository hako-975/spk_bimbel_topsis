<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_orangtua = $_GET['id_orangtua'];

    $data_orangtua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE id_orangtua = '$id_orangtua'"));
    $nama_orangtua = $data_orangtua['nama'];

    $foto = $data_orangtua['foto'];
    $image_path = 'assets/img/profiles/' . $foto;
	
	$delete_orangtua = mysqli_query($conn, "DELETE FROM orangtua WHERE id_orangtua = '$id_orangtua'");

	if ($delete_orangtua) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orang Tua $nama_orangtua berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		if ($foto != 'default.jpg' && $foto != '') {
		    if (file_exists($image_path)) {
		        unlink($image_path);
		    }
		}

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Orang Tua " . $nama_orangtua . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'orangtua.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orang Tua $nama_orangtua gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Orang Tua " . $nama_orangtua . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'orangtua.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
