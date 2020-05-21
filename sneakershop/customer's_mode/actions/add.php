<?php

session_start();
require_once "../db/db.php";

if (isset($_POST['id'])) {

    if(isset($_SESSION['order'])){
        unset($_SESSION['order']);
    }

    $id = $_POST['id'];
    $size = $_POST['size'];

    $product = $connect->query("SELECT * FROM product WHERE id = '$id'");
    $product = $product->fetch(PDO::FETCH_ASSOC);


    if (isset($_SESSION['total']))
        $_SESSION['total']++;
    else
        $_SESSION['total'] = 1;

    if (isset($_SESSION['sum'])) {
        $_SESSION['sum'] += $product['price'];
    } else {
        $_SESSION['sum'] = $product['price'];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $product['id'],
            'quantity' => 1,
            'model' => $product['model'],
            'price' => $product['price'],
            'img' => $product['img'],
            'size'=> $size
        ];
    }


}

header("Location: {$_SERVER['HTTP_REFERER']}");