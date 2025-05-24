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

</form>
<br>
<br>
</form>
<!--includes nav!-->
<?php include 'footer.inc'; ?>
</body>
</html>