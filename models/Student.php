<?php
class Student {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM students ORDER BY id DESC")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $ic, $marks) {
        $stmt = $this->pdo->prepare("INSERT INTO students (name, ic, marks) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $ic, $marks]);
    }

    public function update($id, $name, $ic, $marks) {
        $stmt = $this->pdo->prepare("UPDATE students SET name=?, ic=?, marks=? WHERE id=?");
        return $stmt->execute([$name, $ic, $marks, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>