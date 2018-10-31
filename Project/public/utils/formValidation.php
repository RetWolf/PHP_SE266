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
    return sizeof($results) < 1 ? true : false;
  }

  function checkPasswordBool($first, $second) {
    if(strlen($first) > 6)
      return $first === $second ? true : false;
  }

  function isUserBool($username) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT username FROM users WHERE username LIKE :username");

    $binds = array(
      ":username" => $username,
    );

    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return sizeof($results) > 0 ? true : false;
  }
?>