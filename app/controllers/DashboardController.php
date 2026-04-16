<?php

class DashboardController extends Controller
{

    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }
    }

    public function index()
    {
        $this->checkAuth();

        require_once '../app/models/Task.php';
        require_once '../app/models/Event.php';

        $taskModel = new Task($this->db);
        $eventModel = new Event($this->db);

        $userId = $_SESSION['user_id'];

        $data = [
            'tasks' => $taskModel->getPendingTasks($userId),
            'allTasks' => $taskModel->getTasksByUser($userId),
            'totalEvents' => $eventModel->countByUser($userId)
        ];

        $this->view('dashboard/index', $data);
    }

    public function addTask()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->checkAuth();

            $title = $_POST['title'] ?? '';

            if (empty($title)) {
                $_SESSION['error'] = 'O título da tarefa é obrigatório!';
                $this->redirect('dashboard');
            }

            require_once '../app/models/Task.php';
            $taskModel = new Task($this->db);

            if ($taskModel->create($_SESSION['user_id'], $title)) {
                $_SESSION['success'] = 'Tarefa adicionada com sucesso!';
            } else {
                $_SESSION['error'] = 'Erro ao adicionar tarefa!';
            }

            $this->redirect('dashboard');
        }
    }
    public function completeTask($taskId)
    {
        $this->checkAuth();

        require_once '../app/models/Task.php';
        $taskModel = new Task($this->db);

        if ($taskModel->markAsCompleted($taskId)) {
            $_SESSION['success'] = 'Tarefa marcada como concluída!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar tarefa!';
        }

        $this->redirect('dashboard');
    }
    public function incompleteTask($taskId)
    {
        $this->checkAuth();

        require_once '../app/models/Task.php';
        $taskModel = new Task($this->db);

        if ($taskModel->markAsIncomplete($taskId)) {
            $_SESSION['success'] = 'Tarefa marcada como não concluída!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar tarefa!';
        }

        $this->redirect('dashboard');
    }

    public function deleteTask($taskId)
    {
        $this->checkAuth();

        require_once '../app/models/Task.php';
        $taskModel = new Task($this->db);

        if ($taskModel->delete($taskId)) {
            $_SESSION['success'] = 'Tarefa deletada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao deletar tarefa!';
        }

        $this->redirect('dashboard');
    }
}
