<form class="d-flex-inline form-inline justify-content-between align-content-center" action="actions/add.php" method="post">
    <select class="custom-select" name="size" required>
        <?php foreach ($product['sizes'] as $size) {
            if($size['quantity'] >= 1) { ?>
                <option><?php echo $size['size'] ?></option>
                <?php
            }
        }?>
    </select>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" class="btn btn-dark" value="В корзину">
</form>