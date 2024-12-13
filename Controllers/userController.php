<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

class userController {

    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function inscription() {
        require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'register.php');
    }

    function connexion() {
        require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'login.php');
    }
}