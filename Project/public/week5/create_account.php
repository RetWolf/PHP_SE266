<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Lab 5 - Schools</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Lab 5 - Schools</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="create_account.php">Create Account</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
    include '../utils/isPostRequest.php';
    include '../utils/formValidation.php';
    
    $feedback = "";
    $usernameError = false;
    $passwordError = false;
    
    if(isPostRequest()) {
      $password = filter_input(INPUT_POST, 'userpassword');
      $passwordcheck = filter_input(INPUT_POST, 'userpasswordcheck');
      if(checkPasswordBool($password, $passwordcheck)) {
        include '../utils/dbConnect.php';
        $passwordError = false;
        $username = filter_input(INPUT_POST, 'username');
        if(checkUsernameBool($username)) {
          include '../utils/dbUsers.php';
          $usernameError = false;
          $result = createUser($username, $password);
          $feedback = $result;
          if($result = "User Successfully Created!") {
            session_start();
            $_SESSION['authed'] = true;
            header("Location: ./authed/upload.php");
          }
        } else {
          $usernameError = true;
          $feedback = "A user already exist with that name.";
        }
      } else {
        $passwordError = true;
        $feedback = "Please fix passwords. Min length of 6 characters and passwords must match.";
      }
    }
  ?>
  <div class="container col-md-6 mt-4">
    <form method="post">
      <div class="form-group col-md-8 m-auto">
        <label for="username">Username</label>
        <input type="text" class="form-control <?php echo $usernameError ? 'is-invalid' : ''; ?>" id="username" name="username" required>
      </div>
      <div class="form-group col-md-8 m-auto">
        <label class="mt-3" for="userpassword">Password</label>
        <input type="password" class="form-control <?php echo $passwordError ? 'is-invalid' : ''; ?>" id="userpassword" name="userpassword" placeholder="At least 6 characters" required>
      </div>
      <div class="form-group col-md-8 m-auto">
        <label class="mt-3" for="userpasswordcheck">Re-Enter Password</label>
        <input type="password" class="form-control <?php echo $passwordError ? 'is-invalid' : ''; ?>" id="userpasswordcheck" name="userpasswordcheck" required>
      </div>
      <div class="form-group col-md-8 m-auto">
        <button class="btn btn-primary mt-3" type="submit">Create Account</button>
      </div>
    </form>
    <div class="col-md-8 m-auto"><?php echo $feedback ?></div>
  </div>
</body>
</html>