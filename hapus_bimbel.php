<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_bimbel = $_GET['id_bimbel'];

    $data_bimbel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bimbel WHERE id_bimbel = '$id_bimbel'"));
    $nama_bimbel = $data_bimbel['nama_bimbel'];

	$delete_bimbel = mysqli_query($conn, "DELETE FROM bimbel WHERE id_bimbel = '$id_bimbel'");

	if ($delete_bimbel) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Bimbel $nama_bimbel berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Bimbel " . $nama_bimbel . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'bimbel.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Bimbel $nama_bimbel gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Bimbel " . $nama_bimbel . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'bimbel.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
