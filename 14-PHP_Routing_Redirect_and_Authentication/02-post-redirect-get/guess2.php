<?php
session_start();

$guess = $_SESSION['guess'] ?? '';
$message = $_SESSION['message'] ?? false;

if (isset($_POST['guess'])) {
    $guess = $_POST['guess'] ?? +0;
    $_SESSION['guess'] = $guess;
    if ($guess == 42) {
        $_SESSION['message'] = false;
        $_SESSION['guess'] = '';
        header("Location: victory.php");
        return;
    } else if ($guess < 42) {
        $_SESSION['message'] = "Too low";
    } else {
        $_SESSION['message'] = "Too high...";
    }
    header("Location: guess2.php");
    return;
}
?>
<html>

<head>
    <title>Good Guessing game</title>
</head>

<body style="font-family: sans-serif;">
    <p>Guessing game...</p>
    <p><?php echo $message; ?></p>
    <form method="post">
        <p><label for="guess">Input Guess</label>
            <input type="text" name="guess" id="guess" size="40" <?php echo 'value="' . htmlentities($guess) . '"'; ?> />
        </p>
        <input type="submit" />
    </form>
</body>