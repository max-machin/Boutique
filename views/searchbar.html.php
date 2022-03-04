<form action="" method="post">
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit-search"></button>
</form>

<!-- search.php -> file loaded with all the results -->

<?php

if(isset($_POST['submit-search'])){
    Controller::preventXSS($_POST['search']);
}

?>