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
                    <h1 class="mt-4">Riwayat Kalori</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Riwayat</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            "Tabel di bawah ini menampilkan data riwayat kalori Anda yang telah dicatat selama penggunaan aplikasi. Informasi ini dapat membantu Anda memantau asupan kalori harian dan memahami pola konsumsi makanan Anda secara lebih terstruktur."
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Riwayat Kalori
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Makanan</th>
                                        <th>Jumlah Kalori</th>
                                    </tr>
                                </thead>
                                <tfoot id="riwayat-body">
                                  <tbody>
                                    @if ($history->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data riwayat.</td>
                                        </tr>
                                    @else
                                        @foreach ($history as $item)
                                            <tr>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td>{{ $item->nama_makanan }}</td>
                                                <td>{{ $item->kalori_total }} kkal</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                  </tbody>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; E-Calory 2025</div>
                        <div>
                            <a href="#">Kebijakan Privasi</a>
                            &middot;
                            <a href="#">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>
</html>
