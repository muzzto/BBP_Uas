<?php

class Database {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getConn() {
        return $this->conn;
    }
}

class PengelolaTodo {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function hapusTodo($id) {
        if (empty($id)) {
            return 0;
        }

        $stmt = $this->db->getConn()->prepare("DELETE FROM todos WHERE id=?");
        $res = $stmt->execute([$id]);

        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }
}

if (isset($_POST['id'])) {
    require '../db_conn.php';

    $id = $_POST['id'];

    $database = new Database($conn);
    $pengelolaTodo = new PengelolaTodo($database);
    $hasil = $pengelolaTodo->hapusTodo($id);

    echo $hasil;
} else {
    header("Location: ../index.php?mess=error");
}

