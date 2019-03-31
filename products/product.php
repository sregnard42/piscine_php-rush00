<?php
require_once "../template/header.php";
require_once "../admin/config.php";
include 'categories.php';
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $query = mysqli_query($link, "SELECT * FROM products WHERE id= '$id'");
    if (($array = mysqli_fetch_assoc($query)) === null)
        echo "<br>Ooops no product here !<a href=/index.php>Click here</a><br>";
    else {
        echo "<section class='product'>";
        echo "<a href='./product.php?id=" . $array['id'] . "'><img src=/img/" . $array['img'] . "></a>";
        echo "<p>" . $array['name'] . "</p>";
        echo "<p>" . $array['description'] . "</p>";
        echo "<p>Price : " . $array['price'] . " $</p>";
        echo "<p>Quantity in stock : " . $array['stock'] . "</p>";
        echo "<form action='/cart/cart.php' method='post'>
                <input type='hidden' name='action' value='add'>
                <input type='hidden' name='id' value='" . $array['id'] . "'>
                <input type='hidden' name='l' value='" . $array['name'] . "'>
                <input type='hidden' name='p' value='" . $array['price'] . "'>
                <input type='number' name='q' min='1' value='1'>
                <input type='submit' value='Add to cart' class=\"myButton\"></form>";
        echo "</section>";
        $query = mysqli_query(
            $link,
            "SELECT * FROM products WHERE id != '$id' AND id IN 
            (SELECT id_product FROM product_category WHERE id_category IN 
            (SELECT id_category FROM product_category WHERE id_product = '$id'))
            ORDER BY RAND()"
        );
        echo "<h3>Our similar products</h3><section class='small_product'>";
        while (($array = mysqli_fetch_assoc($query)) !== null) {
            echo "<div class='one_small_product'>";
            echo "<a href='/products/product.php?id=" . $array['id'] . "'><img src=/img/" . $array['img'] ." alt='product_img'></a>";
            echo "<p>" . $array['name'] . "</p>";
            echo "</div>";
        }
        echo "</section>";
    }
}
require_once "../template/footer.php";
