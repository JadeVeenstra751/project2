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
    <form action="process_signup.php" method="post">
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
        <!-- adding a pattern for the password !-->
        <input type="password" name="password" id="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must be at least 8 characters, include at least one letter and one number." required>
        <hr class="indexdivider5">
        <fieldset?> 
                <!-- new section for user or manager-->
                <legend>Choose a Role:</legend>
                <!--selection of radio buttons for user to select a unit-->
                <input type="radio" id="unit_1" name="unit" value="COS10011" required>
                <label for="unit_1">User</label>
                <input type="radio" id="unit_2" name="unit" value="COS60004" required>
                <label for="unit_2">Manager</label>
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