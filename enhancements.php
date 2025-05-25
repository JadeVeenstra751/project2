<!--by jade veenstra-->
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
           Furthermore, a pattern of a required amount of characters, special characters, letters and numbers has
           been implemented into the code for sign up to ensure the manager creates a unique password. Then,
           once the information has been inserted by the manager, it stores the user/manager data into an SQL table inside
           a database.
        </p>
    </section>
<br>
    <section>
        <h3>3. Control access to manage.php by checking username and password</h3>
        <p>BY Jade Veenstra</p>
        <p> To access manage.php, the user has to be logged in as 'manager' with the correct password 
            and the correct username. This is checked during process_login.php where the values are submitted to the login form 
            then checks whether the user exists within the table in the database. If the user was found, it then
            checks the password to see if it is correct. If it is correct, then it starts the session for the user.
            Furthermore, to ensure only managers are able to view manage.php, a field in the SQL table is assigned to 'roles',
            where there is the role of a 'manager' and the role of a 'user' to differentiate them from one another
            and provide access to manage.php only when the role is set to 'manager'. The session is then checked to ensure that the user has the role of 'manager'.
            If not, and the role is 'user', then the user is directed to a page where they are unable to see manage.php.
        </p>
    </section>
<br>
    <section>
        <h3>4. Have access to the web site disabled for user a period of time on, say, three or more invalid login attempts</h3>
        <p>BY Muhammad Taki</p>
        <p>
            I have implemented a somewhat security mechanism that locks out user from logging on an account for 10 seconds.
            It tracks failed login attempts within the user's current session. If the number of incorrect tries reaches 3
            the account is temporarily locked for a set duration 10 seconds. On succesful login,the attempt counter and lockout status are reset.
            This can prevent brute force attacks, that is when hackers runs bots to login using multiple combinations. Innitialy,
            I was going for a db connected login attempt mechanism so the manager can see see which user/s are currently locked out, but due to 
            time constraint I unfortunatly couldn't.
        </p>
    </section>
<br>
<br>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>