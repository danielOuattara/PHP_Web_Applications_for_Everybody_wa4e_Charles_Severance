<?php

session_start();
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

# If the user requested logout then go back to index.php
if (isset($_POST['cancel'])) {
    header('Location: view.php');
    return;
}

require_once('./pdo.php');

if (
    isset($_POST['make']) &&
    isset($_POST['year']) &&
    isset($_POST['mileage'])
) {
    $make = htmlentities($_POST['make']);
    $year = htmlentities($_POST['year']);
    $mileage = htmlentities($_POST['mileage']);

    if (strlen($make) < 1) {
        $_SESSION['error'] = "Make is required";
        header('Location: add.php');
        return;
    } else if (!is_numeric($year) || !is_numeric($mileage)) {
        $_SESSION['error'] = "Mileage and year must be numeric";
        header('Location: add.php');
        return;
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
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
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
        <h1>Tracking Autos for <?= $_SESSION['name'] ?></h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ("<p style='color: red;'> $_SESSION[error] </p>");
            unset($_SESSION['error']);
        }

        ?>
        <form method="post">
            <p>Make : <input type="text" name="make" size=60 /></p>
            <p>Year : <input type="text" name="year" /></p>
            <p>Mileage : <input type="text" name="mileage" /></p>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>

</body>

</html>