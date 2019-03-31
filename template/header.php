<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo htmlspecialchars($_SESSION["username"]);
        }
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/cart.css">
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <link rel="stylesheet" type="text/css" href="/css/body.css">
    <link rel="stylesheet" type="text/css" href="/css/about_us.css">
    <link rel="shortcut icon" type="image/png" href="https://www.donbrocoli.com/wp-content/uploads/2018/05/cropped-favicon.gif"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
<header>
    <div>
        <a href="/index.php"><img src="/img/logo.png" alt="logo" class="logo"></a>
    </div>
    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        ?>
        <div>
            <h2>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>. Welcome to the Brocostore.</h2>
        </div>
        <div>
            <i class="fas fa-sign-out-alt"></i>
            <a href="/account/logout.php">Sign Out</a>
        </div>
        <div>
            <i class="fas fa-user-alt"></i>
            <a href="/account/user.php">My Account</a>
        </div>
        <div>
            <i class="fas fa-shopping-cart"></i>
            <a href="/cart/cart.php">Cart</a>
        </div>
        <?php
    }
    else {
        ?>
        <div>
            <h2>Hi, Welcome to the Brocostore.</h2>
        </div>
        <div>
            <i class="fas fa-sign-in-alt"></i>
            <a href="/account/login.php">Login</a>
        </div>
        <div>
            <i class="fas fa-user-plus"></i>
            <a href="/account/register.php">Register</a>
        </div>
        <div>
            <i class="fas fa-shopping-cart"></i>
            <a href="/cart/cart.php">Cart</a>
        </div>
        <?php
    }
    ?>
</header>
