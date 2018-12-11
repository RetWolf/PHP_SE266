<?php 
  include '../utils/dbConnect.php';
  include '../utils/countryFunctions.php';
  include '../utils/isPostRequest.php';

  // Get country ID from GET object
  $countryID = filter_input(INPUT_GET, 'id');
  $results = "";
  if(isPostRequest()) {
    // Get variables from POST object
    $countryPopulation = filter_input(INPUT_POST, 'countryPopulation');
    $countrySize = filter_input(INPUT_POST, 'countrySize');
    // Update country details
    $results = updateCountryDetails($countryID, $countryPopulation, $countrySize);
  }
  // Get country data using provided ID
  $countryData = getCountryDetails($countryID);
?>

<div class="container">
  <h2>Update Country Details</h2>
  <form method="post">
    <div class="form-group">
      <label for="countryName">Country Name</label>
      <input type="text" class="form-control" id="countryName" value="<?php echo $countryData[0]['CountryName']; ?>" disabled>
    </div>
    <div class="form-group">
      <label for="countryRegion">Region</label>
      <input type="text" class="form-control" id="countryRegion" value="<?php echo $countryData[0]['CountryRegion']; ?>" disabled>
    </div>
    <div class="form-group">
      <label for="countryPopulation">Population (in thousands)</label>
      <input type="text" class="form-control" id="countryPopulation" value="<?php echo $countryData[0]['CountryPopulation']; ?>" name="countryPopulation">
    </div>
    <div class="form-group">
      <label for="countrySize">Size (in square miles)</label>
      <input type="text" class="form-control" id="countrySize" value="<?php echo $countryData[0]['CountrySize']; ?>" name="countrySize">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
  <p><?php echo $results; ?></p>
</div>