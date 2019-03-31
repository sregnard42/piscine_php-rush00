<?php
require_once("../template/header.php");
require_once ("../account/is_admin.php");
require_once ("../admin/config.php");
?>
    <p>
        <a href="del_user.php"><button class="myButton">Delete my account</button></a>
        <a href="reset_password.php"><button class="myButton">Change password</button></a>
        <?php if (is_root() === true) { ?>
            <a href="/admin/admin.php"><button class="myButton">Access to admin tools</button></a>
    <?php } ?>
    </p>
<?php
echo "</section>";
$id = mysqli_real_escape_string($link, $_SESSION['id']);
$query = mysqli_query(
    $link,
    "SELECT products.name, orders.quantity, price, orders.date 
            FROM products, orders 
            WHERE orders.id_user = '$id' 
            AND products.id = orders.id_product
            ORDER BY orders.date
  ");
$total = 0;
$order_total = 0;?>
    <table style="width:75%" class="your_cart">
        <tr>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Total Price</th>
            <th>Date of order</th>
        </tr>
<?php
while (($array = mysqli_fetch_assoc($query)) !== null) {
    echo "<tr><td>" . $array['name']."</td>";
    echo "<td>" . $array['quantity']."</td>";
    echo "<td>" . $array['price'] ." $</td>";
    $total = $array['quantity'] * $array['price'];
    $order_total += $total;
    echo "<td>". $total." $"."</td>";
    echo "<td>" . $array['date'] ."</td></tr>";
}
?>
    </table>
    <?php echo "<p>Order total : ".$order_total." $</p>"; ?>
<?php
require_once("../template/footer.php");