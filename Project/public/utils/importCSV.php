<?php 
  function importCSV($filename, $table) {
    $db = getDatabase();

    $sql = "LOAD DATA LOCAL INFILE $filename INTO TABLE $table FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' IGNORE 1 LINES ('name', 'city', 'state_abbr');";
    $stmt = $db->prepare($sql);

    var_dump($sql);
    var_dump($stmt);
    $results = "Error Importing CSV to Database";
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      $results = "CSV Successfully Imported";
    }
    return $results;
  }

  // Actually working implementation - took 172 seconds.
  /* function importCSV($file, $table) {
    $successfulInserts = 0;
    $failedInserts = 0;
    while(!feof($file)) {
      $school = fgetcsv($file);

      if($school[0] !== "INSTNM") {
        $db = getDatabase();
        $sql = "INSERT INTO $table (name, city, state_abbr) VALUES (:name, :city, :state_abbr);";
        $stmt = $db->prepare($sql);
  
        $binds = array(
          ":name" => $school[0],
          ":city" => $school[1],
          ":state_abbr" => $school[2],
        );
  
        $failResults = "$failedInserts Rows Inserted into Database Unsuccessfully";
        $failedInserts++;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
          $successfulInserts++;
          $failedInserts--;
          $successResults = "$successfulInserts Rows Inserted into Database Successfully.";
        }
      }
    }
    return $failResults."<br/>".$successResults;
  } */

?>