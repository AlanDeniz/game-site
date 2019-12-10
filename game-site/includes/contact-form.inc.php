<?php 

if (isset($_POST['submit'])) { //Det følgende sker, når brugeren trykker på "submit" knappen.
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailFrom = $_POST['mail'];
    $message = $_POST['message'];


    $mailTo = "alandogan@alandenz.dk";
    $headers = "From: ".$mailFrom;
    $text = "You have recieved an Email from ".$name. ".\n\n".$message;

    mail( $mailTo, $subject,  $text, $headers);
    header("Location: ../contact.php?mailsent"); //konfirmation, at mailen er sendt på URL baren.  
}