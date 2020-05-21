<?php
require_once "../db/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $_POST['model'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $sizes = $_POST['sizes'];
    $img_name = $_FILES['img']['name'];

    $query = "INSERT INTO product SET model=:model, brand=:brand, price=:price, img='$img_name', description=:description";

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

    $model_id = $connect->query("SELECT MAX(id) FROM product WHERE model='$model'")->fetch(PDO::FETCH_ASSOC)['MAX(id)'];

    if(!empty($sizes)){
        foreach ($sizes as $size)
            $connect->query("INSERT INTO sizes_of_models SET size='$size', model_id='$model_id', quantity = 10")->execute();
    }

    $img_dir = "C:\\Users\\shkar\\PhpstormProjects\\sneakershop\\customer's_mode\\img\\";
    $img_file_name = $img_dir. basename($img_name);
    move_uploaded_file($_FILES["img"]["tmp_name"], $img_file_name);

    header("Location: /index.php");

} else {
    include "../forms/add_model_form.php";
}