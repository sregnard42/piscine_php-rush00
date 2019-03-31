<?php
include 'template/header.php';
include 'admin/config.php';
include 'products/categories.php';
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $query = mysqli_query(
        $link,
        "SELECT * FROM products WHERE id IN (
    SELECT id_product FROM product_category WHERE id_category = $id)");
    if (($array = mysqli_fetch_assoc($query)) === null)
        echo "<br>Ooops no product here !<a href=./index.php>Click here</a><br>";
    else {
        echo '<div class="shop">';
         do {
            echo "<section class='product'>";
            echo "<a href='/products/product.php?id=" . $array['id'] . "'><img src=/img/" . $array['img'] ." alt='product_img'></a>";
            echo "<p>" . $array['name'] . "</p>";
            echo "</section>";
        } while (($array = mysqli_fetch_assoc($query)) !== null);
        echo "</div>";
    }
}
else {
    ?>
    <div class="shop">
    <?php
    $query = mysqli_query($link, "SELECT * FROM products ORDER BY RAND()");
    while (($array = mysqli_fetch_assoc($query)) !== NULL) {
        echo "<section class='product'>";
        echo "<a href='/products/product.php?id=" . $array['id'] . "'><img src=/img/" . $array['img'] ." alt='product_img'></a>";
        echo "<p>" . $array['name'] . "</p>";
        echo "</section>";
    }

    echo "</div>";
}
include 'template/footer.php';