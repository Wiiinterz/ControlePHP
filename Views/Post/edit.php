<script src="theme.js"></script>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un message</title>
</head>
<body>
    <div id="editPost">
        <h1>Modifier un message</h1>
        <form action="index.php?c=updateMessage" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($message['id']); ?>">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($message['titre']); ?>" required>
            </div>
            <div>
                <label for="content">Contenu :</label>
                <textarea id="content" name="content" required><?= htmlspecialchars($message['contenu']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-outline-primary btn-sm">Mettre à jour</button>
        </form>
    </div>
</body>
</html>