<?php 
// Vi tjekker om brugeren klikker på login knappen.
if (isset($_POST['login-submit'])) {
 
    //database scriptet. indeholder vores forbindelse. 
    require 'db.inc.php'; 
    //jeg indhenter alt det data fra min signinform.  
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    //sektionen her har jeg noget "error-checking", for at være sikker på at vi finder fejl begået af brugeren.

    //Jeg tjekker for tomme input-felter. 
    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
        exit();
      }
       // Herefter skal der indhentes brugerens password i databasen, som matcher det indstastede username. Derefter skal der fjerne hashet, og se om de passer.
    // Vi opretter forbindelse til databasen ved hjælp af prepared statements.
      else {
     $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";   
    // Her initialiserer(init) vi en ny statement ved hjælp af forbindelsen fra filen 'db.inc.php'
     $statement = mysqli_stmt_init($conn);
    //Derefter "prepare" vi vores SQL statement og tjekker for fejl.
     if (!mysqli_stmt_prepare($statement, $sql)) {
    // Hvis der er en fejl sender vi brugeren tilbage til signin siden.
        header("Location: ../index.php?error=sqlerror");
        exit();
     }
   
     else {

       // Derefter skal vi binde den type parameter(param),som vi forventer at gå igennem statement, og binde dataen fra brugeren.
         mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
     
         //vi executer prepared statement og sender det ind i databasen.
         mysqli_stmt_execute($statement);
        
         //vi får resultatet fra statementet 
         $result = mysqli_stmt_get_result($statement);
       
         //derefter indsætter vi resultatet ind i en variabel.
         if ($row = mysqli_fetch_assoc($result)) {
        
            //Vi matcher passwordet fra databasen med det password brugeren har indsat/submittet. 
        //Resultatet kommer tilbage som et Boolean
         $passwordcheck = password_verify($password, $row['pwdUsers']);
         
         //Hvis de ikke er ens, laver vi en fejl besked.
         if ($passwordcheck == false) {
        //ved at passwordet ikke stemmer overens med databasen, sender vi bruger tilbage til index siden med en meddelelse i URL'en.
            header("Location: ../index.php?error=incorrectpassword");
            exit();

         }
         //Hvis passwordet stemmer overens med databasen, ved vi at det er den rette bruger der logger ind.
         else if($passwordcheck == true){

            //Nu skal vi få websitet til at vide at man er logget ind. Det gør man ved SESSION variabler. 
            //session variabler, er variabler som vi kan bruge på alle siderne der har en session kørerne.
            //Derfor skal vi starte en session her, hvis vi skal lave vores variabler.
             session_start();
             // og laver vi vores variabler.
             $_SESSION['id'] = $row['idUsers'];
             $_SESSION['username'] = $row['uidUsers'];
             //Med success, er brugeren logget ind og vi sender dem til index(forsiden)
             header("Location: ../index.php?login=success");
             exit();

         }
        }
         else{
            header("Location: ../index.php?error=incorrectpassword");
            exit();
         }

         }
        
         }
 // forbindelsen mellem statements og databasen lukker vi
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
     }

else {
 //hvis brugeren forsøger på at logge ind på en ukorrekt metode, sender vi dem til signup siden.
    header("Location: ../signup.php");
    exit();

}
