<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Kalori</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>

  <header>
    <div class="site-name">Aplikasi Kalori</div>
    <div class="menu">
      <a href="{{ url('/home') }}">Beranda</a>
      <a style="color:white" href="{{ url('/riwayat') }}">Riwayat</a>
      <a href="{{ url('/laporan') }}">Laporan</a>
    </div>
    <div>
      <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </header>

  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nama Makanan</th>
          <th>Jumlah Kalori</th>
          <th>Status Kalori</th>
        </tr>
      </thead>
      <tbody id="riwayat-body">
        <!-- Data dinamis bisa ditambahkan via JavaScript -->
      </tbody>
    </table>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

  <script src="function.js">
    
  </script>

</body>
</html>
