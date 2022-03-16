

<form id="concours-form" class="form" action="" method="post">
        <h1>Jeux concours</h1>
        <div class="form-group">
            <input id="email" type="email" name="email" >
            <label for="email">E-mail *</label>
            
        </div>
            
        <div class="form-group">
            <input id="surname" type="text" name="surname" >
            <label for="surname">Prénom *</label>
            
        </div>

        <h2>Informations de livraison</h2>

        <div class="form-group">
            <input type="text" name="adresse" id="adresse" >
            <label for="adresse">Adresse *</label>
        </div>

        <div class="form-group">
            <input type="text" name="codePostale" id="codePostale" >
            <label for="codePostale">Code postale *</label>
        </div>

        <div class="form-group">
            <input type="text" name="ville" id="ville" >
            <label for="ville">Ville *</label>
        </div>    
        
        <p><?= $error ?></p>
        <p><?= $success ?></p>
        <input class="submit" type="submit" name="submit" value="PARTICIPER">
        <p class="help">* champs obligatoires</p>

    </form>

    <div id="compte_a_rebours" class="txt-center">

    </div>
    <script type="text/javascript" src="http://localhost/Boutique/views/concours/script.js"></script>

