<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Login Page</title>
</head>

<body>
<?php include 'nav.inc'; ?>

<form id="form2" action="process_login.php" method="post" style="display: flex; justify-content: center;">
  <div class="login-form">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Login">
  </div>
</form>