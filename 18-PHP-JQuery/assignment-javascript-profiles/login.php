<?php

session_start();

# user clicked cancel button
if (isset($_POST["cancel"])) {
    header('Location: index.php');
    return;
}

require_once('./pdo.php');
require('./utilities.php');


#  Check if server received some POST data
if (isset($_POST['login'])) {

    # against html injection
    $email = htmlentities($_POST['email']) ?? "";
    $pass = htmlentities($_POST['pass']) ?? "";

    # server side form input validation
    if (empty($email) || empty($pass)) {
        $_SESSION['error'] = "User name and password are required";
        header('Location: login.php');
        return;
    }
    if (!str_contains($email, "@")) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header('Location: login.php');
        return;
    }
    //---

    $salt = 'XyZzy12*_';
    $hashed_password = hash('md5', $salt . $pass);

    # check user email in database + retrieve some user data
    $sql = '
            SELECT 
                user_id, 
                name
            FROM users  
            WHERE 
                email = :email AND 
                password = :hashed_password';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':email' => $email,
        ':hashed_password' => $hashed_password
    ));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    # login almost success; writing user info in $_SESSION
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['success'] = "Login successful, welcome $_SESSION[name]";
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = "Incorrect password"; // (better message, for user not found): login credentials incorrect, try again ! 
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

        <?php flashMesage() ?>

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