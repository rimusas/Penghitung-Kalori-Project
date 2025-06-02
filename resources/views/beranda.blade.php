<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - E-Calory</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="{{ route('home') }}">E-Calory</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <!-- Search -->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- User Menu -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
    <!-- Sidebar -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Navigasi</div>
                    <a class="nav-link" href="{{ route('home') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('laporan') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Laporan
                    </a>
                    <a class="nav-link" href="{{ route('riwayat') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Riwayat
                    </a>
                    <a class="nav-link" href="{{ route('profile') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                        Profile
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->nama ?? 'Guest' }}
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <!-- Dynamic Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <strong>Data Kamu</strong><br>
                                Nama: {{ Auth::user()->nama }}<br>
                                Usia: {{ Auth::user()->umur }} tahun<br>
                                BB: {{ Auth::user()->berat }} kg<br>
                                TB: {{ Auth::user()->tinggi }} cm
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="{{ route('profile') }}">Edit Data</a>
                                <div class="small text-white"><i class="fas fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <!-- Kalori Normal -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <strong>Kalori Normal</strong><br>
                            {{ $calories }} kkal/hari
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white"><i class="fas fa-calculator"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Total Kalori Kamu -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <strong>Total Kalori Kamu</strong><br>
                            {{ $totalCalories }} kkal
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white"><i class="fas fa-utensils"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Status -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <strong>Status</strong><br>
                            <span style="font-weight:bold;">{{ $status }}</span>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('rekomendasi') }}">Lihat Tips</a>
                            <div class="small text-white"><i class="fas fa-exclamation-circle"></i></div>
                        </div>
                    </div>
                </div>
                <div class="text-center my-4">
                    <a href="{{ route('inputMakanan') }}" class="btn btn-lg btn-primary shadow-lg" style="padding: 15px 30px; font-size: 20px;">
                        <i class="fas fa-utensils"></i> Tambah Makanan
                    </a>
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Makanan
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Bahan Makanan</th>
                                <th>Kalori (kkal)</th>
                                <th>Berat (gram)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabelMakanan as $makanan)
                                <tr>
                                    <td>{{ $makanan->makanan }}</td>
                                    <td>{{ $makanan->kalori_makanan }}</td>
                                    <td>{{ $makanan->berat_makanan }}</td>
                                    <td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <script srsc="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
