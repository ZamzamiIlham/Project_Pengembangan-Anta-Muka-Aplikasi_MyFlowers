<?php
session_start();
include '../config/koneksi.php';

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, mengarahkan pengguna kembali ke halaman login
    header('Location: ../loginUser.php');
    exit();
}

// Mendapatkan data pengguna dari database berdasarkan ID
$userID = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$userID'";
$result = mysqli_query($conn, $query);

// Memeriksa apakah data pengguna ditemukan
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
} else {
    // Jika data pengguna tidak ditemukan, mengirimkan respons error
    $response = array(
        'success' => false,
        'message' => 'Data pengguna tidak ditemukan.'
    );
    echo json_encode($response);
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated profile information from the form submission
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the profile information in the database
    $updateQuery = "UPDATE users SET nama = '$username', email = '$email', alamat ='$alamat', password = '$password' WHERE id = '$userID'";
    mysqli_query($conn, $updateQuery);

    // Redirect the user back to the profile page after successful update
    header('Location: userProfile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="user_style.css">
</head>
<body>
    <div class="account flex container">
        <i class="ri-shield-user-line"></i>
        <div class="account__info grid">
            <form action="" method="POST">
                <div class="account__left">
                    <p>Username</p>
                    <p>Alamat</p>
                    <p>Email</p>
                    <p>Password</p>
                </div>
            
                <div class="account__right">
                    <input type="text" id="username" name="username" value="<?php echo $userData['nama']; ?>" required>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $userData['alamat']; ?>" required>
                    <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
                    <input type="password" id="password" name="password" value="<?php echo $userData['password']; ?>" required>
                </div>

                <button type="submit" class="home__in button" name="submit">Save</button>
            </form>
        </div>
    </div>
</body>
</html>
