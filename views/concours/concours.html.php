

<form id="concours-form" class="form" action="" method="post">
        <h1>Jeux concours</h1>
        <div class="form-group">
            <input id="email" type="email" name="email" required>
            <label for="email">E-mail *</label>
            
        </div>
            
        <div class="form-group">
            <input id="surname" type="text" name="surname" required>
            <label for="surname">Prénom *</label>
            
        </div>

        <h2>Informations de livraison</h2>

        <div class="form-group">
            <input type="text" name="adresse" id="adresse" required>
            <label for="adresse">Adresse *</label>
        </div>

        <div class="form-group">
            <input type="text" name="codePostale" id="codePostale" required>
            <label for="codePostale">Code postale *</label>
        </div>

        <div class="form-group">
            <input type="text" name="ville" id="ville" required>
            <label for="ville">Ville *</label>
        </div>    
        
        <p class="error-msg"><?= $error ?></p>
        <p><?= $success ?></p>
        <input class="submit" type="submit" name="submit" value="PARTICIPER">
        <p class="help">* champs obligatoires</p>

    </form>

    <div id="compte_a_rebours" class="txt-center">

    </div>

    <div id="winner">
        <img src="images/generalvibe/concourskit.jpg" alt="">
        <div>
            <h2>Bravo à <?= $winner['prenom'] ?> !</h2>
            <p>qui remporte le <i>"kit Skincare"</i> d'une valeur de <i>79€</i> !</p>
            <p class="help">Le lot comprend : - Un sérum - une crème hydratante ainsi qu'un - nettoyant.</p>
        </div>
        
    </div>
  
    <script type="text/javascript" src="http://localhost/Boutique/views/concours/script.js"></script>
    
   
    

