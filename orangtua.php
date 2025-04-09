<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $orangtua = mysqli_query($conn, "SELECT * FROM orangtua ORDER BY nama_orangtua ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Orang Tua</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-users"></i> Orang Tua</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Orang Tua
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <a href="tambah_orangtua.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Orang Tua</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Nama Orang Tua</th>
                                            <th class="text-center align-middle">No. HP Orang Tua</th>
                                            <th class="text-center align-middle">Alamat Orang Tua</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($orangtua as $ds): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="align-middle text-start"><?= $ds['nama_orangtua']; ?></td>
                                                <td class="align-middle text-start"><?= $ds['no_hp_orangtua']; ?></td>
                                                <td class="align-middle text-start"><?= $ds['alamat_orangtua']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y, H:i:s', strtotime($ds['dibuat_pada'])); ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="detail_orangtua.php?id_orangtua=<?= $ds['id_orangtua']; ?>" class="m-1 btn btn-primary"><i class="fas fa-fw fa-bars"></i> Detail</a>
                                                    <a href="ubah_orangtua.php?id_orangtua=<?= $ds['id_orangtua']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_orangtua.php?id_orangtua=<?= $ds['id_orangtua']; ?>" data-nama="<?= $ds['nama_orangtua']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- /.row --> <!--begin::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>