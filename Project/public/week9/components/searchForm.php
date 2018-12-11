<?php 
  include '../utils/dbConnect.php';
  include '../utils/countryFunctions.php';
  include '../utils/isPostRequest.php';

  session_start();
  if(isPostRequest()) {
    // Get variables from post object
    $countryName = filter_input(INPUT_POST, 'countryName');
    $countryRegion = filter_input(INPUT_POST, 'countryRegion');
    // Store them in session
    $_SESSION["CountryName"] = $countryName;
    $_SESSION["SelectedRegion"] = $countryRegion;
    // Perform our search
    $results = searchCountryData($countryName, $countryRegion);
    // Close the session
    session_write_close();
  }
  // Get regions to populate our select
  $regions = getAllRegions();
?>

<div class="container">
  <h2>Search Countries</h2>
  <form method="post">
    <div class="form-group">
      <label for="countryName">Country Name</label>
      <input type="text" class="form-control" id="countryName" name="countryName" value="<?php echo isset($_SESSION["CountryName"]) ? $_SESSION["CountryName"] : ""; ?>">
    </div>
    <div class="form-group">
      <label for="countryRegion">Region</label>
      <select id="countryRegion" class="form-control" name="countryRegion">
        <option selected></option>
        <!-- Loop through our regions creating select options -->
        <?php foreach($regions as $region): ?>
          <option <?php echo isset($_SESSION["SelectedRegion"]) && $_SESSION["SelectedRegion"] === $region["CountryRegion"] ? "selected" : ""; ?>><?php echo $region["CountryRegion"]; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
</div>