<?php
  include 'dbConnect.php';
  $db = getDatabase();
  $sql = "SELECT DisneyCharacterName, COUNT(*) AS VoteCount
  FROM DisneyCharacters c LEFT OUTER JOIN DisneyVotes v ON c.DisneyCharacterID=v.DisneyCharacterID
  GROUP BY DisneyCharacterName";
  $stmt = $db->prepare($sql);
  $votes = array();
  if($stmt->execute() && $stmt->rowCount() > 0) {
    $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  $results = array();
  $results[0] = array();
  $results[1] = array();
  foreach($votes as $vote) {
    array_push($results[0], $vote['DisneyCharacterName']);
    array_push($results[1], $vote['VoteCount']);
  }
  $results = json_encode($results);
  echo $results;
?>