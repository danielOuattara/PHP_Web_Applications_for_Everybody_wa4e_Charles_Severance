<?php
session_start();

echo '<pre>';
print_r($_SESSION);
echo '</pre>';


if (isset($_POST['submit'])) {
    if ($_POST['account'] === "" or $_POST['pw'] === "") {
        $_SESSION["error"] = "account & password are required";
        header('Location: login.php');
        return;
    } else {
        if ($_POST['pw'] !== 'umsi') {
            $_SESSION["error"] = "Incorrect password.";
            header('Location: login.php');
            return;
        } else {
            unset($_SESSION["account"]);  // Logout current user
            $_SESSION["account"] = $_POST["account"];
            $_SESSION["success"] = "Logged in.";
            header('Location: app.php');
            return;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>


<body style="font-family: sans-serif;">
    <h1>Please Log In</h1>
    <?php
    if (isset($_SESSION["error"])) {
        echo ('<p style="color:red">' . $_SESSION["error"] . "</p>\n");
        unset($_SESSION["error"]);
    }
    ?>
    <form method="post">
        <p>Account: <input type="text" name="account"></p>
        <p>Password: <input type="text" name="pw"></p>
        <!-- password is umsi -->
        <p>
            <input type="submit" value="Log In" name="submit" />
            <a href="app.php">Cancel</a>
        </p>
    </form>
</body>

</html>