<!--by jade veenstra!-->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
<!-- includes nav.inc -->
<?php include 'nav.inc'; ?>
<!-- reusing the loginbody class because it does not update the page when a new one is created for manage.php!-->
<body class="loginbody">
<form method="post">
    <br><br>
  <fieldset>
    <!--a field where the manager can press a button to list all EOIs!-->
    <legend>List All EOIs</legend>
    <input type="submit" name="list_all" value="List All EOIs">
  </fieldset>
<br><br>
  <fieldset>
    <!--a field where the manager can press a button to list EOIs by job reference number!-->
    <legend>List EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_list" placeholder="Job Reference Number">
    <input type="submit" name="list_by_job" value="List EOIs">
  </fieldset>
<br><br>
  <fieldset>
    <!--a field where the manager input text then can press a button to list EOIs by applicant names!-->
    <legend>List EOIs by Applicant Name</legend>
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <br><br>
    <input type="submit" name="list_by_applicant" value="List EOIs">
  </fieldset>
<br><br>
  <fieldset>
    <!--a field where the manager input text then can press a delete all EOIs by job reference number!-->
    <legend>Delete EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_delete" placeholder="Job Reference Number">
    <br><br>
    <input type="submit" name="delete_by_job" value="Delete EOIs">
  </fieldset>
<br><br>
  <fieldset>
    <!--a field where the manager can input text then press a button to update status!-->
    <legend>Change EOI Status</legend>
    <input type="text" name="eoi_id" placeholder="EOI ID">
    <input type="text" name="new_status" placeholder="New Status">
    <br><br>
    <input type="submit" name="update_status" value="Update Status">
  </fieldset>
<br>
<br>
</form>
<!--includes nav!-->
<?php include 'footer.inc'; ?>
</body>
</html>

<?php
//starts new session
session_start();
//includes db settings
require_once("settings.php");
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}

function sanitize_output($data) {
    return htmlspecialchars($data);
}

echo '<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
</head><body>';

include 'header.inc';
include 'nav.inc';

echo '<h1>EOI Management</h1>';

// 1) List All EOIs
if (isset($_POST['list_all'])) {
    $sql = "SELECT * FROM eoi";
    $result = mysqli_query($conn2, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h3>All EOIs</h3>";
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
                    <td>" . sanitize_output($row['EOInumber']) . "</td>
                    <td>" . sanitize_output($row['Job reference number']) . "</td>
                    <td>" . sanitize_output($row['First Name']) . "</td>
                    <td>" . sanitize_output($row['Last Name']) . "</td>
                    <td>" . sanitize_output($row['Email']) . "</td>
                    <td>" . sanitize_output($row['Phone Number']) . "</td>
                    <td>" . sanitize_output($row['Skills']) . "</td>
                    <td>" . sanitize_output($row['Other Skills']) . "</td>
                    <td>" . sanitize_output($row['Status']) . "</td>
                  </tr>";
        }
        echo "</table><br>";
    } else {
        echo "No EOIs found.<br>";
    }
    mysqli_free_result($result);
}