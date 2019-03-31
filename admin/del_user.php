<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
include_once("admin_fc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        delete_user($_POST['username']);
        header("location: /admin/admin.php");
    }
}
$id = mysqli_real_escape_string($link, $_SESSION['id']);
$query = mysqli_query($link, "SELECT * FROM users WHERE id != $id"); ?>
<div class="green_bg"><p>
        <h2>Select an account to delete :</h2>
<?php
echo "<form action='/admin/del_user.php' method='post'>";
while (($array = mysqli_fetch_assoc($query)) !== null) {
    echo "<input type='radio' name='username' value=" . $array['id'] . ">" . $array['username'];
    echo "<br>";
}
echo "<input type='submit' value='Delete'></form>";
echo "</p></div>";