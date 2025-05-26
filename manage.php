<!-- by jade veenstra! -->
 <!-- and Will Stevens -->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
<?php
require_once("settings.php");
//start new session
session_start();
//if the user is logged in as user or not logged in at all
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'manager') {
    //then redirect user to settings page
    header("Location: ./leafbyte_settings.php");
    exit();
}
//connect to db2
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
//if not successful then show error and gterminate
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<body class="loginbody">
<?php include 'nav.inc'; ?>
<form method="post">
    <br>
    <fieldset>
        <!-- Create sort selection list -->
        <legend>List All EOIs</legend>
        <!-- Field to sort -->
        <label for="sort_field">Sort By:</label>
        <select name="sort_field" id="sort_field">
            <option value="EOInumber">EOI Number (Default)</option>
            <option value="First_name">First Name (Alphabetical)</option>
            <option value="Last_name">Last Name (Alphabetical)</option>
            <option value="DOB">Date of Birth (Date)</option>
            <option value="submission_date">Submission date</option>
            <option value="suburb_town">Suburb/Town (Alphabetical)</option>
            <option value="State">State (Alphabetical)</option>
            <option value="Postcode">PostCode (Numerical)</option>
        </select>
        <!-- Order to sort -->
        <label for="sort_order">Order:</label>
        <select name="sort_order" id="sort_order">
            <option value="ASC">Ascending (A-Z / Oldest First)</option>
            <option value="DESC">Descending (Z-A / Newest First)</option>
        </select>
        <input type="submit" name="list_EOIs" value="List EOIs"><br><br>

        <?php
        // check if the list EOIs button was clicked
        if (isset($_POST['list_EOIs'])) {
            // Get sort field and order from POST, with defaults
            $sort_field = $_POST['sort_field'] ?? 'EOInumber'; // Default sort by EOI Number
            $sort_order = $_POST['sort_order'] ?? 'ASC'; // Default sort order ascending

            // Validate sort_field to prevent SQL injection
            // Only allow specific column names
            $allowed_sort_fields = [
                'EOInumber',
                'First_name',
                'Last_name',
                'DOB',
                'submission_date',
                'suburb_town',
                'State',
                'Postcode'
            ];

            if (!in_array($sort_field, $allowed_sort_fields)) {
                $sort_field = 'EOInumber'; // Fallback to default if invalid field is provided
            }

            // Validate sort_order
            if (!in_array(strtoupper($sort_order), ['ASC', 'DESC'])) {
                $sort_order = 'ASC'; // Fallback to default if invalid order is provided
            }

       
    

            // Construct the query with ORDER BY clause and JOIN
            // Use backticks for column names with spaces or special characters
            // Used google gemini for this query. "How could I join two sql tables using php, making the data relative to each other."
            $query = "SELECT eois.*, address.`Street Address`, address.`suburb_town`, address.`State`, address.`Postcode` 
                      FROM eois 
                      LEFT JOIN `address` ON eois.EOInumber = address.id 
                      ORDER BY `" . mysqli_real_escape_string($conn2, $sort_field) . "` " . mysqli_real_escape_string($conn2, $sort_order);
            // execute query
            $result = mysqli_query($conn2, $query);
            // if query returns, display in a table
            if ($result && mysqli_num_rows($result) > 0) {
                /// start the table and add headers for each column
                echo "<table border='1' cellpadding='5'>";
                echo "<tr>
                        <th>EOI Number</th>
                        <th>Job Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>E-mail</th>
                        <th>Phone Number</th>
                        <th>Skills (Other Text)</th>
                        <th>Status</th>
                        <th>HTML</th>
                        <th>CSS</th>
                        <th>JavaScript</th>
                        <th>PHP</th>
                        <th>MySQL</th>
                        <th>Other Skill Checkbox</th>
                        <th>Not Much Coding EXP</th>
                        <th>Submission date</th>
                        <th>Street Address</th>
                        <th>Suburb/Town</th>
                        <th>State</th>
                        <th>Postcode</th>
                      </tr>";
                // loop through each row and output table data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['EOInumber']) . "</td>
                            <td>" . htmlspecialchars($row['Job Reference number']) . "</td>
                            <td>" . htmlspecialchars($row['First_name']) . "</td>
                            <td>" . htmlspecialchars($row['Last_name']) . "</td>
                            <td>" . htmlspecialchars($row['DOB']) . "</td>
                            <td>" . htmlspecialchars($row['Gender']) . "</td>
                            <td>" . htmlspecialchars($row['Email']) . "</td>
                            <td>" . htmlspecialchars($row['Phone_number']) . "</td>
                            <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                            <td>" . htmlspecialchars($row['status_id']) . "</td>
                            <td>" . ($row['has_HTML'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_CSS'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_JavaScript'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_PHP'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_MySQL'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_Other_Skill_Checkbox'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_Not_much_coding_exp'] ? '✓' : 'X') . "</td>
                            <td>" . htmlspecialchars($row['submission_date']) . "</td>
                            <td>" . htmlspecialchars($row['Street Address']) . "</td>
                            <td>" . htmlspecialchars($row['suburb_town']) . "</td>
                            <td>" . htmlspecialchars($row['State']) . "</td>
                            <td>" . htmlspecialchars($row['Postcode']) . "</td>
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
            $stmt = mysqli_prepare($conn2, "SELECT * FROM eois WHERE `Job Reference number` = ?");
            mysqli_stmt_bind_param($stmt, "s", $job_ref);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // if results found, display in table
            if ($result && mysqli_num_rows($result) > 0) {
                /// start the table and add headers for each column
                echo "<table border='1' cellpadding='5'>";
                echo "<tr>
                    <th>EOInumber</th>
                    <th>Job Reference number</th>
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
                        <td>" . htmlspecialchars($row['EOInumber']) . "</td> <td>" . htmlspecialchars($row['Job Reference number']) . "</td>
                        <td>" . htmlspecialchars($row['First_name']) . "</td>
                        <td>" . htmlspecialchars($row['Last_name']) . "</td>
                        <td>" . htmlspecialchars($row['DOB']) . "</td>
                        <td>" . htmlspecialchars($row['Gender']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Phone_number']) . "</td>
                        <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                        <td>" . htmlspecialchars($row['status_id']) . "</td>
                        <td>" . ($row['has_HTML'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_CSS'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_JavaScript'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_PHP'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_MySQL'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_Other_Skill_Checkbox'] ? '✓' : 'X') . "</td>
                        <td>" . ($row['has_Not_much_coding_exp'] ? '✓' : 'X') . "</td>
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

            //only continue if at least one input is provided
            if (empty($first) && empty($last)) {
                echo "Please enter at least a first name or last name to search.";
            } else {
                // query to select from eois table
                $query = "SELECT * FROM eois WHERE 1=1";
                $params = [];// array to hold params for binding
                $types = "";// string to hold types of params

                // add condition for first name if provided
                if (!empty($first)) {
                    $query .= " AND First_name = ?";
                    $params[] = $first;
                    $types .= "s";// string type
                }
                // add condition for last name if provided
                if (!empty($last)) {
                    $query .= " AND Last_name = ?";
                    $params[] = $last;
                    $types .= "s";// string type
                }
                
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
                        <th>Job Reference number</th>
                        <th>First_name</th>
                        <th>Last_name</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Skills</th>
                        <th>Other Skills</th>
                        <th>Status</th>
                        <th>HTML</th>
                        <th>CSS</th>
                        <th>JavaScript</th>
                        <th>PHP</th>
                        <th>MySQL</th>
                        <th>Other Skill Checkbox</th>
                        <th>Not Much Coding EXP</th>
                      </tr>";
                    // loop through each record and make a new table row for it
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['EOInumber']) . "</td> <td>" . htmlspecialchars($row['Job Reference number']) . "</td>
                            <td>" . htmlspecialchars($row['First_name']) . "</td>
                            <td>" . htmlspecialchars($row['Last_name']) . "</td>
                            <td>" . htmlspecialchars($row['DOB']) . "</td>
                            <td>" . htmlspecialchars($row['Gender']) . "</td>
                            <td>" . htmlspecialchars($row['Email']) . "</td>
                            <td>" . htmlspecialchars($row['Phone_number']) . "</td>
                            <td>" . htmlspecialchars($row['Other Skills']) . "</td>
                            <td>" . htmlspecialchars($row['status_id']) . "</td>
                            <td>" . ($row['has_HTML'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_CSS'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_JavaScript'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_PHP'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_MySQL'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_Other_Skill_Checkbox'] ? '✓' : 'X') . "</td>
                            <td>" . ($row['has_Not_much_coding_exp'] ? '✓' : 'X') . "</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    // display message
                    echo "No EOIs found for that applicant.";
                }
                mysqli_stmt_close($stmt);
            }

        }
        ?>
    </fieldset>

    <br><br>

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
            $stmt = mysqli_prepare($conn2, "DELETE FROM eois WHERE `Job Reference number` = ?");
            mysqli_stmt_bind_param($stmt, "s", $job_ref);
            mysqli_stmt_execute($stmt);
            
            // check how many rows were affected (deleted)
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "EOIs deleted successfully."; // success message
            } else {
                echo "No EOIs matched the job Reference."; // no matches found
            }
            mysqli_stmt_close($stmt); // close statement
        }
        ?>
    </fieldset>
<br>
<br>
    <fieldset>
    <legend>Update Status by EOI Number</legend>
    <input type="text" name="eoi_number_update" placeholder="EOI number">
    <select name="new_status">
        <option value="">-- Select a New Status --</option>
        <option value="New">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
    </select>
    <br><br>
    <input type="submit" name="update_status" value="Update Status">

    <?php
    // checks if the update status button was clicked
    if (isset($_POST['update_status'])) {
        // get, clear whitespace and clean the EOI number and new status input from the form
        $eoi_number = trim($_POST['eoi_number_update'] ?? '');
        $new_status = trim($_POST['new_status'] ?? '');

        // make sure neither field is empty
        if (empty($eoi_number) || empty($new_status)) {
            echo "Please enter an EOI number and select a new status.";
        } else {
            // prepare a SQL statement to safely update the status
            $stmt = mysqli_prepare($conn2, "UPDATE eois SET status_id = ? WHERE EOInumber = ?");
            
            // if preparing the statement worked
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $new_status, $eoi_number); // Assuming EOI number can be treated as a string for binding
                // run the statement
                mysqli_stmt_execute($stmt);

                // check if any rows were updated
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    //display successful message
                    echo "EOI status updated successfully.";
                } else {
                    //display error message
                    echo "No EOIs matched the EOI number.";
                }

                // close the statement
                mysqli_stmt_close($stmt);
            } else {
                // if preparing failed, show an error
                echo "Error preparing update: " . mysqli_error($conn2);
            }
        }
    }
    ?>
    </fieldset>
    <br>
    <br>
    <br>
</form>
<?php include 'footer.inc'; ?>
</body>
</html>