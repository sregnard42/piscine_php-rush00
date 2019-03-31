<?php
require_once "../template/header.php";
require_once "../admin/config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $_POST['username'] = mysqli_real_escape_string($_POST['username']);
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) >= 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.<br>
        <span class="text_error"><?php echo $username_err; ?></span><br>
        <span class="text_error"><?php echo $password_err; ?></span><br>
        <span class="text_error"><?php echo $confirm_password_err; ?></span><br>
    </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>" id="username">
        </div>
        <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>" id="password">
        </div>
        <div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" id="confirm_password">
        </div>
            <input type="submit" value="Submit" class="myButton">
            <input type="reset" value="Reset" class="myButton">
    </form>
    <p>Already have an account ?<br />
    <a href="/login.php"><button class="myButton">Login here</button></a></p>
<?php
require_once "../template/footer.php";