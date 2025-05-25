<!--by jade veenstra!-->
<!--includes header.inc!-->
<?php 
session_start(); 
include 'header.inc'; 
?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Login Page</title>
<!--includes nav.inc!-->
<?php include 'nav.inc'; ?>
</head>

<!--declares a class for login body!-->
<body class="loginbody">

<!--BY TAKI, for max login attempts -->
<?php
// Display login error messages if any are set in the session
if (isset($_SESSION['login_error'])) {
    //Login Attempts NOTICE 
    echo '<p style="color: khaki; text-align: center; font-weight: bold;">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
    unset($_SESSION['login_error']); // Clear the error message after displaying it
}
?>

<form action="process_login.php" method="post">
  <!--class for login-form!-->
  <div class="login-form">
    <h2>Log In:</h2>
    <hr class="indexdivider5">
    <!--username input for user!-->
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <hr class="indexdivider5">
    <!--password input for user!-->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <hr class="indexdivider5">
    <!--submit button!-->
    <input type="submit" value="Login">
  </div>
</form>
<!--includes footer!-->
<?php include 'footer.inc';?>
</body>
</html>
