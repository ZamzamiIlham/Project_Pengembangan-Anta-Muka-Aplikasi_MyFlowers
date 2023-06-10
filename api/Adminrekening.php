<?php
require_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $query = "SELECT * FROM rekening";
    $result = mysqli_query($conn,$query);

    $rekenings = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rekenings[] =$row;
    }

    header('Content-Type: application/json');
    echo json_encode($rekenings);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = json_decode(file_get_contents('php://input'), true);

    $namaBank = $data['namaBank'];
    $nomerRekening = $data ['nomerRekening'];

    $query = "INSERT INTO rekening (namaBank, nomerRekening) VALUES ('$namaBank','$nomerRekening')";
    $result = mysqli_query($conn,$query);

    if ($result) {
        // Menyimpan ID produk yang baru ditambahkan
        $response = ['message' => 'Rekening berhasil ditambahkan', 'id' => mysqli_insert_id($conn)];
        http_response_code(201);
    } else {
        $response = ['message' => 'Terjadi kesalahan saat menambahkan rekening'];
        http_response_code(500);
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);

}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $namaBank = $data['namaBank'];
    $nomerRekening = $data ['nomerRekening'];

    $query = "UPDATE rekening SET namaBank='$namaBank', nomerRekening='$nomerRekening' WHERE id=$id";
    $result= mysqli_query($conn,$query);

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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Mendapatkan ID produk yang akan dihapus
    $id = $_GET['id'];

    // Menghapus produk dari database
    $query = "DELETE FROM rekening WHERE id = $id";
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