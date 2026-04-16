<?php

class Event
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getEventsByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($userId, $title, $description, $location, $eventDate)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO events (user_id, title, description, location, event_date, created_at) 
             VALUES (?, ?, ?, ?, ?, NOW())"
        );
        return $stmt->execute([$userId, $title, $description, $location, $eventDate]);
    }

    public function update($id, $title, $description, $location, $eventDate)
    {
        $stmt = $this->db->prepare(
            "UPDATE events SET title = ?, description = ?, location = ?, event_date = ? WHERE id = ?"
        );
        return $stmt->execute([$title, $description, $location, $eventDate, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM events WHERE user_id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
