<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Kalori</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="style.css"
</head>
<body>

  <header>
    <div class="site-name">Aplikasi Kalori</div>
    <div class="menu">
      <a href="{{ url('/home') }}">Beranda</a>
      <a href="{{ url('/riwayat') }}">Riwayat</a>
      <a style="color:white" href="{{ url('/laporan') }}">Laporan</a>
    </div>
    <div>
      <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </header>

  <div class="container">
    <p>Rekap Minggu 23–29/12/2024</p>
    <canvas id="kaloriChart" height="100"></canvas>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

  <script src="function.js">
  </script>

</body>
</html>
