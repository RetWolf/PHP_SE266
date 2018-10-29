<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Week 4 - Searching & Sorting</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php 
    include '../utils/dbConnect.php';
    include '../utils/dbData.php';
    include '../utils/isSelected.php';

    $columns = getAllColumns();
    $columnsInfo = [
      'ID',
      'Corporation Name',
      'Incorporation Date',
      'Email',
      'Zip Code',
      'Owner',
      'Phone',
    ];

    $action = filter_input(INPUT_GET, 'action');
    $table = 'corps';
    if($action === 'search') {
      $column = filter_input(INPUT_GET, 'searchby');
      $searchValue = filter_input(INPUT_GET, 'searchValue');
      $results = searchData($table, $column, $searchValue);

    } else if ($action === 'sort') {
      $column = filter_input(INPUT_GET, 'sortby');
      $order = filter_input(INPUT_GET, 'order');
      $results = sortData($table, $column, $order);
    } else {
      $results = getAllData($table);
    }
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Lab 4 - Searching & Sorting</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php 
    include 'searching_form.php';
    include 'sorting_form.php';
  ?>
  <div class="container col-md-10 mt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Corp ID #</th>
          <th scope="col">Corp Name</th>
          <th scope="col">Incorp Date</th>
          <th scope="col">Email</th>
          <th scope="col">Zip Code</th>
          <th scope="col">Owner</th>
          <th scope="col">Phone</th>
        </tr>
      </thead>
      <h2><?php echo sizeof($results) === 0 ? "No Results Found" : sizeof($results) . " Results Found" ?></h2>
      <tbody>
        <?php foreach ($results as $result): ?>
          <tr>
            <td><?php echo $result['id']; ?></td>
            <td><?php echo $result['corp']; ?></td>
            <td><?php echo date_format(date_create($result['incorp_dt']), 'm/d/o'); ?></td>
            <td><?php echo $result['email']; ?></td>
            <td><?php echo $result['zipcode']; ?></td>
            <td><?php echo $result['owner']; ?></td>
            <td><?php echo $result['phone']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>