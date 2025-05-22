<?php 
    require_once 'connection.php';

    if (isset($_SESSION['id_pengguna_tiket'])) {
        echo "
            <script>
                window.location='index.php'
            </script>
        ";
        exit;
    }

    // Include the library
    include 'phpqrcode/qrlib.php';

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Entrance Ticket: Celebrating 30 Years of Telkomsel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary" style="background-image: url('assets/img/properties/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; backdrop-filter: brightness(70%);">

    <?php 
        if (isset($_POST['btnRegistrasi'])) {
            $nik = htmlspecialchars($_POST['nik']);
            $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
            $posisi = htmlspecialchars($_POST['posisi']);
            $divisi = htmlspecialchars($_POST['divisi']);
            
            // check nik
            $check_nik = mysqli_query($conn, "SELECT * FROM pengguna_tiket WHERE nik = '$nik'");
            if (mysqli_num_rows($check_nik) > 0) {
                $data = mysqli_fetch_assoc($check_nik);
                $_SESSION['id_pengguna_tiket'] = $data['id_pengguna_tiket'];                
                header("Location: index.php");
                exit;
            }

            $qr_generator = hash('sha256', $nik . time());
            // Buat folder qr jika belum ada
            if (!file_exists('qr')) {
                mkdir('qr');
            }

            // Simpan QR
            $qrFile = "qr/$nik.png";
            QRcode::png($qr_generator, $qrFile, QR_ECLEVEL_L, 4);


            $insert_pengguna_tiket = mysqli_query($conn, "INSERT INTO pengguna_tiket VALUES ('', '$nik', '$nama_lengkap', '$posisi', '$divisi', '$qrFile', '$qr_generator', CURRENT_TIMESTAMP())");
            $id_pengguna_tiket = mysqli_insert_id($conn);
            if ($insert_pengguna_tiket) {
                $_SESSION['id_pengguna_tiket'] = $id_pengguna_tiket;
                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully!',
                            text: 'NIK $nik successfully registered!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: 'NIK $nik failed to register!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }
        }
    ?>

    <div class="login-box">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <div class="text-center">
                    <img src="assets/img/properties/logo.png" class="mx-auto w-50" alt="Logo">
                </div>
            </div>
            <div class="card-body login-card-body pb-0 pt-2">
                <h4 class="text-dark text-center">Registration</h4>
                <form method="post">
                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="nik" name="nik" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="nik">NIK</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-id-card"></span> </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="nama_lengkap">Full Name</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-user"></span> </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="posisi" name="posisi" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="posisi">Position</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-briefcase"></span> </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="divisi" name="divisi" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="divisi">Division</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-user-tie"></span> </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col text-end">
                            <button type="submit" name="btnRegistrasi" class="btn btn-danger">Submit <span class="fas fa-fw fa-sign-in-alt"></span></button>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> 
            <div class="card-footer">
                <p class="m-0 p-0">Copyright &copy; 2025 Hako Lab.</p>
            </div>
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>