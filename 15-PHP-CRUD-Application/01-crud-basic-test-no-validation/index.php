<?php
session_start();
require_once "./pdo.php";

// fetch all data
$sql = "SELECT user_id, name,email FROM users";
$stmt = $pdo->query($sql);
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

    <?php
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'> $_SESSION[success]</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'> $_SESSION[error]</p>";
        unset($_SESSION['error']);
    }
    ?>

    <table border="1">
        <tr>
            <td><b>Name</b></td>
            <td><b>Email</b></td>
            <td><b>Action</b></td>
        </tr>
        <?php
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo ($row['name']);
            echo ("</td><td>");
            echo ($row['email']);
            echo ("</td><td>");
            echo "<a href='edit.php?user_id=$row[user_id]'>Edit</a>", " / ";
            echo "<a href='delete.php?user_id=$row[user_id]'>Delete</a>";
        }
        ?>
    </table>

    <a href="add.php">Add New</a>
</body>

</html>