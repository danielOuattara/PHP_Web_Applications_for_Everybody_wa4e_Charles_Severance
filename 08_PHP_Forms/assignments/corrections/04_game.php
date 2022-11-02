<?php
// Demand a GET parameter
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die("Name parameter missing");
}

// If the user requested logout go back to index.php
if (isset($_POST['logout'])) {
    header('Location: ./../index.php');
    return;
}

//initialize the game
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST['human']) ? $_POST['human'] + 0 : -1;
$computer = rand(0, 2);

function check($computer, $human)
{
    if ($human === $computer) {
        return "Tie";
    } elseif (
        $human == 0 && $computer == 2 ||
        $human == 1 && $computer == 0 ||
        $human == 2 && $computer == 1
    ) {
        return "You Win";
    } else {
        return "You Lose";
    }
}
// Check to see how the play happenned
$result = check($computer, $human);
?>


<!DOCTYPE html>
<html>

<head>
    <title>daniel ouattara</title>
</head>

<body>
    <h1>Thibaud LOYRIAC Assignment 7 - PierreFeuilleCiseaux - Let's PLAY !</h1>
    <p>
        <?php
        if (isset($_GET['name'])) {
            echo "<p>Welcome: ";
            echo htmlentities($_GET['name']);
            echo "</p>\n";
        }
        ?>
    <form method="post">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout">
    </form>

    <pre>

<?php
if ($human == -1) {
    print "Please select a strategy and press Play.\n";
} else if ($human == 3) {
    for ($c = 0; $c < 3; $c++) {
        for ($h = 0; $h < 3; $h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>


</pre>
    </p>
</body>

</html>