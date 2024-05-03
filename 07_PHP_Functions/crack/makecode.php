<?php

$error = false;
$md5 = false;
$code = "";

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    if (strlen($code) != 2) {
        $error = "Input must be exactly two characters";
    } else if (
        $code[0] < "a" || $code[0] > "z" ||
        $code[1] < "a" || $code[1] > "z"
    ) {
        $error = "Input must two lower case letters";
    } else {
        $md5 = hash('md5', $code);
    }
}
?>
<!DOCTYPE html>

<head>
    <title>Daniel Ouattara PIN Code</title>
</head>

<body>
    <h1>MD5 PIN Maker</h1>

    <?php
    if ($error) {
        print '<p style="color:red">';
        print htmlentities($error);
        print "</p>\n";
    }

    if ($md5) {
        print "<p style='color:green'>Congratulations! MD5 value: " . htmlentities($md5) . "</p>";
    }
    ?>

    <p>Please enter a two-letter key for encoding.</p>
    <form>
        <input type="text" name="code" value="<?= htmlentities($code) ?? "" ?>" />
        <input type="submit" value="Compute MD5 for CODE" />
    </form>

    <ul>
        <li><a href="makecode.php">Reset</a></li>
        <li><a href="index.php">Back to Cracking</a></li>
    </ul>

</body>

</html>