<?php
//  tjekker om brugeren trykker på sign up knappen.
if (isset($_POST['signup-submit'])) {
// tilføjer databasens forbindelsen.
    require 'db.inc.php'; 

// tager alle de data vi modtager fra signup formen så vi kan bruge det senere.
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];

  // Laver nogle "error-checks" for at være sikker på vi finder fejl, som brugeren kan begå.


  // Tjekker for tomme inputs-felter.
    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
      }
    //Tjekker for forkerte username OG email.
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invalidemailusername");
      exit();
    }
    //Tjekker for forkert email.
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
      }
      //Tjekker forkert brugernavn.
      elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&mail=".$email);
        exit();
      }
      //Tjekker om det gentagende password er ens eller ej.
      elseif($password !== $password2){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
}
else {

//Der laves endnu en "error-check" for hvis brugeren prøver at oprette en allerede eksisterende Username.
$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
$stmt = mysqli_stmt_init($conn);
// tjekker om der er nogle fejl med vores statements
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../signup.php?error=sqlierror"); //hvis der er fejl får vi følgende besked på URL.
    exit();
}
else{
   
    mysqli_stmt_bind_param($stmt, "s", $username); //"s" = strings
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    //Tjekker om brugeren er allerede taget.
    if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
    exit();
    }

//Her indsættes Brugerens login data inden i databasen.

    else{// prepared statements virker ved at vi sender SQL til databasen først, og senere indæstter vi i placeholder ved at sende brugerens data. placeholder = ?
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        //brugere db forbindelsen.
        $stmt = mysqli_stmt_init($conn);
        //tjekker for nogen fejl
        if (!mysqli_stmt_prepare($stmt, $sql )) {
          // hvis brugeren begår fejl sender vi dem hertil.
            header("Location: ../signup.php?error=sqlierror");
            exit();
    }
    else {
        //Det er vigtig vi hasher vores adgangskoder i databasen, i tilfælde af en hacker får adgang.
        // Hashing metoden her er den seneste metode at gøre det på, da den opdateres automatisk.

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpassword);
       //dette betyder at brugeren er registreret.
        mysqli_stmt_execute($stmt);
        header("Location: ../signup.php?signup=success"); //Sender brugeren til denne URL med en success besked.
        exit();
    }
}
  
}

}// forbindelsen mellem statements og databasen lukker vi
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // hvis brugeren forsøger på at logge ind på en ukorrekt metode, sender vi dem til signup siden.
  header("Location: ../signup.php");
  exit();
}