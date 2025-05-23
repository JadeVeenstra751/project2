<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>Login - LeafByte Tech</title>
</head>
<body class="home">
<?php include 'nav.inc'; ?>

<section class="login-section">
  <form action="process.php" method="post" class="login-form">
    <label for="username" class="login-label">Username:</label>
    <input type="text" id="username" name="username" class="login-input" required>

    <label for="password" class="login-label">Password:</label>
    <input type="password" id="password" name="password" class="login-input" required>

    <input type="submit" value="Login" class="login-button">
  </form>
</section>

<?php include 'footer.inc'; ?>
</body>
</html>