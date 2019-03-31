<?php
require_once('../template/header.php');
if ($_SESSION['key'] !== "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    header("location: /index.php");
}
require_once("admin_fc.php");
$sql = "SELECT username, products.name, orders.quantity, products.price, orders.date
        FROM users, products, orders
        WHERE users.id = orders.id_user
        AND products.id = orders.id_product
        ORDER BY username";
$query = mysqli_query($link, $sql);
?>
<div class="green_bg">
<p>
    <h2>Current orders :</h2>
    <?php
    $total = 0;
    $order_total = 0; ?>
    <table style="margin:0 auto;">
        <tr>
            <th>Username</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Total price</th>
            <th>Date of order</th>
        </tr>
<?php
while (($array = mysqli_fetch_assoc($query)) !== null) {
    echo "<tr><td>" . $array['username'] . "</td>";
    echo "<td>" . $array['name'] . "</td>";
    echo "<td>" . $array['quantity'] . " $</td>";
    echo "<td>" . $array['price'] . " $</td>";
    $total = $array['quantity'] * $array['price'];
    $order_total += $total;
    echo "<td>" . $total . " $" . "</td>";
    echo "<td>" . $array['date'] . "</td></tr>";
}
?>
    </table>
    <?php echo "<p>Order total : " . $order_total . " $</p>"; ?>
</p>
</div> 