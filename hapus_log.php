<?php
require_once 'connection.php';

// Cek session dan jabatan admin
if (!isset($_SESSION['id_user']) || $dataUser['jabatan'] != 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='login.php';</script>";
    exit;
}

// Cek parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Log tidak valid!'); window.location='log.php';</script>";
    exit;
}

$id_log = $_GET['id'];

// Cek apakah log exists
$check_log = mysqli_query($conn, "SELECT * FROM log WHERE id_log = '$id_log'");
if (mysqli_num_rows($check_log) == 0) {
    echo "<script>alert('Log tidak ditemukan!'); window.location='log.php';</script>";
    exit;
}

$log_data = mysqli_fetch_assoc($check_log);

// Hapus log
$delete_log = mysqli_query($conn, "DELETE FROM log WHERE id_log = '$id_log'");

if ($delete_log) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hapus Log</title>
        <?php include_once 'include/head.php'; ?>
    </head>
    <body>
        <script>
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Log berhasil dihapus!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'log.php';
                    }
                });
            } else {
                alert('Log berhasil dihapus!');
                window.location.href = 'log.php';
            }
        </script>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hapus Log</title>
        <?php include_once 'include/head.php'; ?>
    </head>
    <body>
        <script>
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Log gagal dihapus!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'log.php';
                    }
                });
            } else {
                alert('Log gagal dihapus!');
                window.location.href = 'log.php';
            }
        </script>
    </body>
    </html>
    <?php
}
?> 