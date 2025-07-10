<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'SMA N 5 Serang' ?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 0; margin: 0; }
        header { background: #0066cc; color: white; padding: 0.5rem; }
        nav a { color: white; margin: 0 1rem; text-decoration: none; }
        main { padding: 2rem; }
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #fff;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="bg-primary text-white">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <!-- Logo & Judul -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/spk-saw-siswa-sma5serang-app/public/assets/logo.png" alt="Logo" width="60" height="60" class="me-2">
                <div class="mx-3">
                    <div class="small">Sistem Pendukung Keputusan</div>
                    <div class="fw-bold">SMA N 5 Serang</div>
                </div>
            </a>


            <!-- Toggler untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Tengah & Logout Kanan -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <?php
                    function isActive($route) {
                        $currentUrl = $_GET['url'] ?? '';
                        return $currentUrl === $route ? ' active' : '';
                    }
                ?>

                <!-- Menu Tengah -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('user/landing/home') ?>" href="/spk-saw-siswa-sma5serang-app/user/landing/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('user/landing/about') ?>" href="/spk-saw-siswa-sma5serang-app/user/landing/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('user/landing/ranking') ?>" href="/spk-saw-siswa-sma5serang-app/user/landing/ranking">Ranking</a>
                    </li>
                </ul>

                <!-- Logout Kanan -->
                <div class="d-flex">
                    <a href="/spk-saw-siswa-sma5serang-app/user/landing/logout" class="btn btn-outline-light">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-fill">
        <div class="flex-grow-1 d-flex">
            <div class="w-100">
                <?= $content ?>
            </div>
        </div>
    </main>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto text-center text-black">
            <span style="color: black;">&copy; Sistem Pendukung Keputusan Siswa SMA N 5 Serang Terbaik</span>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/natural.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/js/sb-admin-2.min.js"></script>

</body>
</html>
