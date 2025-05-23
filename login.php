<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Login Page</title>
<?php include 'nav.inc'; ?>
</head>

<body>
<form action="process_login.php" method="post" background-color: #ab8462;>
  <div class="login-form">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Login">
  </div>
</form>
 <?php include 'footer.inc';?>
</body>
</html>