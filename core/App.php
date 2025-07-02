<?php
class App {
    public static $currentController = '';
    public static $currentMethod = '';

    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Default namespace/prefix
        $prefix = '';

        // Cek prefix (admin/user)
        if (isset($url[0]) && in_array(strtolower($url[0]), ['admin', 'user'])) {
            $prefix = ucfirst(strtolower($url[0])); // Admin atau User
            unset($url[0]);
        }

        // Ambil controller
        if (isset($url[1])) {
            $controllerName = ucfirst($url[1]) . 'Controller';
            $controllerPath = __DIR__ . '/../app/controllers/' . $prefix . $controllerName . '.php';
            if (file_exists($controllerPath)) {
                $this->controller = $prefix . $controllerName;
                unset($url[1]);
            }
        } else {
            // Default controller
            if ($prefix) {
                $this->controller = $prefix . 'DashboardController';
            }
        }

        // Save nama untuk global
        self::$currentController = $this->controller;

        require_once __DIR__ . '/../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
            }
        }

        self::$currentMethod = $this->method;

        // Params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
