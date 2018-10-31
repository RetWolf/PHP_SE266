<?php 
  function createUser($username, $password) {
    $db = getDatabase();
    $stmt = $db->prepare("INSERT INTO users (username, userpassword) VALUES (:username, :userpassword);");

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $binds = array(
      ":username" => $username,
      ":userpassword" => $passwordHash,
    );

    $results = "Error Creating User - Please try again.";
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "User Successfully Created!";
    }
    return $results;
  }

  function loginUser($username, $password) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT userpassword FROM users WHERE username LIKE :username");

    $binds = array(
      ":username" => $username,
    );

    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $passwordHash = $results[0]['userpassword'];
    
    return password_verify($password, $passwordHash);
  }
?>