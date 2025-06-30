<?php
class Controller {
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
            require_once __DIR__ . '/../app/views/layout.php';
        } else {
            echo $content;
        }
        
    }
}
