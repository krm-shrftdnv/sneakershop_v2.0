<?php
session_start();
require_once "../db/db.php";

if(isset($_SESSION['seller_mode'])) {
    $model_id = $_GET['id'];

    $delete_model = $connect->query("DELETE FROM product WHERE id='$model_id'")->execute();
    $delete_sizes = $connect->query("DELETE FROM sizes_of_models WHERE model_id='$model_id'")->execute();
}

header('Location: /index.php');