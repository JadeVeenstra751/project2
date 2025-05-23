<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // removes all session variables
    $_SESSION = array();
    // destroys the session
    session_destroy();

    // redirects to login page
    header("Location: login.php");
    exit();
}
    ?>
<?php