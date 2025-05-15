<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Input Makanan</title>
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
    <div class="left">
      <h2>Input Makanan</h2>
      <p>
        Usia: <br>
        Jenis Kelamin: <br>
        Berat Badan: <br>
        Tinggi Badan:
      </p>

      <table id="food-table">
        <tr>
          <th>Nama Makanan</th>
          <th>Jumlah Kalori</th>
          <th>Tambahkan</th>
        </tr>
        <tr>
          <td>Makanan 1</td>
          <td>65 kkal</td>
          <td></td>
        </tr>
        <tr>
          <td>Makanan 2</td>
          <td>129 kkal</td>
          <td class="add-btn" onclick="addFoodRow()">+</td>
        </tr>
      </table>
    </div>

    <div class="right">
      <h3>Hasil Penghitungan</h3>
      <p>Kalori Normal yang anda butuhkan adalah sekitar:</p>
      <h2 id="total-calories">... kkal</h2>
      <button onclick="calculateTotal()">Hitung Total Kalori</button>
    </div>
  </div>

  </body>
  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

<script src="function.js"></script>
</body>
</html>
