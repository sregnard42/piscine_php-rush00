<?php
require_once "../template/header.php";
include_once("../admin/config.php");
include_once("cart_fc.php");
include_once("orders_fc.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $order_id = order_id_new();
    $user_id = $_SESSION['id'];
    $cart = $_SESSION['cart'];
    $nb_products = count_product();
    for ($i = 0; $i < $nb_products; $i++) {
        $product_id = $cart['id'][$i];
        $product_quantity = $cart['quantity'][$i];
        order_add($order_id, $user_id, $product_id, $product_quantity);
    }
    delete_cart();
    create_cart();
    header("location: /account/user.php");
} else {
    echo "<p>Please login to checkout</p>";
    echo "<a href='/account/login.php'><button class='myButton'>Login</button></a>";
}
require_once "../template/footer.php";