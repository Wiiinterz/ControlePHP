<?php

session_start();
require_once(__DIR__.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'connectDb.php');

require_once(__DIR__.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'userController.php');

require_once(__DIR__.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'postController.php');

require_once(__DIR__.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'commentController.php');

if(!isset($_GET["x"])){
    require_once(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'header.php');
}

$userController = new UserController($pdo);
$postController = new PostController($pdo);
$commentController = new CommentController($pdo);

if (isset($_GET['c'])) {
    $c = $_GET['c'];

    switch ($c) {
        case 'inscription':
            $userController->inscription();    
            break;

        case 'inscrire':
            $userController->enregistrer();
            break;
                
        case 'verifieconnexion':
            $userController->verifieConnexion();
            break;
                
        case 'login':
            require_once(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'login.php');
            break;

        case 'deconnexion':
            $userController->deconnexion();
            break;

        case 'addMessage':
            $postController->addMessage();
            break;

        case 'listMessages':
            $postController->listMessages();
            break;
        
        case 'createPost':
            $postController->create();
            break;

        case 'editMessage':
            $postController->editMessage();
            break;

        case 'updateMessage':
            $postController->updateMessage();
            break;

        case 'deleteMessage':
            $postController->deleteMessage();
            break;
        
        case 'commentMessage':
            $commentController->addComment();
            break;

        case 'showPostComment':
            $commentController->showPostComment();
            break;

        default:
            $postController->listMessages();
            break;
    }
}

if(!isset($_GET["x"])){
    require_once __DIR__  . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'footer.php';
}
?>