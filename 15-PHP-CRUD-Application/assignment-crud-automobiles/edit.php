<?php

session_start();
require_once('./pdo.php');

// Guardian: Make sure that autos_id is present
if (!isset($_GET['autos_id'])) {
    $_SESSION['error'] = "Missing autos_id";
    header('Location: index.php');
    return;
}

# After check OK if edit button clicked: 
if (
    isset($_POST['make']) and
    isset($_POST['model']) and
    isset($_POST['year']) and
    isset($_POST['mileage']) and
    isset($_POST['autos_id'])
) {

    $make = htmlentities($_POST['make']);
    $model = htmlentities($_POST['model']);
    $year = htmlentities($_POST['year']);
    $mileage = htmlentities($_POST['mileage']);
    $autos_id = htmlentities($_POST['autos_id']);

    if (
        strlen($make) < 1 ||
        strlen($model) < 1 ||
        strlen($year) < 1 ||
        strlen($mileage) < 1
    ) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?autos_id=" . $autos_id);
        return;
    } else if (!is_numeric($year)) {
        $_SESSION['error'] = "Year must be numeric";
        header("Location: edit.php?autos_id=" . $autos_id);
        return;
    } else if (!is_numeric($mileage)) {
        $_SESSION['error'] = "Mileage must be numeric";
        header("Location: edit.php?autos_id=" . $autos_id);
        return;
    }

    $sql = "
        UPDATE autos 
        SET make = :make , model = :model, year = :year, mileage = :mileage  
        WHERE autos_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $make,
        ':model' => $model,
        ':year' => $year,
        ':mileage' => $mileage,
        ':zip' => $autos_id,
    ));
    $_SESSION['success'] = "Record edited!";
    $_SESSION['data'] = [$make, $model, $year, $mileage];
    header('Location: index.php');
    return;
}


# check if auto exists in database AND retrieve auto's data
$sql = "
    SELECT autos_id, make, model, year, mileage 
    FROM autos 
    WHERE autos_id = :zip";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':zip' => $_GET['autos_id']));
$auto = $stmt->fetch(PDO::FETCH_ASSOC);
if ($auto === false) {
    $_SESSION['error'] = 'Auto Not Found';
    header('Location: index.php');
    return;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <h1>Edit</h1>
    <?php // Flash pattern
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
        unset($_SESSION['error']);
    } ?>
    <form method="post">
        <input type='hidden' name='autos_id' value="<?= $auto['autos_id'] ?>">
        <p>Make:
            <input type="text" name="make" value="<?= htmlentities($auto['make']) ?>" size="40">
        </p>
        <p>Model:
            <input type="text" name="model" value="<?= htmlentities($auto['model']) ?>" size="40">
        </p>
        <p>Year:
            <input type="text" name="year" value="<?= htmlentities($auto['year']) ?>" size="40">
        </p>
        <p>Mileage:
            <input type="text" name="mileage" value="<?= htmlentities($auto['mileage']) ?>" size="40">
        </p>

        <p>
            <input type="submit" value="Save" />
            <a href="index.php">Cancel</a>
        </p>
    </form>

</body>

</html>