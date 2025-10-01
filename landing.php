<?php 
  require_once 'connection.php';

  if (isset($_SESSION['id_user'])) {
    echo "
        <script>
            window.location='index.php'
        </script>
    ";
    exit;
  }

  $hasil = mysqli_query($conn, "SELECT *, hasil_topsis.dibuat_pada as dibuat FROM hasil_topsis LEFT JOIN orangtua ON hasil_topsis.id_orangtua = orangtua.id_orangtua LEFT JOIN user ON orangtua.id_user = user.id_user LEFT JOIN bimbel ON hasil_topsis.id_bimbel = bimbel.id_bimbel ORDER BY dibuat desc");

  $bimbel = mysqli_query($conn, "SELECT * FROM bimbel ORDER BY nama_bimbel ASC");


?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Selamat Datang - Sistem Pendukung Keputusan Tempat Bimbel</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bimbel Cerdas | Informasi SPK</title>
  <!-- AdminLTE 4 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="layout-top-nav">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white bg-white navbar-light fixed-top">
    <div class="container">
      <a href="landing.php" class="navbar-brand">
        <span class="brand-text fw-bold">Sistem Pendukung Keputusan Tempat Bimbel</span>
      </a>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="registrasi.php" class="nav-link">Registrasi</a></li>
      </ul>
    </div>
  </nav>
  <div class="wrapper">
  <!-- Hero Section -->
  <div class="content-wrapper">
    <div class="content-header text-center bg-primary text-white mt-5 p-5">
      <div class="container">
        <h1 class="fw-bold">Sistem Pendukung Keputusan Tempat Bimbel</h1>
        <p class="lead">
          Keduanya terletak di area pemukiman di Kecamatan Serpong Utara, Kota Tangerang Selatan. 
          Hal ini membuat bimbel sangat mudah dijangkau oleh penduduk sekitar, baik dengan berjalan kaki, bersepeda, maupun menggunakan kendaraan pribadi. 
          Konsep <strong>"bimbel rumahan"</strong> dihadirkan untuk mempermudah akses belajar bagi semua kalangan, terutama anak-anak di lingkungan sekitar. 
          Biaya bulanan sebesar <strong>Rp100.000</strong> menjadi bukti komitmen untuk menyediakan pendidikan tambahan yang terjangkau, inklusif, dan dapat diakses oleh seluruh lapisan masyarakat tanpa memandang latar belakang ekonomi. 
          Harga ini juga sejalan dengan model bimbel rumahan yang memiliki biaya operasional lebih rendah dibandingkan lembaga pendidikan formal, sehingga tetap mampu memberikan kualitas pembelajaran terbaik.
        </p>
      </div>

    </div>

    <section id="lokasi" class="content py-5">
      <div class="container">
        <h2 class="text-center mb-4">Lokasi & Informasi Bimbel</h2>
        <div class="row g-4">
          <?php foreach ($bimbel as $data_bimbel): ?>
            <div class="col-md-6">
              <div class="card card-outline card-primary h-100">
                <div class="card-body">
                  <h5 class="fw-bold"><i class="fas fa-book-open text-primary"></i> <?= $data_bimbel['nama_bimbel']; ?></h5>
                  <a href="<?= $data_bimbel['alamat_bimbel']; ?>" target="_blank" class="btn btn-primary btn-sm">
                    <i class="fas fa-map-marker-alt"></i> Alamat Lihat di Google Maps
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>

    <!-- Informasi Kriteria -->
    <section id="info" class="content py-5">
      <div class="container">
        <h2 class="text-center mb-4">Kriteria Pemilihan Bimbel</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card card-outline card-primary h-100">
              <div class="card-body text-center">
                <i class="fas fa-money-bill-wave fa-3x text-primary mb-3"></i>
                <h5>Biaya</h5>
                <p>Paket belajar dengan harga terjangkau sesuai kebutuhan siswa.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-outline card-success h-100">
              <div class="card-body text-center">
                <i class="fas fa-building fa-3x text-success mb-3"></i>
                <h5>Fasilitas</h5>
                <p>Ruang belajar nyaman, akses modul online, dan sarana modern.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-outline card-warning h-100">
              <div class="card-body text-center">
                <i class="fas fa-users fa-3x text-warning mb-3"></i>
                <h5>Kapasitas Tempat</h5>
                <p>Kelas kecil agar interaksi guru dan siswa lebih maksimal.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-outline card-danger h-100">
              <div class="card-body text-center">
                <i class="fas fa-chalkboard-teacher fa-3x text-danger mb-3"></i>
                <h5>Kualitas Pengajar</h5>
                <p>Tutor berpengalaman, ahli di bidangnya, dan sabar mengajar.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-outline card-info h-100">
              <div class="card-body text-center">
                <i class="fas fa-lightbulb fa-3x text-info mb-3"></i>
                <h5>Metode Pembelajaran</h5>
                <p>Metode interaktif dengan evaluasi rutin dan diskusi kelompok.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tabel Perbandingan -->
    <section id="perbandingan" class="content py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-4">Hasil Perhitungan Bimbel</h2>
        <table class="table table-bordered" id="table_id">
            <thead class="table-dark">
                <tr>
                    <th class="text-center align-middle">No.</th>
                    <th class="text-center align-middle">Bimbel</th>
                    <th class="text-center align-middle">Preferensi Tertinggi</th>
                    <th class="text-center align-middle">Dibuat Pada</th>
                    <th class="text-center align-middle">Cetak</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($hasil as $dh): ?>
                    <tr>
                        <td class="text-center align-middle"><?= $i++; ?>.</td>
                        <td class="align-middle text-start"><?= $dh['nama_bimbel']; ?></td>
                        <td class="align-middle text-start"><?= $dh['preferensi_tertinggi']; ?></td>
                        <td class="align-middle text-start"><?= date('d-m-Y, H:i \W\I\B', strtotime($dh['dibuat'])); ?></td>
                        <td class="align-middle text-center">
                          <a href="print.php?id_hasil=<?= $dh['id_hasil']; ?>" target="_blank" class="mr-3 btn btn-danger"><i class="fas fa-fw fa-file-pdf"></i> PDF</a>
                          <a href="print.php?id_hasil=<?= $dh['id_hasil']; ?>&file_excel=true" target="_blank" class="mr-3 btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
      </div>
    </section>

  </div>

  <!-- Footer -->
  <footer class="main-footer text-center p-5">
    <p class="m-0 p-0">Copyright &copy; 2025 Dewi Putri Aulia.</p>
  </footer>

</div>
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>