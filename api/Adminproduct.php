<?php
// Memasukkan file konfigurasi database
require_once '../config/koneksi.php';


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