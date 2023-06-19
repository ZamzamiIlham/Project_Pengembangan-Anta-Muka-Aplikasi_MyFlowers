<?php
include '../config/koneksi.php';

//MELIHAT DATA
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $query = "SELECT * FROM pembayaran";
    $result = mysqli_query($conn,$query);

    $rekenings = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rekenings[] =$row;
    }

    header('Content-Type: application/json');
    echo json_encode($rekenings);
}
// MENYIMPAN DATA
if (isset($_POST['product_id']) && isset($_POST['user_id']) && isset($_POST['quantity']) && isset($_POST['total_price'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Ambil data produk terkait dari sumber data Anda (misalnya, API atau database)
    // Gantikan dengan kode untuk mengambil data produk dari sumber data Anda
    $url = 'http://localhost/JWT_PAA/api/Adminproductread.php';
    $products = json_decode(file_get_contents($url), true);
    $product = null;
    foreach ($products as $prod) {
        if ($prod['id'] == $product_id) {
            $product = $prod;
            break;
        }
    }

    // Jika data produk ditemukan
    if ($product) {
        // Simpan data produk ke dalam tabel pembayaran
      

        // Bind parameter untuk query prepared statement
        $stmt = $conn->prepare("INSERT INTO pembayaran (user_id, product_id,quantity, total_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $user_id, $product_id,$quantity, $total_price);

        if ($stmt->execute()) {
            echo "Data produk berhasil disimpan ke tabel pembayaran.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Data produk tidak ditemukan.";
    }
} else {
    echo "ID produk, user_id, quantity, atau total_price tidak ditemukan dalam permintaan.";
}

$conn->close();
?>

