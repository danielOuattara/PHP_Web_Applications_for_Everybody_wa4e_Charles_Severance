<!DOCTYPE html>
<html>

<head>
    <title>daniel ouattara</title>
</head>

<body>
    <h1>Thibaud LOYRIAC Assignment 7 - PierreFeuilleCiseaux - login page</h1>
    <form method="POST">
        <input type="text" name="who" size="40" value="">
        <input type="text" name="pass" size="40" value="">
        <input type="submit" value="Log In" />
    </form>


    <?php
    $failure = false;  // If we have no POST data
    // If there is no parameter, error message is generated
    if (isset($_POST['who'])  && isset($_POST['pass'])) {
        if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
            $failure = "User name and password are required";
        } else {

            $pass = $_POST['pass'];
            $salt = 'XyZzy12*_';
            $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
            $md5 = hash('md5', $salt . $pass);

            if ($md5 == $stored_hash) {
                header("Location: 04_game.php?name=" . urlencode($_POST['who']));
            } else {
                $failure = "Incorrect password";
            }
        }
    }
    ?>

    <p>
        <?php
        if ($failure != false) {
            echo ('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
        }
        ?>
    </p>
</body>

</html>