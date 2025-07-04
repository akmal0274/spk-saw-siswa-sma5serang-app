<?php
class App {
    public static $currentController = '';
    public static $currentMethod = '';

    protected $controllerName = 'AuthController';
    protected $controller;
    protected $method = 'login';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Default prefix: none
        $prefix = '';

        if (isset($url[0])) {
            $first = strtolower($url[0]);

            if ($first === 'admin' || $first === 'user') {
                $prefix = ucfirst($first); // Admin/User
                unset($url[0]);

                if (isset($url[1])) {
                    $controllerName = ucfirst($url[1]) . 'Controller';
                    $controllerPath = __DIR__ . '/../app/controllers/' . $prefix . $controllerName . '.php';

                    if (file_exists($controllerPath)) {
                        $this->controllerName = $prefix . $controllerName;
                        unset($url[1]);
                    } else {
                        die("Controller NOT FOUND: " . $controllerPath);
                    }
                } else {
                    // default dashboard
                    $this->controllerName = $prefix . 'DashboardController';
                }

            } elseif ($first === 'auth') {
                if (isset($url[1])) {
                    $controllerName = ucfirst($url[1]) . 'Controller';
                    $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

                    if (file_exists($controllerPath)) {
                        $this->controllerName = $controllerName;
                        unset($url[1]);
                    } else {
                        $this->controllerName = 'AuthController';
                    }
                } else {
                    $this->controllerName = 'AuthController';
                }
                unset($url[0]);
            } else {
                // fallback default ➜ jika root: redirect ke login atau dashboard tergantung session
                $this->controllerName = 'AuthController';
            }
        }

        self::$currentController = $this->controllerName;

        require_once __DIR__ . '/../app/controllers/' . $this->controllerName . '.php';
        $this->controller = new $this->controllerName;

        if (strpos(get_class($this->controller), 'AdminDashboardController') !== false) {
            $this->method = 'index';
        } elseif (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
            unset($url[2]);
        } elseif (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } else {
            if ($this->controller === 'AuthController') {
                $this->method = 'login';
            } else {
                $this->method = 'index';
            }
        }

        self::$currentMethod = $this->method;

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
