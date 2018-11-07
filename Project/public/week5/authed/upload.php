<?php session_start(); ?>
<?php if(isset($_SESSION['authed']) && $_SESSION['authed']) { ?>
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
    <span class="navbar-brand mb-0 h1">Lab 5 - Schools [ <?php echo $_SESSION['user']; ?> ]</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="./upload.php">Upload</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./search.php">Search</a>
        </li>
      </ul>
      <a class="btn btn-primary ml-auto mr-3" name="logout" href="./logout.php">Logout</a>
    </div>
  </nav>
  <?php 
    include '../../utils/isPostRequest.php';
    include '../../utils/dbConnect.php';
    include '../../utils/importCSV.php';

    if(isPostRequest()) {
      if(isset($_FILES['fileup'])) {
        $tmp_name = $_FILES['fileup']['tmp_name'];
        $path = getcwd().DIRECTORY_SEPARATOR.'uploads';
        $new_name = $path.DIRECTORY_SEPARATOR.$_FILES['fileup']['name'];

        move_uploaded_file($tmp_name, $new_name);

        $file = fopen("./uploads/schools.csv", "rb");
        $table = "schools";
        $startTime = microtime(true);
        $result = importCSV($"./uploads/school.csv", $table);
        echo "Elapsed time is: ".(microtime(true) - $startTime)." seconds.<br/>";
        echo $result;
      }
    }
  ?>
  <div class="container col-md-9 mt-5">
    <div class="jumbotron">
      <h1 class="display-4">CSV Uploader</h1>
      <p class="lead">Please upload your CSV through this form. To search through the database, visit the search page.</p>
      <hr class="my-4">
      <form enctype="multipart/form-data" method="post">
        <input type="file" name="fileup">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>
<?php } else { header("Location: ../login.php"); }  ?>