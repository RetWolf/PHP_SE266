<?php 
  function checkUsernameBool($value) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM users WHERE username LIKE :value");

    $binds = array(
      ":value" => $value,
    );

    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function checkPasswordBool($first, $second) {
    if(strlen($first) > 6)
      return $first === $second ? true : false;
  }
?>