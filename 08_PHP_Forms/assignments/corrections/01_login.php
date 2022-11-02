<!DOCTYPE html>
<html>

<head>
    <title>daniel ouattara</title>
</head>

<body>
    <h1>Please Log In</h1>
    <p style="color: red; font-family: monospace;">
        <?php
        $salt = 'XyZzy12*_';
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $error = false;
        //password: php123
        //print_r($_POST);
        if (isset($_POST["cancel"])) header("Location: ./../index.php");

        if (isset($_POST["who"]) && isset($_POST["pass"])) {
            if (!((strlen($_POST["who"]) > 0) && (strlen($_POST["pass"]) > 0))) {
                print "User name and password are required";
                $error = true;
            } else {
                $passhash = hash('md5', $salt . $_POST['pass']);
                if ($passhash == $stored_hash) {
                    header("Location: 01_game.php?name=" . urlencode($_POST['who']));
                } else {
                    print "Incorrect password";
                    $error = true;
                }
            }
        }
        ?>
    </p>
    <form method="post">
        <label for="who">User Name</label>
        <input type="text" name="who" id="who" size="50" />
        <br>
        <label for="pass">Password</label>
        <input type="text" name="pass" id="pass" size="50" />
        <br>
        <input type="submit" value="Log In" />
        <input type="submit" value="Cancel" name="cancel" />
    </form>

</body>

</html>