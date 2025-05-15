<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <div class="site-name">Site name</div>
    <div class="menu">
      <a href="index.html">Beranda</a>
      <a href="#">Riwayat</a>
      <a href="#">Laporan</a>
    </div>
    <div class="profile-btn">Profil</div>
  </header>

  <div class="container">
    <div class="left" style="width: 100%;">
      <h2>Profil Pengguna</h2>
      <form id="profile-form">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br><br>

        <label for="usia">Usia:</label><br>
        <input type="number" id="usia" name="usia"><br><br>

        <label for="gender">Jenis Kelamin:</label><br>
        <select id="gender" name="gender">
          <option value="">-- Pilih --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <label for="berat">Berat Badan (kg):</label><br>
        <input type="number" id="berat" name="berat"><br><br>

        <label for="tinggi">Tinggi Badan (cm):</label><br>
        <input type="number" id="tinggi" name="tinggi"><br><br>

        <button type="button" onclick="simpanProfil()">Simpan Profil</button>
      </form>

      <div id="profil-output" style="margin-top: 20px;"></div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

  <script src="function.js"></script>
</body>
</html>
