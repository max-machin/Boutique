<form class="form logreg" action="" method="post">
    <h1>Log in</h1>
    
    <div class="form-group">
        <input id="email" type="email" name="email" value="machin.max@laplateforme.io" required>
        <label for="email">E-mail *</label>
        <div class="error-msg">
            <?= $error ?>
            <?= $error_email ?>
        </div>
    </div>

    <div class="form-group">
        <input id="password" type="password" name="password" value="123456AZ" required>
        <label for="password">Password *</label>
        <div class="error-msg">
            <?= $error_password ?>
        </div>
    </div>

    <a class="help bold" href="users/forgotPassword">Forgot password ?</a><br>

    <input class="submit login" type="submit" name="submit" value="Connexion">
    <p class="sous_texte">Not registered yet ? <a href="<?= url ?>users/register">Join us</a></p>
</form>

