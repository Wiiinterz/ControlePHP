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

    function profil() {
        if (isset($_SESSION['id']) && isset($_SESSION['mail'])) {
            $requete = $this->pdo->prepare('SELECT * FROM users WHERE id = :id AND mail = :mail');
            $requete->bindParam(':id', $_SESSION['id']);
            $requete->bindParam(':mail', $_SESSION['mail']);
            $requete->execute();
            $user = $requete->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Users' . DIRECTORY_SEPARATOR . 'profil.php');
            } else {
                echo "Utilisateur non trouvé.";
            }
        } else {
            header('Location: ?c=login');
            exit();
        }
    }

    function enregistrer() {
        $nom = $_POST['identifiant'];
        $password = $_POST['pwd'];
        $email = $_POST['email'];
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $requete = $this->pdo->prepare('INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)');
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':password', $hashedPassword);
        $requete->bindParam(':email', $email);
    
        $ajoutOk = $requete->execute();
    
        if ($ajoutOk) {
            require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'login.php');
        } else {
            echo "Erreur lors de l'enregistrement de l'utilisateur.";
        }
    }
}