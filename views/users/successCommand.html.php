<?php
if ( $_SESSION['user_data']['existCommand'] == true){
    $_SESSION['user_data']['existCommand'] = false;
?>
<div class="successCommand">
    <p class="textcommand success txt-center">Congrats <?= $_SESSION['user_data']['prenom'] ?> <i class="fa-solid fa-thumbs-up"></i>. <br/> 
    You can find a summary of your command in your <a href="users/profil">profil</a>. <br/>
    A bill has also been sent to your mail.</p>
</div>

<section class="commandImageSuccess">
    <div class="commandImage">
        <div class="content">
            <h3>Best products with the best price</h3>
            <p>because your beauty is important</p>
            <a href="products"><button class="submit">SHOPPER</button></a>
        </div>
        <img src="images/generalvibe/baniere2.jpg" alt="Products">
    </div>
</section> 
<?php
} else {
    header('location: ../bags');
}
?>
