<?php

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('User')->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];

                if ($user['role'] === 'admin') {
                    header('Location: /spk-saw-siswa-sma5serang-app/admin/dashboard');
                } else {
                    header('Location: /spk-saw-siswa-sma5serang-app/user/dashboard');
                }
                exit;
            } else {
                $_SESSION['login_error'] = "Username atau password salah.";
            }
        }

        $this->view('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->model('User')->create($username, $email, $password);
            $_SESSION['success'] = "Pendaftaran berhasil. Silakan login.";
            header('Location: /spk-saw-siswa-sma5serang-app/auth/login');
            exit;
        }

        $this->view('auth/register');
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_regenerate_id(true);
        header('Location: /spk-saw-siswa-sma5serang-app/auth/login');
        exit;
    }





}
