<?php
if (isset($_POST["cancel"])) {
    header("Location: ./../index.php");
    return;
}

$username = "";
$password = "";
$message = "";

if (isset($_POST["who"]) && isset($_POST["pass"])) {
    $username = $_POST["who"];
    $password = $_POST["pass"];

    if (strlen($username) < 1 || strlen($password) < 1) {
        $message = "User name and password are required";
    } else {
        $salt = 'XyZzy12*_';
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $data = $salt . $password;
        $hashed_data = hash('md5', $data);

        if ($hashed_data !== $stored_hash) {
            $message = "Incorrect password";
        } else {
            header("Location: 03_game.php?name=" . urlencode($_POST["who"]));
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>daniel ouattara</title>
</head>

<body>
    <header class="header">
        <h1>Please Log In</h1>
    </header>
    <main class="main">
        <p class="error-message"><?= $message; ?></p>
        <form class="form" method="POST">
            <div class="form-group">
                <label class="form-group__label" for="who">User Name</label>
                <input class="form-group__input" type="text" name="who" id="who">
            </div>
            <div class="form-group">
                <label class="form-group__label" for="pass">Password</label>
                <input class="form-group__input" type="text" name="pass" id="pass">
            </div>
            <input class="form__btn" type="submit" value="Log In">
            <input class="form__btn" type="submit" name="cancel" value="Cancel">
        </form>
        <p>For a password hint, view source and find a password hint in the HTML comments.</p>
        <!-- Hint: The password is the three character name of the programming language used in this class 
                (all lower case) followed by 123. -->
    </main>
</body>

</html>