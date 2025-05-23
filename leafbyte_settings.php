<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$isManager = isset($_SESSION['role']) && $_SESSION['role'] === 'manager';

include 'header.inc';
include 'nav.inc';
echo '<link rel="stylesheet" type="text/css" href="styles/styles.css">';
if (!$isLoggedIn) {
    echo '<div class="leafbytesettings">';
    echo '<p class="leafbytebuttons"><a href="./login.php" class="CustomLink">Login</a></p>';
} else {
    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
    echo '<p class="leafbytebuttons"><a href="./logout.php" class="CustomLink">Logout</a></p>';
    if ($isManager) {
        echo '<p class="leafbytebuttons"><a href="./manage.php" class="CustomLink">Manage</a></p>';
    }
}

include 'footer.inc';
?>