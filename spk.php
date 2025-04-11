<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $dataUser['id_user'];
    
    if ($dataUser['jabatan'] == 'orangtua') {
        $orangtua = mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE orangtua.id_user = '$id_user'");

        if (mysqli_num_rows($orangtua) == 0) {
            header("Location: tambah_orangtua.php");
            exit;
        }

        $hasil = mysqli_query($conn, "SELECT *, hasil_topsis.dibuat_pada as dibuat FROM hasil_topsis LEFT JOIN orangtua ON hasil_topsis.id_orangtua = orangtua.id_orangtua LEFT JOIN user ON orangtua.id_user = user.id_user LEFT JOIN bimbel ON hasil_topsis.id_bimbel = bimbel.id_bimbel WHERE user.id_user = '$id_user' ORDER BY dibuat desc");
    } else {
        $hasil = mysqli_query($conn, "SELECT *, hasil_topsis.dibuat_pada as dibuat FROM hasil_topsis LEFT JOIN orangtua ON hasil_topsis.id_orangtua = orangtua.id_orangtua LEFT JOIN user ON orangtua.id_user = user.id_user LEFT JOIN bimbel ON hasil_topsis.id_bimbel = bimbel.id_bimbel ORDER BY dibuat desc");

    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>SPK Tempat Bimbel</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-calculator"></i> SPK Tempat Bimbel</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    SPK Tempat Bimbel
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
                                <a href="tambah_spk.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah SPK Tempat Bimbel</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Nama Orang Tua</th>
                                            <th class="text-center align-middle">Bimbel</th>
                                            <th class="text-center align-middle">Preferensi Tertinggi</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($hasil as $dh): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="align-middle text-start"><?= $dh['nama']; ?></td>
                                                <td class="align-middle text-start"><?= $dh['nama_bimbel']; ?></td>
                                                <td class="align-middle text-start"><?= $dh['preferensi_tertinggi']; ?></td>
                                                <td class="align-middle text-start"><?= date('d-m-Y, H:i', strtotime($dh['dibuat'])); ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="hasil_spk.php?id_hasil=<?= $dh['id_hasil']; ?>" class="m-1 btn btn-primary"><i class="fas fa-fw fa-bars"></i> Detail</a>
                                                    <a href="ubah_spk.php?id_hasil=<?= $dh['id_hasil']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_spk.php?id_hasil=<?= $dh['id_hasil']; ?>" data-nama="<?= $dh['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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