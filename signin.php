<?php

    require 'db/db.php';
    $db = new Database();


    $emailErr = $passwordErr ="";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $emailErr = $db->validateEmail($email);
        $passwordErr = $db->validatePassword($password);
        $passwordErr = $db->loginAccount($email, $password);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Login</title>
</head>
<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/login.svg">
        </div>
        <div class="login-content">
        
        <form method='post'>
            <img src="img/user.svg">
                <h2 class="title">Sign in</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fa-solid fa-user"></i>
                   </div>
                   <div class="div">
                <input type="text" class="input" name="email" require placeholder="Email"><p><?=$emailErr?></p>
            </div>
            </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fa-solid fa-lock"></i>
                   </div>
                   <div class="div">
                <input type="password" class="input" name="password" require placeholder="Password"><p><?=$passwordErr?></p>
            </div>
            </div>
            <input type="submit" class="btn" name="login" value="SIGN IN">
        </form>
    </div>
    </div>
</body>

</html>