<?php
if (isset($_POST['where'])) {
    if ($_POST['where'] == '1') {
        header("Location: redirect1.php");
        return;
    } elseif ($_POST['where'] == '2') {
        header("Location: redirect2.php?params=123");
        return;
    } else {
        header("Location: http://www.dr-chuck.com");
        return;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>redirect1.php</title>
</head>

<body>
    <h1>Router 1</h1>
    <form method="post">
        <p>
            <label for="inp9">Where to go ? (1-3)</label>
            <input type="text" name="where" id="inp9" size="5">
            <input type="submit">
        </p>
    </form>

</body>

</html>