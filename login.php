<!--includes header.inc!-->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Login Page</title>
<!--includes nav.inc!-->
<?php include 'nav.inc'; ?>
</head>

<!--declares a class for login body!-->
<body class="loginbody">
<form action="process_login.php" method="post">
  <!--class for login-form!-->
  <div class="login-form">
    <!--username input for user!-->
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <!--password input for user!-->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <!--submit button!-->
    <input type="submit" value="Login">
  </div>
</form>
<!--includes footer!-->
 <?php include 'footer.inc';?>
</body>
</html>