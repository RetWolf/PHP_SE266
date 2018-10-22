<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Delete Corp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';

    $db = getDatabase();
    $stmt = $db -> prepare('DELETE FROM corps WHERE id = :id');

    $id = filter_input(INPUT_GET, 'id');

    $binds = array(
      ":id" => $id,
    );

    $isDeleted = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $isDeleted = true;
    }
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Lab 3 - Corps</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">View All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_corp.php">Create New Corp</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container col-md-8 text-center">
    <h1>Record <?php echo $id ?> <?php if (!$isDeleted): ?>Not<?php endif; ?> Deleted</h1>
    <a href="./" class="btn btn-primary" role="button">View All</a>
  </div>
</body>
</html>