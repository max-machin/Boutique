<h2>Vos informations personnelles</h2>
<?php
var_dump($user);
?>
<form action="" method="post">
    <label for="email">E-mail *</label></br>
    <input id="email" type="email" name="email" value="<?= $user->email ?>"></br>

    <label for="surname">Prénom *</label></br>
    <input id="surname" type="text" name="surname" value="<?= $user->prenom ?>"></br>

    <label for="name">Nom *</label></br>
    <input id="name" type="text" name="name" value="<?= $user->nom ?>"></br>

    <label for="password">Mot de passe *</label></br>
    <input id="password" type="password" name="password" placeholder="Password"></br>

    <label for="validPassword">Valider mot de passe *</label></br>
    <input id="validPassword" type="password" name="validPassword" placeholder="Confirmez mot de passe"></br>

    <label for="adresse">Adresse</label></br>
    <input id="adresse" type="text" name="adresse" value="<?= $user->adresse ?>"></br>

    <input type="submit" name="submit">
</form>

<h2>Vos dernières commandes</h2>