<?php

session_start();
require_once "db/db.php";

$brands = $connect->query("SELECT * FROM brand");
$brands = $brands->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>";
//var_dump($brands);
//echo "</pre>";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php">SneakerShop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--    <li><a href="index.php">Главная</a></li>-->
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($brands as $brand) { ?>
                <li class="nav-item"><a class="nav-link"
                                        href="index.php?brand=<?php echo $brand["name"] ?>"><?php echo $brand["name"]; ?></a>
                </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="input-group mb-1 mt-1 ">
                    <input type="text" id="search" class="form-control bg-light border-light transition  flex-nowrap"
                           placeholder="Поиск..."
                           aria-describedby="button-addon2">
                    <div class="input-group-append">
                <span class="input-group-text bg-light border-light" id="basic-addon1">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd"
        d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z"
        clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"
        clip-rule="evenodd"/>
</svg>
                </span>
                    </div>
                </div>
            </li>
            <li class="nav-item ml-auto "><a class="nav-link"
                                             href="cart.php">Корзина <?php if (isset($_SESSION['total']) && ($_SESSION['total'] > 0)) {
                        $total = $_SESSION['total'];
                        $sum = $_SESSION['sum'];
                        echo "(Товаров:$total на сумму $sum руб)";
                    } ?></a></li>
        </ul>
    </div>
</nav>
<hr>