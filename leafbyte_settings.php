<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$isManager = isset($_SESSION['role']) && $_SESSION['role'] === 'manager';

include 'header.inc';
include 'nav.inc';
echo '<link rel="stylesheet" type="text/css" href="styles/styles.css">';
if (!$isLoggedIn) {
    echo '<p class="menu"><a href="./login.php" class="CustomLink">Login</a></p>';
} else {
    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
    echo '<p class="menu"><a href="./logout.php" class="CustomLink">Logout</a></p>';
    if ($isManager) {
        echo '<p class="menu"><a href="./manage.php" class="CustomLink">Manage</a></p>';
    }
}

include 'footer.inc';
?>