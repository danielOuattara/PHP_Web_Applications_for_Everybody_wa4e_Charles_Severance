<?php
// Tell PHP we won't be using cookies for the session
ini_set('session.use_cookies', '0');
ini_set('session.use_only_cookies', 0);
ini_set('session.use_trans_sid', 1);

session_start();

// Start the view
?>
<p><b>No Cookies for You!</b></p>