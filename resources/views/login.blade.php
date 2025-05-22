<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}"
</head>
<body>

  <header>
    <div class="site-name">Penghitung Kalori Harian</div>
    <div class="menu">
      <a href="{{ url('/home') }}">Beranda</a>
      <a href="{{ url('/history') }}">Riwayat</a>
      <a href="{{ url('/report') }}">Laporan</a>
    </div>
  </header>

  <div class="login-container">
    <h2>Login</h2>
    <form action="{{ url('/login') }}" method="POST">
    @csrf
    <input type="email" name="email" id="email" placeholder="Email" required>
    <br>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <div class="button-container">
      <button type="submit">Login</button>
      <a href="{{ url('/register') }}">Register</a>
    </div>
    </form>
    @if (session('error'))
      <div class="error-massage">
        {{ session('error') }}
      </div>
      @else
      <div class="success-massage">
        {{ session('success') }}
      </div>
    @endif
    </div>

  <footer>
    <p>&copy; 2025 Aplikasi Penghitung Kalori Harian</p>
  </footer>

  <script src="{{  assert('function.js') }}"></script>

</body>
</html>
