<?php

class Router
{
    private $controller = 'AuthController';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $this->parseUrl();
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if (isset($url[0]) && $url[0] != '') {
                $this->controller = ucfirst($url[0]) . 'Controller';
            }

            if (isset($url[1]) && $url[1] != '') {
                $this->method = $url[1];
            }

            if (count($url) > 2) {
                $this->params = array_slice($url, 2);
            }
        }
    }

    public function execute()
    {
        $controllerFile = '../app/controllers/' . $this->controller . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($this->controller)) {
                $controller = new $this->controller();

                if (method_exists($controller, $this->method)) {
                    call_user_func_array(
                        array($controller, $this->method),
                        $this->params
                    );
                } else {
                    die("Método {$this->method} não encontrado em {$this->controller}");
                }
            } else {
                die("Classe {$this->controller} não encontrada");
            }
        } else {
            die("Controlador não encontrado: {$this->controller}");
        }
    }
}
