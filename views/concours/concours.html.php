

<form id="concours-form" class="form" action="" method="post">
        <h1>Contest</h1>
        <div class="form-group">
            <input id="email" type="email" name="email" required>
            <label for="email">E-mail *</label>
            
        </div>
            
        <div class="form-group">
            <input id="surname" type="text" name="surname" required>
            <label for="surname">First Name *</label>
            
        </div>

        <h2>Delivery information</h2>

        <div class="form-group">
            <input type="text" name="adresse" id="adresse" required>
            <label for="adresse">Address *</label>
        </div>

        <div class="form-group">
            <input type="text" name="codePostale" id="codePostale" required>
            <label for="codePostale">Postal code *</label>
        </div>

        <div class="form-group">
            <input type="text" name="ville" id="ville" required>
            <label for="ville">City *</label>
        </div>    
        
        <p class="error-msg"><?= $error ?></p>
        <p><?= $success ?></p>
        <input class="submit" type="submit" name="submit" value="PARTICIPER">
        <p class="help">* required fields</p>

    </form>

    <div id="compte_a_rebours" class="txt-center">

    </div>

    <div id="winner">
        <img src="images/generalvibe/concourskit.jpg" alt="">
        <div>
            <h2>Congrats to <?= $winner['prenom'] ?> !</h2>
            <p>Who win the <i>"Skincare kit"</i> : <i>79€</i> !</p>
            <p class="help">The set includes: - A serum - a moisturizer and a - cleanser.</p>
        </div>
        
    </div>
  
    <script type="text/javascript" src="http://localhost/Boutique/views/concours/script.js"></script>
    
   
    

