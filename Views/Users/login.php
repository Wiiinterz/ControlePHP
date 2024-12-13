<script src="theme.js"></script>
<h1>Connexion</h1>

<form action="?c=verifieconnexion" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="pwd" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="pwd" id="pwd" required></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="enregistrer">Se connecter</button>
    </div>

</form>