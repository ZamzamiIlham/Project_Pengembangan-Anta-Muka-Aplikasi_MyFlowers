<?php

require_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari body request
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];


    // Menyimpan data pengguna baru ke database
    $query = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = ['message' => 'Registrasi berhasil'];
        http_response_code(201);
    } else {
        $response = ['message' => 'Terjadi kesalahan saat registrasi'];
        http_response_code(500);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
