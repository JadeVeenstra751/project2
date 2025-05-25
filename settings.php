    <!--by jade veenstra!-->
    <?php
    $host = "localhost"; //server hostname
    $user = "root";// username for SQL db
    $pwd = "";// password for SQL user

    // databases
    $sql_db2 = "usersandeois";

    // connect to userprofile db
    //establish connection
    $conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
    if (!$conn2) {
        //if connection unsuccessful, stop execution
        die("Connection to userprofile failed: " . mysqli_connect_error());
    }
    ?>