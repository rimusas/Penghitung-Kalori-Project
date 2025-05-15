<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="style.css"
</head>
<body>

  <header>
    <div class="site-name">Site name</div>
    <div class="menu">
      <a href="#">Beranda</a>
      <a href="#">Riwayat</a>
      <a href="#">Laporan</a>
    </div>
    <div class="login-btn">Login</div>
  </header>

  <div class="login-container">
    <h2>Login</h2>
    <input type="text" id="username" placeholder="Username">
    <br>
    <input type="password" id="password" placeholder="Password">
    <div class="button-container">
      <button onclick="login()">Login</button>
      <button onclick="register()">Register</button>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

  <script src="function.js"></script>

</body>
</html>
