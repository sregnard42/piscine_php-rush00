<?php
/**
 * Check if user is root
 * @return bool
 */
function is_root(){
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root42');
    define('DB_NAME', 'miniboutique');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "SELECT id FROM admin WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_close($stmt);
            return true;
        }
    }
    else {
        mysqli_stmt_close($stmt);
        return false;
    }
}