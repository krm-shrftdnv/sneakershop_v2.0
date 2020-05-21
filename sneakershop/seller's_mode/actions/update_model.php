<?php
session_start();
require_once "../db/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['update_id'])) {
        $id = $_SESSION['update_id'];
        $model = $_POST['model'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        var_dump($_FILES['img']);
        if($_FILES['img']['error'] != 4) { //проверка, что файл загружен
            //удаляем старую фотку
            $old_img_name = $connect->query("SELECT img FROM product WHERE id='$id'")->fetch(PDO::FETCH_ASSOC)["img"];
            $img_dir = "C:\\Users\\shkar\\PhpstormProjects\\sneakershop\\customer's_mode\\img\\";
            $img_file_name = $img_dir. basename($old_img_name);
            unlink($img_file_name);
            //добавляем новую
            $new_img_name = $_FILES['img']['name'];
            $img_file_name = $img_dir. basename($new_img_name);
            move_uploaded_file($_FILES["img"]["tmp_name"], $img_file_name);
            $query = "UPDATE product SET model=:model, brand=:brand, price=:price, img='$new_img_name', description=:description WHERE id='$id'";
        } else{
            $query = "UPDATE product SET model=:model, brand=:brand, price=:price, description=:description WHERE id='$id'";
        }

        $stmt = $connect->prepare($query);

        $model = htmlspecialchars(strip_tags($model));
        $brand = htmlspecialchars(strip_tags($brand));
        $price = htmlspecialchars(strip_tags($price));
        $description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam("model", $model);
        $stmt->bindParam("brand", $brand);
        $stmt->bindParam("price", $price);
        $stmt->bindParam("description",$description);

        $stmt->execute();

        if(!empty($_POST['sizes'])){
            $sizes = $_POST['sizes'];
            $connect->query("DELETE FROM sizes_of_models WHERE model_id='$id'")->execute();
            foreach ($sizes as $size)
                $connect->query("INSERT INTO sizes_of_models SET size='$size', model_id='$id', quantity = 10")->execute();
        }

        unset($_SESSION['update_id']);
        header("Location: /index.php");
    }
} else {
    $model_id = $_GET['id'];
    $_SESSION['update_id'] = $model_id;
    include "../forms/update_model_form.php";
}