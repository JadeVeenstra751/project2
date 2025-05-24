<!--by jade veenstra!-->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
<!-- includes nav.inc -->
<?php include 'nav.inc'; ?>
<body>
<h1>EOI Management</h1>
<form method="post">
    <h3>List All EOIs</h3><br>
    <input type="submit" name="list_all" value="List All EOIs"><br><br>

    <h3>List EOIs by Job Reference Number</h3>
    <input type="text" name="job_ref_list" placeholder="Job Reference Number">
    <input type="submit" name="list_by_job" value="List EOIs"><br><br>

    <h3>List EOIs by Applicant Name</h3>
    <hr class="indexdivider5">
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <input type="submit" name="list_by_applicant" value="List EOIs"><br><br>

    <h3>Delete EOIs by Job Reference Number</h3>
    <input type="text" name="job_ref_delete" placeholder="Job Reference Number">
    <input type="submit" name="delete_by_job" value="Delete EOIs"><br><br>

    <h3>Change EOI Status</h3>
    <input type="text" name="eoi_id" placeholder="EOI ID">
    <input type="text" name="new_status" placeholder="New Status">
    <input type="submit" name="update_status" value="Update Status"><br><br>
<br>
</form>
<!--includes nav!-->
<?php include 'footer.inc'; ?>
</body>
</html>