<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>View all Corps</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';

    $db = getDatabase();
    $stmt = $db -> prepare('SELECT * FROM corps');
    $results = array();

    if ($stmt -> execute() && $stmt -> rowCount() > 0) {
      $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Lab 3 - Corps</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">View All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_corp.php">Create New Corp</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Corporation Name</th>
          <th scope="col">Actions</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $result): ?>
          <tr>
            <td><?php echo $result['corp']; ?></td>
            <td><a href="read_corp.php?id=<?php echo $result['id']; ?>" class="btn btn-primary" role="button">Read</a></td>
            <td><a href="update_corp.php?id=<?php echo $result['id']; ?>" class="btn btn-secondary" role="button">Update</a></td>
            <td><a href="delete_corp.php?id=<?php echo $result['id']; ?>" class="btn btn-danger" role="button">Delete</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>