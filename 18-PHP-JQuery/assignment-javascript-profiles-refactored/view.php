<?php
session_start();
require_once('./utilities.php');

# Check profile_id AND user_id are present
if (!isset($_GET['profile_id']) || !isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Missing connection data";
    header('Location: index.php');
    return;
}

# If the user request cancel deletion
if (isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

# Tiny sanitize $_GET['profile_id']
$url_profile_id = htmlentities($_GET['profile_id']);

# Store the results of 2 requests
$singleProfile = FetchFullSingleProfile($url_profile_id);
$singleProfilePositions = FetchPositions($url_profile_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php require_once "bootstrap.php"; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Profile information</h1>
        <p><b>First Name</b>: <?= $singleProfile['first_name'] ?></p>
        <p><b>Last Name</b>: <?= $singleProfile['last_name'] ?></p>
        <p><b>Email:</b> <?= $singleProfile['email'] ?></p>
        <p><b>Headline:</b> <?= $singleProfile['headline'] ?></p>
        <p><b>Summary:</b> <?= $singleProfile['summary'] ?></p>

        <?php
        if (empty($singleProfilePositions)) {
            echo "<p><b>Positions </b>: No Position Yet !</p>";
        } else {
            echo " <p><b>Positions </b></p><ul>";
            foreach ($singleProfilePositions as $position) {
                echo "<li>";
                echo $position["year"], " : ", $position['description'];
                echo "</li>";
            }
            echo "</ul>";
        }
        ?>
        <p>
            <a href="index.php">Done</a>
        </p>
    </div>

</body>

</html>