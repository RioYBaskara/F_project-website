<?php
include("connect.php");
session_start();


if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($koneksi, "SELECT*FROM users WHERE email='$email' AND password = '$password' AND is_deleted = '0';");
  $query_delete = mysqli_query($koneksi, "SELECT*FROM users  WHERE email='$email' AND password = '$password' AND is_deleted = '1';");
  if (mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_array($query);
    $_SESSION['email'] = $user['email'];
    $_SESSION['username'] = $user['username'];
    header('Location:index.php');
  } else if (mysqli_fetch_array($query_delete)) {
    echo "<script>alert('Akun Anda sudah di suspend! Jika ingin memulihkan akun silahkan menghubungi admin!')</script>";
  } else {
    echo "<script>alert('Akun tidak Ditemukan!')</script>";

  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="stylesheet" href="CSS/form.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <style>
    a {
      color: blue;
    }

    a:hover {
      color: white;
      /* saat mouse diarahkan */
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="index.php" class="home-link">&larr; Home</a>
    <div class="brand">thrifture<span>.</span></div>
  </nav>
  <!-- NAVBAR SELESAI -->
  <?php
  if (isset($_GET['pesan']) && $_GET['pesan'] == 'login_dulu') {
    echo "<p style='color:red;'>Silakan login terlebih dahulu untuk checkout.</p>";
  } ?>
  <div class="form">
    <form action="" method="post">
      <h2 style="text-align: center;">Login Thrifture</h2>
      <p class="msg"></p>

      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
      </div>
      <button class="btn btn-dark fw-bold" name="submit">Login</button>
      <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
    </form>
  </div>
  <!-- Background IMG -->
  <img class="bg-img" src="assets/nav.jpeg" alt="bg_image">
  <!-- Bg-IMG berakhir -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>

</html>