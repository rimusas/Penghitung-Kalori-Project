<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <div class="site-name">Site name</div>
    <div class="menu">
      <a href="#">Beranda</a>
      <a href="#">Riwayat</a>
      <a href="#">Laporan</a>
    </div>
    <div class="profile-btn">Profil</div>
  </header>

  <div class="container">
    <h2>Login</h2>
    <form id="register-form">
      <div class="form-group">
        <label>Nama*</label>
        <input type="text" name="nama" required>
      </div>
      <div class="form-group">
        <label>Berat Badan*</label>
        <input type="number" name="berat" required>
      </div>

      <div class="form-group">
        <label>Email*</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label>Tinggi Badan*</label>
        <input type="number" name="tinggi" required>
      </div>

      <div class="form-group">
        <label>Password*</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label>Usia*</label>
        <input type="number" name="usia" required>
      </div>

      <div class="form-group">
        <label>Jenis Kelamin*</label>
        <input type="text" name="gender" required>
      </div>
      <div></div>

      <div class="form-group full-width">
        <button type="submit">Register</button>
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

  <script src="function.js">
   
  </script>

</body>
</html>
