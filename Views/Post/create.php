<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un message</title>
</head>
<body>
    <div id="createPost">
        <h1>Créer un nouveau message</h1>

        <form action="index.php?c=addMessage" method="post">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Contenu :</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <button type="submit">Publier</button>
        </form>
    </div>
</body>
</html>