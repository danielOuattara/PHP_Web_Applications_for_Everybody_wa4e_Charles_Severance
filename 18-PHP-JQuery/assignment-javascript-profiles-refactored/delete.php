<?php

session_start();
require_once('./pdo.php');
require('./utilities.php');

# Check profile_id AND user_id are present
ValidateAuths();

# If the user request cancel deletion
CancelOperation();

# Tiny sanitize $_GET['profile_id']
$url_profile_id = htmlentities($_GET['profile_id']);

# After database check OK + delete button clicked: 

# delete an existig profile
if (isset($_POST['delete']) and isset($_POST['profile_id'])) {
    DeleteProfile();
    $_SESSION['success'] = 'Profile deleted';
    header('Location: index.php');
    return;
}

# check if profile to update exists in database
$profile = FetchSingleProfileDeleting($url_profile_id);
if (empty($profile)) {
    $_SESSION['error'] = 'Profile Not Found';
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
    <div class="container">
        <h1>Deleting Profile</h1>
        <form method="post">
            <p>First Name: <?= $profile['first_name'] ?></p>
            <p>Last Name: <?= $profile['last_name'] ?></p>
            <input type="hidden" name="profile_id" value="<?= $profile['profile_id'] ?>" />
            <input type="submit" name="delete" value="Delete">
            <input type="submit" name="cancel" value="Cancel">
            </p>
        </form>
    </div>

</body>

</html>