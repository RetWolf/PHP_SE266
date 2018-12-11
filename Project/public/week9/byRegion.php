<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Final Exam - By Region</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
</head>
<body>
  <?php include '../utils/dbConnect.php'; ?>
  <?php include '../utils/countryFunctions.php'; ?>
  <?php $results = populationByRegion(); ?>
  <?php include './components/header.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <?php include './components/table.php'; ?>
      </div>
      <div class="col-md-7 mt-5">
        <?php include './components/chart.php'; ?>
      </div>
    </div>
  </div>
  <?php include './components/footer.php'; ?>
</body>
</html>