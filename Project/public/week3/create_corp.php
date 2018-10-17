<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create a Corp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';
    include '../utils/isPostRequest.php';

    $results = '';

    if(isPostRequest()) {
      $db = getDatabase();

      $stmt = $db -> prepare("INSERT INTO corps SET corp = :corp, email = :email, zipcode = :zip, owner = :owner, phone = :phone, incorp_dt = NOW()");

      $corp = filter_input(INPUT_POST, 'corp');
      $email = filter_input(INPUT_POST, 'email');
      $zip = filter_input(INPUT_POST, 'zip');
      $owner = filter_input(INPUT_POST, 'owner');
      $phone = filter_input(INPUT_POST, 'phone');

      $binds = array(
        ':corp' => $corp,
        ':email' => $email,
        ':zip' => $zip,
        ':owner' => $owner,
        ':phone' => $phone,
      );

      if ($stmt -> execute($binds) && $stmt -> rowCount() > 0) {
        $results = 'Corporation Created!';
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
        <li class="nav-item active">
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
          <input type="text" class="form-control" id="corp" placeholder="Acme Corp" name="corp" value="">
        </div>
        <div class="form-group col-md-6">
          <label for="owner">Owner Name</label>
          <input type="text" class="form-control" id="owner" placeholder="Jane Doe" name="owner" value="">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-8">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" placeholder="jane@acmecorp.com" name="email" value="">
        </div>
        <div class="form-group col-md-4">
          <label for="zip">Zip Code</label>
          <input type="text" class="form-control" id="zip" placeholder="01234" name="zip" value="">
        </div>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" class="form-control" id="phone" placeholder="123-456-7890" name="phone" value="">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <h3><?php echo $results; ?></h3>
  </div>
</body>
</html>