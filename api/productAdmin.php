<?php
// Memasukkan file konfigurasi database
require_once '../config/koneksi.php';

// Mendapatkan data produk
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query untuk mendapatkan semua produk
    $query = "SELECT * FROM produk";
    $result = mysqli_query($conn, $query);

    // Menyimpan hasil query dalam array
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Mengembalikan data produk dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($products);
}

// Menambahkan produk baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari body request
    $data = json_decode(file_get_contents('php://input'), true);

    // Memasukkan data ke database
    $nama = $data['nama'];
    $stok = $data['stok'];
    $harga = $data['harga'];

    $query = "INSERT INTO produk (nama, stok, harga) VALUES ('$nama', $stok, $harga)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Menyimpan ID produk yang baru ditambahkan
        $response = ['message' => 'Produk berhasil ditambahkan', 'id' => mysqli_insert_id($conn)];
        http_response_code(201);
    } else {
        $response = ['message' => 'Terjadi kesalahan saat menambahkan produk'];
        http_response_code(500);
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Mengupdate data produk
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Mendapatkan data dari body request
    $data = json_decode(file_get_contents('php://input'), true);

    // Memperbarui data di database
    $id = $data['id'];
    $nama = $data['nama'];
    $stok = $data['stok'];
    $harga = $data['harga'];

    $query = "UPDATE produk SET nama='$nama', stok=$stok, harga=$harga WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = ['message' => 'Produk berhasil diperbarui'];
        http_response_code(200);
    } else {
        $response = ['message' => 'Terjadi kesalahan saat memperbarui produk'];
        http_response_code(500);
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Menghapus produk
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Mendapatkan ID produk yang akan dihapus
    $id = $_GET['id'];

    // Menghapus produk dari database
    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = ['message' => 'Produk berhasil dihapus'];
        http_response_code(200);
    } else {
        $response = ['message' => 'Terjadi kesalahan saat menghapus produk'];
        http_response_code(500);
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
