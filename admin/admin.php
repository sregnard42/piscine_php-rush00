<?php
include_once("../template/header.php");
include_once("../admin/config.php");

if ($_SESSION['key'] === "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3") {
    ?>
    <section class="admin_all">
<?php
    include("../admin/requesthandler.php");
    include("../admin/del_user.php");
    include("../admin/new_product.php");
    include("../admin/edit_product.php");
    include("../admin/new_categorie.php");
    include("../admin/delete_categorie.php");
    include("../admin/product_category.php");
    include("../admin/orders.php");
    mysqli_close($link);
?>
</section>
<?php
} else
    echo "Only for root";

include_once("../template/footer.php");