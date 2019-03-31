<?php

require_once("../admin/config.php");

function order_id_new()
{
    $id = 1;
    while (order_id_exists($id) === true)
        ++$id;
    return $id;
}

function order_id_exists($id)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "SELECT id_order FROM `orders` WHERE id_order = $id";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists = (mysqli_stmt_num_rows($stmt) >= 1) ? true : false;
    mysqli_stmt_close($stmt);
    return $exists;
}

function order_add($order_id, $user_id, $product_id, $product_quantity)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO `orders`(`id_order`, `id_user`, `id_product`, `quantity`) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $order_id, $user_id, $product_id, $product_quantity);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}