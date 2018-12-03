<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Timecard Implementation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Timecard Implementation</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="./createProject.php" class="btn btn-primary">Create a Project</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php 
    include '../../utils/dbConnect.php';
    include '../../utils/timecardFunctions.php';

    $projects = getAllProjects();
  ?>
  <div class="container col-md-8">
    <?php foreach($projects as $project): ?>
      <div class="card text-center my-3">
        <div class="card-body">
          <h5 class="card-title"><?php echo $project["name"]; ?></h5>
          <p class="card-text"><?php echo $project["details"]; ?></p>
          <?php if(isset($_SESSION["clocked_id"]) && $project["id"] == $_SESSION["clocked_id"]): ?>
            <a href="timecard.php?id=<?php echo $project["id"]; ?>&clocked_in=<?php echo $project["clocked_in"]; ?>" class="btn btn-primary"><?php echo $project["clocked_in"] ? "Clock Out" : "Clock In" ?></a>
          <?php elseif(isset($_SESSION["clocked_id"]) && $project["id"] != $_SESSION["clocked_id"]): ?>
            <a href="#" class="btn btn-primary">Disabled</a>
          <?php else: ?>
            <a href="timecard.php?id=<?php echo $project["id"]; ?>&clocked_in=<?php echo $project["clocked_in"]; ?>" class="btn btn-primary"><?php echo $project["clocked_in"] ? "Clock Out" : "Clock In" ?></a>
          <?php endif; ?>
          <a href="editProject.php?id=<?php echo $project["id"]; ?>" class="btn btn-secondary px-4">Edit</a>
          <a href="deleteProject.php?id=<?php echo $project["id"]; ?>" class="btn btn-danger px-3">Delete</a>
        </div>
        <div class="card-footer text-muted">
          <?php echo $project["time_worked"]; ?> Minutes Worked
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>