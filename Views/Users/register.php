<h1>Inscription</h1>

<form action="?c=inscrire" method="post">

    <div class="mb-3">
        <label for="identifiant" class="form-label">Nom</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" required>
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" name="email" id="email" required></textarea>
    </div>
    <div class="mb-3">
        <label for="pwd" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="pwd" id="pwd" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="enregistrer">Enregistrer</button>
    </div>
</form>