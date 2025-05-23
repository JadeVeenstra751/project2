<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Login Page</title>
</head>

<body>
<?php include 'nav.inc'; ?>

<form action="process_login.php" method="post" background-color: #ab8462;>
  <div class="login-form">
    <fieldset>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
  </fieldset>
    <input type="submit" value="Login">
  </div>
</form>