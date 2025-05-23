<?php
require_once "settings.php";
$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
if ($dbconn) {

    $query = "SELECT * FROM cars";
    $result = mysqli_query($dbconn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr>
            <th>EOI Number</th>
            <th>Job Ref</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Street Address</th>
            <th>Suburb</th>
            <th>State</th>
            <th>Postcode</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Skill 1</th>
            <th>Skill 2</th>
            <th>Skill 3</th>
            <th>Other Skills</th>
            <th>Status</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</td>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['yom'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>There are no EOIs to display.</p>";
    }
    
    mysqli_close($dbconn);
} else {
    echo "<p>Unable to connect to the database.</p>";
}
?>