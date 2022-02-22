<form action="" method="post">
    <input type="email" name="email" placeholder="Email">
    <span><?= $error_email ?></span>
    <input type="text" name="surname" placeholder="Prénom">
    <span><?= $error_surname ?></span>
    <input type="text" name="name" placeholder="Nom">
    <span><?= $error_name ?></span>
    <input type="password" name="password" placeholder="Mot de passe">
    <span><?= $error_password ?></span>
    <input type="password" name="validPassword" placeholder="Confirmez mot de passe">
    <span><?= $error_validPassword ?></span>
    <input type="text" name="Adresse" placeholder="Adresse">
    <input type="submit" name="submit">
</form>