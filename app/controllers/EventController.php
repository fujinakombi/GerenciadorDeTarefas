<?php
class EventController extends Controller
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

        require_once '../app/models/Event.php';
        $eventModel = new Event($this->db);

        $data = [
            'events' => $eventModel->getEventsByUser($_SESSION['user_id'])
        ];

        $this->view('events/index', $data);
    }

    public function create()
    {
        $this->checkAuth();
        $this->view('events/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->checkAuth();

            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $location = $_POST['location'] ?? '';
            $eventDate = $_POST['event_date'] ?? '';
            if (empty($title) || empty($description) || empty($location) || empty($eventDate)) {
                $_SESSION['error'] = 'Todos os campos são obrigatórios!';
                $this->redirect('event/create');
            }

            require_once '../app/models/Event.php';
            $eventModel = new Event($this->db);

            if ($eventModel->create($_SESSION['user_id'], $title, $description, $location, $eventDate)) {
                $_SESSION['success'] = 'Evento criado com sucesso!';
                $this->redirect('event');
            } else {
                $_SESSION['error'] = 'Erro ao criar evento!';
                $this->redirect('event/create');
            }
        }
    }

    public function edit($id)
    {
        $this->checkAuth();

        require_once '../app/models/Event.php';
        $eventModel = new Event($this->db);
        $event = $eventModel->findById($id);

        if (!$event) {
            $_SESSION['error'] = 'Evento não encontrado!';
            $this->redirect('event');
        }

        $data = ['event' => $event];
        $this->view('events/edit', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->checkAuth();

            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $location = $_POST['location'] ?? '';
            $eventDate = $_POST['event_date'] ?? '';

            if (empty($title) || empty($description) || empty($location) || empty($eventDate)) {
                $_SESSION['error'] = 'Todos os campos são obrigatórios!';
                $this->redirect('event/edit/' . $id);
            }

            require_once '../app/models/Event.php';
            $eventModel = new Event($this->db);

            if ($eventModel->update($id, $title, $description, $location, $eventDate)) {
                $_SESSION['success'] = 'Evento atualizado com sucesso!';
                $this->redirect('event');
            } else {
                $_SESSION['error'] = 'Erro ao atualizar evento!';
                $this->redirect('event/edit/' . $id);
            }
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        require_once '../app/models/Event.php';
        $eventModel = new Event($this->db);

        if ($eventModel->delete($id)) {
            $_SESSION['success'] = 'Evento deletado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao deletar evento!';
        }

        $this->redirect('event');
    }
}
