<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des messages</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div id="postPage" class="container mt-5">
        <h1 class="mb-4">Liste des messages</h1>
        <div id="feed">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="post" data-post-id="<?= $message['id']; ?>">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($message['titre']); ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($message['contenu'])); ?></p>
                                <p class="card-text"><small class="text-muted">Posté par : <?= htmlspecialchars($message['nom_utilisateur']); ?> le <?= $message['date_publication']; ?></small></p>
                                <div id="buttons_for_post">
                                    <?php if (isset($_SESSION['id'])): ?>
                                        <button class="btn btn-outline-success btn-sm comment-button" data-post-id="<?= $message['id']; ?>">Commenter</button>
                                    <?php endif; ?>

                                    <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $message['utilisateur_id']): ?>
                                        <div id="utils_connected_user">
                                            <a class="btn btn-outline-primary btn-sm" href="index.php?c=editMessage&id=<?= $message['id']; ?>">Modifier</a>
                                            <a class="btn btn-outline-danger btn-sm" href="index.php?c=deleteMessage&id=<?= $message['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">Supprimer</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="comment-div-show">
                                </div>
                            </div>
                        </div>
                    <div class="show-comment">
                    </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun message disponible.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
