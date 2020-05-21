<?php
session_start();
if (isset($_SESSION['seller_mode'])) {
    require_once "db/db.php";
    require_once "parts/header.php";
    $products = $connect->query("SELECT * FROM product");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <a href="actions/add_model.php"><button>Добавить модель</button></a>
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
        <div>
            <p><?php echo $product['model'] ?></p>
            <select>
                <?php foreach ($product['sizes'] as $size) {
                    if($size['quantity'] >= 1) { ?>
                        <option><?php echo $size['size'] ?></option>
                        <?php
                    }
                }?>
            </select>
            <a href="actions/update_model.php?id=<?php echo $product['id'] ?>"><button>Обновить модель</button></a>
            <a href="actions/delete_model.php?id=<?php echo $product['id'] ?>"><button>Удалить модель</button></a>

        </div>
        <?php
    }
    ?>

    <?php
} else
    include "forms/sign_in_form.html";
?>