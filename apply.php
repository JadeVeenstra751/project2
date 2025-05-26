 <?php include 'header.inc';

 ?>
    <meta name="author" content="Will Stevens">
    <title>Job Application Page</title>
</head>
<body class="page">
     <!--Creates menu that is used to go from page to page within project-->
	<?php include 'nav.inc';?>
     <!--inputs company logo at the top of the page, resizing it to 50px-->
    <aside>
      <img src="images/leafbytetechlogo.png" class="logo" alt="CompanyLogo" width="200">  
    </aside>
    <!--Acts as title of page-->
    <h1 class="title">Jop Application Page</h1>
    <fieldset class="AsideNote">
        <!--Brief rule set of how the form will have to be submitted-->
        <p class="note"><strong><em>Please Note:</em></strong> All fields are required to validate your application. 
            If they are not filled in, or filled in incorrectly, you won't be able to submit. 
            If you are unable to answer you can use N/A. </p> 
    </fieldset>
    <!--Creation of form-->
     <form method="post" action="process_eoi.php">
        <!--Adds a fieldset that has a drop down list, containing job reference numbers. 
        Uses "please select" as a placeholder-->
        <fieldset>
            <legend><strong>Job Reference Number</strong></legend>
            <select name="jobnum" id="job_num" required="required" class="job_num">
                <option disabled selected value>Please Select</option>
                <option value="SF71T">SF71T- Software Developer</option>
                <option value="AI02M">AI02M - AI/ML Engineer</option>
            </select>
        </fieldset>
        <!--Creates a fieldset for name and date of birth-->
        <fieldset>
            <legend><strong>Name and Birth</strong></legend>
            <!--Adds two text areas that makes sure only letters can be inputted for name-->
            <p>
                <label for = "GivenName">Given Name</label>
                <input type="text" name="name" id="GivenName" pattern="[A-Za-z]{1,20}" placeholder="e.g John" title="Can only be letter A through Z, can't be more than 20 characters" size="20" required>
            </p>
            <p>
                <label for = "family"> Family Name</label>
                <input type="text" id="family" name="family" pattern="[A-Za-z]{1,20}" placeholder="e.g Smith" title="Can only be letter A through Z, can't be more than 20 characters" maxlength="20" size="20" required> 
            </p>
             <!--Adds a date selector that is used to input date of birth-->
            <p>
                <label for = "DOB">Date of Birth</label>
                <input type="date" name="DOB" id="DOB" size="10" required>
            </p>
            <!--Adds a radio button set for Gender. Can only select one option-->
            <p>
                <label for="Male">Male</label>
                <input type="radio" name="Gender" id="Male" value="Male" required>
                <label for="Female">Female</label>
                <input type="radio" name="Gender" value="Female" id="Female" required>
                <label for="Non-Binary">Non-Binary</label>
                <input type="radio" name="Gender" id="Non-Binary" value="Non-Binary" required>
                <label for="PreferNotToSay">Prefer not to say</label>
                <input type="radio" name="Gender" id="PreferNotToSay" value="PreferNotToSay" required>
            </p>
        </fieldset>
        <!--Makes a fieldset for Residential Address-->
        <fieldset>
            <legend><strong>Residential Address</strong></legend>
            <!--Adds a textarea for street address-->
            <p>
                <label for="StreetAddress">Street Address</label>
                <input type="text" size="20" name="street_address" id="StreetAddress" placeholder="e.g 123 Fake St" maxlength="40" required>
            </p>
            <!--Makes a textarea for suburb/town-->
            <p>
                <label for="suburb">Suburb/Town</label>
                <input type="text" size="15" id="suburb" name="suburb" placeholder="e.g Hawthorne" pattern="[A-Za-z]{1,40}" title="Can only be letter A through Z, can't be more than 40 characters" maxlength="40" required>
            </p>
            <!--creates a dropdown list for State, using please select as a placeholder-->
            <p>
                <label for="state">State</label>
                <select name="state" id="state" required>
                    <option disabled selected value>Please Select</option>
                    <option value="Vic">VIC</option>
                    <option value="Nsw">NSW</option>
                    <option value="Qld">QLD</option>
                    <option value="Nt">NT</option>
                    <option value="Wa">WA</option>
                    <option value="Sa">SA</option>
                    <option value="Tas">TAS</option>
                    <option value="Act">ACT</option>
                </select>
            </p>
            <!--Creates a text area for postcode, checking that it only uses numbers and is 4 digits long-->
            <p>
                <label for="post">Postcode</label>
                <input type="number" size="5"  id="post"  name="postcode" maxlength="4"  min="2000" max="2999"  step="1"  placeholder="e.g. 2100" title="Please enter a 4-digit postcode between 2000 and 2999."  pattern="[0-9]{4}" required>
            </p>
        </fieldset>
        <!--Creates a fieldset that obtains contact information (Email and Phone)-->
        <fieldset>
            <legend><strong>Contact Information</strong></legend>
            <!--Makes a text area for address that automatically validates and checks it only uses letters-->
            <p>
                <label for="email">Email Address</label>
                <input type="email" name="email" size="35" title="Has to be in the valid email form i.e john.doe@gmail.com" id="email" required>
            </p>
            <!--Makes a textarea for phone number that checks that it only uses numbers, and is in between 8 and 12 digits.-->
            <p>
                <label for="Phone">Phone Number</label>
                <input type="text" size="15" id="Phone" name="phone" pattern="[0-9]{8,12}" title="Can only be numbers 0 through 9, minimum of 8 characters, maximum of 12" required>
            </p>
        </fieldset>
        <!--Creates a fieldset that obtains personal skills relevant to Job-->
        <fieldset>
            <legend><strong>Personal Skills relevant to Job</strong></legend>
            <!--Makes a series of checkbox inputs, where html is checked already-->
            <p>
            <label for="html">HTML</label> 
                <input type="checkbox" id="html" name="skills[]" value="html" checked="checked">
              <label for="CSS">CSS</label>
                <input type="checkbox" id="CSS" name="skills[]" value="CSS">
            <label for="JavaScript">JavaScript</label>
                <input type="checkbox" id="JavaScript" name="skills[]" value="JavaScript">
            <label for = "PHP">PHP</label>
                <input type="checkbox" id="PHP" name="skills[]" value="PHP">
            <label for = "MySQL">MySQL</label>
                <input type="checkbox" id="MySQL" name="skills[]" value="MySQL">
            <label for = "Other">Other</label>
                <input type="checkbox" id="Other" name="skills[]" value="Other">
            <label for="N/A">Not a lot of coding experience</label>
                <input type="checkbox" id="N/A" name="skills[]" value="N/A">
            </p>
            <!--Makes a textarea where user can type out other skills relevant to job-->
            <p>
                <label for="OtherSkills">Other Skills</label>
            </p>
            <p>
                <textarea id="OtherSkills" name="OtherSkills" rows="5" cols="40" placeholder="Please enter any other relevant skills here."></textarea>
            </p>
        </fieldset>
        <!--Creates submit and reset buttons, submitting will print out inputted info, reset will reset-->
        <p>
          <input class="submission" type= "submit" value="Apply">
          <input class="submission" type= "reset" value="Reset Form"> 
        </p>
     </form>
     <!--Breaklines to counteract footer-->
     <br>
     <br>
     <br>
     <!--Creats a footer at the bottom of the page that includes a link to our Jira project, and a fake copy right watermark-->
     <footer class="footer">
    <?php include 'footer.inc';?>
</body>
</html>