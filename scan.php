<?php
    include 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <?php include_once 'include/head.php'; ?>
    <style>
      #reader {
        width: 400px;
        margin: auto;
      }
      #result {
        margin-top: 20px;
        font-size: 1.2em;
        text-align: center;
      }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once 'include/navbar.php'; ?>

        <main class="app-main">
            <div class="app-content">
                <div class="container">
                    <h2 class="text-center mt-4 mb-4">Scan QR / Barcode Ticket</h2>
                    <div id="reader"></div>
                    <div id="result">Scan result will appear here</div>
                </div>
            </div>
        </main>

        <?php include_once 'include/footer.php'; ?>
    </div>

    <?php include_once 'include/script.php'; ?>

    <script>
      function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning after first success
        html5QrcodeScanner.clear();

        $('#result').html(`Scanning result: <b>${decodedText}</b><br>Validating...`);

        $.ajax({
          url: 'validate_token.php',
          type: 'GET',
          data: { token: decodedText },
          dataType: 'json',
          success: function(data) {
            if(data.status === 'success'){
              $('#result').html(`<span style="color:green;">✅ ${data.message}</span>`);
            } else {
              $('#result').html(`<span style="color:red;">❌ ${data.message}</span>`);
            }
          },
          error: function(xhr, status, error) {
            $('#result').html(`<span style="color:red;">Error: ${error}</span>`);
          }
        });
      }

      var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 }
      );
      html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
