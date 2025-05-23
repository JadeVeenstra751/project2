<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>Login - LeafByte Tech</title>
</head>

<body>
<?php include 'nav.inc'; ?>

<form action="process.php" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Login">
  
<?php include 'footer.inc'; ?>
</body>
</html>