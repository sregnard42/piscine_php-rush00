<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category_id']) && $_POST['submit'] === "Delete") {
        delete_category($_POST['category_id']);
        header("location: /admin/admin.php");
    }
}
$query = mysqli_query($link, "SELECT * FROM categories ");
?>
<div class="green_bg">
<h2>Delete category :</h2>
<form action='/admin/delete_categorie.php' method='post'>
    <select name="category_id" size="1" title="category">
        <?php
        while (($array = mysqli_fetch_assoc($query)) !== null)
            echo "<option value=" . $array['id'] . ">" . $array['name'];
        ?>
    </select><br>
    <input type="submit" name="submit" value="Delete">
</form>
</div>