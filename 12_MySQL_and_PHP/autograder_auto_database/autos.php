<?php

# Check a GET parameter from URL
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

# sanitize existing name params from URL
$name = htmlentities($_REQUEST['name']);

# If the user requested logout then go back to index.php
if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}



require_once('./pdo.php');

$error = false;  // If we have no POST data
$success = false;

if (
    isset($_POST['make']) &&
    isset($_POST['year']) &&
    isset($_POST['mileage'])
) {
    $make = htmlentities($_POST['make']);
    $year = htmlentities($_POST['year']);
    $mileage = htmlentities($_POST['mileage']);

    if (strlen($make) < 1) {
        $error = "Make is required";
    } else if (!is_numeric($year) || !is_numeric($mileage)) {
        $error = "Mileage and year must be numeric";
    } else {
        $sql = "
            INSERT INTO 
                autos (make, year, mileage) 
                VALUES (:make, :year, :mileage)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':make' => $make,
            ':year' => $year,
            ':mileage' => $mileage
        ));

        $success = "Record inserted";
    }
}

// fetch all data
$stmt = $pdo->query("SELECT * FROM autos");
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Daniel Ouattara</title>
</head>

<body>
    <div class="container">
        <h1>Tracking Autos for <?= $name ?></h1>
        <?php
        if ($error !== false) {
            echo ('<p style="color: red;">' . htmlentities($error) . "</p>\n");
        }
        if ($success !== false) {
            echo ('<p style="color: green;">' . htmlentities($success) . "</p>\n");
        }
        ?>
        <form method="post">
            <p>Make : <input type="text" name="make" size=60 /></p>
            <p>Year : <input type="text" name="year" /></p>
            <p>Mileage : <input type="text" name="mileage" /></p>
            <input type="submit" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>

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
</body>

</html>