<p>HTML field types...</p>
<p>
   Taken from
   <a href="http://www.w3schools.com/html/html5_form_input_types.asp" target="_blank">
      http://www.w3schools.com/html/html5_form_input_types.asp</a>
</p>

<form method="post" action="html5.php">


   <label for="favcolor">
      Select your favorite color: <input type="color" name="favcolor" value="#0000ff" id="favcolor"><br />
   </label>

   <label for="bday">
      Birthday: <input type="date" name="bday" value="2013-09-02" id="bday"><br />
   </label>

   <label for="email">
      E-mail: <input type="email" name="email" id="email"><br />
   </label>

   <label for="quantity">
      Quantity (between 1 and 5): <input type="number" name="quantity" min="1" max="5" id="quantity"><br />
   </label>

   <label for="homepage">
      Add your homepage: <input type="url" name="homepage" id="homepage"><br>
   </label>

   <label for="saucer">
      Transportation: <input type="flying" name="saucer" id="saucer"><br>
   </label>

   <input type="submit" name="submit" value="Submit" id="submit" />

   <input type="button" onclick="location.href='http://www.wa4e.com/'; return false;" value="Escape" id="" />
   </p>
</form>

<pre>
$_POST:
<?php
// print_r($_POST);
print_r($GLOBALS);
?>
</pre>