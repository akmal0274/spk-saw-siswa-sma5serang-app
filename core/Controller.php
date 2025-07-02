<?php
class Controller {
    public function __construct()
    {
        // Cek session login
        if (!isset($_SESSION['user'])) {
            // Kecuali untuk controller Auth
            if (get_class($this) !== 'AuthController') {
                header('Location: /spk-saw-siswa-sma5serang-app/auth/login');
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
