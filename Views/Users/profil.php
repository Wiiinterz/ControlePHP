<script src="script.js"></script>
<script src="theme.js"></script>

<h1>Profil de l'utilisateur : <span id='profil_identifiant_titre'><?php echo $user['nom']; ?></span></h1>
<div class="row">
    <div class="col">
        <p><b>Identifiant : </b> <span id='profil_identifiant' date-id="<?php echo $user['id']; ?>" contenteditable="true"><?php echo $user['nom'];?></span></p>
        <p><b>Email : </b> <span id='profil_mail' data-id="<?php echo $user['id']; ?>" contenteditable="true"><?php echo $user['email'];?></span></p>
    </div>
<hr>
<div id='boutons'>
    <a href="?c=listMessages" class='btn btn-primary'>Retour au feed</a>
    <button id='bouton_modifier_profil' class='btn btn-primary d-none'>Modifier le profil</button>
</div>