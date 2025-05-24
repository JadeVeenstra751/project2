<!-- by jade veenstra! -->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
<?php include 'nav.inc'; ?>
<?php
//start new session
session_start();
//includes db settings
require_once("settings.php");
//connect to db2
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
//if not successful then show error and gterminate
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!--uses login body class because creating a new one does not update it for some reason-->
<body class="loginbody">
<form method="post">
  <br><br>
  <!--a field where the manager can press a button to list all EOIs!-->
  <fieldset>
    <legend>List All EOIs</legend>
    <input type="submit" name="list_all" value="List All EOIs"><br><br>

    <?php
     // check if the list all button was clicked
    if (isset($_POST['list_all'])) {
      //from eois table select all records
        $query = "SELECT * FROM eois";
      // execute query
        $result = mysqli_query($conn2, $query);
      // if query returns, display in a table
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr>
                    <th>EOInumber</th>
                    <th>Job reference number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Status</th>
                  </tr>";
            // loop through each row and output table data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['EOInumber']) . "</td>
                        <td>" . htmlspecialchars($row['Job reference number']) . "</td>
                        <td>" . htmlspecialchars($row['First Name']) . "</td>
                        <td>" . htmlspecialchars($row['Last Name']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Phone Number']) . "</td>
                        <td>" . htmlspecialchars($row['Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Status']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
          // if no EOIs found, display message
            echo "No EOIs found.";
        }
    }
    ?>
  </fieldset>

  <br><br>

  <!--a field where the manager can press a button to list EOIs by job reference number-->
  <fieldset>
    <legend>List EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_list" placeholder="Job Reference Number">
    <input type="submit" name="list_by_job" value="List EOIs"><br><br>

    <?php
     // check if list by job button was clicked
    if (isset($_POST['list_by_job'])) {
      //get job reference number input, default empty string
        $job_ref = $_POST['job_ref_list'] ?? '';
        //prepare sql statements to prevent injections
        $stmt = mysqli_prepare($conn2, "SELECT * FROM eois WHERE `Job reference number` = ?");
        mysqli_stmt_bind_param($stmt, "s", $job_ref);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
         // if results found, display in table
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr>
                    <th>EOInumber</th>
                    <th>Job reference number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Status</th>
                  </tr>";
           // loop through each matching EOI and output as table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['EOInumber']) . "</td>
                        <td>" . htmlspecialchars($row['Job reference number']) . "</td>
                        <td>" . htmlspecialchars($row['First Name']) . "</td>
                        <td>" . htmlspecialchars($row['Last Name']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Phone Number']) . "</td>
                        <td>" . htmlspecialchars($row['Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Status']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
          //if no eois, display message
            echo "No matching EOIs found.";
        }
        // closes the prepared statement
        mysqli_stmt_close($stmt);
    }
    ?>
  </fieldset>

  <br><br>

  <!--a field where the manager input text then can press a button to list EOIs by applicant names!-->
  <fieldset>
    <legend>List EOIs by Applicant Name</legend>
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <br><br>
    <input type="submit" name="list_by_applicant" value="List EOIs">

    <?php
     // checks if list by applicant button was clicked
    if (isset($_POST['list_by_applicant'])) {
        $first = $_POST['first_name'] ?? ''; // gets first name input or empty string
        $last = $_POST['last_name'] ?? ''; // gets last name input or empty string

         // query to select from eois table
        $query = "SELECT * FROM eois WHERE 1=1";
        $params = []; // array to hold params for binding
        $types = ""; // string to hold types of params

        //CHAT.GPT ASSISTANCE FROM HERE//
         // add condition for first name if provided
        if (!empty($first)) {
            $query .= " AND `First Name` = ?";
            $params[] = $first;
            $types .= "s";// string type
        }
         // add condition for last name if provided
        if (!empty($last)) {
            $query .= " AND `Last Name` = ?";
            $params[] = $last;
            $types .= "s";// string type
        }
        //CHAT.GPT ASSISTANCE ENDS HERE//

        // prepare query with any conditions
        $stmt = mysqli_prepare($conn2, $query);
        if (!empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
          // if results found, display in a table
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr>
                    <th>EOInumber</th>
                    <th>Job reference number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Status</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['EOInumber']) . "</td>
                        <td>" . htmlspecialchars($row['Job reference number']) . "</td>
                        <td>" . htmlspecialchars($row['First Name']) . "</td>
                        <td>" . htmlspecialchars($row['Last Name']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Phone Number']) . "</td>
                        <td>" . htmlspecialchars($row['Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                        <td>" . htmlspecialchars($row['Status']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
          // display message
            echo "No EOIs found for that applicant.";
        }
        mysqli_stmt_close($stmt);
    }
    ?>
  </fieldset>

  <br><br>

  <!--a field where the manager input text then can press a delete all EOIs by job reference number!-->
  <fieldset>
    <legend>Delete EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_delete" placeholder="Job Reference Number">
    <br><br>
    <input type="submit" name="delete_by_job" value="Delete EOIs">

    <?php
     // checks if delete by job button clicked
    if (isset($_POST['delete_by_job'])) {
        $job_ref = $_POST['job_ref_delete'] ?? ''; // get job ref input or empty string
        // prepare delete statement
        $stmt = mysqli_prepare($conn2, "DELETE FROM eois WHERE `Job reference number` = ?");
        mysqli_stmt_bind_param($stmt, "s", $job_ref);
        mysqli_stmt_execute($stmt);
      
        //CHAT.GPT assistance from here//
      // check how many rows were affected (deleted)
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "EOIs deleted successfully."; // success message
        } else {
            echo "No EOIs matched the job reference."; // no matches found
        }
        mysqli_stmt_close($stmt); // close statement
        //CHAT.GPT assistance ends here//
    }
    ?>
  </fieldset>
  <br>
  <br>
</form>
<?php include 'footer.inc'; ?>
</body>
</html>