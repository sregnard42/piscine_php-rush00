<?php

require_once("config.php");

/**
 * Delete user
 * @param $user
 * @return void
 */
function delete_user($id)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "DELETE FROM `users` WHERE `id`= ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function new_product($name, $desc, $price)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO products (name, description, price, stock, img) VALUES (?,?,?,1,'default.jpg')";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $desc, $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function del_product($id)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function edit_product($id, $name, $desc, $price, $stock)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "UPDATE `products` SET `name`=?,`description`=?,`price`=?,`stock`=? WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssiii", $name, $desc, $price, $stock, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function new_category($name)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function delete_category($id)
{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function product_category($product_id, $category_ids)
{
    print_r($category_ids);
    foreach ($category_ids as $category_id)
        add_cat_to_prod($product_id, $category_id);
}

function add_cat_to_prod($product_id, $category_id)
{
    echo "id_product = " . $product_id . "\n";
    echo "id_cat = " . $category_id . "\n";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO product_category (`id_product`, `id_category`) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $product_id, $category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}