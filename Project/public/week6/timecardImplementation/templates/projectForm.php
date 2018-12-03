<?php 
  session_start();
  if(isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
    $details = $_SESSION["details"];
  } else {
    $name = "";
    $details = "";
  }
?>
<div class="container col-md-8">
  <form method="post" class="mt-3">
    <div class="form-group">
      <label for="projectName">Project Name</label>
      <input type="text" class="form-control" id="projectName" name="projectName" placeholder="SE Capstone Project" autofocus value="<?php echo $name; ?>">
    </div>
    <div class="form-group">
      <label for="projectDetails">Project Details</label>
      <textarea class="form-control" id="projectDetails" name="projectDetails" rows="4" placeholder="This is a test project."><?php echo $details; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <p><?php echo $results; ?></p>
</div>