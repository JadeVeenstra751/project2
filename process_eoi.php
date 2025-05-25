<?php
// eoi_process.php by Will Stevens

// Include the database connection settings
require_once 'settings.php';

// Function to sanitize input data
// This function is the primary defense against unwanted SQL injections.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data); // Strips all slashes off data
    $data = htmlspecialchars($data); // Converts special characters to HTML entities
    return $data;
}

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Retrieve and sanitize form data for EOI submission
    $jobnum = sanitize_input($_POST['jobnum'] ?? '');
    $name = sanitize_input($_POST['name'] ?? '');
    $family_name = sanitize_input($_POST['family'] ?? '');
    $dob = sanitize_input($_POST['DOB'] ?? ''); 
    $gender = sanitize_input($_POST['Gender'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? '');
    $has_HTML = 0;
    $has_CSS = 0;
    $has_JavaScript = 0;
    $has_PHP = 0;
    $has_MySQL = 0;
    $has_Other_Skill_Checkbox = 0;
    $has_Not_much_coding_exp = 0;
    $other_skills = sanitize_input($_POST['OtherSkills'] ?? '');

// Check if any skills were submitted and iterate through the array
if (isset($_POST['skills']) && is_array($_POST['skills'])) {
    foreach ($_POST['skills'] as $selected_skill) {
        // Sanitize each individual selected skill value
        $sanitized_skill = sanitize_input($selected_skill); //Sends selected_skill as a local variable

        // Set the corresponding flag to 1 if the skill was selected
        switch ($sanitized_skill) {
            case 'HTML':
                $has_HTML = 1;
                break;
            case 'CSS':
                $has_CSS = 1;
                break;
            case 'JavaScript':
                $has_JavaScript = 1;
                break;
            case 'PHP':
                $has_PHP = 1;
                break;
            case 'MySQL':
                $has_MySQL = 1;
                break;
            case 'Other': 
                $has_Other_Skill_Checkbox = 1;
                break;
            case 'Not a lot of coding experience':
                $has_Not_much_coding_exp = 1;
                break;
        }
    }
}
// --- END NEW SKILLS HANDLING ---

    $other_skills = sanitize_input($_POST['OtherSkills'] ?? '');

    // Retrieve and sanitize form data for Address
    $street_address = sanitize_input($_POST['street_address'] ?? '');
    $suburb_town = sanitize_input($_POST['suburb'] ?? '');
    $state = sanitize_input($_POST['state'] ?? '');
    $postcode = sanitize_input($_POST['postcode'] ?? '');

    //Validate all required fields
    $required_fields = [
        'jobnum' => $jobnum,
        'name' => $name,
        'family_name' => $family_name,
        'DOB' => $dob,
        'gender' => $gender,
        'email' => $email,
        'phone' => $phone,
        `street_address` => $street_address,
        'suburb_town' => $suburb_town,
        'state' => $state,
        'postcode' => $postcode
    ];
    //Checks to make sure all required fields are filled
    $errors = [];
    foreach ($required_fields as $field_name => $field_value) {
        if (empty($field_value)) {
            $errors[] = ucfirst(str_replace('_', ' ', $field_name)) . " is required.";
        }
    }

    // If there are any validation errors, print them and stop
    if (!empty($errors)) {
        echo "<h2>Error: Missing Required Information</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "<p>Please go back and fill in all the required fields.</p>";
        exit(); // Stop script execution
    }

    // Establish database connection
    $conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start a transaction to ensure both inserts succeed or fail together, allowing for safe and consistent insertion
    mysqli_begin_transaction($conn);
    try {
        //Prepare and execute SQL INSERT for eoi_submissions table
        $sql_eoi = "INSERT INTO `eoi's` (`Job Reference number`, `First_name`, `Last_name`, `DOB`, `Gender`, `Email`, `Phone_number`,
        `has_HTML`, `has_CSS`, `has_JavaScript`, `has_PHP`, `has_MySQL`, `has_Other_Skill_Checkbox`, `has_Not_much_coding_exp`, `Other Skills`) 
        VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?,?)";
        $stmt_eoi = mysqli_prepare($conn, $sql_eoi);
        // Checks to see if preperation was unuccessful (thus false)
        if (!$stmt_eoi) {
            throw new Exception("Error preparing EOI statement: " . mysqli_error($conn));
        }

    mysqli_stmt_bind_param(
    $stmt_eoi, //prepared statement that will have paramaters binded to
    "sssssssiisiiiis", // s=string, i=integer
    $jobnum,
    $name,
    $family_name,
    $dob,
    $gender,
    $email,
    $phone,
    $has_HTML,
    $has_CSS,
    $has_JavaScript,
    $has_PHP,
    $has_MySQL,
    $has_Other_Skill_Checkbox,
    $has_Not_much_coding_exp,
    $other_skills
);

        if (!mysqli_stmt_execute($stmt_eoi)) {
            throw new Exception("Error executing EOI statement: " . mysqli_stmt_error($stmt_eoi));
        }

        // Get the ID of the newly inserted EOI record
        $eoi_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt_eoi);

        // Prepare and execute SQL INSERT for addresses table
        $sql_address = "INSERT INTO `address` (`EOInumber`, `Street Address`, suburb_town, `State`, `Postcode`) VALUES (?, ?, ?, ?, ?)";
        $stmt_address = mysqli_prepare($conn, $sql_address);

        if (!$stmt_address) {
            throw new Exception("Error preparing Address statement: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt_address, "isssi", $eoi_id, $street_address, $suburb_town, $state, $postcode); // 'i' for integer (eoi_id), 'sss' for strings

        if (!mysqli_stmt_execute($stmt_address)) {
            throw new Exception("Error executing Address statement: " . mysqli_stmt_error($stmt_address));
        }

        mysqli_stmt_close($stmt_address);

        // Commit the transaction if both inserts were successful
        mysqli_commit($conn);

        echo "<h2>Expression of Interest Submitted Successfully!</h2>";
        echo "<p>Thank you for your submission.</p>";
        $sql = "SELECT EOInumber FROM `eoi's`";
        $EOInum = mysqli_query($conn2, $sql);
        echo "<p> Your EOI record number is : "/$EOInum"/</p>"

    } catch (Exception $e) {
        // Rollback the transaction if any error occurred
        mysqli_rollback($conn);
        echo "<h2>Error submitting your Expression of Interest.</h2>";
        echo "<p>Please try again. Error: " . $e->getMessage() . "</p>";
    } finally {
        // Close the database connection
        mysqli_close($conn);
    }

} else {
    // If the form was not submitted via POST, redirect or show an error
    echo "<h2>Invalid Request Method.</h2>";
    echo "<p>Please submit the form using the POST method.</p>";
    header("Location: apply.php"); // Redirect back to the form
}

?>