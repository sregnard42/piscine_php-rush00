<?php
require_once "../template/header.php";
include_once("cart_fc.php");

$error = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
    if(!in_array($action,array('add', 'delete', 'refresh')))
        $error=true;

    //récuperation des variables en POST ou GET
    $id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;
    $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
    $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
    $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '',$l);
    //On verifie que $p soit un float
    $p = floatval($p);

    //On traite $q qui peut etre un entier simple ou un tableau d'entier

    if (is_array($q)){
        $quantity = array();
        $i=0;
        foreach ($q as $content){
            $quantity[$i++] = intval($content);
        }
    }
    else
        $q = intval($q);

}

if (!$error){
    switch($action){
        Case "add":
            add_product($id,$l,$q,$p);
            break;

        Case "delete":
            delete_product($l);
            break;

        Case "refresh" :
            for ($i = 0 ; $i < count($quantity) ; $i++)
            {
                modification_product($_SESSION['cart']['product'][$i],round($quantity[$i]));
            }
            break;
        Default:
            break;
    }
}
?>
    <div class="cart">
        <form method="post" action="cart.php">
            <table>
                <tr>
                    <td colspan="4" class="your_cart">Your Cart</td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Action</td>
                </tr>


                <?php
                if (create_cart())
                {
                    $number_of_products=count($_SESSION['cart']['product']);
                    if ($number_of_products <= 0)
                        echo "<tr><td>Your cart is empty </td></tr>";
                    else
                    {
                        for ($i=0 ;$i < $number_of_products ; $i++)
                        {
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($_SESSION['cart']['product'][$i])."</ td>";
                            echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['cart']['quantity'][$i])."\"/></td>";
                            echo "<td>".htmlspecialchars($_SESSION['cart']['price'][$i])." $</td>";
                            echo "<td><a href=\"".htmlspecialchars("cart.php?action=delete&l=".rawurlencode($_SESSION['cart']['product'][$i]))."\"><i class=\"far fa-trash-alt\"></i></a></td>";
                            echo "</tr>";
                        }
                        echo "<tr><td colspan=\"2\"> </td>";
                        echo "<td colspan=\"2\">";
                        echo "Total : ".total_price()." $";
                        echo "</td></tr>";

                        echo "<tr><td colspan=\"4\">";
                        echo "<input class=\"myButton\" type=\"submit\" value=\"Refresh\"/>";
                        echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                        echo "</td></tr>";
                    }
                }
                ?>
            </table>
        </form>
    </div>
<div id="button_cart">
    <a href="/cart/checkout.php"><button class="myButton">Checkout</button></a>
    <a href="/index.php"><button class="myButton">Continue shopping</button></a>
</div>
<?php
require_once "../template/footer.php";