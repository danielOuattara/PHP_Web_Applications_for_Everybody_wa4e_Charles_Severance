<?php
session_start();

# Check user is logged in
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

# If the user requests a logout: go to index.php
if (isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

require_once('./pdo.php');

if (
    isset($_POST['make']) &&
    isset($_POST['model']) &&
    isset($_POST['year']) &&
    isset($_POST['mileage'])
) {
    $make = htmlentities($_POST['make']);
    $model = htmlentities($_POST['model']);
    $year = htmlentities($_POST['year']);
    $mileage = htmlentities($_POST['mileage']);

    if (
        strlen($make) < 1 ||
        strlen($model) < 1 ||
        strlen($year) < 1 ||
        strlen($mileage) < 1
    ) {
        $_SESSION['error'] = "All fields are required";
        header('Location: add.php');
        return;
    } else if (!is_numeric($year)) {
        $_SESSION['error'] = "Year must be numeric";
        header('Location: add.php');
        return;
    } else if (!is_numeric($mileage)) {
        $_SESSION['error'] = "Mileage must be numeric";
        header('Location: add.php');
        return;
    } else {
        $sql = "
            INSERT INTO 
                autos (make, model, year, mileage) 
                VALUES (:make, :model, :year, :mileage)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':make' => $make,
            ':model' => $model,
            ':year' => $year,
            ':mileage' => $mileage
        ));
        $_SESSION['success'] = "Record added";
        header("Location: index.php");
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
        <h1>Tracking Autos for <?= $_SESSION['name'] ?></h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ("<p style='color: red;'> $_SESSION[error] </p>");
            unset($_SESSION['error']);
        }

        ?>
        <form method="post">
            <p>Make : <input type="text" name="make" size=60 /></p>
            <p>Model : <input type="text" name="model" size=60 /></p>
            <p>Year : <input type="text" name="year" /></p>
            <p>Mileage : <input type="text" name="mileage" /></p>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>

</body>

</html>