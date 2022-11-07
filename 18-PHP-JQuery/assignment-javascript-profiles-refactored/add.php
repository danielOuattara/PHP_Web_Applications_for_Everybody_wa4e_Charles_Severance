<?php
session_start();
require('./utilities.php');
require('./pdo.php');

# Check if user is logged in
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

# If the user request cancel new entry
CancelOperation();

if (isset($_POST['add'])) {

    # server side post inputs validation
    $profile_validation = ValidateProfileInput();
    $position_validation = ValidatePositionInput();

    if (is_string($profile_validation)) {
        $_SESSION['error'] = $profile_validation;
        header('Location: add.php');
        return;
    }

    if (is_string($position_validation)) {
        $_SESSION['error'] = $position_validation;
        header('Location: add.php');
        return;
    }
    //---

    # write in database
    $sql = '
        INSERT INTO 
            Profile (user_id, first_name, last_name, email, headline, summary)
            VALUES ( :uid, :fn, :ln, :em, :he, :su)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':uid' => $_SESSION['user_id'],
            ':fn' => $profile_validation['first_name'],
            ':ln' => $profile_validation['last_name'],
            ':em' => $profile_validation['email'],
            ':he' => $profile_validation['headline'],
            ':su' => $profile_validation['summary']
        )
    );

    $profile_id = $pdo->lastInsertId();

    for ($i = 0; $i < count($position_validation); $i++) {

        $year = $position_validation[$i]['year'];
        $description = $position_validation[$i]['description'];
        $rank = $position_validation[$i]['rank'];

        $sql = '
            INSERT INTO 
                Position (profile_id, rank, year, description)
                VALUES ( :profile_id, :rank, :year, :description)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                ':profile_id' => $profile_id,
                ':year' => $year,
                ':description' => $description,
                ':rank' => $rank
            )
        );
    }

    $_SESSION['success'] = "Record added";
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "bootstrap.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./jquery.js"></script>
    <title>Daniel Ouattara</title>
</head>

<body>
    <div class="container">
        <h1>Adding Profile for UMSI</h1>

        <?php flashMesage();  ?>

        <form method="post">
            <p>First Name:
                <input type="text" name="first_name" value="<?php htmlentities($_SESSION['first_name'] ?? "") ?>" size="60">
            </p>
            <p>Last Name:
                <input type="text" name="last_name" size="60">
            </p>
            <p>Email:
                <input type="text" name="email" size="30">
            </p>
            <p>Headline:<br />
                <input type="text" name="headline" size="80">
            </p>
            <p>Summary:<br />
                <textarea name="summary" rows="8" cols="80"></textarea>
            </p>
            <br> <br>

            <div id="position-fields"></div>
            <p>
                Position: <input type="submit" id="addPosition" value="+">
                <span id="position-message"></span>
            </p>
            <p>
                <input type="submit" value="Add" name="add">
                <input type="submit" name="cancel" value="Cancel">
            </p>
        </form>
    </div>
</body>

</html>