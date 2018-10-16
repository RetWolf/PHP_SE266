<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>View Actors</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';

    $db = getDatabase();
    $stmt = $db -> prepare('SELECT * FROM actors');
    $results = array();

    if ($stmt -> execute() && $stmt -> rowCount() > 0) {
      $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Lab 2 - Actors</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_actors.php">Add an Actor</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="view_actors.php">View Actors</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID #</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Date of Birth</th>
          <th scope="col">Height</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $result): ?>
          <tr>
            <th scope="row"><?php echo $result['id']; ?></td>
            <td><?php echo $result['firstname']; ?></td>
            <td><?php echo $result['lastname']; ?></td>
            <td><?php echo $result['dob']; ?></td>
            <td><?php echo $result['height']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>