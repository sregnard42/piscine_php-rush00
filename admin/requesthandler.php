<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
include_once("admin_fc.php");
if (isset($_POST['submit']))
    include_once("../template/header.php");
?>
<div class="green_bg"><p>
    <form id="sqlform" name="sqlform" action="/admin/requesthandler.php" method="post">
        <p>Send a custom SQL Request :</p>
        <textarea rows="5" cols="50" form="sqlform" id="sql" name="sql" >SELECT username, products.name, orders.quantity FROM users, products, orders WHERE users.id = orders.id_user AND products.id = orders.id_product ORDER BY username</textarea><br /> 
        <input type="submit" name="submit" value="Send" />
    </form>
    <p><a href="http://127.0.0.1:8100/phpmyadmin/server_sql.php"><button class="myButton" style="background-color:darkcyan">phpMyAdmin</button></a><br />
<?php
if (isset($_POST['submit'])) {
    echo "<a href=\"/admin/admin.php\"><button class=\"myButton\" style=\"background-color:darkcyan;\">Back to admin page</button></a></p>";
    $query = $_POST['sql'];
    echo "<p>" . $query . "</p>";
    $query = mysqli_query($link, $query);
    while ($array = mysqli_fetch_assoc($query))
    {
        echo "<p>";
        foreach($array as $col)
            echo $col . " \t ";
        echo "</p>";
    }
}
?>
</p></div>
<?php
if (isset($_POST['submit']))
    include_once("../template/footer.php");
