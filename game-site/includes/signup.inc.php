<?php

if (isset($_POST['signup-submit'])) {

    require 'db.inc.php'; 


    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];

    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
      }

      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invalidemailusername");
      exit();
    }

      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
      }

      elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&mail=".$email);
        exit();
      }

      elseif($password !== $password2){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
}
else {
$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql )) {
    header("Location: ../signup.php?error=sqlierror");
    exit();
}
else{
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows();

    if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
    exit();
    }
    else{
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql )) {
            header("Location: ../signup.php?error=sqlierror");
            exit();
    }
    else {

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpassword);
        mysqli_stmt_execute($stmt);
        header("Location: ../signup.php?signup=success");
        exit();
    }
}
  
}

    }
}