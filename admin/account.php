<?php 
include'sidenav.php';
$url = 'http://localhost/JWT_PAA/api/Adminaccount.php';
$admin = json_decode(file_get_contents($url), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>
<body>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: black;" class="nav"  >☰ Account</span>
            </div>

            <div class="col-div-6">
                <div class="profile">
                    <img src="../asset/user.png" class="pro-img" />
                    <p>Ilham Zamzami <span>Admin</span></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="account flex">
            <i class="ri-shield-user-line"></i>
            <div class="account__info grid">
                <div class="account__left">
                    <p>Username</p>
                    <p>Email</p>
                    <p>Password</p>
                </div>
                <?php foreach ($admin as $admins):?>
                <div class="account__right">
                    <p><?php echo $admins['username']; ?></p>
                    <p><?php echo $admins['email']; ?></p>
                    <p><?php echo $admins['password']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>