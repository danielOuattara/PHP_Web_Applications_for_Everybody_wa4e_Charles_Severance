<?php


#-----------------------------------------------------------

function ValidateAuths()
{
    # Check profile_id AND user_id are present
    if (!isset($_GET['profile_id']) || !isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Missing auhtentification / authorization";
        header('Location: index.php');
        return;
    }
}
#-----------------------------------------------------------

function CancelOperation()
{
    # If the user request cancel deletion
    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }
}
#------------------------------------------------------------

function FetchAllProfiles()
{
    require('./pdo.php');
    $sql = '    
        SELECT 
            profile_id, 
            user_id,
            CONCAT(first_name, " ", last_name) AS name,
            headline
        FROM Profile';
    $stmt = $pdo->query($sql);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

#------------------------------------------------------------

function FetchSingleProfileDeleting($_id)
{
    require('./pdo.php');
    $sql = "
        SELECT 
            profile_id,
            first_name, 
            last_name
        FROM Profile 
        WHERE profile_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
#------------------------------------------------------------

function FetchFullSingleProfile($_id)
{
    require('./pdo.php');
    $sql = "
        SELECT 
            profile_id,
            user_id, 
            first_name, 
            last_name, 
            email, 
            headline, 
            summary
        FROM Profile 
        WHERE profile_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

#------------------------------------------------------------

function FetchPositions($_id)
{
    require('./pdo.php');
    $sql = "
    SELECT 
        Position.position_id,
        Position.year,
        Position.description,
        Position.rank
    FROM 
        Profile 
    JOIN Position ON Position.profile_id = Profile.profile_id
    WHERE Profile.profile_id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


#------------------------------------------------------------
# flash Message
function flashMesage()
{
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'> $_SESSION[success]</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'> $_SESSION[error]</p>";
        unset($_SESSION['error']);
    }
}


#------------------------------------------------------------

function ValidateProfileInput()
{
    $first_name = htmlentities($_POST['first_name']) ?? "";
    $last_name = htmlentities($_POST['last_name']) ?? "";
    $email = htmlentities($_POST['email']) ?? "";
    $headline = htmlentities($_POST['headline']) ?? "";
    $summary = htmlentities($_POST['summary']) ?? "";

    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($email) ||
        empty($headline) ||
        empty($summary)
    ) {
        return "All fields are required";
    }

    if (!str_contains($email, "@")) {
        return "Email must have an at-sign (@)";
    }
    $postInput = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'headline' => $headline,
        'summary' => $summary
    ];
    return $postInput;
}

#------------------------------------------------------------

function ValidatePositionInput()
{
    $postPosition = [];
    for ($i = 1; $i <= 9; $i++) {
        if (
            !isset($_POST['year' . $i]) ||
            !isset($_POST['description' . $i])
        )
            continue;

        $year = htmlentities($_POST['year' . $i]);
        $description = htmlentities($_POST['description' . $i]);

        if (strlen($year) < 1 || strlen($description) < 1) {
            return "All fields are required";
        }

        if (!is_numeric($year)) {
            return "Position year must be numeric";
        }

        $position = [
            'year' => $year,
            'description' => $description,
            'rank' => $i
        ];
        array_push($postPosition, $position);
    }

    return $postPosition;
}

# ---------------------------------------------------------------

function DeleteProfile()
{
    require('./pdo.php');

    $sql = "
        DELETE FROM Profile 
        WHERE 
            profile_id = :profile_id AND 
            user_id= :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':profile_id' => $_POST['profile_id'],
        ':user_id' => $_SESSION['user_id']
    ));
}
