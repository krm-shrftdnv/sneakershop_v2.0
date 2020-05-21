<?php

require_once "parts/header.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $product = $connect->query("SELECT * FROM product WHERE id = '$product_id'");
    $product = $product->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Такой модели у нас пока нет.");
    }
    $sizes = $connect->query("SELECT * FROM sizes_of_models WHERE model_id = '$product_id'")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sizes as $size) {
        $product['sizes'][$size['size']] = [
            'size' => $size['size'],
            'quantity' => $size['quantity']
        ];
    }
}

?>
<div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">
    <h1 class="title  mb-5 mt-3">О товаре</h1>
    <div class="card">
        <!--        <a href="index.php">Вернуться на главную</a>-->
        <img src="img/<?php echo $product['img'] ?>" style="max-height: 552px" class="card-img-top"
             alt="<?php echo $product['model'] ?> photo">
        <div class="card-body">
            <h5 class="card-title"><?php echo $product['model'] ?><?php echo $product['price'] ?></h5>
            <p class="card-text"> <?php echo $product['description'] ?></p>
        </div>
        <div class="card-body container-fluid">
            <?php require "parts/add.php" ?>
        </div>
    </div>
</div>
