<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    if ($dataUser['jabatan'] == 'orangtua') {
        $id_user = $dataUser['id_user'];
        $orangtua = mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE orangtua.id_user = '$id_user'");

        if (mysqli_num_rows($orangtua) > 0) {
            header("Location: index.php");
            exit;
        }
    }

    $user = mysqli_query($conn, "SELECT u.* FROM user u LEFT JOIN orangtua s ON u.id_user = s.id_user WHERE s.id_user IS NULL AND jabatan = 'orangtua' ORDER BY u.username ASC");
    $nama = $dataUser['nama'];
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Orangtua</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahOrangtua'])) {
            if ($dataUser['jabatan'] == 'orangtua') {
                $id_user = $dataUser['id_user'];
            } else {
                $id_user = htmlspecialchars($_POST['id_user']);
            }

            $no_hp_orangtua = htmlspecialchars($_POST['no_hp_orangtua']);
            $alamat_orangtua = htmlspecialchars($_POST['alamat_orangtua']);

            $insert_orangtua = mysqli_query($conn, "INSERT INTO orangtua VALUES ('', '$no_hp_orangtua', '$alamat_orangtua', '$id_user', CURRENT_TIMESTAMP())");

            if ($insert_orangtua) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orangtua $nama berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Orangtua " . $nama . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'orangtua.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orangtua $nama gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Orangtua " . $nama . " gagal ditambahkan!'
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
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Tambah Orangtua</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="orangtua.php">Orangtua</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Orangtua
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post" enctype="multipart/form-data"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="id_user" class="form-label">Akun User Orangtua</label>
                                            <?php if ($dataUser['jabatan'] == 'orangtua'): ?>
                                                <input type="text" disabled style="cursor: not-allowed;" class="form-control" value="<?= $dataUser['username']; ?>">
                                            <?php else: ?>
                                                <select class="form-select" id="id_user" name="id_user" required>
                                                    <option value="0">--- Pilih Akun User ---</option>
                                                    <?php foreach ($user as $du): ?>
                                                        <option value="<?= $du['id_user']; ?>"><?= $du['username']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            <?php endif ?>
                                        </div>
                                        <?php if ($dataUser['jabatan'] == 'orangtua'): ?>
                                            <div class="mb-3"> 
                                                <label for="nama" class="form-label">Nama Orangtua</label>
                                                <input type="text" disabled class="form-control" id="nama" name="nama" value="<?= $nama; ?>" style="cursor: not-allowed;" required>
                                            </div>
                                        <?php endif ?>
                                        <div class="mb-3"> 
                                            <label for="no_hp_orangtua" class="form-label">No. Telepon Orangtua</label> 
                                            <input type="number" class="form-control" id="no_hp_orangtua" name="no_hp_orangtua" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="alamat_orangtua" class="form-label">Alamat Orangtua</label>
                                            <textarea class="form-control" id="alamat_orangtua" name="alamat_orangtua" required></textarea>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3 text-end">
                                        <button type="submit" name="btnTambahOrangtua" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
                                    </div> 
                                </form> <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>