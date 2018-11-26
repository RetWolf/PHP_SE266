<?php
  include 'dbConnect.php';

  $id = filter_input(INPUT_POST, "id");
  switch ($id) {
    case '1':
      $name = "Donald Duck";
      break;
    case '2':
      $name = "Mickey Mouse";
      break;
    case '3':
      $name = "Goofy";
      break;
    default:
      break;
  }
  $db = getDatabase();
  $sql = "INSERT INTO DisneyVotes (DisneyCharacterID, VoterIP, VoterDateTime) VALUES (:id, :ip, now());";
  $stmt = $db->prepare($sql);
  $binds = array(
    ":id" => $id,
    ":ip" => $_SERVER['REMOTE_ADDR'],
  );
  $results = "Failed to cast vote.";
  if($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $results = "Successfully cast vote for $name";
  }
  $results = json_encode($results);
  echo $results;
?>