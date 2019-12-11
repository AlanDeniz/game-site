<?php
// indhenter alt fra "header.php" siden, super god metode for at spare tid, og gør det lettere for os!
  require "header.php";

?>

<main>
<div class="wrapper-main">
        <section class="section-default">
<h1>Sign Up</h1>

<?php
  // Her laves der en "error message", hvis brugeren begår en fejl under signup.
if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
              echo '<p class="error-message">All fields needs to be filled!</p>'; 
             }
             else if ($_GET["error"] == "invalidemail") {
              echo '<p class="error-message">Invalid e-mail!</p>';
            }
             else if ($_GET["error"] == "passwordcheck") {
              echo '<p class="error-message">Make sure your password match!</p>';
            }
            else if ($_GET["error"] == "usertaken") {
              echo '<p class="error-message">Your username is already in use!</p>';
            }
            }


    // Her laves der en "success message", hvis brugeren udfylder alt korrekt under signup.
    else if (isset($_GET["signup"])) {
      if ($_GET["signup"] == "success") {
        echo '<p class="success-message">Your signup is successful!</p>';
      }
      
    }

?>

<form class="signup-form" action="includes/signup.inc.php" method="post">
<input type="text" name="uid" placeholder="Username">
<input type="text" name="mail" placeholder="Email">
<input type="password" name="pwd" placeholder="Password">
<input type="password" name="pwd2" placeholder="Repeat Password">
<button type="submit" name="signup-submit">Sign Up</button>

</form>



</section>
</div>
</main>



<?php
 // Det samme bliver gjort i footeren som i headeren. Hurtigere og lettere for kodning.
  require "footer.php";
?>