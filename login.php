
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login - SPK BIMBEL TOPSIS</title>
  <?php include_once 'include/head.php'; ?>
</head>

<body>
  <?php 
    require_once 'koneksi.php';
    if (isset($_SESSION['id_user'])) {
      header('Location: index.php');
      exit;
    }

    if (isset($_POST['btnLogin'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
      
      if ($data_user = mysqli_fetch_assoc($cek_username)) {
        if (password_verify($password, $data_user['password'])) {
          $_SESSION['id_user'] = $data_user['id_user'];
          header("Location: index.php");
          exit;
        } else {
          echo "
            <script>
              Swal.fire({
                icon: 'error',
                title: 'Gagal Login!',
                text: 'Username atau Password salah!',
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
      } else {
        echo "
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Gagal Login!',
              text: 'Username atau Password salah!',
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
    }
  ?>

  <div class="layer"></div>
  <main class="page-center">
    <article class="sign-up">
      <h1 class="sign-up__title">Welcome Bimbel Cabaca Abidzar!</h1>
      <form class="sign-up-form form" method="post">
        <label class="form-label-wrapper">
          <p class="form-label">Username</p>
          <input name="username" class="form-input" type="text" placeholder="Enter your username" required>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">Password</p>
          <input name="password" class="form-input" type="password" placeholder="Enter your password" required>
        </label>
        <button class="form-btn primary-default-btn transparent-btn" name="btnLogin">Login</button>
      </form>
    </article>
  </main>
  <?php include_once 'include/footer.php'; ?>

</body>
</html>