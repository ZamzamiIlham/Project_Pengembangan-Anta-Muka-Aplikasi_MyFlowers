<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

include '../config/koneksi.php';
include '../vendor/autoload.php';

use \Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['email']) && isset($data['password'])) {
        $email = mysqli_real_escape_string($conn, $data['email']);
        $pass = mysqli_real_escape_string($conn, $data['password']);

        $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if (mysqli_num_rows($select_users) > 0) {
            $row = mysqli_fetch_assoc($select_users);

            if ($row['password'] != '') {
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

                echo json_encode([
                    'status' => 1,
                    'jwt' => $jwt,
                    'message' => 'Login Successfully',
                ]);
            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => 'Invalid Credential',
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                'message' => 'Invalid Credential',
            ]);
        }
    } else {
        echo json_encode([
            'status' => 0,
            'message' => 'Missing email or password',
        ]);
    }
}

?>
