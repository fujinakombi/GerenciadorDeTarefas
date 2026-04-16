<?php

class Task {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTasksByUser($userId) {
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingTasks($userId) {
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tasks WHERE user_id = ? AND completed = FALSE ORDER BY created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($userId, $title) {
    {
        $stmt = $this->db->prepare(
            "INSERT INTO tasks (user_id, title, completed, created_at) VALUES (?, ?, FALSE, NOW())"
        );
        return $stmt->execute([$userId, $title]);
    }

    public function markAsCompleted($id) {
    {
        $stmt = $this->db->prepare("UPDATE tasks SET completed = TRUE WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function markAsIncomplete($id) {
    {
        $stmt = $this->db->prepare("UPDATE tasks SET completed = FALSE WHERE id = ?");
        return $stmt->execute([$id]);
    }


    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
