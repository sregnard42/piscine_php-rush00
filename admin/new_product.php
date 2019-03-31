<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_name']) && $_POST['submit'] === "Create") {
        new_product($_POST['product_name'], $_POST['product_desc'], $_POST['product_price']);
        header("location: /admin/admin.php");
    }
}
?>
<div class="green_bg">
<p>
    <h2>Add a new product to the database :</h2>
    <form action='/admin/new_product.php' method='post'>
        <label for="product_name">Name</label><input type="text" name="product_name" id="product_name" required><br />
        <label for="product_desc">Description</label><input type="text" name="product_desc" id="product_desc" required><br />
        <label for="product_price">Price</label><input type="number" min=0 name="product_price" id="product_price" required><br />
        <input type="submit" name="submit" value="Create">
    </form>
</p>
</div> 