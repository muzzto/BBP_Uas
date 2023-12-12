<?php

class DBManager {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
}

class TodoHandler {
    private $todoManager;

    public function __construct($conn) {
        $this->todoManager = new TodoManager($conn);
    }

    public function handleAddTodo() {
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $result = $this->todoManager->addTodo($title);

            $this->redirect($result);
        } else {
            $this->redirect('error');
        }
    }

    private function redirect($result) {
        $location = '../index.php?mess=' . $result;
        header("Location: $location");
        exit();
    }
}

require '../db_conn.php';

$todoHandler = new TodoHandler($conn);
$todoHandler->handleAddTodo();
