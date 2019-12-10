<?php
  // session_start giver os mulighed for at gemme information som SESSION-variabler.
  session_start();
  // "require" laver en fejl besked, og stopper scriptet efterfølgende. "include" laver en fejl besked, men scriptet fortsætter med at køre.
  require "includes/db.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
<!-- Stødte på nogle problemer med CSS'en. Den gad ikke at opdatere, når jeg ændrede i den. PHP'en fixede det problem. -->
<link rel="stylesheet" href="css/styles.css?d=<?php echo time();?>"> 
<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900
    |Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- p5.js bibloteket, som jeg benytter mig af når jeg laver spillet. -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
<script src="https://cdn.rawgit.com/bmoren/p5.collide2D/cfb05302/p5.collide2d.min.js"></script>
</head>
<body>
<!-- Her er min header, hvor jeg har indsat mit login form -->
<header>
<nav class="navbar navbar-expand-lg navbar-light"> 
<a class="navbar-brand" href="index.php"> 
<img src="images/logo.png" alt="logo" width="100" height="100">
 </a> 
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <ul class="navbar-nav mr-auto">
 <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
 <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li> 
 <?php
        if (!isset($_SESSION['id'])) { 
 echo '<li class="nav-item"><a class="nav-link" href=""></a></li>';
 } 
 
else{ 
  echo '<li class="nav-item"><a class="nav-link" href="games.php">games</a></li>';
 } 
 
 ?>
</ul>
</div>
 
<!-- Her er selve login formen.
Har valgt at indsætte "post" ved "method", det har jeg gjort grundet de informationer vi sender er sensitive(password). 
Der er også indført PHP - Ved hjælp af PHP, kan jeg skjule komponenter på siden udfra om brugeren er logget ind eller ud. 
Vi gør det baseret på SESSION variablerne. !-->
 <div class="header-login">
 <?php
        if (!isset($_SESSION['id'])) {
          echo '<form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="login-submit">Login</button>
          </form>
          <a href="signup.php" class="header-signup">Signup</a>';
        }
        else {
           echo '<form action="includes/logout.inc.php" method="post">
            <button type="submit" name="login-submit">Logout</button>
          </form>';
        }
        ?>
 </div>
</nav>

</header>

