<?php

session_start();

# user clicked cancel button
if (isset($_POST["cancel"])) {
    header('Location: index.php');
    return;
}

require_once('./pdo.php');

#  Check if server received some POST data
if (isset($_POST['login'])) {

    # against html injection
    $email = htmlentities($_POST['email']) ?? "";
    $pass = htmlentities($_POST['pass']) ?? "";

    # server side form input validation
    if (strlen($email) < 1 || strlen($pass) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header('Location: login.php');
        return;
    }
    if (!str_contains($email, "@")) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header('Location: login.php');
        return;
    }

    # check user email in database + retrieve some user data
    $sql = '
            SELECT user_id, name, password 
            FROM users  
            WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':email' => $email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    # user (with given email) NOT FOUND in database
    if ($user === false) {
        $_SESSION['error'] = 'User Not Found';
        header('Location: login.php');
        return;
    }

    $salt = 'XyZzy12*_';
    $hashed_password = hash('md5', $salt . $pass);

    # check user given hashed password against database hash password 
    if ($user['password'] === $hashed_password) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = "Incorrect password";
        header('Location: login.php');
        return;
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
            <input type="password" name="pass" id="pass"><br />

            <input type="submit" name="login" value="Log In" onclick="doValidate()" />
            <input type="submit" name="cancel" value="Cancel" />
        </form>
        <p>
            For a password hint, view source and find a password hint
            in the HTML comments.
            <!-- Hint: The password is php123. -->
        </p>
        <script>
            function doValidate() {
                console.log('Validation of form input !');
                try {
                    addr = document.getElementById('email').value;
                    pwd = document.getElementById('pass').value;
                    if (addr == false || pwd == false) {
                        alert("Both fields must be filled out");
                        return false;
                    } else if (addr.indexOf('@') == -1) {
                        alert("Invalid email address");
                        return false;
                    } else {
                        return true;
                    }
                } catch (err) {
                    console.log(err)
                    return false;
                }
                return false;
            }
        </script>
    </div>
</body>

</html>