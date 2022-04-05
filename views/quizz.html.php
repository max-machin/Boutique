
<form class = "quizz" action="" method="post">
    <p>What would be your skintype?</p><br>
        <input type="radio" name="q1" value="dry">dry<br>
        <input type="radio" name="q1" value="oily">oily<br>
        <input type="radio" name="q1" value="normal">normal<br>
        <input type="radio" name="q1" value="sensitive">sensitive<br>

    <p>What is your main concern?</p><br>
        <input type="radio" name="q2" value="acne">pimples/acne<br>
        <input type="radio" name="q2" value="red">redness<br>
        <input type="radio" name="q2" value="wrinkle">wrinkles<br>
        <input type="radio" name="q2" value="drypatches">dry patches<br>

    <p>At the end of the day, how does your skin feel?</p><br>
        <input type="radio" name="q3" value="dry">dry, i need to put on cream<br>
        <input type="radio" name="q3" value="oily">oily, i feel like i got a lot of sebum<br>
        <input type="radio" name="q3" value="normal">i don't feel any particular unpleasant sensation on my skin<br>

        <input id='submit' type="submit" name="answer" value="Show Result"> 
</form>

<div class='suggestedProducts'>
</div>

<script type="text/javascript" src="views/quizz.js"></script>