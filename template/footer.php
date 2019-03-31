<footer>
    <div>
        <a href="/index.php"><i class="fas fa-store"></i></a>
        <a href="/about_us.php">About us</a>
    </div>
    <div class="cart_footer">
        <?php
        if(isset($_SESSION['cart']) && count($_SESSION['cart']['product']) >= 1)
        {
            echo "<p><i class=\"fas fa-shopping-cart\"></i> Product ".$number_of_products=count($_SESSION['cart']['product'])."</p>";
            if (isset($_SESSION['total_price'])) {
                echo "<p>Total price : ".$_SESSION['total_price']." $</p>";
            }
        }
        ?>
    </div>
    <div>
        <a href="/index.php"><img src="/img/logo.png" alt="logo"></a>
    </div>
</footer>
</body>
</html>
