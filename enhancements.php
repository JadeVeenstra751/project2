<!--by jade veenstra!-->
<?php
//starts php session
session_start();
require_once("settings.php");
//establishes connection with db
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
//if connection fails then show error
if (!$conn2){
    die("Connection failed: " . mysqli_connect_error());
}
// checks login and manager status
$isLoggedIn = isset($_SESSION['username']);
$isManager = isset($_SESSION['role']) && $_SESSION['role'] === 'manager';

//includes header.inc
include 'header.inc'; ?>
    <meta name="author" content="Jade Veenstra">
    <title>Settings Page</title>
</head>

<body>
<!--includes nav.inc!-->
<?php include 'nav.inc';

if (!$isLoggedIn) {//if user not logged in then
    //issues with css so i had to add in the css into the page to get it to work
    echo '<body style="background-color: #caba9c;">';
    echo '<div style="text-align:center; margin: 2em 0;">';
    echo '<a id="indexinfoapply" href="./login.php" class="CustomLink" style="padding:1em 2em; font-size:1.5em; border-radius:50px; display:inline-block;">Login</a>';
} else {
    echo '<h1>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</h1>';
    echo '<a id="indexinfoapply" href="./logout_process.php" class="CustomLink">Logout</a></p>';
    if ($isManager) {
        echo '<a id="indexinfoapply" href="./manage.php" style="padding:1em 2em; font-size:1.5em; border-radius:50px; display:inline-block; class="CustomLink">Manage</a>';
    }
}
echo '</div>';

include 'footer.inc';
?>

</body>
</html>