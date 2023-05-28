<?php
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nama = $_POST['nama'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    

 
    if ($password !== $cpassword) {
        $error = 'Password tidak sesuai dengan konfirmasi password';
    } else {
        
        $url = 'http://localhost/JWT_PAA/api/Usersign.php';
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => $password
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);


        if ($result === false) {
            $error = 'Terjadi kesalahan saat membuat akun';
        } else {
            $response = json_decode($result, true);
            if ($response && isset($response['status']) && $response['status'] === 'success') {
                header('Location: loginUser.php');
                exit();
            } else {
                $error = isset($response['message']) ? $response['message'] : 'Terjadi kesalahan saat membuat akun';
                if (isset($response['message']) && $response['message'] === 'Email sudah terdaftar') {
                    $emailError = 'Email sudah terdaftar';
                }
            }
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
                <input type="nama" name="nama" placeholder="enter your username" required class="box">
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
            <button class="sign__in button" type="submit" name="submit" value="Daftar">
               Sign Now
            </button>
            <div class="text__login">Already have an account? <a href="loginUser.php" class="log__now">login now</a></div>
        </div>
        </form>
    </div>
</body>
</html>