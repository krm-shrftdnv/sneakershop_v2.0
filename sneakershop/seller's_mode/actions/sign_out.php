<?php
session_start();
if(isset($_SESSION['seller_mode'])) unset($_SESSION['seller_mode']);

header("Location: /index.php");
