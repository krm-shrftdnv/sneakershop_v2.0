<?php

session_start();
require_once "../db/db.php";

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['total'] -= $_SESSION['cart'][$id]['quantity'];
        $_SESSION['sum'] -= $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['quantity'];
        unset($_SESSION['cart'][$id]);
    }

}

header("Location: {$_SERVER['HTTP_REFERER']}");