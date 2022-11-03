<?php

session_start();
require_once('./pdo.php');

# After check OK if edit button clicked: 
if (
    isset($_POST['name']) and
    isset($_POST['email']) and
    isset($_POST['password']) and
    isset($_POST['user_id'])
) {
    $sql = "
        UPDATE users 
        SET name = :name , email = :email, password = :password 
        WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':zip' => $_POST['user_id']
    ));
    $_SESSION['success'] = "User updated !";
    header('Location: index.php');
    return;
}


# check user exists in database AND retrieve user's data
$sql = "SELECT user_id, name, email, password FROM users WHERE user_id = :zip";
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
    <title>Edit</title>
</head>

<body>
    <h1>Edit</h1>
    <form method="post">
        <input type='hidden' name='user_id' value="<?= $row['user_id'] ?>">
        <p>Name:
            <input type="text" name="name" value="<?= htmlentities($row['name']) ?>" size="40">
        </p>
        <p>Email:
            <input type="text" name="email" value="<?= htmlentities($row['email']) ?>">
        </p>
        <p>Password:
            <input type="text" name="password" value="<?= htmlentities($row['password']) ?>">
        </p>
        <p>
            <input type="submit" value="Update" />
            <a href="index.php">Cancel</a>
        </p>
    </form>

</body>

</html>