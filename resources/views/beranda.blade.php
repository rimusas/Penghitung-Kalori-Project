<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Input Makanan</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

  <header>
    <div class="site-name">Aplikasi Kalori</div>
    <div class="menu">
      <a style="color:white" href="{{ url('/home') }}">Beranda</a>
      <a href="{{ url('/riwayat') }}">Riwayat</a>
      <a href="{{ url('/laporan') }}">Laporan</a>
    </div>
    <div>
      <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </header>

  <div class="button-container">
    <div class="left">
      <h2>Data Diri</h2>
      <p>
        Usia: {{ $user->umur }} <br>
        Jenis Kelamin: {{ $user->jenisKelamin }} <br>
        Berat Badan: {{ $user->berat }} kg <br>
        Tinggi Badan: {{ $user->tinggi }} cm
      </p>
      <a href="{{ url('/profile') }}">Edit Profil</a>
      <h2>Input Makanan</h2>
      <table id="food-table">
        <tr>
          <th>Nama Makanan</th>
          <th>Jumlah Kalori</th>
          <th>Tambahkan</th>
        </tr>
        <tr>
          <td>Makanan 1</td>
          <td>65 kkal</td>
          <td class="add-btn" onclick="addFoodRow()">+</td>
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

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

<script src="{{ asset('function.js') }}"></script>
</body>
</html>
