<form class="form logreg" action="" method="post">
    <h1>Je me connecte</h1>
    
    <div class="form-group">
        <input id="email" type="email" name="email" required>
        <label for="email">E-mail *</label>
        <div class="error-msg">
            <?= $error ?>
            <?= $error_email ?>
        </div>
    </div>

    <div class="form-group">
        <input id="password" type="password" name="password" required>
        <label for="password">Mot de passe *</label>
        <div class="error-msg">
            <?= $error_password ?>
        </div>
    </div>

    <a class="help bold" href="users/forgotPassword">Mot de passe oublié ?</a><br>

    <input class="submit login" type="submit" name="submit" value="Connexion">
    <p class="sous_texte">Pas encore inscrit ? <a href="<?= url ?>users/register"> Rejoignez-nous</a></p>
</form>

