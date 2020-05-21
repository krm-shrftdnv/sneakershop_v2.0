<?php
//session_start();
require_once "../db/db.php";
$brands = $connect->query("SELECT * FROM brand");
$brands = $brands->fetchAll(PDO::FETCH_ASSOC);

$model_id = $_SESSION['update_id'];
$model = $connect->query("SELECT * FROM product WHERE id='$model_id'")->fetch(PDO::FETCH_ASSOC);
$sizes = $connect->query("SELECT * FROM sizes_of_models WHERE model_id = '$model_id'")->fetchAll(PDO::FETCH_ASSOC);
foreach ($sizes as $size) {
    $model['sizes'][$size['size']] = [
        'size' => $size['size'],
        'quantity' => $size['quantity']
    ];
}
require_once "../parts/header.php";
?>

<form enctype="multipart/form-data" action="../actions/update_model.php" method="post">
    Модель: <input type="text" name="model" placeholder="Модель" value="<?php echo $model['model'] ?>"><br>
    Бренд: <select name="brand">
        <?php
        foreach ($brands as $brand) {
        if ($brand['name'] == $model['brand']){
            ?>
            <option selected> <?php echo $brand['name'] ?> </option>
            <?php
        } else { ?>
            <option> <?php echo $brand['name'] ?> </option>
        <?php  }
        }
        ?>
    </select><br>
    Цена: <input type="text" name="price" placeholder="Цена" value="<?php echo $model['price'] ?>"><br>
    Доступные размеры:
    <select>
        <?php foreach ($model['sizes'] as $size) {
            if ($size['quantity'] >= 1) { ?>
                <option><?php echo $size['size'] ?></option>
                <?php
            }
        } ?>
    </select><br>

    Выберите размеры, которые будут доступны:<br>
    <?php
    $sizes = $connect->query("SELECT * FROM shoe_size")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sizes as $size) {
        ?>

        <?php echo $size['size'] ?><input type="checkbox" name="sizes[]" value="<?php echo $size['size'] ?>"><br>
        <?php
    }
    ?>

<!--    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>-->
    Прикрепить изображение: <input type="file" name="img"><br>
    Введите описание товара:<br>
    <textarea name="description" placeholder="Описание"><?php echo $model['description'] ?></textarea><br>
    <input type="submit" value="Сохранить">
</form>
