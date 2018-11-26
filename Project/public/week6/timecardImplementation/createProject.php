<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Timecard Prototype</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Timecard Prototype</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container col-md-8">
    <form class="mt-3">
      <div class="form-group">
        <label for="projectName">Project Name</label>
        <input type="text" class="form-control" id="projectName" placeholder="SE Capstone Project">
      </div>
      <div class="form-group">
        <label for="projectDetails">Project Details</label>
        <textarea class="form-control" id="projectDetails" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>

</html> 