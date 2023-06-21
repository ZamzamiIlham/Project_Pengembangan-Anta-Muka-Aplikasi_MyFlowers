<?php
include 'sidenav.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil endpoint API untuk mendapatkan detail pembayaran berdasarkan id
    $url = "http://localhost/JWT_PAA/api/UserBuktiRead.php?id=" . $id;
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data !== null) {
        if (!empty($data)) {
            $firstData = $data[0]; // Ambil data pertama

            // Tampilkan data
            echo '
                <body>
                    <div id="main">
                        <div class="paymentDetail flex container">
                            <div class="paymentDetail__box">
                                <div class="paymentAtas flex">
                                    <div class="paymentDetail__left">
                                        <img src="../api/bukti/' . $firstData['gambar'] . '" alt="">
                                    </div>
                                    <div class="paymentDetail__rigth">
                                        <div class="pay1">
                                            <h2>' . $firstData['nama_user'] . '</h2>
                                            <p>' . $firstData['nama'] . '</p>
                                        </div>
                                        <div class="pay2">
                                            <div class="pay2jumlah flex">
                                                <h4>Jumlah : </h4>
                                                <p>' . $firstData['quantity'] . '</p>
                                            </div>
                                            <div class="pay2harga flex">
                                                <h4>Total Harga : </h4>
                                                <p>Rp ' . $firstData['total_price'] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>';
        } else {
            echo "Data tidak ditemukan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengambil data dari API.";
    }
} else {
    echo "Parameter 'id' tidak ditemukan dalam URL.";
}
?>
