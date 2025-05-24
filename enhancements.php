<!-- enhancements.php -->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra, Will Stevens, Muhummad Taki">
<title>Enhancements Documentation</title>
<?php include 'nav.inc'; ?>
</head>

<body class="enhancementsbody">
<main class="enhancements-content">
    <h1>Enhancements Implemented</h1>

    <section>
        <h3>1. Provide the manager with the ability to select the field on which to sort the order in which the EOI records are displayed</h3>
        <p>BY Will Stevens</p>
    </section>
<br>
    <section>
        <h3>2. Create a manager registration page with server side validation requiring unique username and a password rule, and store this information in a table.</h3>
        <p>BY Jade Veenstra</p>
        <p>A page on leafbyte_settings.php (when logged in as a manager) has a button that can direct the user
           to another php page named manageraccount_creation.php. This is where the manager can register a new user
           or new manager and sign them up to the website. To ensure server side validation, an SQL query is 
           implemented to check if the username already exists in the database, making sure that every username is unique. 
           Furthermore, a pattern of a required amount of characters, special characters, letters and numbers have 
           been implemented into the code for sign up to ensure the manager creates a unique password. Then,
           once the information has been inserted by the manager, it stores the user/manager data into an SQL table.
        </p>

    </section>
<br>
    <section>
        <h3>3. Control access to manage.php by checking username and password</h3>
        <p>BY Jade Veenstra</p>
    </section>
<br>
    <section>
        <h3>4. Have access to the web site disabled for user a period of time on, say, three or more invalid login attempts</h3>
        <p>BY Muhammad Taki</p>
    </section>
</main>

<?php include 'footer.inc'; ?>
</body>
</html>