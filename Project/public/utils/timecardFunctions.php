<?php 
  function getAllProjects() {
    // Connect to DB
      $db = getDatabase();
    // Prepare Select Statement
      $sql = "SELECT * FROM projects";
      $stmt = $db->prepare($sql);
    // Execute DB call and return result
      $results = array();
      if($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      return $results;
   }

   function getOneProject($id) {
     // Connect to DB
     $db = getDatabase();
     // Prepare select statement
     $sql = "SELECT * FROM projects WHERE id = :id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":id" => $id,
     );
     // Execute DB call and return result
     $results = array();
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     return $results;
   }

   function createProject($name, $details) {
     # Connect to DB
     $db = getDatabase();
     // Prepare insert statement
     $sql = "INSERT INTO projects (name, details) VALUES (:name, :details);";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":name" => $name,
       ":details" => $details
     );
     // Execute DB call with binds and return result
     $results = "Failed to create new project.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully created new project.";
     }
     return $results;
   }

   function editProject($id, $name, $details) {
     // Connect to DB
     $db = getDatabase();
     // Prepare update statement
     $sql = "UPDATE projects SET name = :name, details = :details WHERE id = :id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":name" => $name,
       ":details" => $details,
       ":id" => $id,
     );
     // Execute DB call with binds and return result
     $results = "Failed to update project.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully updated project.";
     }
     return $results;
   } 

   function deleteProject($id) {
     // Connect to DB
     $db = getDatabase();
     // Prepare delete statement
     $sql = "DELETE FROM projects WHERE id = :id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":id" => $id,
     );
     // Execute DB call with binds and return result
     $results = "Failed to delete project.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully created new project.";
     }
     return $results;
   }

   function clockProjectIn($id) {
     // Connect to DB
     $db = getDatabase();
     // Prepare update statement
     $sql = "UPDATE projects SET clocked_in = 1 WHERE id = :id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":id" => $id,
     );
     // Execute DB call with binds and return result
     $results = "Failed to clock project in.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully clocked project in.";
     }
     return $results;
   }

   function clockProjectOut($id) {
     // Connect to DB
     $db = getDatabase();
     // Prepare update statement
     $sql = "UPDATE projects SET clocked_in = 0 WHERE id = :id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":id" => $id,
     );
     // Execute DB call with binds and return result
     $results = "Failed to clock project out.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully clocked project in.";
     }
     return $results;
   }

   function createTimecard($id) {
     // Connect to DB
     $db = getDatabase();
     // Prepare insert statement
     $sql = "INSERT INTO timecards (project_id, checked_in) VALUES (:id, now())";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":id" => $id,
     );
     $results = "Failed to create timecard.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully created timecard.";
     }
     return $results;
   }

   function getOpenTimecard() {
     // Connect to DB
     $db = getDatabase();
     // Prepare select statement
     $sql = "SELECT * FROM timecards WHERE checked_out IS NULL";
     $stmt = $db->prepare($sql);
     $results = array();
     if($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     return $results[0];
   }

   function closeTimecard($id, $startTime) {
     // Connect to DB
     $db = getDatabase();
     // Prepare update statement
     $sql = "UPDATE timecards SET checked_out = now(), time_worked = :timeWorked WHERE timecard_id = :id";
     $stmt = $db->prepare($sql);
     // Calculate time worked
     $timezone = new DateTimeZone("America/New_York");
     $startTime = new DateTime($startTime, $timezone);
     $endTime = new DateTime("now", $timezone);
     $timeWorked = date_diff($startTime, $endTime);
     $minutes = $timeWorked->days * 24 * 60;
     $minutes += $timeWorked->h * 60;
     $minutes += $timeWorked->i;
     // Setup binds array
     $binds = array(
       ":timeWorked" => $minutes,
       ":id" => $id,
     );
     // Execute DB call and return results
     $results = "Failed to check out timecard.";
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $results = "Successfully checked out timecard.";
     }

     return $results;
   }

   function setProjectTimeWorked($projectid) {
     // Connect to DB
     $db = getDatabase();
     // Prepare select to retrieve all timecards with the provided project id
     $sql = "SELECT * FROM timecards WHERE project_id = :project_id";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":project_id" => $projectid,
     );
     // Execute DB call and get timecards array
     $timecards = array();
     if($stmt->execute($binds) && $stmt->rowCount() > 0) {
       $timecards = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     // Calculate total minutes worked
     $minsTotal = 0;
     foreach($timecards as $timecard) {
       $minsTotal += $timecard["time_worked"];
     }
     // Prepare update statement to set time_worked on the project
     $sql = "UPDATE projects SET time_worked = :minsTotal WHERE id = :projectid";
     $stmt = $db->prepare($sql);
     // Setup binds array
     $binds = array(
       ":minsTotal" => $minsTotal,
       ":projectid" => $projectid,
     );
     // Execute DB call and return result
     $results = "Failed to set project time worked.";
     if($stmt->execute($binds) && $stmt->rowCount > 0) {
       $results = "Successfully updated project time worked.";
     }
     return $results;
   }
?>