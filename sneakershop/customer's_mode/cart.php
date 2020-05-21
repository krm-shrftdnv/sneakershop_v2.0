<?php

require_once "db/db.php";
require_once "parts/header.php";
if (isset($_SESSION['order'])) { ?>
<div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">
    <h2>Ваш заказ под номером <?php echo $_SESSION['order'] ?> принят.</h2>
    <p>Проверьте указанную почту.</p>
    <a href="index.php">На главную</a>
</div>
    <?php
} else if (isset($_SESSION['cart']) && ($_SESSION['total'] > 0)) { ?>
<div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">
    <h1 class="title  mb-5 mt-3">Корзина</h1>
    <?php
    foreach ($_SESSION['cart'] as $product) {
        ?>
        <div class="card">
            <a href="product.php?id=<?php echo $product['id'] ?>"><img src="img/<?php echo $product['img'] ?>"
                                                                       style="max-height: 552px" class="card-img-top"
                                                                       alt="<?php echo $product['model'] ?> photo"></a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['model'] ?></h5>
                <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>-->
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <svg class="bi bi-inboxes" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M.125 11.17A.5.5 0 01.5 11H6a.5.5 0 01.5.5 1.5 1.5 0 003 0 .5.5 0 01.5-.5h5.5a.5.5 0 01.496.562l-.39 3.124A1.5 1.5 0 0114.117 16H1.883a1.5 1.5 0 01-1.489-1.314l-.39-3.124a.5.5 0 01.121-.393zm.941.83l.32 2.562a.5.5 0 00.497.438h12.234a.5.5 0 00.496-.438l.32-2.562H10.45a2.5 2.5 0 01-4.9 0H1.066zM3.81.563A1.5 1.5 0 014.98 0h6.04a1.5 1.5 0 011.17.563l3.7 4.625a.5.5 0 01-.78.624l-3.7-4.624A.5.5 0 0011.02 1H4.98a.5.5 0 00-.39.188L.89 5.812a.5.5 0 11-.78-.624L3.81.563z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M.125 5.17A.5.5 0 01.5 5H6a.5.5 0 01.5.5 1.5 1.5 0 003 0A.5.5 0 0110 5h5.5a.5.5 0 01.496.562l-.39 3.124A1.5 1.5 0 0114.117 10H1.883A1.5 1.5 0 01.394 8.686l-.39-3.124a.5.5 0 01.121-.393zm.941.83l.32 2.562A.5.5 0 001.884 9h12.234a.5.5 0 00.496-.438L14.933 6H10.45a2.5 2.5 0 01-4.9 0H1.066z"
                              clip-rule="evenodd"/>
                    </svg>
                    Количество: <?php echo $product['quantity'] ?>
                </li>
                <li class="list-group-item ">
                    <svg class="bi bi-arrows-fullscreen" width="1.3em" height="1.3em" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M1.464 10.536a.5.5 0 01.5.5v3h3a.5.5 0 010 1h-3.5a.5.5 0 01-.5-.5v-3.5a.5.5 0 01.5-.5z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M5.964 10a.5.5 0 010 .707l-4.146 4.147a.5.5 0 01-.707-.708L5.257 10a.5.5 0 01.707 0zm8.854-8.854a.5.5 0 010 .708L10.672 6a.5.5 0 01-.708-.707l4.147-4.147a.5.5 0 01.707 0z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M10.5 1.5A.5.5 0 0111 1h3.5a.5.5 0 01.5.5V5a.5.5 0 01-1 0V2h-3a.5.5 0 01-.5-.5zm4 9a.5.5 0 00-.5.5v3h-3a.5.5 0 000 1h3.5a.5.5 0 00.5-.5V11a.5.5 0 00-.5-.5z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M10 9.964a.5.5 0 000 .708l4.146 4.146a.5.5 0 00.708-.707l-4.147-4.147a.5.5 0 00-.707 0zM1.182 1.146a.5.5 0 000 .708L5.328 6a.5.5 0 00.708-.707L1.889 1.146a.5.5 0 00-.707 0z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M5.5 1.5A.5.5 0 005 1H1.5a.5.5 0 00-.5.5V5a.5.5 0 001 0V2h3a.5.5 0 00.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                    Размер: <?php echo $product['size'] ?>
                </li>
                <li class="list-group-item">
                    <svg class="bi bi-bag" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M14 5H2v9a1 1 0 001 1h10a1 1 0 001-1V5zM1 4v10a2 2 0 002 2h10a2 2 0 002-2V4H1z"
                              clip-rule="evenodd"/>
                        <path d="M8 1.5A2.5 2.5 0 005.5 4h-1a3.5 3.5 0 117 0h-1A2.5 2.5 0 008 1.5z"/>
                    </svg>
                    Стоимость: <?php echo $product['quantity'] * $product['price'] ?>
                </li>
            </ul>
            <div class="card-body container-fluid">
                <form class="container-fluid" action="actions/delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                    <input class="container-fluid btn btn-outline-danger" type="submit" value="Удалить">
                </form>
            </div>
        </div>
        <?php
    }
    ?>

    <h1 class="title  mb-5 mt-3">Оформить заказ</h1>
    <form action="actions/order.php" method="post" class="order">
        <div class="form-group">
            <label>Ваше имя</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><svg class="bi bi-person" width="1em" height="1em"
                                                        viewBox="0 0 16 16" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd"
        d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z"
        clip-rule="evenodd"/>
</svg></span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Ильдар" aria-label="somebody"
                       aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="form-group">
            <label>Ваша электронная почта</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><svg class="bi bi-envelope" width="1em"
                                                        height="1em" viewBox="0 0 16 16"
                                                        fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M14 3H2a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1zM2 2a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H2z"
                              clip-rule="evenodd"/>
                        <path fill-rule="evenodd"
                              d="M.071 4.243a.5.5 0 01.686-.172L8 8.417l7.243-4.346a.5.5 0 01.514.858L8 9.583.243 4.93a.5.5 0 01-.172-.686z"
                              clip-rule="evenodd"/>
                        <path d="M6.752 8.932l.432-.252-.504-.864-.432.252.504.864zm-6 3.5l6-3.5-.504-.864-6 3.5.504.864zm8.496-3.5l-.432-.252.504-.864.432.252-.504.864zm6 3.5l-6-3.5.504-.864 6 3.5-.504.864z"/>
                    </svg></span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="somebody@example.com"
                       aria-label="somebody"
                       aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="form-group">
            <label>Ваш номер</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><svg class="bi bi-lock" width="1em" height="1em"
                                                                          viewBox="0 0 16 16" fill="currentColor"
                                                                          xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd"
        d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z"
        clip-rule="evenodd"/>
</svg></span>
                </div>
                <input type="tel" name="phone" class="form-control" placeholder="89999999999" aria-label="somebody"
                       aria-describedby="basic-addon1">
            </div>
        </div>
        <small class="form-text text-muted">Используем номер и почту для рассылки только важной
            информации.</small>
        <button type="submit" name="order" class="container-fluid btn btn-primary mt-2">Заказать</button>
    </form>

    <?php
    } else {
        ?>
        <div class="container-sm p-4 " style="max-width: 40em; margin-top: 50px">
            <h2>В вашей корзине ещё нет
                покупок</h2>
        </div>
        <!--    <a href="index.php">На главную</a>-->
        <?php
    }
    ?>
