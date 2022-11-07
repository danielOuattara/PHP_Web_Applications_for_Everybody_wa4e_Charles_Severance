<?php
session_start();
require('./utilities.php');
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
    <div class="container">

        <h1>Daniel Ouattara's Resume Registry</h1>

        <?php

        if (!isset($_SESSION['name']) || !isset($_SESSION['user_id'])) {
            # user is NOT logged
            echo ("<p><a href='login.php'>Please log in</a></p>");
        } else {
            # user is logged
            flashMesage();

            $profiles = FetchAllProfiles();
            if ($profiles) {
                echo ("
                    <table border='1'>
                    <thead>
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Headline</b></td>
                            <td><b>Action</b></td>
                        </tr>
                    </thead>
                    <tbody>
                ");
                foreach ($profiles as $profile) {
                    echo ("
                        <tr>
                            <td><a href='view.php?profile_id=$profile[profile_id]'> $profile[name]</a> </td>
                            <td> $profile[headline] </td>
                            <td> 
                                <a href='edit.php?profile_id=$profile[profile_id]'>Edit</a> / 
                                <a href='delete.php?profile_id=$profile[profile_id]'>Delete</a> 
                            </td>
                        </tr>
                    ");
                }
                echo "</tbody></table>";
            }

            echo ("
            <p><a href='logout.php'>Logout</a></p>
            <p><a href='add.php'>Add New Entry</a></p>
            ");
        }
        ?>
        <p>
            <b>Note:</b> Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its
            data periodically - which you should not do in your implementation.
        </p>
    </div>
</body>

</html>