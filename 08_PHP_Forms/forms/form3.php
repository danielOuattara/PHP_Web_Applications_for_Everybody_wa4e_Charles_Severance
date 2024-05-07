<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>POST</title>
</head>

<body>
   <p>Guessing game...</p>
   <form method="post">
      <p>
         <label for="guess">Input Guess</label>
         <input type="text" name="guess" size="40" id="guess" />
      </p>
      <input type="submit" />
   </form>

   <pre>
$_POST:
<?php
print_r($_POST);
?>

$_GET:
<?php
print_r($_GET);
?>
</pre>

</body>

</html>