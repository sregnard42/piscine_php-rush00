<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category_name']) && $_POST['submit'] === "Create") {
        new_category($_POST['category_name']);
        header("location: /admin/admin.php");
    }
}
?>
<div class="green_bg">
<h2>Create category :</h2>
<form action='/admin/new_categorie.php' method='post'>
    <label for="category_name">Name</label><input type="text" name="category_name" id="category_name" required><br />
    <input type="submit" name="submit" value="Create">
</form>
</div>