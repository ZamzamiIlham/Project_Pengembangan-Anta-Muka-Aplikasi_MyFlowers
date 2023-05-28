<?php

require_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $query = "SELECT * FROM admin";
    $result = mysqli_query($conn,$query);

    $admin = [];
    while ($row = mysqli_fetch_assoc($result)){
        $admin[]=$row;
    }

    header('Content-Type: application/json');
    echo json_encode($admin);
}