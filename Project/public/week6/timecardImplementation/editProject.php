<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Timecard Prototype</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Timecard Prototype</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php 
    include '../../utils/dbConnect.php';
    include '../../utils/isPostRequest.php';
    include '../../utils/timecardFunctions.php';

    $results = "";
    if(isPostRequest()) {
      session_start();
      $id = $_SESSION["id"];
      $name = filter_input(INPUT_POST, "projectName");
      $details = filter_input(INPUT_POST, "projectDetails");
      $results = editProject($id, $name, $details);
      session_destroy();
      header("Location: ./index.php");
    } else {
      session_start();
      $id = filter_input(INPUT_GET, "id");
      $project = getOneProject($id);
      $_SESSION["id"] = $project[0]["id"];
      $_SESSION["name"] = $project[0]["name"];
      $_SESSION["details"] = $project[0]["details"]; 
      session_write_close();
    }

    include './templates/projectForm.php';
  ?>
</body>

</html>