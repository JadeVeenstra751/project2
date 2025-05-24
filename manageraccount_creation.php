    <!-- by jade veenstra -->
    <!-- includes header.inc -->
    <?php include 'header.inc'; ?>
    <meta name="author" content="Jade Veenstra">
    <title>LeafByte Tech Manager Sign-Up Page</title>
    <!-- includes nav.inc -->
    <?php include 'nav.inc'; ?>
    </head>
    <!-- declares a class for signup body -->
    <body class="loginbody">
    <form action="manageraccount_creation_process.php" method="post">
        <!-- class for signup-form -->
        <div class="login-form">
        <h2>Create an Account for a User or Manager:</h2>
        <hr class="indexdivider5">
        <!-- username input for user -->
        <label for="username">Choose a Username:</label>
        <input type="text" name="username" id="username" required>
            <hr class="indexdivider5">
        <!-- password input for user -->
        <label for="password">Choose a Password:</label>
        <!-- adding a pattern for the password must have at least one letter, one digit, one special cahracter and a minimum of 8 characters. CHAT.GPT was uesd to generate this pattern!-->
        <input type="password" name="password" id="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$" title="Password must be at least 8 characters, include at least one letter, one number and one special character." required>
        <hr class="indexdivider5">
        <fieldset?>
                <legend>Choose a Role:</legend>
                <input type="radio" id="role_user" name="role" value="user" required>
                <label for="role_user">User</label>

                <input type="radio" id="role_manager" name="role" value="manager" required>
                <label for="role_manager">Manager</label>
            </fieldset>
        <hr class="indexdivider5">
        <!-- submit button -->
        <input type="submit" value="Sign Up">
        </div>
    </form>
    <!-- includes footer -->
    <?php include 'footer.inc'; ?>
    </body>
    </html>