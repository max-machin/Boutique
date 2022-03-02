<h2>Vos informations personnelles</h2>
<form action="" method="post">
    <label for="email">E-mail *</label></br>
    <input id="email" type="email" name="email" value="<?= $user->email ?>"></br>

    <label for="surname">Prénom *</label></br>
    <input id="surname" type="text" name="surname" value="<?= $user->prenom ?>"></br>

    <label for="name">Nom *</label></br>
    <input id="name" type="text" name="name" value="<?= $user->nom ?>"></br>

    <label for="adresse">Adresse</label></br>
    <input id="adresse" type="text" name="adresse" value="<?= $user->adresse ?>"></br>

    <input type="submit" name="submit" value="Modifier infos">
</form>

<form action="" method="post" style="display: <?= $display1 ?>">
    <label for="oldPassword">Ancien mot de passe *</label></br>
    <input id="oldPassword" type="password" name="oldPassword" placeholder="******"></br>
    <span><?= $error_old_password ?></span></br>
    <input type="submit" name="subPassword" value="Confirmer password">
</form>

<form action="" method="post" style="display: <?= $display2 ?>">
    <label for="newPassword">Nouveau mot de passe *</label></br>
    <input id="newPassword" type="password" name="newPassword" placeholder="******"></br>
    <span><?= $error_new_password ?></span></br>

    <label for="validPassword">Valider mot de passe *</label></br>
    <input id="validPassword" type="password" name="validPassword" placeholder="Confirmer mot de passe"></br>
    <span><?= $error_validPassword ?></span></br>
    <input type="submit" name="subNewPassword" value="Modifier password">
</form>

<h2>Vos dernières commandes</h2>