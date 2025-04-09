<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_orangtua = $_GET['id_orangtua'];
    
    $data_orangtua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orangtua WHERE id_orangtua = '$id_orangtua'"));
    
    if ($data_orangtua == null) {
        header("Location: orangtua.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Orang Tua - <?= $data_orangtua['nama_orangtua']; ?></title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnUbahOrangTua'])) {
            $nama_orangtua = htmlspecialchars($_POST['nama_orangtua']);
            $no_hp_orangtua = htmlspecialchars($_POST['no_hp_orangtua']);
            $alamat_orangtua = htmlspecialchars($_POST['alamat_orangtua']);

            $foto = $data_orangtua['foto'];
            $foto_new = $_FILES['foto']['name'];
            if ($foto_new != '') {
                $acc_extension = array('png', 'jpg', 'jpeg', 'gif');
                $extension = explode('.', $foto_new);
                $extension_lower = strtolower(end($extension));
                $size = $_FILES['foto']['size'];
                $file_tmp = $_FILES['foto']['tmp_name'];     

                if ($size > 5253120) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Ukuran file terlalu besar!',
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

                if(!in_array($extension_lower, $acc_extension))
                {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'File yang di upload bukan gambar!',
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

                $image_path = 'assets/img/profiles/' . $foto;
                
                if ($foto != 'default.jpg' && $foto != '') {
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $foto = uniqid() . '_' . time() . '_' . $foto_new;
            }
            
            $update_orangtua = mysqli_query($conn, "UPDATE orangtua SET nama_orangtua = '$nama_orangtua', no_hp_orangtua = '$no_hp_orangtua', alamat_orangtua = '$alamat_orangtua', foto = '$foto' WHERE id_orangtua = '$id_orangtua'");

            if ($update_orangtua) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orang Tua $nama_orangtua berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                if ($foto_new != '') {
                    $file_tmp = $_FILES['foto']['tmp_name'];     
                    move_uploaded_file($file_tmp, 'assets/img/profiles/' . $foto);
                }

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Orang Tua " . $nama_orangtua . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'orangtua.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Orang Tua $nama_orangtua gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Orang Tua " . $nama_orangtua . " gagal diubah!'
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
                            <h3 class="mb-0">Ubah Orang Tua - <?= $data_orangtua['nama_orangtua']; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="orangtua.php">Orang Tua</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Orang Tua
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post" enctype="multipart/form-data"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="nama_orangtua" class="form-label">Nama Orang Tua</label>
                                            <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" value="<?= $data_orangtua['nama_orangtua']; ?>" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="no_hp_orangtua" class="form-label">No. Telepon</label> 
                                            <input type="number" class="form-control" id="no_hp_orangtua" name="no_hp_orangtua" value="<?= $data_orangtua['no_hp_orangtua']; ?>" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="alamat_orangtua" class="form-label">Alamat Orang Tua</label>
                                            <textarea class="form-control" id="alamat_orangtua" name="alamat_orangtua" required><?= $data_orangtua['alamat_orangtua']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)"> 
                                                <label class="input-group-text" for="foto">Upload</label> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3 text-end">
                                        <button type="submit" name="btnUbahOrangTua" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
                                    </div> 
                                </form> <!--end::Form-->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-body text-center">
                                    <h5 class="form-label">Preview Foto</h5>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <img id="preview-img" class="img-fluid rounded-3" src="assets/img/profiles/<?= $data_orangtua['foto']; ?>" alt="<?= $data_orangtua['foto']; ?>">
                                        </div>
                                        <div class="col">
                                            <img id="preview-img-circle" class="img-fluid rounded-circle" src="assets/img/profiles/<?= $data_orangtua['foto']; ?>" alt="<?= $data_orangtua['foto']; ?>">
                                        </div>
                                    </div>  
                                </div>
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