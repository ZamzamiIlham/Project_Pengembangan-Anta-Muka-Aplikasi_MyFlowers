<?php
require_once '../config/koneksi.php';

//////////////////REGISTER////////////////////
//Mendapatkan data user
if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    $query ="SELECT * FROM users";
    $result= mysqli_query($conn,$query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)){
        $users[]= $row;
    }

    header('Content-Type: application/json');
    echo json_encode($users);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari body request
    $data = json_decode(file_get_contents('php://input'), true);

    $nama = $data['nama'];
    $email = $data['email'];
    $password = $data['password'];

    //Meriksa apakah email sudah terdaftar
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResut = mysqli_query($conn,$checkQuery);

    if(mysqli_num_rows($checkResut)> 0){
        $response = ['message' => 'Email sudah terdaftar'];
    } elseif (empty($password)) {
        $response = ['message' => 'Password tidak boleh kosong'];
    } else {
        $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $response = ['message' => 'Registrasi berhasil'];
            http_response_code(201);
        } else {
            $response = ['message' => 'Terjadi kesalahan saat registrasi'];
            http_response_code(500);
        }
    }

    // Menyimpan data pengguna baru ke database

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

    
}
?>
