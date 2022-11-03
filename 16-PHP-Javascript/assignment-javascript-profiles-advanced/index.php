<?php
session_start();
require_once('./pdo.php');


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

# fetch all data on login
$sql = "
SELECT 
    profile_id, 
    user_id,
    concat(first_name, ' ', last_name) AS name,
    headline
FROM Profile";
$stmt = $pdo->query($sql);
$profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
# -------------------------------------------------

# fetch user search
if (isset($_POST["search"])) {
    $searchTerm = htmlentities($_POST["searchTerm"]) ?? "";
    $sql = "   
        SELECT 
            profile_id,
            user_id,
            CONCAT(first_name, ' ', last_name) AS name,
            headline,
            summary
        FROM Profile
        WHERE first_name LIKE :searchTerm";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(':searchTerm' => '%' . $searchTerm . '%'));
    print_r($stmt);
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($searchResults === false) {
        $_SESSION['error'] = "No result found";
        header("Location: index.php");
        return;
    }

    $_SESSION['searchResults'] = $searchResults;
    $_SESSION['success'] = "Results found";
    header('Location: index.php');
    return;
}
#-----------------------------------------------------
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
            if (isset($_SESSION['success'])) {
                echo "<p style='color:green'> $_SESSION[success]</p>";
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'> $_SESSION[error]</p>";
                unset($_SESSION['error']);
            }

            # START print all data -----
            if ($profiles) {
                echo ("
                    <table border='2'>
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
                            <td> $profile[name] </td>
                            <td> $profile[headline] </td>");
                    if ($profile['user_id'] === $_SESSION['user_id']) {
                        echo ("
                            <td> 
                                <a href='edit.php?profile_id=$profile[profile_id]'>Edit</a> / 
                                <a href='delete.php?profile_id=$profile[profile_id]'>Delete</a> 
                            </td>
                            ");
                    } else {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table></br>";
            }
            # END print all data -----


            # start print search data -----

            if (!empty($_SESSION['searchResults'])) {
                echo ("
                    <p>Research Output </p>
                    <table border='2'>
                    <thead>
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Headline</b></td>
                            <td><b>Action</b></td>
                        </tr>
                    </thead>
                    <tbody>
                ");
                foreach ($_SESSION['searchResults'] as $search_result) {
                    echo ("
                        <tr>
                            <td> $search_result[name] </td>
                            <td> $search_result[headline] </td>
                            <td> 
                                <a href='edit.php?profile_id=$search_result[profile_id]'>Edit</a> / 
                                <a href='delete.php?profile_id=$search_result[profile_id]'>Delete</a> 
                            </td>
                        </tr>
                    ");
                }
                echo "</tbody></table>";
            }
            echo ("
            <br/>
            <form method='post'>
            <label for='searchTerm'>Search:</label>
            <input type='text' name='searchTerm' id='searchTerm'/>
            <input type='submit' name='search' value='Go search'>
            </form>"
            );

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