<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Register</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

  <header>
    <div class="site-name">Aplikasi Kalori</div>
    <div class="menu">
      <a href="{{ url('/home') }}">Beranda</a>
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

  <div class="container">
    <h2>Register</h2>

    @if ($errors->any())
      <div class="error-messages">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ url('/register') }}" method="POST" id="register-form">
      @csrf
      <div class="form-group">
        <label>Nama*</label>
        <input type="text" name="nama" required>
      </div>
      <div class="form-group">
        <label>Berat Badan*</label>
        <input type="number" name="berat" step="0.01" required>
      </div>
      <div class="form-group">
        <label>Email*</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label>Tinggi Badan*</label>
        <input type="number" name="tinggi" step="0.01" required>
      </div>
      <div class="form-group">
        <label>Password*</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label>Usia*</label>
        <input type="number" name="umur" required>
      </div>
      <div class="form-group">
        <label>Jenis Kelamin*</label>
        <select name="jenisKelamin" required>
          <option value="" disabled selected>Pilih</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="form-group full-width">
        <button type="submit">Register</button>
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

</body>
</html>
