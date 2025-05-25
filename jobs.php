<?php
include 'header.inc';
include 'settings.php';
?>
    <meta name="author" content="Muhammad Taki">
    <title>Job description</title>
</head>
<body class="page" id="test_jobs">
    <!--Applied <nav> to create a navigation section for site links-->
    <?php include 'nav.inc';?>
    <!--Applied <img> to display the company logo-->
    <img id="logo_jobs" src="images/leafbytetechlogo.png" alt="CompanyLogo"> 
    <h1 id="h1_jobs">Jobs at Leaf Byte Tech</h1>

    <aside id="aside_jobs">
        <h3>Benefits of working at </h3>
        <ul>
            <!--Use of GenAI (Gemini), prompt: Write me multiple benefits working at my madeup company, make it up-->
            <li><b>Flexible Work Hours</b> – We believe in results, not rigid schedules.</li>
            <li><b>Remote & Hybrid Options</b> – Work from anywhere</li>
            <li><b>Learning & Development</b> – Access to online courses, and certifications</li>
            <li><b>Tech Perks</b> – Get high tech laptop and access to paid softwares fore free </li>
        </ul>
    </aside>

    <?php
    // Establish database connection
    $conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

    // Check connection
    if (!$conn2) {
        die("Connection failed: " . mysqli_connect_error()); // Stop on connection error
    }

    // SQL query to fetch all jobs
    $sql = "SELECT * FROM jobs";
    $result = mysqli_query($conn2, $sql);

    // Loop through each job record and display it
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<section>";
        echo "<fieldset>";
         // Display the job 'name' (title) within a <legend> and <h2> tag
        echo "<legend class='h1_jobs'><h2>" . ($row['name']) . "</h2></legend>";
        // Display the job 'reference' number
        echo "<p><b>Reference Number:</b> " . ($row['reference']) . "</p>";
        echo "<p><b>Description:</b></p>";
        // Add a heading for the job description
        echo "<p>" . ($row['description']) . "</p>";
        echo "<p><b>Responsibilities of this position include:</b></p>";
        echo "<ol>";
        // Split the responsibilities string by semicolon and display as list items
        //Use of GenAI (Gemnini): prompt: I want to retrive text from db to ordered list, explain in steps 
        $responsibilities = explode(';', $row['skills_responsibilities']); //explode, seperates string to array
        // Loop through each individual skill/responsibility in the newly created array
        foreach ($responsibilities as $skill) {
            // Remove any leading or trailing whitespace from the skill
             $skill = trim($skill);
            // Check if the skill is not empty after trimming
            if ($skill != "") {
                echo "<li>$skill</li>";
            }
        }
        echo "</ol>";
        echo "<p><b>Salary Range:</b> " . ($row['salary']) . "</p>";
        echo "</fieldset>";
        echo "</section>";
        echo "<br>";
    }

    // close connection
    mysqli_close($conn2);
    ?>

    <?php include 'footer.inc';?>
</body>
</html>