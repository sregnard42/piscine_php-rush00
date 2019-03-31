<?php
require_once("../template/header.php");
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "../admin/config.php";
$password = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $_SESSION["username"];
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        $sql = "DELETE FROM users WHERE username = ?";
                        if($stmt = mysqli_prepare($link, $sql)){
                            mysqli_stmt_bind_param($stmt, "s", $param_username);
                            if(mysqli_stmt_execute($stmt)){
                                session_destroy();
                                header("location: login.php");
                                exit();
                            }
                        }
                        mysqli_stmt_close($stmt);
                    } else{
                        $password_err = "The password you entered was not valid.";
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
    <h2>Delete account</h2>
    <p>Please fill out this form to delete your account.<br>
        <span class="text_error"><?php echo $password_err; ?></span>
    </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> >
            <label for="password">Password</label><input type="password" name="password" id ="password" value="<?php echo htmlspecialchars($password); ?>">
        </div>
        <div>
            <input type="submit" value="Submit" class="myButton">
        </div>
    </form>
    <a href="/account/user.php"><button class="myButton">Cancel</button></a>
<?php
require_once("../template/footer.php");