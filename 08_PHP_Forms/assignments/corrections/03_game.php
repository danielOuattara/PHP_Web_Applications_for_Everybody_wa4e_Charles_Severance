<?php
if (!isset($_REQUEST["name"])) {
    die("Name parameter missing");
}

if (isset($_POST["logout"])) {
    header("Location: ./../index.php");
    return;
}

$username = htmlentities($_REQUEST["name"]);
$message = "Please select a strategy and press Play.";

// This function takes as its input the computer and human play
// and returns "Tie", "You Lose", "You Win" depending on play
// where "You" is the human being addressed by the computer
function check($computer, $human)
{
    if ($computer === $human) {
        return "Tie";
    } elseif ($computer === "Rock") {
        if ($human === "Paper") {
            return "You Win";
        } else {
            return "You Lose";
        }
    } elseif ($computer === "Paper") {
        if ($human === "Scissors") {
            return "You Win";
        } else {
            return "You Lose";
        }
    } else {
        if ($human === "Paper") {
            return "You Lose";
        } else {
            return "You Win";
        }
    }
}

if (isset($_POST["choice"])) {
    $userChoice = $_POST["choice"];
    $names = array("Rock", "Paper", "Scissors");

    if ($userChoice === "test") {
        $message = "";
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $result = check($names[$i], $names[$j]);
                $message .= "Human=$names[$j] Computer=$names[$i] Result=$result\n";
            }
        }
    } else {
        $computerChoice = $names[array_rand($names)];
        $userChoice = ucfirst($userChoice);
        $result = check($computerChoice, $userChoice);
        $message = "Your Play=$userChoice Computer Play=$computerChoice Result=$result";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>daniel ouattara</title>
</head>

<body>
    <header class="header">
        <h1>Rock Paper Scissors</h1>
    </header>
    <main class="main">
        <p>Welcome: <?= $username; ?></p>
        <form class="form" method="POST">
            <select class="form__select" name="choice">
                <option value="" selected disabled>Select</option>
                <option value="rock">Rock</option>
                <option value="paper">Paper</option>
                <option value="scissors">Scissors</option>
                <option value="test">Test</option>
            </select>
            <input class="form__btn form__btn--play" type="submit" value="Play">
            <input class="form__btn" type="submit" name="logout" value="Logout">
        </form>
        <div class="result">
            <pre><?= $message; ?></pre>
        </div>
    </main>
</body>

</html>