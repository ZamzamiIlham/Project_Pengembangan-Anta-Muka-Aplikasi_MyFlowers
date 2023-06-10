<?php
function upload_image(){
    if(isset($_FILES["product_image"])){
        $extension = explode('.', $_FILES['product_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = 'upload/' . $new_name;
        move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
        return $new_name;
    }
}

function get_image_name($user_id)
{
    require_once '../config/koneksi.php';
    $statement = $connection->prepare("SELECT gambar FROM produk WHERE id = '$user_id'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        return $row["gambar"];
    }
}

function get_total_all_record(){
    require_once '../config/koneksi.php';
    $statement = $connection->prepare("SELECT * FROM produk");
    $statement-> execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();

}
?>