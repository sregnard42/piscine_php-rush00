<?php
require_once('../template/header.php');
require_once('admin_fc.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
if (isset($_GET['id']))
    $id = $_GET['id'];
else if (isset($_POST['product_id']) && $_POST['submit'] == "Edit") {
    edit_product($_POST['product_id'], $_POST['product_name'], $_POST['product_desc'], $_POST['product_price'], $_POST['product_stock']);
    header("location: /admin/admin.php");
}
$query = mysqli_query($link, "SELECT * FROM products");
?>
<div class="green_bg">
<p>
    <h2>Edit a product in the database :</h2>
    <form action='/admin/edit_prod.php' method='post'>
        <select name="product_id" size="1">
            <?php
            while (($array = mysqli_fetch_assoc($query)) !== null) {
                echo "<option value=" . $array['id'];
                if ($id == $array['id'])
                    echo " selected";
                echo ">" . $array['name'];
            }
            ?>
        </select><br>
        <label for="product_name">Name</label><input type="text" name="product_name" id="product_name" required><br />
        <label for="product_desc">Description</label><input type="text" name="product_desc" id="product_desc" required><br />
        <label for="product_price">Price</label><input type="number" min=0 name="product_price" id="product_price" required><br />
        <label for="product_stock">Stock</label><input type="number" min=0 name="product_stock" id="product_stock" required><br />
        <input type="submit" name="submit" value="Edit">
    </form>
</p>
</div> 
<?php require_once('../template/footer.php');