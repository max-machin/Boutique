
<form action="" method="post">
    <label for="email">E-mail *</label></br>
    <input id="email" type="email" name="email" placeholder="Email"></br>
    <span><?= $error_email ?></span></br>

    <label for="surname">Prénom *</label></br>
    <input id="surname" type="text" name="surname" placeholder="Prénom"></br>
    <span><?= $error_surname ?></span></br>

    <label for="name">Nom *</label></br>
    <input id="name" type="text" name="name" placeholder="Nom"></br>
    <span><?= $error_name ?></span></br>

    <label for="password">Mot de passe *</label></br>
    <input id="password" type="password" name="password" placeholder="Mot de passe"></br>
    <span><?= $error_new_password ?></span></br>

    <label for="validPassword">Valider mot de passe *</label></br>
    <input id="validPassword" type="password" name="validPassword" placeholder="Confirmez mot de passe"></br>
    <span><?= $error_validPassword ?></span></br>

    <label for="adresse">Adresse</label></br>
    <input id="adresse" type="text" name="adresse" placeholder="Adresse"></br>

    <input type="submit" name="submit">
</form>

<p>* champs obligatoires</p>