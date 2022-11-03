<?php
session_start();

# Check if user is logged in
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

# If the user request cancel new entry
if (isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if (isset($_POST['add'])) {

    # against html injection
    $user_id = htmlentities($_SESSION['user_id']) ?? "";
    $first_name = htmlentities($_POST['first_name']) ?? "";
    $last_name = htmlentities($_POST['last_name']) ?? "";
    $email = htmlentities($_POST['email']) ?? "";
    $headline = htmlentities($_POST['headline']) ?? "";
    $summary = htmlentities($_POST['summary']) ?? "";

    echo $user_id;
    echo $summary;


    # server side form input validation
    if (
        strlen($first_name) < 1 ||
        strlen($last_name) < 1 ||
        strlen($email) < 1 ||
        strlen($headline) < 1 ||
        strlen($summary) < 1
    ) {
        $_SESSION['error'] = "All fields are required";
        header('Location: add.php');
        return;
    }

    if (!str_contains($email, "@")) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header('Location: add.php');
        return;
    }
    //---

    # write in database
    require_once('./pdo.php');
    $sql = '
        INSERT INTO 
            Profile (user_id, first_name, last_name, email, headline, summary)
            VALUES ( :uid, :fn, :ln, :em, :he, :su)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':uid' => $user_id,
            ':fn' => $first_name,
            ':ln' => $last_name,
            ':em' => $email,
            ':he' => $headline,
            ':su' => $summary
        )
    );

    $_SESSION['success'] = "Record added";
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Daniel Ouattara</title>
</head>

<body>
    <div class="container">
        <h1>Adding Profile for UMSI</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ("<p style='color: red;'> $_SESSION[error] </p>");
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>First Name:
                <input type="text" name="first_name" size="60" />
            </p>
            <p>Last Name:
                <input type="text" name="last_name" size="60" />
            </p>
            <p>Email:
                <input type="text" name="email" size="30" />
            </p>
            <p>Headline:<br />
                <input type="text" name="headline" size="80" />
            </p>
            <p>Summary:<br />
                <textarea name="summary" rows="8" cols="80"></textarea>
            <p>
                <input type="submit" value="Add" name="add">
                <input type="submit" name="cancel" value="Cancel">
            </p>
        </form>
    </div>

</body>

</html>