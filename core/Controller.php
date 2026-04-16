<?php

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function view($view, $data = [])
    {
        extract($data);
        $viewPath = '../app/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            include '../app/views/layouts/base.php';
        } else {
            die("View não encontrada: " . $view);
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . '/' . $url);
        exit;
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
