<?php
session_start();
require_once('./pdo.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php require_once "bootstrap.php"; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel Ouattara</title>
</head>

<body>

    <?php

    if (!isset($_SESSION['name'])) {
        echo ("<div class='container'>
                <h2>Welcome to the Automobiles Database</h2>
                <p><a href='login.php'>Please log in</a></p>
                <p>Attempt to <a href='add.php'>add data</a> without logging in</p>
            </div>");
    } else {
        // fetch all data

        echo ("<div class='container'>
        <h2>Welcome to the Automobiles Database</h2>");

        if (isset($_SESSION['success'])) {
            echo "<p style='color:green'> $_SESSION[success]</p>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red'> $_SESSION[error]</p>";
            unset($_SESSION['error']);
        }

        $stmt = $pdo->query("SELECT model, make, year, autos_id, mileage FROM autos");
        $autos = $stmt->fetchAll(PDO::FETCH_ASSOC);



        if (!$autos) {
            echo "<p>No rows found</p>";
        } else {
            echo ("
            <table border='2'>
            <tr>
                <td><b>Make</b></td>
                <td><b>Model</b></td>
                <td><b>Year</b></td>
                <td><b>Mileage</b></td>
                <td><b>Action</b></td>
            </tr>");
            foreach ($autos as $auto) {
                echo '<tr><td>';
                echo ($auto['make']);
                echo ('</td><td>');
                echo ($auto['model']);
                echo ('</td><td>');
                echo ($auto['year']);
                echo ('</td><td>');
                echo ($auto['mileage']);
                echo ('</td><td>');
                echo "<a href='edit.php?autos_id=$auto[autos_id]'>Edit</a>", " / ";
                //echo "<a href='delete.php?autos_id=$auto[autos_id]'>Delete</a>";
                echo ('<a href="delete.php?autos_id=' . $auto['autos_id'] . '">Delete</a>');
            }
            echo "</table>";
        }

        echo ("<p><a href='add.php'>Add New Entry</a></p>
            <p><a href='logout.php'>Logout</a></p>
            <p>
            <b>Note:</b> Your implementation should retain data across multiple 
            logout/login sessions.  This sample implementation clears all its
            data on logout - which you should not do in your implementation.
            </p>
        </div>");
    }
    ?>

</body>

</html>