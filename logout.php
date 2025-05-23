<?php
session_start();
// removes all session variables
$_SESSION = array();
// destroys the session
session_destroy();
// redirects to login page
header("Location: ./logout.php");
exit();
?>