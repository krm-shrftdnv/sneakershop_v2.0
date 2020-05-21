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

    .transition {
        transition: all 300ms ease-out;
    }

    .card {
        transition: all 600ms ease-out;
    }

    .card:hover {
        border-color: #000000;
        -moz-box-shadow: 0 0 12px #000000;
        -webkit-box-shadow: 0 0 12px #000000;
        box-shadow: 0 0 12px #000000;
    }
</style>
<div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">

    <!--search-->
    <div id="titlesearch">
        <div class="radio-group flex-row d-flex flex-row mt-3 mb-5 justify-content-between align-content-center">
            <div class="align-self-center">
                <h1 class="title my-auto">Найдено<span class="badge badge-dark transition  ml-sm-3"></span></h1>
            </div>
            <div data-value="adidas" class="align-self-center radio transition">
                    <span class="my-auto badge badge-pill badge-dark  transition"
                    >Adidas</span>
            </div>
            <div data-value="nike" class="my-auto align-self-center radio">
                <span class="badge badge-pill badge-dark  transition" style="font-weight: 500">Nike</span>
            </div>
            <div data-value="puma" class="my-auto align-self-center radio">
                <span class="radio badge badge-pill badge-dark transition" style="font-weight: 500">Puma</span>
            </div>
            <div data-value="reebok" class="my-auto align-self-center radio">
                <span class="radio badge badge-pill badge-dark transition" style="font-weight: 500">Reebok</span>
            </div>
            <input hidden id="priorityfilter" type="text" name="radio-value"/>
        </div>
    </div>
    <div id="title">
        <h1 class="title mt-3 mb-5 ">Все товары<span class="badge badge-dark transition  ml-sm-3"><?php sizeof($products) ?></span></h1>
    </div>

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
                        <img class="card-img-top" style="max-height: 250px" src="img/<?php echo $product['img'] ?>"
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
<!--search-->
<script>
    $('.radio-group .radio ').hover(
        function () {
            $(this).children().addClass('pl-sm-4 pr-sm-4 radio-hover')
        },
        function () {
            $(this).children().removeClass(' pl-sm-4 pr-sm-4 radio-hover')
        }
    );

    $('.radio-group .radio').click(function () {
        let alreadyselected = $(this).children().hasClass('selected');
        $(this).parent().find('.radio').children().removeClass('selected pt-2 pb-2');
        if (alreadyselected) {
            $(this).parent().find('input').val("");
            search(false);
        } else {
            $(this).children().addClass('selected pt-2 pb-2');
            var val = $(this).attr('data-value');
            $(this).parent().find('input').val(val);
            search(true);
        }
    });
    $(document).ready(function () {
        $("#titlesearch").hide();
        $("#search").keyup(search);
    });

    function search(withFilter) {
        let value = $("#search").val().toLowerCase();
        let words= value.split(" ");
        let count = 0;
        let searching = value.length !== 0;

        $(".card").filter(function () {
            let totalFilter=true;
            let thisText=$(this).text().toLowerCase();
            for (let i = 0; i < words.length ; i++) {
                totalFilter=totalFilter&&(thisText.indexOf(words[i]) > -1);
            }
            let priorityFilter = true;
            if (searching && withFilter) {

                let priority = $("#priorityfilter").val();
                priorityFilter = (thisText.indexOf(priority) > -1);
            }
            if (totalFilter && priorityFilter) {
                count++;
            }
            $(this).toggle(totalFilter&& priorityFilter);
        });
        if (searching) {//searching
            hideTitles(count, 400);
        } else {//stop searching
            showTitles(400);
        }
    }

    function hideTitles(count, delay) {
        $("#titlesearch h1 span").text(count);
        $("#title").hide();
        $("#titlesearch").show();
    }

    function showTitles(delay) {
        $("#titlesearch").hide();
        $("#title").show();
    }

    $("#search").hover(
        function () {
            $(this).addClass('pr-sm-5');
        },
        function () {
            $(this).removeClass('pr-sm-5');
        }
    );
    $("#search").focus(
        function () {
        },
        function () {
        }
    );
</script>
