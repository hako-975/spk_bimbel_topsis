<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_hasil = $_GET['id_hasil'];

    $data_hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hasil_topsis INNER JOIN orangtua ON hasil_topsis.id_orangtua = orangtua.id_orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE hasil_topsis.id_hasil = '$id_hasil'"));

    if ($data_hasil == null) {
        header("Location: spk.php");
        exit;
    }

    $orangtua = mysqli_query($conn, "SELECT * FROM orangtua ORDER BY nama_orangtua ASC");
    $bimbel = mysqli_query($conn, "SELECT * FROM bimbel ORDER BY nama_bimbel ASC");
    $kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY nama_kriteria ASC");

    if (isset($_GET['id_orangtua'])) {
        $id_orangtua = $_GET['id_orangtua'];
        $data_orangtua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE id_orangtua = '$id_orangtua'"));
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah SPK Tempat Bimbel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnSpkBimbel'])) {
            $id_orangtua = htmlspecialchars($_POST['id_orangtua']);

            if ($id_orangtua == '0') {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Pilih orangtua!',
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

            $hasil = mysqli_query($conn, "UPDATE hasil_topsis SET id_orangtua = '$id_orangtua', dibuat_pada = CURRENT_TIMESTAMP() WHERE id_hasil = '$id_hasil'");

            $penilaian_data = $_POST['penilaian'];
            $error = false;
            mysqli_query($conn, "DELETE FROM penilaian WHERE id_hasil = '$id_hasil'");
            foreach ($penilaian_data as $id => $data) {
                $id_bimbel = $data['id_bimbel'];
                foreach ($data as $key => $nilai_data) {
                    // Abaikan 'id_bimbel' karena bukan array nilai
                    if (!is_array($nilai_data)) {
                        continue;
                    }

                    $id_kriteria = $nilai_data['id_kriteria'];
                    $nilai = $nilai_data['nilai'];

                    // Query insert
                    $query = "INSERT INTO penilaian VALUES ('', '$id_kriteria', '$id_bimbel', '$nilai', '$id_hasil')";

                    if (!mysqli_query($conn, $query)) {
                        $error = true;
                        break;
                    }
                }
            }

            $nama_orangtua = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orangtua INNER JOIN user ON orangtua.id_user = user.id_user WHERE id_orangtua = '$id_orangtua'"))['nama'];

            if (!$error) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'SPK Tempat Bimbel $nama_orangtua Berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'SPK Tempat Bimbel " . $nama_orangtua . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'hasil_spk.php?id_hasil=$id_hasil';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Bimbel $nama_orangtua gagal dihitung!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Bimbel " . $nama_orangtua . " gagal diubah!'
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
                            <h3 class="mb-0">SPK Tempat Bimbel</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="orangtua.php">Orang Tua</a></li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="id_orangtua" class="form-label fw-bold">Nama Orang Tua</label>
                                            <select name="id_orangtua" id="id_orangtua" class="form-select select2">
                                                <option value="<?= $data_hasil['id_orangtua']; ?>"><?= $data_hasil['nama']; ?></option>
                                                <?php foreach ($orangtua as $ds): ?>
                                                    <?php if ($data_hasil['id_orangtua'] != $ds['id_orangtua']): ?>
                                                        <option value="<?= $ds['id_orangtua']; ?>"><?= htmlspecialchars($ds['nama']); ?></option>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <hr>
                                        <?php foreach ($bimbel as $dj): ?>
                                            <input type="hidden" name="penilaian[<?= $dj['id_bimbel']; ?>][id_bimbel]" value="<?= $dj['id_bimbel']; ?>">
                                            <div class="row">
                                                <label class="form-label fw-bold">Bimbel <?= htmlspecialchars($dj['nama_bimbel']); ?></label>
                                                <?php foreach ($kriteria as $dk): ?>
                                                    <input type="hidden" name="penilaian[<?= $dj['id_bimbel']; ?>][<?= $dk['id_kriteria']; ?>][id_kriteria]" value="<?= $dk['id_kriteria']; ?>">
                                                    <div class="mb-3 col">
                                                        <label for="nilai_<?= $dj['id_bimbel']; ?>_<?= $dk['id_kriteria']; ?>" class="form-label">
                                                            <?= htmlspecialchars($dk['nama_kriteria']); ?>
                                                        </label>
                                                        <?php 
                                                            $id_bimbel = $dj['id_bimbel'];
                                                            $id_kriteria = $dk['id_kriteria'];
                                                            $penilaian = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM penilaian WHERE id_hasil = '$id_hasil' AND id_bimbel = '$id_bimbel' AND id_kriteria = '$id_kriteria'"));
                                                        ?>
                                                        <input type="number" step="0.01" id="nilai_<?= $dj['id_bimbel']; ?>_<?= $dk['id_kriteria']; ?>" class="form-control" name="penilaian[<?= $dj['id_bimbel']; ?>][<?= $dk['id_kriteria']; ?>][nilai]" min="0" value="<?= $penilaian['nilai']; ?>" required>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <hr>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="card-footer pt-3 text-end">
                                        <button type="submit" name="btnSpkBimbel" class="btn btn-primary">
                                            <i class="fas fa-fw fa-save"></i> Submit
                                        </button>
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