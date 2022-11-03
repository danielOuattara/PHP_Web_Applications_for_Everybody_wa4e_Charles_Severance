<?php

session_start();
require_once('./pdo.php');

// Guardian: Make sure that autos_id is present
if (!isset($_GET['autos_id'])) {
    $_SESSION['error'] = "Missing autos_id";
    header('Location: index.php');
    return;
}

# After check OK if delete button clicked: 
if (isset($_POST['delete']) and isset($_POST['autos_id'])) {
    $sql = "DELETE FROM autos WHERE autos_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record deleted';
    header('Location: index.php');
    return;
}

# check auto exists in database
$sql = "SELECT autos_id, make FROM autos WHERE autos_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':id' => $_GET['autos_id']));
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
    <title>Delete</title>
</head>

<body>
    <p>Confirm: Deleting <?= htmlentities($auto['make']) ?></p>
    <form method='post'>
        <input type='hidden' name='autos_id' value="<?= $auto['autos_id'] ?>">
        <input type='submit' value="Delete" name='delete' />
        <a href="index.php">Cancel</a>
    </form>

</body>

</html>