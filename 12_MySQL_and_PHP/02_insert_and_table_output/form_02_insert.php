<?php

/** 
 * Simply connect to DB.
 * Use a form to add new member.
 * Automatically output new member in a table upon created
 */

require_once "./../pdo.php";

if (
    isset($_POST['name']) && 
    isset($_POST['email'])&& 
    isset($_POST['password'])
) {
    $sql = "
        INSERT INTO 
            users (`name`, `email`, `password`) 
            VALUES (:name, :email, :password)";
    // echo ("<pre>\n" . $sql . "\n</pre>\n");

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
}

# retrieve data
$stmt = $pdo->query("SELECT name, email, password FROM users");
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
        </tr>
        <?php
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo ($row['name']);
            echo ("</td><td>");
            echo ($row['email']);
            echo ("</td><td>");
            echo ($row['password']);
            echo ("</td></tr>\n");
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