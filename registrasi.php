<?php 
    require_once 'connection.php';

    if (isset($_SESSION['id_user'])) {
        echo "
            <script>
                window.location='index.php'
            </script>
        ";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Sistem Pendukung Keputusan Tempat Bimbel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary" style="background-image: url('assets/img/properties/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; backdrop-filter: brightness(70%);">

    <?php 
        if (isset($_POST['btnRegistrasi'])) {
            $username = htmlspecialchars($_POST['username']);
            $nama = htmlspecialchars($_POST['nama']);
            $password = $_POST['password'];
            $ulangi_password = $_POST['ulangi_password'];
            
            // check username
            $check_username = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
            if (mysqli_num_rows($check_username) > 0) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal!',
                            text: 'Username sudah digunakan!',
                            confirmButtonText: 'Kembali'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }

            // check ulangi password
            if ($password != $ulangi_password) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal!',
                            text: 'Password tidak sama dengan ulangi password!',
                            confirmButtonText: 'Kembali'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }

            $password_baru = password_hash($password, PASSWORD_DEFAULT);


            $insert_user = mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password_baru', 'orangtua', '$nama', 'default.jpg', CURRENT_TIMESTAMP())");
            
            $id_user = mysqli_insert_id($conn);

            if ($insert_user) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'User $username berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $id_user . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'User " . $username . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'login.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'User $username gagal ditambahkan!', CURRENT_TIMESTAMP(), " . 1 . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'User " . $username . " gagal ditambahkan!'
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
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="text-center">
                    <img src="assets/img/properties/logo.jpg" class="mx-auto w-50" alt="Logo">
                </div>
                <h4 class="text-center">Sistem Pendukung Keputusan Tempat Bimbel</h4>
            </div>
            <div class="card-body login-card-body pb-0 pt-2">
                <h4 class="text-dark text-center">User Registrasi</h4>
                <form method="post">
                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="username" name="username" autocomplete="off" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="username">Username</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-user"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="nama" name="nama" autocomplete="off" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="nama">Nama Lengkap</label> 
                        </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-user"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating"> <input id="password" name="password" type="password" class="form-control" placeholder="" required> <label for="password">Password</label> </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-lock"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating"> <input id="ulangi_password" name="ulangi_password" type="password" class="form-control" placeholder="" required> <label for="ulangi_password">Ulangi Password</label> </div>
                        <div class="input-group-text"> <span class="fas fa-fw fa-lock"></span> </div>
                    </div> <!--begin::Row-->
                    <div class="row mt-3">
                        <div class="col text-start my-auto">
                            <a href="login.php">Login</a>
                        </div> <!-- /.col -->
                        <div class="col text-end">
                            <button type="submit" name="btnRegistrasi" class="btn btn-primary">Registrasi <span class="fas fa-fw fa-sign-in-alt"></span></button>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> 
            <div class="card-footer">
                <p class="m-0 p-0">Copyright &copy; 2025 Dewi Putri Aulia.</p>
            </div>
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>