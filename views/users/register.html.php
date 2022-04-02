
    <form class="form logreg reg" action="" method="post">
        <h1>Je crée mon compte</h1>
        <div class="form-group">
            <input id="email" type="email" name="email" required>
            <label for="email">E-mail *</label>
            <div class="error-msg"><?= $error_email ?></div>
        </div>
            
        <div class="form-group">
            <input id="surname" type="text" name="surname" required>
            <label for="surname">Prénom *</label>
            <div class="error-msg"><?= $error_surname ?></div>
        </div>

        <div class="form-group">
            <input id="name" type="text" name="name" required>
            <label for="name">Nom *</label>
            <div class="error-msg"><?= $error_name ?></div>
        </div>

        <div class="form-group">
            <input id="password" type="password" name="password" required>
            <label for="password">Mot de passe *</label>
            <div class="error-msg"><?= $error_password ?></div>
        </div>
        <div class="form-group">    
            <input id="validPassword" type="password" name="validPassword" required>
            <label for="validPassword">Valider mot de passe *</label>
            <div class="error-msg"><?= $error_validPassword ?></div>
        </div>
        
        <input class="submit" type="submit" name="submit" value="Créer un compte">
        <p class="help">* champs obligatoires</p>

        <p class="sous_texte">Vous avez déjà un compte ? <a href="<?= url ?>users/login"> Connectez-vous</a></p>

    </form>