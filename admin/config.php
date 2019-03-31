<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root42');
define('DB_NAME', 'miniboutique');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error(). "<a href='../admin/install.php'><button class=\"myButton\">Install database</button></a>");
}
