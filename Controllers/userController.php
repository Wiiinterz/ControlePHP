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
        if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
            $requete = $this->pdo->prepare('SELECT * FROM users WHERE id = :id AND email = :email');
            $requete->bindParam(':id', $_SESSION['id']);
            $requete->bindParam(':email', $_SESSION['email']);
            $requete->execute();
            $user = $requete->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'profil.php');
            } else {
                echo "Utilisateur non trouvé.";
            }
        } else {
            header('Location: ?c=login');
            exit();
        }
    }

    function modifier_profil() {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
            exit();
        }
    
        $id = $_SESSION['id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
    
        $requete = $this->pdo->prepare('UPDATE users SET nom = :nom, email = :email WHERE id = :id');
        $requete->bindParam(':id', $id);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':email', $email);
    
        $modifOk = $requete->execute();
    
        if ($modifOk) {
            echo "Profil modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du profil.";
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

    function verifieConnexion() {
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        
        $requete = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $requete->bindParam(':email', $email);
        $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
    
    
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['identifiant'] = $user['identifiant'];
            $_SESSION['email'] = $user['email'];

            header('Location: ?c=listMessages');
            
        } else {
            require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Users' . DIRECTORY_SEPARATOR . 'login.php');

            echo "Mot de passe incorrect.";
        }
        
    }

    function deconnexion() {
        session_destroy();
        header('Location: ?c=listMessages');
    }
}