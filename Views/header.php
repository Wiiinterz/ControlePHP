<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Social Network</title>
</head>
<body class="p-2">
    <nav class="navbar navbar-expand-lg">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item d-flex align-items-center">
                <a class="btn btn-outline-dark boutons_nav" href="?c=listMessages">Feed des messages</a>
            </li>
            <?php if (isset($_SESSION['id'])) { ?>
                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-outline-dark boutons_nav" href="?c=createPost">Créer un message</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-dark boutons_nav" href="?c=profil">Mon profil</a>
                </li>
            <?php } ?> 
            <li>
<<<<<<< Updated upstream
                <button id="theme-toggle" class="btn btn-secondary boutons_nav">Mode sombre</button>
=======
                <div class="theme-toggle">
                  <img id="theme-icon" src="sun.png" alt="Mode clair" class="theme-icon">
                </div>
>>>>>>> Stashed changes
            </li>

            

        </ul>
        <div id="Logo">
            <img id="logo" src="Logo.png" alt="Logo" class="logo">
        </div>
        <div class="connexion">
                <?php if (isset($_SESSION['id'])) { ?>
                    <ul class="nav d-flex flex-row">
                        <li class="nav-item  align-items-center">
                            <a class="btn btn-outline-dark boutons_nav" href="?c=deconnexion">Déconnexion</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav d-flex flex-row">
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-dark boutons_nav"  href="?c=inscription">Inscription</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-dark boutons_nav"  href="?c=login">Connexion</a>
                        </li>
                    </ul>   
                <?php } ?> 
            </div>
    </nav>

    <div class="container-fluid">