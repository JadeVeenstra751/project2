<!-- by jade veenstra -->
<!-- includes header.inc -->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Sign-Up Page</title>
</head>

<!-- declares a class for signup body -->
<body class="loginbody">
  <!-- includes nav.inc -->
<?php include 'nav.inc'; ?>
  <form action="process_signup.php" method="post">
    <!-- class for signup-form -->
    <div class="login-form">
      <h2>Create an Account:</h2>
      <hr class="indexdivider5">
      <!-- username input for user -->
      <label for="username">Choose a Username:</label>
      <input type="text" name="username" id="username" required>
        <hr class="indexdivider5">
      <!-- password input for user -->
      <label for="password">Choose a Password:</label>
      <input type="password" name="password" id="password" required>
      <hr class="indexdivider5">
      <!-- submit button -->
      <input type="submit" value="Sign Up">
    </div>
  </form>
  <!-- includes footer -->
  <?php include 'footer.inc'; ?>
</body>
</html>