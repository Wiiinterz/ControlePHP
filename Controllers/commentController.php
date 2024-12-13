<?php

requireonce(_DIR.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'comment.php');

class CommentController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }



    public function addComment() {
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?c=login');
            exit;
        }

        $content = htmlspecialchars($_POST['content']);
        $userId = $_SESSION['id'];
        $postId = $_GET['post_id'];

        $commentModel = new Comment($this->pdo);
        $result = $commentModel->addComment($content, $userId, $postId);
    }

    public function showPostComment(){
        $postId = $_GET['post_id'];
        $commentModel = new Comment($this->pdo);
        $comments = $commentModel->getCommentsByPostId($postId);

        echo json_encode($comments);
    }

}