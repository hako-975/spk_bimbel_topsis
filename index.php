<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_pengguna_tiket'])) {
        header("Location: registrasi.php");
        exit;
    }

    $id_pengguna_tiket = $_SESSION['id_pengguna_tiket'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengguna_tiket WHERE id_pengguna_tiket = '$id_pengguna_tiket'"));

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Entrance Ticket: Celebrating 30 Years of Telkomsel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container"> <!-- Info boxes -->
                    <div class="row mt-5">
                        <div class="col p-5 text-center bg-white rounded">
                            <img src="<?= $data['qr_code_file']; ?>" alt="QR Code"><br>
                            <a download href="<?= $data['qr_code_file']; ?>" target="_blank" class="btn btn-success"><i class="fas fa-fw fa-download"></i> Download</a><br><br>
                            <h3>Save This QR Code!</h3>
                            <p>
                                The QR code below is used to Enter the Room for the Telkomsel 30th Anniversary event.
                            </p>
                            <p>
                                Please keep this image safe and do not share it with others to ensure secure access.
                            </p>
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