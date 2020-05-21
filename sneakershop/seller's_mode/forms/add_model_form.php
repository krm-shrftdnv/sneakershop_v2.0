<?php

require_once "../db/db.php";
$brands = $connect->query("SELECT * FROM brand");
$brands = $brands->fetchAll(PDO::FETCH_ASSOC);
require_once "../parts/header.php";
?>

<form enctype="multipart/form-data" action="../actions/add_model.php" method="post">
    <input type="text" name="model" placeholder="Модель">
    <select name="brand">
    <?php
    foreach ($brands as $brand) {
        ?>
        <option><?php echo $brand['name'] ?></option>
        <?php
    }
    ?>
    </select>
    <input type="text" name="price" placeholder="Цена"><br>

    <?php
    $sizes = $connect->query("SELECT * FROM shoe_size")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sizes as $size) {
        ?>

        <?php echo $size['size'] ?><input type="checkbox" name="sizes[]" value="<?php echo $size['size'] ?>"><br>
        <?php
    }
    ?>

<!--    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
    Прикрепить изображение: <input type="file" name="img">
    <textarea name="description" placeholder="Описание"></textarea>
    <input type="submit" value="Добавить">
</form>
