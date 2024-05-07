<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HTML Injection & Validation</title>
</head>

<body>
   <?php
   // $old_guess = isset($_POST['guess']) ? $_POST['guess'] : '';
   $old_guess = $_POST['guess'] ?? '';
   ?>
   <p>Guessing game...</p>
   <form method="post">
      <p>
         <label for="guess">Input Guess</label>
         <input type="text" name="guess" id="guess" size="40" value="<?= htmlentities($old_guess) ?>" />
      </p>
      <input type="submit" />
   </form>

   <pre>
$_POST:
<?php
echo "htmlentities(\$old_guess) = ", htmlentities($old_guess);
print_r($_POST);
?>
</pre>

   <p>Incoming Data Validation</p>

   <ul>
      <li>
         <p>Make sur all user data is present and in the correct format before processing</p>
      </li>
      <li>
         <p>Non empty <code>strlen($var) > 0</code></p>
      </li>
      <li>
         <p>A number: <code>is_numeric($var)</code></p>
      </li>
      <li>
         <p>A email: <code>strpos($var, "@")</code></p>
      </li>
      <li>
         <p>etc...</p>
      </li>

   </ul>

</body>

</html>