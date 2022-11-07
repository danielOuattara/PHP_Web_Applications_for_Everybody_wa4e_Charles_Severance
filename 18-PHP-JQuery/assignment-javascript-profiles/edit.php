<?php

session_start();
require('./utilities.php');
require('./pdo.php');


# Check profile_id AND user_id are present
ValidateAuths();

# If the user request cancel deletion
CancelOperation();

# Tiny sanitize $_GET['profile_id']
$url_profile_id = htmlentities($_GET['profile_id']);

# check if profile to update exists in database
$singleProfile = FetchFullSingleProfile($url_profile_id);
if (empty($singleProfile)) {
    $_SESSION['error'] = 'Profile Not Found';
    header('Location: index.php');
    return;
}


echo "<pre>";
echo "\$singleProfile = ";
print_r($singleProfile);
echo "</pre>";

# check possible Positions in the existing profile
$singleProfilePositions = FetchPositions($url_profile_id);

echo "<pre>";
echo "\$singleProfilePositions = ";
print_r($singleProfilePositions);
echo "</pre>";

# starting update : check if edit button clicked: 
if (isset($_POST['edit'])) {

    # server side post inputs validation
    $profile_validation = ValidateProfileInput();
    $position_validation = ValidatePositionInput();

    if (is_string($profile_validation)) {
        $_SESSION['error'] = $profile_validation;
        header("Location: edit.php?profile_id=" . $url_profile_id);
        return;
    }

    if (is_string($position_validation)) {
        $_SESSION['error'] = $position_validation;
        header("Location: edit.php?profile_id=" . $url_profile_id);
        return;
    }

    # write in database
    $sql = "
        UPDATE Profile 
        SET 
            first_name = :first_name, 
            last_name = :last_name, 
            email = :email, 
            headline = :headline, 
            summary = :summary
        WHERE 
            profile_id = :profile_id AND user_id= :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':first_name' => $profile_validation['first_name'],
            ':last_name' => $profile_validation['last_name'],
            ':email' => $profile_validation['email'],
            ':headline' => $profile_validation['headline'],
            ':summary' => $profile_validation['summary'],
            ':user_id' => $_SESSION['user_id'],
            ':profile_id' => $singleProfile['profile_id']
        )
    );



    if (empty($singleProfilePositions)) {
        # No Position(s) found: Adding New
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
                    ':profile_id' => $singleProfile['profile_id'],
                    ':year' => $year,
                    ':description' => $description,
                    ':rank' => $rank
                )
            );
        }
    } elseif (!empty($singleProfilePositions)) {
        # Updating Existed Positions

        for ($i = 0; $i < count($singleProfilePositions); $i++) {

            $year = $position_validation[$i]['year'];
            $description = $position_validation[$i]['description'];
            $rank = $position_validation[$i]['rank'];

            $sql = "
                UPDATE Position
                SET 
                    year = :year, 
                    description = :description
                WHERE 
                    position_id = :position_id AND profile_id= :profile_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':year' => $year,
                    ':description' => $description,
                    ':position_id' => $singleProfilePositions[$i]['position_id'],
                    ':profile_id' => $singleProfile['profile_id']
                )
            );
        }
    }

    $_SESSION['success'] = "Profile edited!";
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./jquery.js"></script>
    <title>Edit</title>
</head>

<body>
    <h1>Edit</h1>
    <?php flashMesage() ?>

    <form method="post">
        <p>First Name:
            <input type="text" name="first_name" value="<?= $singleProfile['first_name'] ?>" size="60" />
        </p>
        <p>Last Name:
            <input type="text" name="last_name" value="<?= $singleProfile['last_name'] ?>" size="60" />
        </p>
        <p>Email:
            <input type="text" name="email" value="<?= $singleProfile['email'] ?>" size="30" />
        </p>
        <p>Headline:<br />
            <input type="text" name="headline" value="<?= $singleProfile['headline'] ?>" size="80" />
        </p>
        <p>Summary:<br />
            <textarea name="summary" rows="8" cols="80"> <?php echo $singleProfile['summary'] ?></textarea>


            <?php
            if (empty($singleProfilePositions)) {
                echo "<p><b>No Position Yet. Click + sign below to add positions</b> !</p>";
            } else {
                echo " <p><b>Positions can be edited</b></p>";
                foreach ($singleProfilePositions as $key => $position) {
                    echo ("
                    <div id=position-" . strval($key + 1) . ">
                        <p>Year:
                            <input type='text' name='year" . strval($key + 1) . "' value= $position[year] />
                            <input type='button' value='-'/>
                        </p>
                        <textarea name='description" . strval($key + 1) . "' rows='8' cols='80'>$position[description]</textarea>
                    </div> <br/>");
                }
            } ?>

        <div id='position-fields'></div>
        <p> Position:
            <input type='submit' id='addPosition' value='+'>
        </p>
        <p>
            <input type="submit" name="edit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</body>

</html>