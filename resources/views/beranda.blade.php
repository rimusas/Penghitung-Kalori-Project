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
      <form action="{{ route('food.store') }}" method="POST">
          @csrf
          <input type="text" name="nama_makanan" placeholder="Nama Makanan" required>
          <input type="number" step="0.01" name="porsi" placeholder="Porsi" required>
          <input type="number" step="0.01" name="kalori_per_porsi" placeholder="Kalori per Porsi" required>
          <button type="submit">Tambahkan</button>
      </form>

    <table>
    <thead>
        <tr>
            <th>Nama Makanan</th>
            <th>Porsi</th>
            <th>Kalori Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foods as $food)
            <tr>
                <td>{{ $food->nama_makanan }}</td>
                <td>{{ $food->porsi }}</td>
                <td>{{ $food->kalori_total }} kkal</td>
                <td>
                    <!-- Form untuk Edit -->
                    <form action="{{ route('food.update', $food->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="nama_makanan" value="{{ $food->nama_makanan }}">
                        <input type="hidden" name="porsi" value="{{ $food->porsi }}">
                        <input type="hidden" name="kalori_per_porsi" value="{{ $food->kalori_total / $food->porsi }}">
                        <button type="submit">Edit</button>
                    </form>
                    <!-- Form untuk Hapus -->
                    <form action="{{ route('food.delete', $food->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
      </tbody>
      </table>
    </div>
    <div class="right">
      <h3>Hasil Penghitungan</h3>
      <p>Total Kalori yang anda dapatkan hari ini:</p>
      <h2 id="total-calories">... kkal</h2>
      <button onclick="calculateTotal()">Hitung Total Kalori</button>
    </div>
  </div>
  <div class="bawah">
    <h2>Menu Makanan</h2>
    <table class="table-data">
        <tr class="table-data">
          <th class="table-data">Gambar</th>
          <th class="table-data">Nama Makanan</th>
          <th class="table-data">berat per porsi</th>
          <th class="table-data">Kalori</th>
        </tr>
        <tr>
          <td class="table-data">ini gambar</td>
          <td class="table-data">makanan</td>
          <td class="table-data">12 g</td>
          <td class="table-data">120</td>
        </tr>
      </table>
  </div>
  <footer>
    <p>&copy; 2025 Aplikasi Kalori</p>
  </footer>

<script src="{{ asset('function.js') }}"></script>
</body>
</html>
