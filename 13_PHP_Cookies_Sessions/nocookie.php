<?php session_start() ?>

<p><b>No cookies for you !</b></p>

<?php
if (!isset($_SESSION['value'])) {
    echo "<p>Session is empty</p>";
} else if ($_SESSION['value'] < 3) {
    $_SESSION['value'] += 1;
    echo "<p>Add one \$_SESSION['value'] = $_SESSION[value]</p>";
} else {
    session_destroy();
    session_start();
    echo "<p>Session Restarted</p>";
}
?>

<p><a href="nocookie.php">Click This Anchor Tag!</a></p>
<pre>
<?php print_r($_SESSION); ?>
</pre>