<!-- <html>

<head>
  <title>Guessing Game for Charles Severance</title>
</head>

<body>
  <h1>Welcome to my guessing game</h1>
  <p>
    <?php
    // if (!isset($_GET['guess'])) {
    //   echo ("Missing guess parameter");
    // } else if (strlen($_GET['guess']) < 1) {
    //   echo ("Your guess is too short");
    // } else if (!is_numeric($_GET['guess'])) {
    //   echo ("Your guess is not a number");
    // } else if ($_GET['guess'] < 42) {
    //   echo ("Your guess is too low");
    // } else if ($_GET['guess'] > 42) {
    //   echo ("Your guess is too high");
    // } else {
    //   echo ("Congratulations - You are right");
    // }
    ?>
  </p>
</body>

</html> -->

<!-- -------------------------------------------------------------------- -->

<?php

$guess = "";
$error = null;
$notification = "";

if (isset($_GET["guess"]) and !empty($_GET["guess"])) {
  $guess = $_GET["guess"];
  if (strlen($_GET['guess']) < 1) {
    $notification =  "Your guess is too short";
  } else if (!is_numeric($_GET['guess'])) {
    $notification =  "Your guess is not a number";
  } else if ($_GET['guess'] < 42) {
    $notification =  "Your guess is too low";
  } else if ($_GET['guess'] > 42) {
    $notification =  "Your guess is too high";
  } else {
    $notification =  "Congratulations - You are right";
  }
} else {
  $error = "ERROR: Please provide a number in the input field";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guessing Game for Charles Severance</title>
</head>

<body>

  <h1>Welcome to my guessing game</h1>

  <form method="get">
    <label for="guess">
      <input type="text" name="guess" id="guess" value="<?= htmlentities($guess) ?>" />
      <input type="submit" value="submit" name="submit">
    </label>
  </form>

  <?php
  if ($error) {
    print '<p style="color:red">';
    print htmlentities($error);
    print "</p>\n";
  }

  if ($notification) {
    print "<p>" . htmlentities($notification) . "</p>";
  }
  ?>



</body>

</html>