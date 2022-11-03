<?php

session_start();

if (isset($_POST['cancel'])) {
    session_destroy();
    header("Location: index.php");
    return;
}


$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // password =  php123

// Check to see if we have some POST data, if we do process it
if (isset($_POST['email']) && isset($_POST['pass'])) {

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['pass']);

    if (strlen($email) < 1 || strlen($password) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header('Location: login.php');
        return;
    } elseif (!str_contains($email, "@")) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header('Location: login.php');
        return;
    } else {
        $hashed_password = hash('md5', $salt . $password);
        if ($hashed_password === $stored_hash) {
            error_log("Login success " . $email);
            $_SESSION['name'] = $_POST['email'];
            header("Location: view.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail " . $email . " $hashed_password");
            header('Location: login.php');
            return;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Daniel Ouattara</title>
</head>

<body>

    <div class="container">
        <h1>Please Log In</h1>

        <?php
        if (isset($_SESSION['error'])) {
            echo ("<p style='color: red;'> $_SESSION[error] </p>");
            unset($_SESSION['error']);
        }
        ?>

        <form method="POST">
            <label for="email">Email : </label>
            <input type="text" name="email" id="email"><br />

            <label for="pass">Password : </label>
            <input type="text" name="pass" id="pass"><br />

            <input type="submit" value="Log In" />
            <form><input type="submit" name="cancel" value="Cancel"></form>
        </form>

        <p>
            For a password hint, view source and find a password hint
            in the HTML comments.
            <!-- Hint: The password is php123. -->
        </p>
    </div>

</body>

</html>