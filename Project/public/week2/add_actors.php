<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add an Actor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';
    include '../utils/isPostRequest.php';

    $results = '';

    if(isPostRequest()) {
      $db = getDatabase();

      $stmt = $db -> prepare("INSERT INTO actors SET firstname = :fname, lastname = :lname, dob = :dob, height = :height");

      $fname = filter_input(INPUT_POST, 'fname');
      $lname = filter_input(INPUT_POST, 'lname');
      $dob = filter_input(INPUT_POST, 'dob');
      $height = filter_input(INPUT_POST, 'height');

      $binds = array(
        ':fname' => $fname,
        ':lname' => $lname,
        ':dob' => $dob,
        ':height' => $height,
      );

      if ($stmt -> execute($binds) && $stmt -> rowCount() > 0) {
        $results = 'Actor Added!';
      }
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
        <li class="nav-item active">
          <a class="nav-link" href="add_actors.php">Add an Actor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_actors.php">View Actors</a>
        </li>
      </ul>
    </div>
  </nav>


  <div class="container col-md-6">
    <h3><?php echo $results; ?></h3>
    <form method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="fname">First Name</label>
          <input type="text" class="form-control" id="fname" placeholder="John" name="fname" value="">
        </div>
        <div class="form-group col-md-6">
          <label for="lname">Last Name</label>
          <input type="text" class="form-control" id="lname" placeholder="Doe" name="lname" value="">
        </div>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="text" class="form-control" id="dob" placeholder="5/15/1995" name="dob" value="">
      </div>
      <div class="form-group">
        <label for="height">Height</label>
        <input type="text" class="form-control" id="height" placeholder="5'11" name="height" value="">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>