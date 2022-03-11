<form class="form" action="" method="post">
    <h1>Je me connecte</h1>
    <?= $error ?><br/>

    <div class="form-group">
        <input id="email" type="email" name="email" required>
        <label for="email">E-mail *</label>
        <span><?= $error_email ?></span>
    </div>

    <div class="form-group">
        <input id="password" type="password" name="password" required>
        <label for="password">Mot de passe *</label>
        <span><?= $error_password ?></span>
    </div>

    <a class="help forgot" href="forgotPassword">Mot de passe oublié ?</a><br>

    <input class="submit login" type="submit" name="submit" value="Connexion">

    <p class="sous_texte">Pas encore inscrit? <a href="<?= url ?>users/register"> Rejoignez-vous</a></p>
</form>

