<?php include 'header.inc'; ?>
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

function check_and_create_table($conn2, $table_name, $create_sql) {
    // Check if table exists
    $result = mysqli_query($conn2, "SHOW TABLES LIKE '" . mysqli_real_escape_string($conn2, $table_name) . "'");

    if (mysqli_num_rows($result) == 0) {
        // Table does not exist, try to create it
        if (mysqli_query($conn2, $create_sql)) {
            error_log("Table '$table_name' created successfully.");
            return true;
        } else {
            error_log("Error creating table '$table_name': " . mysqli_error($conn2));
            return false;
        }
    }
    // Table already exists
    return true;
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
    // This shouldn't occur as the form checks this already, but in the case it does, it won't allow it to go through
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
    if (!$conn2) {
        die("Connection failed: " . mysqli_connect_error());
    }

        // --- START: Table Existence Check and Creation ---
    $eois_create_sql = "
        CREATE TABLE eois (
            EOInumber INT AUTO_INCREMENT PRIMARY KEY,
            `Job Reference number` VARCHAR(255) NOT NULL,
            First_name VARCHAR(255) NOT NULL,
            Last_name VARCHAR(255) NOT NULL,
            DOB DATE,
            Gender VARCHAR(50),
            Email VARCHAR(255) NOT NULL,
            Phone_number VARCHAR(50),
            status_id SET('New', 'Current', 'Final') DEFAULT 'New',
            has_HTML TINYINT(1) DEFAULT 0 NOT NULL,
            has_CSS TINYINT(1) DEFAULT 0 NOT NULL,
            has_JavaScript TINYINT(1) DEFAULT 0 NOT NULL,
            has_PHP TINYINT(1) DEFAULT 0 NOT NULL,
            has_MySQL TINYINT(1) DEFAULT 0 NOT NULL,
            has_Other_Skill_Checkbox TINYINT(1) DEFAULT 0 NOT NULL,
            has_Not_much_coding_exp TINYINT(1) DEFAULT 0 NOT NULL,
            `Other Skills` TEXT,
            submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";
    // Foreign key to link to eois
    $address_create_sql = "
        CREATE TABLE address (
            id INT AUTO_INCREMENT PRIMARY KEY,
            `Street Address` VARCHAR(255) NOT NULL,
            `suburb_town` VARCHAR(255) NOT NULL,
            `State` VARCHAR(50) NOT NULL,
            `Postcode` VARCHAR(20) NOT NULL,
            FOREIGN KEY (id) REFERENCES eois(EOInumber) ON DELETE CASCADE 
        );
    ";

    // Check and create eois table
    if (!check_and_create_table($conn2, 'eois', $eois_create_sql)) {
        die("Failed to create or verify 'eois' table. Please check database permissions.");
    }

    // Check and create address table
    if (!check_and_create_table($conn2, 'address', $address_create_sql)) {
        die("Failed to create or verify 'address' table. Please check database permissions.");
    }
    // --- END: Table Existence Check and Creation ---

    // Start a transaction to ensure both inserts succeed or fail together, allowing for safe and consistent insertion
    // I found try, catch and finally on the W3School forums, where if it tries the insertion and there is an error, it will be caught
    mysqli_begin_transaction($conn2);
    try {
        //Prepare and execute SQL INSERT for eoi_submissions table
        $sql_eoi = "INSERT INTO `eois` (`Job Reference number`, `First_name`, `Last_name`, `DOB`, `Gender`, `Email`, `Phone_number`,
        `has_HTML`, `has_CSS`, `has_JavaScript`, `has_PHP`, `has_MySQL`, `has_Other_Skill_Checkbox`, `has_Not_much_coding_exp`, `Other Skills`) 
        VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?,?)";
        $stmt_eoi = mysqli_prepare($conn2, $sql_eoi);
        // Checks to see if preperation was unuccessful (thus false)
        // This will catch the error
        if (!$stmt_eoi) {
            throw new Exception("Error preparing EOI statement: " . mysqli_error($conn2));
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
        // This will catch an error if there is one
        if (!mysqli_stmt_execute($stmt_eoi)) {
            throw new Exception("Error executing EOI statement: " . mysqli_stmt_error($stmt_eoi));
        }

        // Get the ID of the newly inserted EOI record
        $eoi_id = mysqli_insert_id($conn2);
        mysqli_stmt_close($stmt_eoi);

        // Prepare and execute SQL INSERT for addresses table
        $sql_address = "INSERT INTO `address` (`Street Address`, `suburb_town`, `State`, `Postcode`) VALUES (?, ?, ?, ?)";
        $stmt_address = mysqli_prepare($conn2, $sql_address);

        if (!$stmt_address) {
            throw new Exception("Error preparing Address statement: " . mysqli_error($conn2));
        }

        mysqli_stmt_bind_param($stmt_address, "sssi", $street_address, $suburb_town, $state, $postcode); // 'i' for integer (eoi_id), 'sss' for strings

        if (!mysqli_stmt_execute($stmt_address)) {
            throw new Exception("Error executing Address statement: " . mysqli_stmt_error($stmt_address));
        }

        mysqli_stmt_close($stmt_address);

        // Commit the transaction if both inserts were successful
        mysqli_commit($conn2);
        // Sends to succes.php to display success message
        header("Location: success.php"); 
    } catch (Exception $e) {
        // Rollback the transaction if any error occurred
        mysqli_rollback($conn2);
        echo "<h2>Error submitting your Expression of Interest.</h2>";
        echo "<p>Please try again. Error: " . $e->getMessage() . "</p>";
    } finally {
        // Close the database connection
        mysqli_close($conn2);
    }

} else {
    // If the form was not submitted via POST, redirect or show an error
    echo "<h2>Invalid Request Method.</h2>";
    echo "<p>Please submit the form using the POST method.</p>";
    header("Location: apply.php"); // Redirect back to the form
}

?>
<?php include 'footer.inc'; ?>
