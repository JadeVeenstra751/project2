<?php
//starts new session
session_start();
//includes db settings
require_once("settings.php");
//connects to db
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

//if conn2 unsuccessful
if (!$conn2){
    die("Connection failed: " . mysqli_connect_error());
}

// BY TAKI - LOGIN ATTEMPT AND LOCKOUT
$max_login_attempts = 3;
$lockout_duration_seconds = 10;

// Setup login tracking 
//Use of GenAI (Gemini):
//prompt: I want to create variables and use it as a while loop to detect login attempts and when it reaches a specific number it should disable login for a specified time. in steps tell me how
$_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;
$_SESSION['lockout_until'] = $_SESSION['lockout_until'] ?? null;
//AI use end here
//if post
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //stores username and password input in login form
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    // Check if locked out
    // If 'lockout_until' is set in the session and the current time is before the lockout end time
    if ($_SESSION['lockout_until'] && strtotime($_SESSION['lockout_until']) > time()) {
         // Calculate the number of seconds remaining until the lockout expires 
        $remaining = strtotime($_SESSION['lockout_until']) - time();
        // Set an error message in the session to inform the user about the lockout and remaining time
        $_SESSION['login_error'] = "Account locked. Try again in $remaining seconds.";
        header("Location: ./login.php");
        exit();
    }

    // Prepare statement to fetch user data (username, password, role)
    $stmt = $conn2->prepare("SELECT username, password, role FROM user WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // BY JADE - LOGIN VERIFICATION
        $valid = false;
        if ($user) {
            // assistance from CHAT.GPT and week 11 modules
            // Verify password
            if (strpos($user['password'], '$2y$') === 0) {
                // if password is hashed, verify with password_verify
                $valid = password_verify($input_password, $user['password']);
            } else {
                // otherwise password stored in plain text
                $valid = ($input_password === $user['password']);

                // if valid, rehash password and update db for better security
                if ($valid) {
                    $newHash = password_hash($input_password, PASSWORD_DEFAULT);
                    $updateStmt = $conn2->prepare("UPDATE user SET password = ? WHERE username = ?");
                    $updateStmt->bind_param("ss", $newHash, $input_username);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
            }
            // CHAT.GPT assistance ends here

            // BY TAKI - SUCCESSFUL OR FAILED LOGIN HANDLING
            if ($valid) {
                 // If the username and password are correct:
                 // Reset the count of wrong tries back to zero
                $_SESSION['login_attempts'] = 0;
                // Clear any existing lockout time in the session
                $_SESSION['lockout_until'] = null;

                // Create a brand new session ID for security
                session_regenerate_id(true);
                // Save the user's name in the session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                // user go after logging in
                header("Location: ./leafbyte_settings.php");
                exit();
            } else {
                // If the username or password is NOT correct:
                // Add one to the count of wrong login tries
                $_SESSION['login_attempts']++;
                 // If the number of wrong tries has reached the limit:
                if ($_SESSION['login_attempts'] >= $max_login_attempts) {
                    //Use of GenAI: prompt: I want to create variables and use it as a while loop to detect login attempts and when it reaches a specific number it should disable login for a specified time. in steps tell me how
                    $_SESSION['lockout_until'] = date('Y-m-d H:i:s', time() + $lockout_duration_seconds);
                    // Set a time in the session for when the account will be unlocked (current time + lockout duration)
                     // Show a message saying the account is locked and for how long
                    $_SESSION['login_error'] = "Too many failed attempts. Account locked for $lockout_duration_seconds seconds.";
                    //AI use till here
                } else {
                    // If the number of wrong tries is still below the limit:
                    // Calculate how many more tries the user has left
                    $remaining = $max_login_attempts - $_SESSION['login_attempts'];
                    // Show a message saying the login was wrong and how many tries are left
                    $_SESSION['login_error'] = "Incorrect credentials. $remaining attempt(s) remaining.";
                }
                header("Location: ./login.php");
                exit();
            }
        } else {
            // BY TAKI - user handling
            // Add one to the count of wrong login tries
            $_SESSION['login_attempts']++;
            // If the number of wrong tries has reached the limit:
            if ($_SESSION['login_attempts'] >= $max_login_attempts) {
                // Set a time in the session for when the account will be unlocked (current time + lockout duration)
                //Use of GenAI (Gemini): prompt: I want to create variables and use it as a while loop to detect login attempts and when it reaches a specific number it should disable login for a specified time. in steps tell me how
                $_SESSION['lockout_until'] = date('Y-m-d H:i:s', time() + $lockout_duration_seconds);
                $_SESSION['login_error'] = "Too many failed login attempts. Account locked for $lockout_duration_seconds seconds.";
                //AI use till here
            } else {
                $_SESSION['login_error'] = "Incorrect credentials.";
            }
            header("Location: ./login.php");
            exit();
        }

        //close statement
        $stmt->close();
    } else {
        //otherwise fail and show error for prepared statement
        die("Prepare failed: " . $conn2->error);
    }
}

// Close database connection at the end of the script
mysqli_close($conn2);
?>
