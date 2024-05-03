<?php
$md5 = "";
$message = false;
$error = false;

if (isset($_GET['encode'])) {
    if (!empty($_GET['encode'])) {
        $md5 = hash('md5', $_GET['encode']);
        $message = "Congratulations!Copy the hashed value below and paste it in input field of the root page";
    } else {
        $error = "ERROR: please read the instructions above.";
    }
}
?>
<!DOCTYPE html>

<head>
    <title>Daniel Ouattara MD5</title>
</head>

<body>
    <h1>MD5 Maker</h1>
    <p>Provide a 4 integers and click `Compute MD5` to get its MD5 hash.</p>
    <?php
    if ($message) {
        print '<p style="color:green">';
        print htmlentities($message);
        print "</p>\n";
    }
    if ($error) {
        print '<p style="color:red">';
        print htmlentities($error);
        print "</p>\n";
    }

    ?>
    <p><?= $message ?></p>

    <p>MD5: <?= htmlentities($md5); ?></p>

    <form>
        <input type="text" name="encode" size="60" />
        <input type="submit" value="Compute MD5" />
    </form>
    <ul>
        <li><a href="md5.php">Reset</a></li>
        <li><a href="index.php">Back to Cracking</a></li>
    </ul>

</body>

</html>