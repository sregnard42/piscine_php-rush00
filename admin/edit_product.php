<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id'])) {
        if ($_POST['submit'] == "Delete") {
            del_product($_POST['product_id']);
            header("location: /admin/admin.php");
        }
        if ($_POST['submit'] == "Edit") {
            header("location: /admin/edit_prod.php?id=" . $_POST['product_id']);
        }
    }
}
$query = mysqli_query($link, "SELECT * FROM products");
?>
<div class="green_bg">
<p>
    <h2>Edit a product in the database :</h2>
    <form action='/admin/edit_product.php' method='post'>
        <select name="product_id" size="1">
            <?php
            while (($array = mysqli_fetch_assoc($query)) !== null)
                echo "<option value=" . $array['id'] . ">" . $array['name'];
            ?>
        </select><br>
        <input type="submit" name="submit" value="Edit">
        <input type="submit" name="submit" value="Delete">
    </form>
</p>
</div> 