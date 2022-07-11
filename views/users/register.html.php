
    <form class="form logreg reg" action="" method="post">
        <h1>Set up your account</h1>
        <div class="form-group">
            <input id="email" type="email" name="email" required>
            <label for="email">E-mail *</label>
            <div class="error-msg"><?= $error_email ?></div>
        </div>
            
        <div class="form-group">
            <input id="surname" type="text" name="surname" required>
            <label for="surname">First name*</label>
            <div class="error-msg"><?= $error_surname ?></div>
        </div>

        <div class="form-group">
            <input id="name" type="text" name="name" required>
            <label for="name">Last Name *</label>
            <div class="error-msg"><?= $error_name ?></div>
        </div>

        <div class="form-group">
            <input id="password" type="password" name="password" required>
            <label for="password">Password *</label>
            <div class="error-msg"><?= $error_password ?></div>
        </div>
        <div class="form-group">    
            <input id="validPassword" type="password" name="validPassword" required>
            <label for="validPassword">Confirm the password *</label>
            <div class="error-msg"><?= $error_validPassword ?></div>
        </div>
        
        <input class="submit" type="submit" name="submit" value="Créer un compte">
        <p class="help">* required fields</p>

        <p class="sous_texte">Already have an account? <a href="<?= url ?>users/login"> Sign in</a></p>

    </form>