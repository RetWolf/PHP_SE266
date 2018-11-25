# Timecard Functions & SQL
* Create Project
 ```php
function createProject() {
  // Get values from POST request
    $projectName = filter_input(INPUT_POST, "projectName");
    $projectDetails = filter_input(INPUT_POST, "projectDetails");
  // Connect to DB
    $db = getDatabase();
  // Prepare Insert Statement
    $sql = "INSERT INTO projects (projectName, projectDetails) VALUES (:projectName, :projectDetails)";
    $stmt = $db->prepare($sql);
  // Bind data
    $binds = array(
      ":projectName" => $projectName,
      ":projectDetails" => $projectDetails,
    );
  // Execute DB call and return result
    $results = "Failed to create Project";
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "Successfully created $projectName.";
    }
    return $results;
}
```
* Get all Projects (for dynamically creating project viewer)
 ```php
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
```
* Get one Project (for editing a project)
 ```php
function getOneProject($id) {
  // Connect to DB
    $db = getDatabase();
  // Prepare Select Statement
    $sql = "SELECT * FROM projects WHERE id = :id";
    $stmt = $db->prepare($sql);
  // Bind data
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
```
* Delete project
 ```php
function deleteProject($id) {
  // Connect to DB
    $db = getDatabase();
  // Prepare Delete Statement
    $sql = "DELETE FROM projects WHERE id = :id";
    $stmt = $db->prepare($sql);
  // Bind data
    $binds = array(
      ":id" => $id,
    );
  // Execute DB call and return result
    $results = "Failed to Delete Project";
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "Succesfully deleted project.";
    }
    return $results;
}
```
* Check In
 ```php
function checkIn($projectId) {
  // Connect to DB
    $db = getDatabase();
  // Prepare Insert Statement
    $sql = "INSERT INTO timecards (projectId, checkedIn) VALUES (:projectId, now())";
    $stmt = $db->prepare($sql);
  // Bind data
    $binds = array(
      ":projectId" => $projectId,
    );
  // Execute DB call and return result
  // Need to figure out way to return timecard ID --------
    $results = "Failed to Check In";
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "Successfully Checked In";
    }
    return $results;
}
```
* Check Out
 ```php
function checkOut($timecardId) {
  // Connect to DB
    $db = getDatabase();
  // Prepare Update Statement
    $sql = "UPDATE timecards SET checkedOut = now() WHERE timecardId = :timecardId";
    $stmt = $db->prepare($sql);
  // Bind data
    $binds = array(
      ":timecardId" => $timecardId,
    );
  // Execute DB call and return results
    $results = "Failed to Check Out";
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "Successfully Checked Out";
    }
    return $results;
}
```
* Total Time Spent
 ```php
function getAllTimecards($projectId) {
  // Connect to DB
    $db = getDatabase();
  // Prepare Insert Statement
    $sql = "SELECT * FROM timecards WHERE projectId = :projectId"
    $stmt = $db->prepare($sql);
  // Bind data
    $binds = array(
      ":projectId" => $projectId,
    );
  // Execute DB call and return results
    $results = array();
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}
```