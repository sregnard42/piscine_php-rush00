<?php
/**
 * Check if cart exist if not create it.
 * @return bool
 */
function create_cart(){
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();
        $_SESSION['cart']['id'] = array();
        $_SESSION['cart']['product'] = array();
        $_SESSION['cart']['quantity'] = array();
        $_SESSION['cart']['price'] = array();
        $_SESSION['cart']['lock'] = false;
    }
    return true;
}


/**
 * Add product in cart
 * @param string $product
 * @param int $quantity
 * @param float $price
 * @return void
 */
function add_product($id,$product,$quantity,$price){

    //Si le panier existe
    if (create_cart() && !is_lock())
    {
        //Si le produit existe déjà on ajoute seulement la quantité
        $product_position = array_search($product,  $_SESSION['cart']['product']);

        if ($product_position !== false)
        {
            $_SESSION['cart']['quantity'][$product_position] += $quantity ;
        }
        else
        {
            //Sinon on ajoute le produit
            array_push( $_SESSION['cart']['id'],$id);
            array_push( $_SESSION['cart']['product'],$product);
            array_push( $_SESSION['cart']['quantity'],$quantity);
            array_push( $_SESSION['cart']['price'],$price);
        }
    }
    else
        echo "Ooops ! You find a bug ! Contact the admin.";
}



/**
 * Change quantity of product in cart
 * @param $product
 * @param $quantity
 * @return void
 */
function modification_product($product,$quantity){
    //Si le panier éxiste
    if (create_cart() && !is_lock())
    {
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($quantity > 0)
        {
            //Recharche du produit dans le panier
            $product_position = array_search($product,  $_SESSION['cart']['product']);

            if ($product_position !== false)
            {
                $_SESSION['cart']['quantity'][$product_position] = $quantity ;
            }
        }
        else
            delete_product($product);
    }
    else
        echo "Ooops ! You find a bug ! Contact the admin.";
}

/**
 * Delete product in cart.
 * @param $product
 * @return void
 */
function delete_product($product){
    if (create_cart() && !is_lock())
    {
        $tmp=array();
        $tmp['id'] = array();
        $tmp['product'] = array();
        $tmp['quantity'] = array();
        $tmp['price'] = array();
        $tmp['lock'] = $_SESSION['cart']['lock'];

        for($i = 0; $i < count($_SESSION['cart']['product']); $i++)
        {
            if ($_SESSION['cart']['product'][$i] !== $product)
            {
                array_push( $tmp['id'],$_SESSION['cart']['id'][$i]);
                array_push( $tmp['product'],$_SESSION['cart']['product'][$i]);
                array_push( $tmp['quantity'],$_SESSION['cart']['quantity'][$i]);
                array_push( $tmp['price'],$_SESSION['cart']['price'][$i]);
            }
        }
        $_SESSION['cart'] =  $tmp;
        unset($tmp);
    }
    else
        echo "Ooops ! You find a bug ! Contact the admin.";
}


/**
 * Total price of product in cart
 * @return int
 */
function total_price(){
    $total=0;
    for($i = 0; $i < count($_SESSION['cart']['product']); $i++)
    {
        $total += $_SESSION['cart']['quantity'][$i] * $_SESSION['cart']['price'][$i];
    }
    $_SESSION['total_price'] = $total;
    return $total;
}


/**
 * Delete cart
 * @return void
 */
function delete_cart(){
    unset($_SESSION['cart']);
}

/**
 * Know if cart is lock
 * @return bool
 */
function is_lock(){
    if (isset($_SESSION['cart']) && $_SESSION['cart']['lock'])
        return true;
    else
        return false;
}

/**
 * Count number of product in the cart
 * @return int
 */
function count_product()
{
    if (isset($_SESSION['cart']))
        return count($_SESSION['cart']['product']);
    else
        return 0;
}