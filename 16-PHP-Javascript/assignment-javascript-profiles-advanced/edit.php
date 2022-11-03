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

# After database check OK, if edit button clicked: 
if (isset($_POST['edit'])) {

    $post_profile_id = htmlentities($_POST['profile_id']) ?? "";
    $post_first_name = htmlentities($_POST['first_name']) ?? "";
    $post_last_name = htmlentities($_POST['last_name']) ?? "";
    $post_email = htmlentities($_POST['email']);
    $post_headline = htmlentities($_POST['headline']) ?? "";
    $post_summary = htmlentities($_POST['summary']) ?? "";

    if (
        strlen($post_first_name) < 1 ||
        strlen($post_last_name) < 1 ||
        strlen($post_email) < 1 ||
        strlen($post_headline) < 1 ||
        strlen($post_summary) < 1
    ) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?profile_id=" . $post_profile_id);
        return;
    }

    if (!str_contains($post_email, "@")) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: edit.php?profile_id=" . $post_profile_id);
        return;
    }
    //---

    $sql = "
        UPDATE Profile 
        SET 
            first_name = :firstname, 
            last_name = :lastname, 
            email = :email, 
            headline = :headline, 
            summary = :summary
        WHERE 
            profile_id = :profileId AND user_id= :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':firstname' => $post_first_name,
            ':lastname' => $post_last_name,
            ':email' => $post_email,
            ':headline' => $post_headline,
            ':summary' => $post_summary,
            ':profileId' => $post_profile_id,
            ':userId' => $_SESSION['user_id']
        )
    );
    $_SESSION['success'] = "Profile edited!";
    header('Location: index.php');
    return;
}


# database check if profile exists in database + retrieve its data
$sql = '
    SELECT 
        profile_id,
        user_id 
        first_name, 
        last_name, 
        email, 
        headline, 
        summary
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
    <title>Edit</title>
</head>

<body>
    <h1>Edit</h1>
    <?php // Flash pattern
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
        unset($_SESSION['error']);
    } ?>

    <form method="post">
        <input type='hidden' name='profile_id' value="<?= $profile['profile_id'] ?>">
        <p>First Name:
            <input type="text" name="first_name" value="<?= $profile['first_name'] ?>" size="60" />
        </p>
        <p>Last Name:
            <input type="text" name="last_name" value="<?= $profile['last_name'] ?>" size="60" />
        </p>
        <p>Email:
            <input type="text" name="email" value="<?= $profile['email'] ?>" size="30" />
        </p>
        <p>Headline:<br />
            <input type="text" name="headline" value="<?= $profile['headline'] ?>" size="80" />
        </p>
        <p>Summary:<br />
            <textarea name="summary" rows="8" cols="80"> <?php echo $profile['summary'] ?></textarea>
        <p>
            <input type="submit" name="edit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>

</body>

</html>