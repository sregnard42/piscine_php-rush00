<?php
require_once ("../template/header.php");
require_once ("../admin/config.php");
$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) >= 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            include ("../account/is_admin.php");
                            if (is_root() === true)
                                $_SESSION['key'] = "fee32be7c00e73eab97a39549d79af73aec87b6fa22a0b56867a4975fe82344cd9776c6d6dff419e0f2e415c492340bb8329bbfac0c872934df66466c2e0e5d3";
                            header("location: ../index.php");
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<h2>Login</h2>
<p>Please fill in your credentials to login.<br>
    <span class="text_error"><?php echo $username_err; ?></span><br>
    <span class="text_error"><?php echo $password_err; ?></span></p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> >
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" id="username">
    </div>
    <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> >
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <input type="submit" value="Login" class="myButton">
    </div>
</form>
<p>Don't have an account?<br />
<a href="register.php"><button class="myButton">Sign up now</button></a></p>
<?php
require_once ("../template/footer.php");
