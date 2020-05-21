<?php
session_start();
//можно заменить на запрос в бд
$seller_login = "admin";
$seller_password = "password";

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (($login == $seller_login) && ($password == $seller_password)) {
        $_SESSION['seller_mode'] = true;
    }
    header("Location: /index.php");

} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
