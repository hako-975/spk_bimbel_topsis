<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: landing.php");
        exit;
    }

    if ($dataUser['jabatan'] == 'orangtua') {
        $id_user = $dataUser['id_user'];
        $orangtua = mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE orangtua.id_user = '$id_user'");

        if (mysqli_num_rows($orangtua) == 0) {
            header("Location: tambah_orangtua.php");
            exit;
        }

        $id_orangtua = mysqli_fetch_assoc($orangtua)['id_orangtua'];
        $jml_spk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hasil_topsis WHERE id_orangtua = '$id_orangtua'"));
    } else {
        $jml_spk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hasil_topsis"));
    }
    $jml_bimbel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bimbel"));
    $jml_kriteria = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kriteria"));
    $jml_orangtua = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orangtua"));
    $jml_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Dashboard - Sistem Pendukung Keputusan Tempat Bimbel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div>
            <div class="loading-spinner"></div>
            <div class="loading-text">Memuat Dashboard...</div>
        </div>
    </div>
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-tachometer-alt"></i> Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="fas fa-fw fa-clipboard-list"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Jumlah Kriteria</span> 
                                    <span class="info-box-number">
                                        <?= $jml_kriteria; ?>
                                    </span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="fas fa-fw fa-school"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Jumlah Bimbel</span> 
                                    <span class="info-box-number">
                                        <?= $jml_bimbel; ?>
                                    </span> </div>
                            </div> <!-- /.info-box -->
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="fas fa-fw fa-users text-white"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Jumlah Orang Tua</span>
                                    <span class="info-box-number"><?= $jml_orangtua; ?></span>
                                </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="fas fa-fw fa-user text-white"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Jumlah User</span> <span class="info-box-number"><?= $jml_user; ?></span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-info shadow-sm"> <i class="fas fa-fw fa-calculator text-white"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Jumlah SPK</span> <span class="info-box-number"><?= $jml_spk; ?></span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
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