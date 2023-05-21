<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    
    $id = $_GET['id'];

    
    $url = 'http://localhost/JWT_PAA/api/productAdmin.php?id=' . $id;

    $options = [
        'http' => [
            'method' => 'DELETE'
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    header('Location: product.php');
    exit();
} else {
    header('Location: product.php');
    exit();
}
