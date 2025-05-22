<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna</title>
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
    <div class="logout-btn">
      <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </header>

  <div class="container">
    <h2>Profil Pengguna</h2>
    @if (session('success'))
      <div class="success-message">
          {{ session('success') }}
      </div>
    @endif

    <form id="profile-form" action="{{ url('/profile') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="{{ $user->nama }}" required><br><br>

        <label for="umur">Umur:</label><br>
        <input type="number" id="umur" name="umur" value="{{ $user->umur }}" required><br><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
          <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select><br><br>

        <label for="berat">Berat Badan (kg):</label><br>
        <input type="number" id="berat" name="berat" value="{{ $user->berat }}" required><br><br>

        <label for="tinggi">Tinggi Badan (cm):</label><br>
        <input type="number" id="tinggi" name="tinggi" value="{{ $user->tinggi }}" required><br><br>

        <button type="submit">Simpan Profil</button>
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

</body>
</html>
