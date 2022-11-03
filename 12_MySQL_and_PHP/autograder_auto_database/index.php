<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php require_once "bootstrap.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel Ouattara</title>
</head>

<body>
    <div class="container">
        <h1>Welcome to Autos Database</h1>

        <p>
            <a href="login.php">Please Log In</a>
        </p>
        <p>
            Attempt to go to
            <a href="autos.php">autos.php</a> without logging in - it should fail
            with an error message.
        </p>
        <p>
            <a href="https://www.wa4e.com/assn/autosdb/" target="_blank">Specification for this Application</a>
        </p>
        <p><strong>Note:</strong>Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its data on logout -
            which you should not do in your implementation.
        </p>
    </div>

</body>

</html>

<html>