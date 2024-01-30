<?php


class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($data) {
        $stmt = $this->conn->prepare("INSERT INTO students (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['username'], $data['password']);
        $stmt->execute();
    }

    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); 
    }

    public function updateUser($id, $data) {
        $stmt = $this->conn->prepare("UPDATE students SET courses = ?, class = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data['courses'], $data['class'], $id);
        $stmt->execute();
    }
}

?>
