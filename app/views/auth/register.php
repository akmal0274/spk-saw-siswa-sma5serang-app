<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - SPK Penentuan Siswa Berprestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .login-container {
            height: 100vh;
        }
        .login-left {
            background: url('/apksawsmanli/public/assets/school.jpeg') no-repeat center center;
            background-size: cover;
            position: relative;
            color: white;
        }
        .login-left .overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
        }
        .login-left .content {
            position: relative;
            z-index: 2;
            padding: 40px;
        }
        .login-form {
            max-width: 400px;
            margin: auto;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row h-100">
            <!-- KIRI -->
            <div class="col-md-6 login-left d-flex align-items-center justify-content-center">
                <div class="overlay"></div>
                <div class="content text-center">
                    <img src="/apksawsmanli/public/assets/logo.png" alt="Logo Sekolah" style="max-width: 120px;">
                    <h4 class="mt-3">SISTEM PENUNJANG KEPUTUSAN</h4>
                    <h2>PENENTUAN SISWA BERPRESTASI</h2>
                </div>
            </div>

            <!-- KANAN -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="login-form w-100">
                    <h3 class="mb-4 text-center">Register</h3>
                    <form action="/apksawsmanli/auth/register" method="POST">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Daftar</button>
                    </form>
                    <div class="mt-3 text-center">
                        Sudah punya akun? <a href="/apksawsmanli/auth/login">Login sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
