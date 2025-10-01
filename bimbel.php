<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $bimbel = mysqli_query($conn, "SELECT * FROM bimbel ORDER BY nama_bimbel ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Bimbel</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-school"></i> Bimbel</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Bimbel
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
                                <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                    <a href="tambah_bimbel.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Bimbel</a>
                                <?php endif ?>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Nama Bimbel</th>
                                            <th class="text-center align-middle">Alamat Bimbel</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                <th class="text-center align-middle">Aksi</th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($bimbel as $dj): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="align-middle text-start"><?= $dj['nama_bimbel']; ?></td>
                                                <td class="align-middle text-start"><a href="<?= $dj['alamat_bimbel']; ?>" target="_blank"><?= $dj['alamat_bimbel']; ?></a></td>
                                                <td class="align-middle text-start"><?= date("d-m-Y, H:i", strtotime($dj['dibuat_pada'])); ?></td>
                                                <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                    <td class="text-center align-middle">
                                                        <a href="ubah_bimbel.php?id_bimbel=<?= $dj['id_bimbel']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                        <a href="hapus_bimbel.php?id_bimbel=<?= $dj['id_bimbel']; ?>" data-nama="<?= $dj['nama_bimbel']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                    </td>
                                                <?php endif ?>
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