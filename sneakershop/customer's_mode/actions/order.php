<?php

session_start();
require_once '../db/db.php';

if(isset($_POST['order'])){

    $username = $_POST['username'];
    $email =$_POST['email'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO `order` SET username=:username, email=:email, phone=:phone ";

    $stmt = $connect->prepare($query);

    $username = htmlspecialchars(strip_tags($username));
    $email = htmlspecialchars(strip_tags($email));
    $phone = htmlspecialchars(strip_tags($phone));

    $stmt->bindParam("username", $username);
    $stmt->bindParam("email", $email);
    $stmt->bindParam("phone", $phone);

    $stmt->execute();

    $lastId = $connect->query("SELECT MAX(id) FROM `order` WHERE email='$email'");
    $lastId = $lastId->fetch(PDO::FETCH_ASSOC);
    $lastId = $lastId['MAX(id)'];

    $query = "INSERT INTO `order_model` SET order_id=:order_id, model_id=:model_id, `size` =:ssize, quantity=:quantity ";

    foreach ($_SESSION['cart'] as $product){
        $stmt = $connect->prepare($query);

        $model_id = $product['id'];
        $size = $product['size'];
        $quantity = $product['quantity'];

        $stmt->bindParam("order_id",$lastId);
        $stmt->bindParam("model_id",$model_id);
        $stmt->bindParam("ssize",$size);
        $stmt->bindParam("quantity",$quantity);
        $stmt->execute();

        //уменьшить количество этого размера этой модели в sizes_of_models
        $update_size = $connect->query("UPDATE sizes_of_models SET quantity = quantity - 1 WHERE `size` = '$size' AND model_id = '$model_id'")->execute();

    }

    $admin_email = "krm.shrftdnv@gmail.com";
    $admin_message = "<h2>Новый заказ под номером $lastId на сумму {$_SESSION['sum']} рублей.</h2>";
    $admin_message .= "<h3>Телефон заказчика: $phone.</h3>";
    $admin_message .= "<h3>Эл.почта заказчика: $email.</h3>";
    $date = date("d.m.y H:i");
    $admin_message .= "<h3>Дата и время заказа: $date.</h3>";
    $admin_message .= "<h3>Состав заказа:</h3>";

    $message = "<h2>Ваш заказ под номером $lastId принят.</h2>";
    $message .= "<h3>Состав заказа:</h3>";

    foreach ($_SESSION['cart'] as $product) {
        $string = "<p>{$product['model']} размера {$product['size']} в количестве {$product['quantity'] } шт.</p>";
        $message .= $string;
        $admin_message .= $string;
    }


    $message .= "<h3>Сумма заказа: {$_SESSION['sum']} рублей</h3>";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: shkar2001@mail.ru';

    $subject = "Ваш заказ под номером $lastId принят.";
    $admin_subject = "Новый заказ под номером $lastId.";

    mail($email, $subject, $message, $headers);
    mail($admin_email, $admin_subject, $admin_message, $headers);

    unset($_SESSION['total']);
    unset($_SESSION['sum']);
    unset($_SESSION['cart']);

    $_SESSION['order'] = $lastId;

}

header("Location: {$_SERVER['HTTP_REFERER']}");