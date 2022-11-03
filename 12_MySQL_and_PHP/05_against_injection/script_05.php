<?php
require_once "./../pdo.php";
require_once("./form_helper.php");


# delete php
if (isset($_REQUEST['user_id'])) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
}

// insert php
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
}

// fetch all data
$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add memeber + output members</title>
</head>

<body>
    <table border="1">
        <tr>
            <td><b>Name</b></td>
            <td><b>Email</b></td>
            <td><b>Password</b></td>
            <td><b>Action</b></td>
        </tr>
        <?php
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo ($row['name']);
            echo ("</td><td>");
            echo ($row['email']);
            echo ("</td><td>");
            echo ($row['password']);
            echo ("</td><td>");
            // echo "
            // <form method='post'>
            //     <input type='hidden' name='user_id' value=" . $row['user_id'] . " >
            //     <input type='submit' value='Delete' />
            // </form>";
            // echo ("</td></tr>\n");

            delete_helper($row['user_id']);
        }
        ?>
    </table>
    <p>Add A New User</p>
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
        <p><input type="submit" value="Add New" /></p>
    </form>
</body>

</html>