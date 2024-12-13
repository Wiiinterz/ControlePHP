<?php

require_once (__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'post.php');

class PostController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function create() {
        require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Post' . DIRECTORY_SEPARATOR . 'create.php');
    }

 
    public function listMessages() {
        $messageModel = new Message($this->pdo);
        $messages = $messageModel->getAllMessages();

        require 'Views/Post/index.php';
    }

    public function addMessage() {
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?c=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $userId = $_SESSION['id'];

            $messageModel = new Message($this->pdo);
            $result = $messageModel->createMessage($title, $content, $userId);

            if ($result) {
                header('Location: index.php?c=listMessages');
                exit;
            } else {
                echo "Erreur lors de l'ajout du message.";
            }
        }
    }

    /**
     * Affiche le formulaire pour modifier un message
     */
    public function editMessage() {

        $messageId = $_GET['id'] ?? null;
        if ($messageId) {
            $messageModel = new Message($this->pdo);
            $message = $messageModel->getMessageById($messageId);

            if ($message && $message['utilisateur_id'] === $_SESSION['id']) {
                require 'Views/Post/edit.php';
            } else {
                echo "Vous n'avez pas la permission de modifier ce message.";
            }
        }
    }

    /**
     * Met à jour un message existant
     */
    public function updateMessage() {
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?c=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['title'], $_POST['content'])) {
            $messageId = $_POST['id'];
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $userId = $_SESSION['id'];

            $messageModel = new Message($this->pdo);
            $result = $messageModel->updateMessage($messageId, $title, $content, $userId);

            if ($result) {
                header('Location: index.php?c=listMessages');
                exit;
            } else {
                echo "Erreur lors de la mise à jour du message.";
            }
        }
    }

    /**
     * Supprime un message
     */
    public function deleteMessage() {
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?c=login');
            exit;
        }

        $messageId = $_GET['id'] ?? null;
        if ($messageId) {
            $userId = $_SESSION['id'];
            $messageModel = new Message($this->pdo);
            $result = $messageModel->deleteMessage($messageId, $userId);

            if ($result) {
                header('Location: index.php?c=listMessages');
                exit;
            } else {
                echo "Erreur lors de la suppression du message ou permission refusée.";
            }
        }
    }
}