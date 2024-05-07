<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>persist data into the field input </title>
</head>

<body>
   <?php
   // How to persist data into the field input 
   // $old_guess = isset($_POST['guess']) ? $_POST['guess'] : '';
   $old_guess = $_POST['guess'] ?? '';
   ?>
   <p>Guessing game...</p>
   <form method="post">
      <p>
         <label for="guess">Input Guess</label>
         <input type="text" name="guess" id="guess" size="40" value="<?= $old_guess ?>" />
      </p>
      <input type="submit" />
   </form>
   <p>Danger here: see solution on form5.php</p>

   <pre>
$_POST:
<?php
print_r($_POST);
?>
</pre>

</body>

</html>