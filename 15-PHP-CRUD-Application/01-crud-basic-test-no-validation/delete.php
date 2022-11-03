<?php

session_start();
require_once('./pdo.php');

# After check OK if delete button clicked: 
if (isset($_POST['delete']) and isset($_POST['user_id'])) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
    $_SESSION['success'] = 'Record deleted';
    header('Location: index.php');
    return;
}

# check user exists in database
$sql = "SELECT user_id, name FROM users WHERE user_id = :zip";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':zip' => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = '404: User Not Found OR Bad value for user_id';
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
    <h1>Delete</h1>
    <p>Do you confirm deleting <?= htmlentities($row['name']) ?> from users ?</p>
    <form method='post'>
        <input type='hidden' name='user_id' value="<?= $row['user_id'] ?>">
        <input type='submit' value='Delete' name='delete' />
        <a href="index.php">Cancel</a>
    </form>

</body>

</html>