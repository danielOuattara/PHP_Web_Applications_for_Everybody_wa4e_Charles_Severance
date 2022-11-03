<?php

session_start();
require_once('./pdo.php');

if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {
    $sql = "
        INSERT INTO 
            users (name, email, password) 
            VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
    $_SESSION['success'] = "Recorder Added !";
    header('Location: index.php');
    return;
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
</head>

<body>
    <h1>Add A New User</h1>
    <form method="post">
        <p>Name:
            <input type="text" name="name" size="40">
        </p>
        <p>Email:
            <input type="text" name="email">
        </p>
        <p>Password:
            <input type="password" name="password">
        </p>
        <p>
            <input type="submit" value="Add New" />
            <a href="index.php">Cancel</a>
        </p>
    </form>

</body>

</html>