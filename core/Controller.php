<?php
class Controller {
    public function __construct() {
        if (isset($_GET['url']) && strpos($_GET['url'], 'logout') !== false) {
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $current = get_class($this);

        if (!isset($_SESSION['user'])) {
            if ($current !== 'AuthController') {
                header('Location: /spk-saw-siswa-sma5serang-app/auth/login');
                exit;
            }
        } else {
            if ($current === 'AuthController') {
                if ($_SESSION['user']['role'] === 'admin') {
                    header('Location: /spk-saw-siswa-sma5serang-app/admin/dashboard');
                } else {
                    header('Location: /spk-saw-siswa-sma5serang-app/user/landing/home');
                }
                exit;
            }
        }
    }

    public function model($model) {
        require_once __DIR__ . '/../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = []) {
        extract($data);
        ob_start();
        require_once __DIR__ . '/../app/views/' . $view . '.php';
        $content = ob_get_clean();
        $authViews = ['auth/login', 'auth/register'];
        if (!in_array($view, $authViews)) {
            if (isset($_SESSION['user']['role'])) {
                if ($_SESSION['user']['role'] === 'admin') {
                    require_once __DIR__ . '/../app/views/layouts/adminLayout.php';
                } else {
                    require_once __DIR__ . '/../app/views/layouts/userLayout.php';
                }
            } else {
                require_once __DIR__ . '/../app/views/layout.php';
            }
        } else {
            echo $content;
        }
            
    }
}
