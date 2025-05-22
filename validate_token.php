<?php
header('Content-Type: application/json');
include 'connection.php';

if (!isset($_GET['token']) || empty($_GET['token'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Token is required.'
    ]);
    exit;
}

$token = mysqli_real_escape_string($conn, $_GET['token']);

// Cari peserta berdasarkan token
$query = mysqli_query($conn, "SELECT * FROM pengguna_tiket WHERE token = '$token'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid token.'
    ]);
    exit;
}

$nik = $data['nik'];

// Cek apakah peserta sudah pernah masuk
// $cekLog = mysqli_query($conn, "SELECT * FROM log_masuk WHERE nik = '$nik' AND status = 'sukses'");
// if (mysqli_num_rows($cekLog) > 0) {
//     echo json_encode([
//         'status' => 'error',
//         'message' => "{$data['nama_lengkap']} has already entered."
//     ]);
//     exit;
// }

// // Catat waktu masuk peserta
// $insert = mysqli_query($conn, "INSERT INTO log_masuk (nik, status) VALUES ('$nik', 'sukses')");
// if (!$insert) {
//     echo json_encode([
//         'status' => 'error',
//         'message' => 'Failed to record entry. Please try again.'
//     ]);
//     exit;
// }

echo json_encode([
    'status' => 'success',
    'message' => "Welcome, {$data['nama_lengkap']} from <strong>{$data['divisi']}</strong>, position <strong>{$data['posisi']}</strong>! Enjoy the event."
]);
