<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['submit'] == "Add") {
        product_category($_POST['product_id'], $_POST['cat']);
        header("location: /admin/admin.php");
    }
}
$query_prod = mysqli_query($link, "SELECT * FROM products");
$query_cat = mysqli_query($link, "SELECT * FROM categories");
?>
<div class="green_bg">
<p>
    <h2>Add categories to a product :</h2>
    <form action='/admin/product_category.php' method='post'>
        <select name="product_id" size="1">
            <?php
            while (($array = mysqli_fetch_assoc($query_prod)) !== null)
                echo "<option value=" . $array['id'] . ">" . $array['name'];
            ?>
        </select><br>
        <?php
        while (($array = mysqli_fetch_assoc($query_cat)) !== null)
            echo "<div><input type=\"checkbox\" name=\"cat[]\" value=" . $array['id'] . ">" . $array['name'] . "</div>";
        ?>
        <input type="submit" name="submit" value="Add">
    </form>
</p>
</div> 