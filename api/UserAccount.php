<?php
session_start();
include '../config/koneksi.php';

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, mengirimkan respons error
    $response = array(
        'success' => false,
        'message' => 'Anda belum login.'
    );
    echo json_encode($response);
    exit();
}

// Mendapatkan data pengguna dari database berdasarkan ID
$userID = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$userID'";
$result = mysqli_query($conn, $query);

// Memeriksa apakah data pengguna ditemukan
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Membuat respons JSON
    $response = array(
        'success' => true,
        'user' => $userData
    );
    echo json_encode($response);
} else {
    // Jika data pengguna tidak ditemukan, mengirimkan respons error
    $response = array(
        'success' => false,
        'message' => 'Data pengguna tidak ditemukan.'
    );
    echo json_encode($response);
}
?>
