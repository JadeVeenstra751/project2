<?php
session_start();
// checks login and manager status
$isLoggedIn = isset($_SESSION['username']);
$isManager = isset($_SESSION['role']) && $_SESSION['role'] === 'manager';

include 'header.inc'; ?>
    <meta name="author" content="Jade Veenstra">
    <title>Settings Page</title>
</head>

<body>
<?php include 'nav.inc';

if (!$isLoggedIn) {
    echo '<body style="background-color: #caba9c;">';
    echo '<div style="text-align:center; margin: 2em 0;">';
    echo '<a id="indexinfoapply" href="./login.php" class="CustomLink" style="padding:1em 2em; font-size:1.5em; border-radius:50px; display:inline-block;">Login</a>';
    echo '</div>';
} else {
    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
    echo '<p class="leafbytebuttons"><a href="./logout.php" class="CustomLink">Logout</a></p>';
    if ($isManager) {
        echo '<p class="leafbytebuttons"><a href="./manage.php" class="CustomLink">Manage</a></p>';
    }
}

include 'footer.inc';
?>

</body>
</html>