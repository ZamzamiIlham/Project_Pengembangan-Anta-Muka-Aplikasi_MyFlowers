<?php
require_once('./config/koneksi.php');


if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, ($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, ($_POST['cpassword']));
    $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user already exist!';
       
     }else{
        if($pass != $cpass){
           $message[] = 'confirm password not matched!';
         
        }else{
           mysqli_query($conn, "INSERT INTO `admin`(username, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
           $message[] = 'registered successfully!';
           header('location:login.php');
        }
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign</title>
    <!-- CSS -->
    <link rel="stylesheet" href="sign_style.css">
    <!-- REMIX ICON -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<div class="login__container container">
    <div class="login__left flex">
        <img src="../images/logo.png" alt="">
        <h1>Flowers Shop</h1>
    </div>

    <div class="login__right flex">
        <div class="lr__header flex">
            <h1>Register</h1>
            <p>Toko bunga terbaik di indonesia</p>
        </div>

        <form action="" method="POST">
        <div class="lr__input flex">
            <div class="input__box">
                <i class="ri-user-line"></i>
                <input type="username" name="username" placeholder="enter your username " required class="box">
            </div>
            <div class="input__box">
                <i class="ri-mail-line"></i>
                <input type="email" name="email" placeholder="enter your email" required class="box">
            </div>
            <div class="input__box">
                <i class="ri-lock-2-line"></i>
                <input type="password" name="password" placeholder="enter your password" required class="box">
            </div>
            <div class="input__box">
                <i class="ri-lock-2-line"></i>
                <input type="password" name="cpassword" placeholder="confirm password" required class="box">
            </div>
            <!--<div class="sign__in button">
                <input type="submit" name="submit" value="register now" class="btn">
            </div>-->
            <button class="sign__in button" type="submit" name="submit" >
               Sign Now
            </button>
            <div class="text__login">Already have an account? <a href="login.php" class="log__now">login now</a></div>
        </div>
        </form>
    </div>
</body>
</html>