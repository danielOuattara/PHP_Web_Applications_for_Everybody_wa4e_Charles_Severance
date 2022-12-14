<?php // Do not put any HTML above this line


if (isset($_POST['cancel'])) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // password =  php123
$failure = false;  // If we have no POST data


// Check to see if we have some POST data, if we do process it
if (isset($_POST['who']) && isset($_POST['pass'])) {

    $who = htmlentities($_POST['who']);
    $password = htmlentities($_POST['pass']);

    if (strlen($who) < 1 || strlen($password) < 1) {
        $failure = "Email and password are required";
    } elseif (!str_contains($who, "@")) {
        $failure = "Email must have an at-sign (@)";
    } else {
        $check = hash('md5', $salt . $password);
        if ($check == $stored_hash) {
            // Redirect the browser to autos.php
            // header('HTTP/1.1 302 Redirect');
            error_log("Login success " . $who);
            header("Location: autos.php?name=" . urlencode($who), true, 302);
            return;
        } else {
            $failure = "Incorrect password";
            error_log("Login fail " . $who . " $check");
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
        // Note triple not equals and think how badly double
        // not equals would work here...
        if ($failure !== false) {
            // Look closely at the use of single and double quotes
            echo ('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
        }
        ?>

        <form method="POST">
            <label for="who">User Name : </label>
            <input type="text" name="who" id="who"><br />

            <label for="id_1723">Password: </label>
            <input type="text" name="pass" id="id_1723"><br />

            <input type="submit" value="Log In">
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