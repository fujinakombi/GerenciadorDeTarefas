<?php
class AuthController extends Controller
{

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        $this->view('auth/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email e senha são obrigatórios!';
                $this->redirect('');
            }

            require_once '../app/models/User.php';
            $userModel = new User($this->db);

            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $this->redirect('dashboard');
            } else {
                $_SESSION['error'] = 'Email ou senha incorretos!';
                $this->redirect('');
            }
        }
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        $this->view('auth/register');
    }

    public function storeRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $_SESSION['error'] = 'Todos os campos são obrigatórios!';
                $this->redirect('auth/register');
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'As senhas não coincidem!';
                $this->redirect('auth/register');
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'A senha deve ter pelo menos 6 caracteres!';
                $this->redirect('auth/register');
            }

            require_once '../app/models/User.php';
            $userModel = new User($this->db);

            if ($userModel->register($name, $email, $password)) {
                $_SESSION['success'] = 'Cadastro realizado com sucesso! Faça login.';
                $this->redirect('');
            } else {
                $_SESSION['error'] = 'Email já cadastrado ou erro ao registrar!';
                $this->redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('');
    }
}
