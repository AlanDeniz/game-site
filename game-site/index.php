<?php
  session_start();
    // indhenter alt fra "header.php" siden, super god metode for at spare tid, og gør det lettere for os!
  require "header.php";

?>



<section class="index-banner">
            <div class="vertical-center">
                <br><br><h2>WELCOME TO<br>FLASH GAMES</h2>
                <h1>Free javascript based minigames</h1>
            </div>

<main>
<div class="wrapper-main-2">
        <section class="section-default-2">
    
        <!-- PHP'en hjælper med at skifte informationer, afhængig af brugerens login status og påvises der en besked på forsiden.-->
        <?php 
        if (!isset($_SESSION['id'])) {
        echo '<p class="login-info">You are logged out!</p>';
        }
        else {
         echo '<p class="login-info">You are logged in!</p>';
        }


?>


</section>

</section>
</div>
</main>



<?php
 // Det samme bliver gjort i footeren som i headeren. Hurtigere og lettere for kodning.
  require "footer.php";

?>

