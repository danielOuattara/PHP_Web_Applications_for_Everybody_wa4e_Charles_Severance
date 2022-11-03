<?php

session_start();

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

require_once('./pdo.php');

# After database check OK + delete button clicked: 

if (isset($_POST['delete']) and isset($_POST['profile_id'])) {
    $sql = "
        DELETE FROM Profile 
        WHERE profile_id = :profileId AND user_id= :userId";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
        ':profileId' => $_POST['profile_id'],
        ':userId' => $_SESSION['user_id']
    ));
    $_SESSION['success'] = 'Profile deleted';
    header('Location: index.php');
    return;
}

# check if profile exists in database + retrieve some profile data
$sql = '
    SELECT 
        profile_id, 
        first_name, 
        last_name 
    FROM Profile 
    WHERE profile_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':id' => $url_profile_id));
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

if ($profile === false) {
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