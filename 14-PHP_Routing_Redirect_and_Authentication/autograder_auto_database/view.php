<?php

session_start();
# Check for name value in $_SESSION
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}


# If the user requested logout then go back to index.php
if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}

require_once('./pdo.php');

// fetch all data
$stmt = $pdo->query("SELECT * FROM autos");
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel Ouattara</title>
    <?php require_once "bootstrap.php"; ?>

</head>

<body>
    <div class="container">
        <h1>Tracking Autos for <?= $_SESSION['name'] ?></h1>
        <?php
        if (isset($_SESSION['success'])) {
            echo ("<p style='color: green;'> $_SESSION[success] </p>");
            unset($_SESSION['success']);
        }
        ?>
        <div class="container">
            <?php
            if (isset($autos)) {
                echo "<h2>Automobiles</h2>";
                echo "<ul>";

                foreach ($autos as $auto) {
                    echo "<li>";
                    echo $auto["year"], " ", $auto['make'], " / ", $auto['mileage'];
                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
        <p>
            <a href="add.php">Add New</a> |
            <a href="logout.php">Logout</a>
        </p>
    </div>
</body>

</html>