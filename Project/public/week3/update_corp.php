<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update a Corp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';
    include '../utils/isPostRequest.php';

    $db = getDatabase();
    $message = '';

    if(isPostRequest()) {
      session_start();
      $id = $_SESSION['id'];
      $corp = filter_input(INPUT_POST, 'corp');
      $owner = filter_input(INPUT_POST, 'owner');
      $email = filter_input(INPUT_POST, 'email');
      $zip = filter_input(INPUT_POST, 'zip');
      $phone = filter_input(INPUT_POST, 'phone');

      $stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zip, owner = :owner, phone = :phone WHERE id = :id");

      $binds = array(
        ':id' => $id,
        ':corp' => $corp,
        ':email' => $email,
        ':zip' => $zip,
        ':owner' => $owner,
        ':phone' => $phone,
      );

      $message = 'Update failed';
      if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
          $message = 'Update Complete';
      }
    } else {
      session_start();
      $stmt = $db -> prepare('SELECT * FROM corps WHERE id = :id');

      $id = filter_input(INPUT_GET, 'id');
      $_SESSION['id'] = $id;

      $binds = array(
        ":id" => $id,
      );

      $result = array();
      if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        header('Location: index.php');
        die('ID not found');
      }
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

  <div class="container col-md-6">
    <form method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="corp">Corporation Name</label>
          <input type="text" class="form-control" id="corp" placeholder="Acme Corp" name="corp" value="<?php echo isset($result['corp']) ? $result['corp'] : $corp; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="owner">Owner Name</label>
          <input type="text" class="form-control" id="owner" placeholder="Jane Doe" name="owner" value="<?php echo isset($result['owner']) ? $result['owner'] : $owner; ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-8">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" placeholder="jane@acmecorp.com" name="email" value="<?php echo isset($result['email']) ? $result['email'] : $email; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="zip">Zip Code</label>
          <input type="text" class="form-control" id="zip" placeholder="01234" name="zip" value="<?php echo isset($result['zipcode']) ? $result['zipcode'] : $zip; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" class="form-control" id="phone" placeholder="123-456-7890" name="phone" value="<?php echo isset($result['phone']) ? $result['phone'] : $phone; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Submit Changes</button>
      <a href="delete_corp.php?id=<?php echo isset($result['id']) ? $result['id'] : $id; ?>" class="btn btn-danger" role="button">Delete Corp</a>
      <a href="./" class="btn btn-secondary" role="button">Go Back</a>
    </form>
    <br>
    <h3><?php echo $message; ?></h3>
</body>
</html>