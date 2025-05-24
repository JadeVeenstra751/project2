<!--by jade veenstra!-->
<?php include 'header.inc'; ?>
<meta name="author" content="Jade Veenstra">
<title>LeafByte Tech Manage EOIs</title>
<!-- includes nav.inc -->
<?php include 'nav.inc'; ?>
<body>
<h1>EOI Management</h1>
<form method="post">

  <fieldset>
    <legend>List All EOIs</legend>
    <input type="submit" name="list_all" value="List All EOIs"><br><br>
  </fieldset>

  <fieldset>
    <legend>List EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_list" placeholder="Job Reference Number">
    <input type="submit" name="list_by_job" value="List EOIs"><br><br>
  </fieldset>

  <fieldset>
    <legend>List EOIs by Applicant Name</legend>
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <input type="submit" name="list_by_applicant" value="List EOIs"><br><br>
  </fieldset>

  <fieldset>
    <legend>Delete EOIs by Job Reference Number</legend>
    <input type="text" name="job_ref_delete" placeholder="Job Reference Number">
    <input type="submit" name="delete_by_job" value="Delete EOIs"><br><br>
  </fieldset>

  <fieldset>
    <legend>Change EOI Status</legend>
    <input type="text" name="eoi_id" placeholder="EOI ID">
    <input type="text" name="new_status" placeholder="New Status">
    <input type="submit" name="update_status" value="Update Status"><br><br>
  </fieldset>

</form>
<br>
</form>
<!--includes nav!-->
<?php include 'footer.inc'; ?>
</body>
</html>