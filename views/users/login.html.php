<form action="" method="post">
    <?= $error ?><br/>

    <label for="email">E-mail *</label></br>
    <input id="email" type="email" name="email" placeholder="Email"></br>
    <span><?= $error_email ?></span></br>

    <label for="password">Mot de passe *</label></br>
    <input id="password" type="password" name="password" placeholder="Mot de passe"></br>
    <span><?= $error_password ?></span></br>

    <a href="forgotPassword">Mot de passe oublié?</a><br>

    <input type="submit" name="submit">
</form>