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

    protected function redirect($result) {
        $location = '../index.php?mess=' . $result;
        header("Location: $location");
        exit();
    }

    // Getter untuk mendapatkan todoManager
    public function getTodoManager() {
        return $this->todoManager;
    }

    // Setter untuk mengatur todoManager
    public function setTodoManager($todoManager) {
        $this->todoManager = $todoManager;
    }
}

class TodoHandlerOverride extends TodoHandler {
    // Overriding handleAddTodo
    public function handleAddTodo() {
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $result = $this->getTodoManager()->addTodo($title); // Menggunakan getter

            $this->redirect($result);
        } else {
            $this->redirect('error');
        }
    }
}

require '../db_conn.php';

$todoHandler = new TodoHandlerOverride($conn); // Menggunakan TodoHandlerOverride
$todoHandler->handleAddTodo();
