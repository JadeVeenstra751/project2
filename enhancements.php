<!--by jade veenstra!-->
<?php
//starts new session
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

<body class = "enhancementsbody">
<!--includes nav.inc!-->
<?php include 'nav.inc';

//if not logged in, then show buttons that will direct to login page or sign up page
if (!isset($_SESSION['username'])) {
    echo '<div class="centered-container">';
    //signup button
    echo '<a id="indexinfoapply" href="./signup.php" class="CustomLink">Sign Up</a>';
    echo '<hr class="indexdivider4">';
    //login button
    echo '<a id="indexinfoapply" href="./login.php" class="CustomLink">Login</a>';
    echo '</div>';
} else {
    //else if logged in, then it will show a welcome message and logout button
    echo '<div class="centered-container logged-in">';
    echo '<h1>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</h1>';
    echo '<a id="indexinfoapply" href="./logout_process.php" class="CustomLink">Logout</a>';
    //if the user has the "manager" role then the user is able to access 2 new buttons: manage and create a new account
    if ($isManager) {
        echo '<hr class="indexdivider4">';
        //manage button
        echo '<a id="indexinfoapply" href="./manage.php" class="CustomLink">Manage</a>';
        echo '<hr class="indexdivider4">';
        //create new account button
        echo '<a id="indexinfoapply" href="./manageraccount_creation" class="CustomLink">Create a New Account</a>';
    }
    echo '</div>';
}
//include the fotter
include 'footer.inc';
?>
</body>
</html>