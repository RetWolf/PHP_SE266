<?php 
  function getDisneyInfo() {
    $db = getDatabase();
    $sql = "SELECT * FROM DisneyCharacters";
    $stmt = $db->prepare($sql);
    $results = array();
    if($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }
?>