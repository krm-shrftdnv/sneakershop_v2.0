<?php

require_once "parts/header.php";

if (isset($_GET['brand'])) {
    $selectedBrand = $_GET['brand'];
    $products = $connect->query("SELECT * FROM product WHERE brand = '$selectedBrand'");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
    if (!$products) {
        die("Такой категории не найдено");
    }

} else {
    $products = $connect->query("SELECT * FROM product");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
}
?>
<style>
    .col-centered {
        float: none;
        margin: 0 auto;
    }
</style>
<div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">
    <div class="row row-cols-sm-2 mx-0 jus">
        <?php

        foreach ($products as $product) {
            $product_id = $product['id'];
            $sizes = $connect->query("SELECT * FROM sizes_of_models WHERE model_id = '$product_id'")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($sizes as $size) {
                $product['sizes'][$size['size']] = [
                    'size' => $size['size'],
                    'quantity' => $size['quantity']
                ];
            }
            ?>
            <div class="d-flex col-sm mx-0 mt-md-1 mb-md-1">
                <div class="card border-dark mt-sm-1 col-centered">
                    <a href="product.php?id=<?php echo $product['id'] ?>">
                        <img class="card-img-top" style="max-height: 200px" src="img/<?php echo $product['img'] ?>"
                             alt="<?php echo $product['model'] ?> photo">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "{$product['model']}"." "."{$product['price']}₽" ?></h4>
                        <?php require "parts/add.php" ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
