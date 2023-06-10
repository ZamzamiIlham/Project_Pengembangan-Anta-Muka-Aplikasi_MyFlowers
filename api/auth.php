<?php
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;

// Menentukan kunci rahasia untuk signing JWT
$key = "Knuuyduy267w5vsut1edj9y771g6vxjv";

// Fungsi untuk membuat token JWT
function generateToken($user_id) {
    global $key;

    // Atur waktu kadaluwarsa token (misalnya 1 jam)
    $expiry_time = time() + (60 * 60);

    // Membuat payload JWT
    $payload = array(
        "user_id" => $user_id,
        "exp" => $expiry_time
    );

    // Membuat token JWT menggunakan Firebase JWT
    $jwt = JWT::encode($payload, $key);

    return $jwt;
}

// Fungsi untuk memverifikasi token JWT
function verifyToken($token) {
    global $key;

    try {
        // Memverifikasi dan mengembalikan payload jika token valid
        $payload = JWT::decode($token, $key, array('HS256'));
        return $payload;
    } catch (Exception $e) {
        // Mengembalikan false jika token tidak valid
        return false;
    }
}
?>
