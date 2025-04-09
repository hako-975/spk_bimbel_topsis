<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_hasil = $_GET['id_hasil'];

    $data_hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hasil_topsis INNER JOIN orangtua ON hasil_topsis.id_orangtua = orangtua.id_orangtua WHERE hasil_topsis.id_hasil = '$id_hasil'"));
    $nama_orangtua = $data_hasil['nama_orangtua'];

	$delete_hasil = mysqli_query($conn, "DELETE FROM hasil_topsis WHERE id_hasil = '$id_hasil'");

	if ($delete_hasil) {
		$delete_hasil_penilaian = mysqli_query($conn, "DELETE FROM penilaian WHERE id_hasil = '$id_hasil'");
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Hasil Bimbel $nama_orangtua berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Hasil Bimbel " . $nama_orangtua . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'spk.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Hasil Bimbel $nama_orangtua gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Hasil Bimbel " . $nama_orangtua . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'spk.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
