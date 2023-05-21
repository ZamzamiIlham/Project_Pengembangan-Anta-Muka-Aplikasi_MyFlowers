<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST');
include './config/koneksi.php';
include './vendor/autoload.php';

use \Firebase\JWT\JWT;

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn,($_POST['password']));
 
    $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
    if(mysqli_num_rows($select_users) > 0){
 
        $row = mysqli_fetch_assoc($select_users);
    
        if($row['password'] != ''){
            $payload = [
                'iss' => "localhost",
                'aud' => 'localhost',
                'exp' => time() + 1000, 
                'data' => [
                    'email' => $email,
                    'password' => $pass,
                ],
            ];
            $SECRET_KEY = "g1523AzABUYzhihdwuiiufujw901NHIU";
            $jwt = \Firebase\JWT\JWT::encode($payload, $SECRET_KEY, 'HS256');
            setcookie("SET_COOKIES", $jwt);
            echo json_encode([
                'status' => 1,
                'jwt' => $jwt,
                'message' => 'Login Successfully',
            ]);
            header('location:admin/home.php');
        }else{
            echo json_encode([
                'status' => 0,
                'message' => 'Invalid Carditional',
            ]);
        }
    }else {
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- CSS-->
    <link rel="stylesheet" href="sign_style.css">
    <!-- REMIX ICON -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<div class="login__container container">
    <div class="login__left flex">
        <img src="./asset/logo.png" alt="">
        <h1>Flowers Shop</h1>
    </div>
    <div class="login__right flex">
        <div class="lr__header flex">
            <h1>Login</h1>
            <p>Toko bunga terbaik di indonesia</p>
        </div>
        
        <form action="" method="POST">
        <div class="lr__input flex">
            <div class="input__box">
                <i class="ri-mail-line"></i>
                <input type="email" name="email" placeholder="enter your email" required class="box">
            </div>
            <div class="input__box">
                <i class="ri-lock-2-line"></i>
                <input type="password" name="password" placeholder="enter your password" required class="box">
            </div>
            <a href="#" class="forgot">Forgot Password? </a>
            <button  class="log__in button" type="submit" name="submit" >
               Login Now
            </button>
            <div class="text__sign-up">Don't have an account? <a href="register.php" class="reg__now">register now</a></div>
        </div>
        </form>
    </div>
</div> 
</body>
</html>